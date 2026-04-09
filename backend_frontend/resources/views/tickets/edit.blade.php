@extends('layouts.app')

@section('title', 'Modifier le ticket')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Modifier le ticket</h1>
    
    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Sujet</label>
                <input type="text" name="sujet" value="{{ $ticket->sujet }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Client ID</label>
                <input type="number" name="client_id" value="{{ $ticket->client_id }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Catégorie ID</label>
                <input type="number" name="categorie_id" value="{{ $ticket->categorie_id }}" class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Assigné à ID</label>
                <input type="number" name="assigne_a" value="{{ $ticket->assigne_a }}" class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Priorité</label>
                <select name="priorite" class="w-full border rounded px-3 py-2">
                    <option value="faible" {{ $ticket->priorite === 'faible' ? 'selected' : '' }}>Faible</option>
                    <option value="moyenne" {{ $ticket->priorite === 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                    <option value="haute" {{ $ticket->priorite === 'haute' ? 'selected' : '' }}>Haute</option>
                    <option value="urgente" {{ $ticket->priorite === 'urgente' ? 'selected' : '' }}>Urgente</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Statut</label>
                <select name="statut" class="w-full border rounded px-3 py-2">
                    <option value="ouvert" {{ $ticket->statut === 'ouvert' ? 'selected' : '' }}>Ouvert</option>
                    <option value="en_cours" {{ $ticket->statut === 'en_cours' ? 'selected' : '' }}>En cours</option>
                    <option value="resolu" {{ $ticket->statut === 'resolu' ? 'selected' : '' }}>Résolu</option>
                    <option value="ferme" {{ $ticket->statut === 'ferme' ? 'selected' : '' }}>Fermé</option>
                </select>
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="description" required rows="4" class="w-full border rounded px-3 py-2">{{ $ticket->description }}</textarea>
            </div>
        </div>
        
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mettre à jour</button>
            <a href="{{ route('tickets.show', $ticket->id) }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
        </div>
    </form>
</div>
@endsection
