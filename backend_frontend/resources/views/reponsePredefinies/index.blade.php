@extends('layouts.app')

@section('title', 'Réponses prédéfinies')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Réponses prédéfinies</h1>
        <a href="{{ route('reponsePredefinies.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Créer une réponse</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Titre</th>
                <th class="px-4 py-2 text-left">Catégorie</th>
                <th class="px-4 py-2 text-left">Contenu</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reponsePredefinies as $reponse)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $reponse->titre }}</td>
                <td class="px-4 py-2">{{ $reponse->categorie_id }}</td>
                <td class="px-4 py-2">{{ Str::limit($reponse->contenu, 50) }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('reponsePredefinies.show', $reponse->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('reponsePredefinies.edit', $reponse->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
