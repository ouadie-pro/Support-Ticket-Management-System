<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Commentaire;
use App\Models\JournalActivite;
use App\Notifications\NewCommentNotification;
use App\Notifications\TicketStatusNotification;
use App\Notifications\TicketAssignedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with(['client', 'categorie', 'agent']);

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

        if ($request->has('date') && $request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $user = Auth::user();
        if ($user->isClient()) {
            $query->where('user_id', $user->id);
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $categories = \App\Models\CategorieTicket::all();
        
        $user = Auth::user();
        if ($user->isAdmin() || $user->isAgent()) {
            $agents = User::whereHas('role', function($q) {
                $q->where('code', 'agent');
            })->get();
            return view('tickets.create', compact('categories', 'agents'));
        }
        
        return view('tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sujet' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'nullable|exists:categorie_tickets,id',
            'priorite' => 'nullable|in:faible,moyenne,haute,urgente',
        ], [
            'sujet.required' => 'Le sujet est obligatoire.',
            'sujet.max' => 'Le sujet ne peut pas dépasser 255 caractères.',
            'description.required' => 'La description est obligatoire.',
        ]);

        $ticket = Ticket::create([
            'sujet' => $validated['sujet'],
            'description' => $validated['description'],
            'user_id' => Auth::id(),
            'categorie_id' => $validated['categorie_id'] ?? null,
            'priorite' => $validated['priorite'] ?? 'moyenne',
            'statut' => 'ouvert',
        ]);

        JournalActivite::create([
            'utilisateur_id' => Auth::id(),
            'action' => 'create',
            'objet_type' => Ticket::class,
            'objet_id' => $ticket->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $admins = User::whereHas('role', function($q) {
            $q->where('code', 'admin');
        })->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewCommentNotification(
                (object)['contenu' => "Nouveau ticket créé: {$ticket->sujet}"],
                'ticket',
                $ticket->sujet
            ));
        }

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Ticket créé avec succès.');
    }

    public function show(Ticket $ticket)
    {
        $user = Auth::user();
        
        if ($user->isClient() && $ticket->user_id !== $user->id) {
            abort(403, 'Accès non autorisé à ce ticket.');
        }
        
        $ticket->load(['client', 'categorie', 'agent', 'commentaires.utilisateur']);
        
        $agents = User::whereHas('role', function($q) {
            $q->where('code', 'agent');
        })->get();

        $reponsePredefinies = \App\Models\ReponsePredefinie::all();

        return view('tickets.show', compact('ticket', 'agents', 'reponsePredefinies'));
    }

    public function edit(Ticket $ticket)
    {
        $this->authorizeTicket($ticket);
        
        $agents = User::whereHas('role', function($q) {
            $q->where('code', 'agent');
        })->get();

        $categories = \App\Models\CategorieTicket::all();

        return view('tickets.edit', compact('ticket', 'agents', 'categories'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $this->authorizeTicket($ticket);

        $validated = $request->validate([
            'sujet' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'nullable|exists:categorie_tickets,id',
            'assigne_a' => 'nullable|exists:users,id',
            'priorite' => 'nullable|in:faible,moyenne,haute,urgente',
            'statut' => 'nullable|in:ouvert,en_cours,resolu,ferme',
        ]);

        $donneesAvant = $ticket->toArray();

        $ticket->update($validated);

        JournalActivite::create([
            'utilisateur_id' => Auth::id(),
            'action' => 'update',
            'objet_type' => Ticket::class,
            'objet_id' => $ticket->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'donnees_avant' => $donneesAvant,
            'donnees_apres' => $ticket->toArray(),
        ]);

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Ticket mis à jour.');
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'statut' => 'required|in:ouvert,en_cours,resolu,ferme',
        ]);

        $donneesAvant = $ticket->toArray();
        $ancienStatut = $ticket->statut;

        $ticket->update(['statut' => $validated['statut']]);

        JournalActivite::create([
            'utilisateur_id' => Auth::id(),
            'action' => 'status_changed',
            'objet_type' => Ticket::class,
            'objet_id' => $ticket->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'donnees_avant' => ['statut' => $ancienStatut],
            'donnees_apres' => ['statut' => $validated['statut']],
        ]);

        if ($ticket->client && $ticket->client->user) {
            $ticket->client->user->notify(new TicketStatusNotification($ticket, $ancienStatut, $validated['statut']));
        }

        return back()->with('success', 'Statut mis à jour.');
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'assigne_a' => 'nullable|exists:users,id',
        ]);

        $donneesAvant = $ticket->toArray();

        $ticket->update([
            'assigne_a' => $validated['assigne_a'],
            'statut' => $validated['assigne_a'] ? 'en_cours' : $ticket->statut,
        ]);

        JournalActivite::create([
            'utilisateur_id' => Auth::id(),
            'action' => 'assigned',
            'objet_type' => Ticket::class,
            'objet_id' => $ticket->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'donnees_avant' => ['assigne_a' => $donneesAvant['assigne_a'] ?? null],
            'donnees_apres' => ['assigne_a' => $validated['assigne_a']],
        ]);

        if ($validated['assigne_a']) {
            $agent = User::find($validated['assigne_a']);
            if ($agent) {
                $agent->notify(new TicketAssignedNotification($ticket));
            }
        }

        return back()->with('success', 'Ticket assigné avec succès.');
    }

    public function destroy(Request $request, Ticket $ticket)
    {
        $this->authorizeTicket($ticket);

        JournalActivite::create([
            'utilisateur_id' => Auth::id(),
            'action' => 'delete',
            'objet_type' => Ticket::class,
            'objet_id' => $ticket->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'donnees_avant' => $ticket->toArray(),
        ]);

        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket supprimé.');
    }

    protected function authorizeTicket(Ticket $ticket)
    {
        $user = Auth::user();
        
        if ($user->isAdmin() || $user->isAgent()) {
            return true;
        }
        
        if ($ticket->user_id && $ticket->user_id === $user->id) {
            return true;
        }
        
        abort(403, 'Accès non autorisé.');
    }
}
