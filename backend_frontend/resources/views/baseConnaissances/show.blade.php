@extends('layouts.app')

@section('title', 'Article de connaissance')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Article de connaissance</h1>
        <div class="space-x-2">
            <a href="{{ route('baseConnaissances.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
            <a href="{{ route('baseConnaissances.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Retour</a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-500">Titre</label>
            <p class="text-xl font-bold">{{ $article->titre }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Catégorie d'article</label>
            <p class="text-lg">{{ $article->categorie_article_id }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Date de publication</label>
            <p class="text-lg">{{ $article->date_publication }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Statut</label>
            <span class="px-2 py-1 text-xs rounded 
                @if($article->statut === 'publie') bg-green-100 text-green-800
                @elseif($article->statut === 'archive') bg-gray-100 text-gray-800
                @else bg-yellow-100 text-yellow-800 @endif">
                {{ $article->statut }}
            </span>
        </div>
    </div>
    
    <div class="mt-6">
        <label class="block text-sm font-medium text-gray-500 mb-2">Contenu</label>
        <div class="bg-gray-50 p-4 rounded">
            <p>{{ $article->contenu }}</p>
        </div>
    </div>
    
    <div class="mt-6 border-t pt-6">
        <form action="{{ route('baseConnaissances.destroy', $article->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
