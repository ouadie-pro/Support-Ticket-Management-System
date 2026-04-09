@extends('layouts.app')

@section('title', 'Réponse prédéfinie')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Réponse prédéfinie</h1>
        <div class="space-x-2">
            <a href="{{ route('reponsePredefinies.edit', $reponse->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
            <a href="{{ route('reponsePredefinies.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Retour</a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-500">Titre</label>
            <p class="text-lg">{{ $reponse->titre }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Catégorie</label>
            <p class="text-lg">{{ $reponse->categorie_id }}</p>
        </div>
    </div>
    
    <div class="mt-6">
        <label class="block text-sm font-medium text-gray-500 mb-2">Contenu</label>
        <div class="bg-gray-50 p-4 rounded">
            <p>{{ $reponse->contenu }}</p>
        </div>
    </div>
    
    <div class="mt-6 border-t pt-6">
        <form action="{{ route('reponsePredefinies.destroy', $reponse->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réponse?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
