@extends('layouts.app')

@section('title', 'Escalade')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Escalade</h1>
        <div class="space-x-2">
            <a href="{{ route('escalades.edit', $escalade->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
            <a href="{{ route('escalades.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Retour</a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-500">Ticket</label>
            <p class="text-lg">{{ $escalade->ticket_id }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">De (utilisateur)</label>
            <p class="text-lg">{{ $escalade->de_utilisateur_id }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Vers (utilisateur)</label>
            <p class="text-lg">{{ $escalade->vers_utilisateur_id }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Date d'escalade</label>
            <p class="text-lg">{{ $escalade->date_escalade }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Statut</label>
            <span class="px-2 py-1 text-xs rounded 
                @if($escalade->statut === 'resolue') bg-green-100 text-green-800
                @elseif($escalade->statut === 'rejetee') bg-red-100 text-red-800
                @else bg-yellow-100 text-yellow-800 @endif">
                {{ $escalade->statut }}
            </span>
        </div>
    </div>
    
    <div class="mt-6">
        <label class="block text-sm font-medium text-gray-500 mb-2">Motif</label>
        <div class="bg-gray-50 p-4 rounded">
            <p>{{ $escalade->motif }}</p>
        </div>
    </div>
    
    <div class="mt-6 border-t pt-6">
        <form action="{{ route('escalades.destroy', $escalade->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette escalade?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
