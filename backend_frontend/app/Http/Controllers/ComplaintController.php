<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\User;
use App\Models\Commentaire;
use App\Models\JournalActivite;
use App\Notifications\ComplaintStatusNotification;
use App\Notifications\ComplaintAssignedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = Complaint::with(['user', 'agent']);

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('numero', 'like', "%{$search}%")
                  ->orWhere('sujet', 'like', "%{$search}%");
            });
        }

        if ($request->has('statut') && $request->statut) {
            $query->where('statut', $request->statut);
        }

        if ($request->has('priorite') && $request->priorite) {
            $query->where('priorite', $request->priorite);
        }

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        if ($request->has('date') && $request->date) {
            $query->whereDate('created_at', $request->date);
        }

        if (!$user->isAdmin() && !$user->isAgent()) {
            $query->where('user_id', $user->id);
        }

        $complaints = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sujet' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:technique,facturation,service,autre',
            'priorite' => 'nullable|in:faible,moyenne,haute,urgente',
        ], [
            'sujet.required' => 'Le sujet est obligatoire.',
            'sujet.max' => 'Le sujet ne peut pas dépasser 255 caractères.',
            'description.required' => 'La description est obligatoire.',
            'type.required' => 'Le type de réclamation est obligatoire.',
            'type.in' => 'Le type de réclamation est invalide.',
        ]);

        $complaint = Complaint::create([
            'user_id' => Auth::id(),
            'sujet' => $validated['sujet'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'priorite' => $validated['priorite'] ?? 'moyenne',
            'statut' => 'soumis',
        ]);

        JournalActivite::create([
            'utilisateur_id' => Auth::id(),
            'action' => 'create',
            'objet_type' => Complaint::class,
            'objet_id' => $complaint->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $admins = User::whereHas('role', function($q) {
            $q->where('code', 'admin');
        })->get();

        foreach ($admins as $admin) {
            $admin->notify(new \App\Notifications\NewCommentNotification(
                (object)['contenu' => "Nouvelle réclamation créée: {$complaint->sujet}"],
                'complaint',
                $complaint->sujet
            ));
        }

        return redirect()->route('complaints.show', $complaint->id)->with('success', 'Réclamation soumise avec succès.');
    }

    public function show(Complaint $complaint)
    {
        $user = Auth::user();
        
        if (!$user->isAdmin() && !$user->isAgent() && $complaint->user_id !== $user->id) {
            abort(403, 'Accès non autorisé à cette réclamation.');
        }
        
        $complaint->load(['user', 'agent', 'comments.utilisateur']);
        
        $agents = User::whereHas('role', function($q) {
            $q->where('code', 'agent');
        })->orWhereHas('role', function($q) {
            $q->where('code', 'admin');
        })->get();

        $reponsePredefinies = \App\Models\ReponsePredefinie::all();

        return view('complaints.show', compact('complaint', 'agents', 'reponsePredefinies'));
    }

    public function edit(Complaint $complaint)
    {
        $this->authorizeComplaint($complaint);
        return view('complaints.edit', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        $this->authorizeComplaint($complaint);

        $validated = $request->validate([
            'sujet' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:technique,facturation,service,autre',
            'priorite' => 'nullable|in:faible,moyenne,haute,urgente',
        ]);

        $donneesAvant = $complaint->toArray();

        $complaint->update($validated);

        JournalActivite::create([
            'utilisateur_id' => Auth::id(),
            'action' => 'update',
            'objet_type' => Complaint::class,
            'objet_id' => $complaint->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'donnees_avant' => $donneesAvant,
            'donnees_apres' => $complaint->toArray(),
        ]);

        return redirect()->route('complaints.show', $complaint->id)->with('success', 'Réclamation mise à jour.');
    }

    public function destroy(Request $request, Complaint $complaint)
    {
        $this->authorizeComplaint($complaint);

        JournalActivite::create([
            'utilisateur_id' => Auth::id(),
            'action' => 'delete',
            'objet_type' => Complaint::class,
            'objet_id' => $complaint->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'donnees_avant' => $complaint->toArray(),
        ]);

        $complaint->delete();
        return redirect()->route('complaints.index')->with('success', 'Réclamation supprimée.');
    }

    public function assign(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'traite_par' => 'nullable|exists:users,id',
        ]);

        $donneesAvant = $complaint->toArray();

        $complaint->update([
            'traite_par' => $validated['traite_par'],
            'statut' => $validated['traite_par'] ? 'en_attente' : $complaint->statut,
        ]);

        JournalActivite::create([
            'utilisateur_id' => Auth::id(),
            'action' => 'assigned',
            'objet_type' => Complaint::class,
            'objet_id' => $complaint->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'donnees_avant' => ['traite_par' => $donneesAvant['traite_par'] ?? null],
            'donnees_apres' => ['traite_par' => $validated['traite_par']],
        ]);

        if ($validated['traite_par']) {
            $agent = User::find($validated['traite_par']);
            if ($agent) {
                $agent->notify(new ComplaintAssignedNotification($complaint));
            }
        }

        return back()->with('success', 'Réclamation assignée.');
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'statut' => 'required|in:soumis,en_attente,en_cours,resolu,rejete',
        ]);

        $donneesAvant = $complaint->toArray();
        $ancienStatut = $complaint->statut;

        $complaint->update(['statut' => $validated['statut']]);

        JournalActivite::create([
            'utilisateur_id' => Auth::id(),
            'action' => 'status_changed',
            'objet_type' => Complaint::class,
            'objet_id' => $complaint->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'donnees_avant' => ['statut' => $ancienStatut],
            'donnees_apres' => ['statut' => $validated['statut']],
        ]);

        if ($complaint->user && $complaint->user->id !== Auth::id()) {
            $complaint->user->notify(new ComplaintStatusNotification($complaint, $ancienStatut, $validated['statut']));
        }

        return back()->with('success', 'Statut mis à jour.');
    }

    public function updatePriority(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'priorite' => 'required|in:faible,moyenne,haute,urgente',
        ]);

        $donneesAvant = $complaint->toArray();

        $complaint->update(['priorite' => $validated['priorite']]);

        JournalActivite::create([
            'utilisateur_id' => Auth::id(),
            'action' => 'priority_changed',
            'objet_type' => Complaint::class,
            'objet_id' => $complaint->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'donnees_avant' => ['priorite' => $donneesAvant['priorite']],
            'donnees_apres' => ['priorite' => $validated['priorite']],
        ]);

        if ($complaint->user && $complaint->user->id !== Auth::id()) {
            $complaint->user->notify(new \App\Notifications\NewCommentNotification(
                (object)['contenu' => "La priorité de votre réclamation a été changée à: {$validated['priorite']}"],
                'complaint',
                $complaint->sujet
            ));
        }

        return back()->with('success', 'Priorité mise à jour.');
    }

    public function resolve(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'resolution' => 'required|string',
        ]);

        $donneesAvant = $complaint->toArray();

        $complaint->update([
            'statut' => 'resolu',
            'resolution' => $validated['resolution'],
            'date_resolution' => now(),
        ]);

        JournalActivite::create([
            'utilisateur_id' => Auth::id(),
            'action' => 'resolved',
            'objet_type' => Complaint::class,
            'objet_id' => $complaint->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'donnees_avant' => $donneesAvant,
            'donnees_apres' => $complaint->toArray(),
        ]);

        if ($complaint->user && $complaint->user->id !== Auth::id()) {
            $complaint->user->notify(new ComplaintStatusNotification($complaint, $donneesAvant['statut'], 'resolu'));
        }

        return back()->with('success', 'Réclamation résolue.');
    }

    protected function authorizeComplaint(Complaint $complaint)
    {
        $user = Auth::user();
        
        if (!$user->isAdmin() && !$user->isAgent() && $complaint->user_id !== $user->id) {
            abort(403, 'Accès non autorisé.');
        }
    }
}
