<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['client', 'categorie', 'agent'])->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sujet' => 'required|string|max:255',
            'description' => 'required|string',
            'client_id' => 'required|integer',
            'categorie_id' => 'nullable|integer',
            'assigne_a' => 'nullable|integer',
            'priorite' => 'nullable|in:faible,moyenne,haute,urgente',
            'statut' => 'nullable|in:ouvert,en_cours,resolu,ferme',
        ]);

        Ticket::create($validated);
        return redirect()->route('tickets.index');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'sujet' => 'required|string|max:255',
            'description' => 'required|string',
            'client_id' => 'required|integer',
            'categorie_id' => 'nullable|integer',
            'assigne_a' => 'nullable|integer',
            'priorite' => 'nullable|in:faible,moyenne,haute,urgente',
            'statut' => 'nullable|in:ouvert,en_cours,resolu,ferme',
        ]);

        $ticket->update($validated);
        return redirect()->route('tickets.show', $ticket->id);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index');
    }
}
