@extends('layouts.app')

@section('title', 'Pièce jointe')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Pièce jointe</h1>
        <div class="space-x-2">
            <a href="{{ route('pieceJointes.edit', $piece->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
            <a href="{{ route('pieceJointes.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Retour</a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-500">Ticket</label>
            <p class="text-lg">{{ $piece->ticket_id }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Nom du fichier</label>
            <p class="text-lg">{{ $piece->nom_fichier }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Chemin du fichier</label>
            <p class="text-lg">{{ $piece->chemin_fichier }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Type de fichier</label>
            <p class="text-lg">{{ $piece->type_fichier }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Taille du fichier</label>
            <p class="text-lg">{{ $piece->taille_fichier }} octets</p>
        </div>
    </div>
    
    <div class="mt-6 border-t pt-6">
        <form action="{{ route('pieceJointes.destroy', $piece->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette pièce jointe?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
