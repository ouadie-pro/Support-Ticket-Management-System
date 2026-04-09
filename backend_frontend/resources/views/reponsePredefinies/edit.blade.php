@extends('layouts.app')

@section('title', 'Modifier la réponse prédéfinie')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Modifier la réponse prédéfinie</h1>
    
    <form action="{{ route('reponsePredefinies.update', $reponse->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Titre</label>
                <input type="text" name="titre" value="{{ $reponse->titre }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Catégorie</label>
                <input type="number" name="categorie_id" value="{{ $reponse->categorie_id }}" class="w-full border rounded px-3 py-2">
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Contenu</label>
                <textarea name="contenu" required rows="6" class="w-full border rounded px-3 py-2">{{ $reponse->contenu }}</textarea>
            </div>
        </div>
        
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mettre à jour</button>
            <a href="{{ route('reponsePredefinies.show', $reponse->id) }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
        </div>
    </form>
</div>
@endsection
