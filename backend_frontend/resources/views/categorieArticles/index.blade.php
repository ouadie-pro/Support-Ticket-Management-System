@extends('layouts.app')

@section('title', 'Catégories d\'articles')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Catégories d'articles</h1>
        <a href="{{ route('categorieArticles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Créer une catégorie</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Code</th>
                <th class="px-4 py-2 text-left">Libellé</th>
                <th class="px-4 py-2 text-left">Description</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorieArticles as $categorie)
            <tr class="border-t">
                <td class="px-4 py-2 font-mono text-sm">{{ $categorie->code }}</td>
                <td class="px-4 py-2">{{ $categorie->libelle }}</td>
                <td class="px-4 py-2">{{ Str::limit($categorie->description, 50) }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('categorieArticles.show', $categorie->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('categorieArticles.edit', $categorie->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
