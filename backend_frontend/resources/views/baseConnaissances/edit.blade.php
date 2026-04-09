@extends('layouts.app')

@section('title', 'Modifier l\'article de connaissance')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Modifier l'article de connaissance</h1>
    
    <form action="{{ route('baseConnaissances.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Titre</label>
                <input type="text" name="titre" value="{{ $article->titre }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Catégorie d'article</label>
                <input type="number" name="categorie_article_id" value="{{ $article->categorie_article_id }}" class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Statut</label>
                <select name="statut" class="w-full border rounded px-3 py-2">
                    <option value="brouillon" {{ $article->statut === 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                    <option value="publie" {{ $article->statut === 'publie' ? 'selected' : '' }}>Publié</option>
                    <option value="archive" {{ $article->statut === 'archive' ? 'selected' : '' }}>Archivé</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Date de publication</label>
                <input type="date" name="date_publication" value="{{ $article->date_publication }}" class="w-full border rounded px-3 py-2">
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Contenu</label>
                <textarea name="contenu" required rows="10" class="w-full border rounded px-3 py-2">{{ $article->contenu }}</textarea>
            </div>
        </div>
        
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mettre à jour</button>
            <a href="{{ route('baseConnaissances.show', $article->id) }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
        </div>
    </form>
</div>
@endsection
