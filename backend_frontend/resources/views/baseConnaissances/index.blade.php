@extends('layouts.app')

@section('title', 'Base de connaissances')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Base de connaissances</h1>
        <a href="{{ route('baseConnaissances.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Créer un article</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Titre</th>
                <th class="px-4 py-2 text-left">Catégorie</th>
                <th class="px-4 py-2 text-left">Statut</th>
                <th class="px-4 py-2 text-left">Date de publication</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($baseConnaissances as $article)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $article->titre }}</td>
                <td class="px-4 py-2">{{ $article->categorie_article_id }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 text-xs rounded 
                        @if($article->statut === 'publie') bg-green-100 text-green-800
                        @elseif($article->statut === 'archive') bg-gray-100 text-gray-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        {{ $article->statut }}
                    </span>
                </td>
                <td class="px-4 py-2">{{ $article->date_publication }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('baseConnaissances.show', $article->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('baseConnaissances.edit', $article->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
