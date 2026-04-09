<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin() || $user->isAgent()) {
            $complaints = Complaint::with(['user', 'agent'])->paginate(15);
        } else {
            $complaints = Complaint::where('user_id', $user->id)->paginate(15);
        }
        
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
        ]);

        Complaint::create([
            'user_id' => Auth::id(),
            'sujet' => $validated['sujet'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'priorite' => $validated['priorite'] ?? 'moyenne',
        ]);

        return redirect()->route('complaints.index')->with('success', 'Réclamation soumise avec succès.');
    }

    public function show(Complaint $complaint)
    {
        $complaint->load(['user', 'agent', 'comments']);
        return view('complaints.show', compact('complaint'));
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

        $complaint->update($validated);

        return redirect()->route('complaints.show', $complaint->id);
    }

    public function destroy(Complaint $complaint)
    {
        $this->authorizeComplaint($complaint);
        $complaint->delete();
        return redirect()->route('complaints.index');
    }

    public function assign(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'traite_par' => 'required|exists:users,id',
        ]);

        $complaint->update([
            'traite_par' => $validated['traite_par'],
            'statut' => 'en_attente',
        ]);

        return back()->with('success', 'Réclamation assignée.');
    }

    public function resolve(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'resolution' => 'required|string',
        ]);

        $complaint->update([
            'statut' => 'resolu',
            'resolution' => $validated['resolution'],
            'date_resolution' => now(),
        ]);

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
