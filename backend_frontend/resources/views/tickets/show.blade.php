@extends('layouts.app')

@section('title', 'Ticket')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Ticket {{ $ticket->numero }}</h1>
        <div class="space-x-2">
            <a href="{{ route('tickets.edit', $ticket->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
            <a href="{{ route('tickets.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Retour</a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-500">Numéro</label>
            <p class="text-lg font-mono">{{ $ticket->numero }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Sujet</label>
            <p class="text-lg">{{ $ticket->sujet }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Client</label>
            <p class="text-lg">{{ $ticket->client->nom ?? '-' }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Catégorie</label>
            <p class="text-lg">{{ $ticket->categorie->libelle ?? '-' }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Assigné à</label>
            <p class="text-lg">{{ $ticket->agent->nom ?? '-' }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Priorité</label>
            <span class="px-2 py-1 text-xs rounded 
                @if($ticket->priorite === 'urgente') bg-red-100 text-red-800
                @elseif($ticket->priorite === 'haute') bg-orange-100 text-orange-800
                @elseif($ticket->priorite === 'moyenne') bg-yellow-100 text-yellow-800
                @else bg-green-100 text-green-800 @endif">
                {{ $ticket->priorite }}
            </span>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Statut</label>
            <span class="px-2 py-1 text-xs rounded 
                @if($ticket->statut === 'ferme') bg-gray-100 text-gray-800
                @elseif($ticket->statut === 'resolu') bg-green-100 text-green-800
                @elseif($ticket->statut === 'en_cours') bg-blue-100 text-blue-800
                @else bg-purple-100 text-purple-800 @endif">
                {{ $ticket->statut }}
            </span>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Créé le</label>
            <p class="text-lg">{{ $ticket->created_at }}</p>
        </div>
    </div>
    
    <div class="mt-6">
        <label class="block text-sm font-medium text-gray-500 mb-2">Description</label>
        <div class="bg-gray-50 p-4 rounded">
            <p>{{ $ticket->description }}</p>
        </div>
    </div>
    
    <div class="mt-6 border-t pt-6">
        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce ticket?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
