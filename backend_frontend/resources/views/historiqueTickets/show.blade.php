@extends('layouts.app')

@section('title', 'Historique de ticket')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Historique de ticket</h1>
        <div class="space-x-2">
            <a href="{{ route('historiqueTickets.edit', $historique->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
            <a href="{{ route('historiqueTickets.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Retour</a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-500">Ticket</label>
            <p class="text-lg">{{ $historique->ticket_id }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Utilisateur</label>
            <p class="text-lg">{{ $historique->utilisateur_id }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Action</label>
            <p class="text-lg">{{ $historique->action }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Date d'action</label>
            <p class="text-lg">{{ $historique->date_action }}</p>
        </div>
    </div>
    
    <div class="mt-6">
        <label class="block text-sm font-medium text-gray-500 mb-2">Détails</label>
        <div class="bg-gray-50 p-4 rounded">
            <p>{{ $historique->details }}</p>
        </div>
    </div>
    
    <div class="mt-6 border-t pt-6">
        <form action="{{ route('historiqueTickets.destroy', $historique->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet historique?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
