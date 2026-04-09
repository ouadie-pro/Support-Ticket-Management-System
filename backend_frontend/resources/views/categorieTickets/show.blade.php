@extends('layouts.app')

@section('title', 'Catégorie')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Catégorie</h1>
        <div class="space-x-2">
            <a href="{{ route('categorieTickets.edit', $categorieTicket->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
            <a href="{{ route('categorieTickets.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Retour</a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-500">Code</label>
            <p class="text-lg font-mono">{{ $categorieTicket->code }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Libellé</label>
            <p class="text-lg">{{ $categorieTicket->libelle }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">SLA (heures)</label>
            <p class="text-lg">{{ $categorieTicket->sla_heures ?? '-' }}</p>
        </div>
    </div>
    
    <div class="mt-6 border-t pt-6">
        <form action="{{ route('categorieTickets.destroy', $categorieTicket->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('Êtes-vous sûr?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
