@extends('layouts.app')

@section('title', 'Modifier la pièce jointe')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Modifier la pièce jointe</h1>
    
    <form action="{{ route('pieceJointes.update', $piece->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Ticket</label>
                <input type="number" name="ticket_id" value="{{ $piece->ticket_id }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Nom du fichier</label>
                <input type="text" name="nom_fichier" value="{{ $piece->nom_fichier }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Chemin du fichier</label>
                <input type="text" name="chemin_fichier" value="{{ $piece->chemin_fichier }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Type de fichier</label>
                <input type="text" name="type_fichier" value="{{ $piece->type_fichier }}" class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Taille du fichier</label>
                <input type="number" name="taille_fichier" value="{{ $piece->taille_fichier }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>
        
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mettre à jour</button>
            <a href="{{ route('pieceJointes.show', $piece->id) }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
        </div>
    </form>
</div>
@endsection
