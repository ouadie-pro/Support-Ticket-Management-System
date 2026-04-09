@extends('layouts.app')

@section('title', 'Utilisateurs')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Utilisateurs</h1>
        <a href="{{ route('utilisateurs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Nom</th>
                <th class="px-4 py-2 text-left">Prénom</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Téléphone</th>
                <th class="px-4 py-2 text-left">État</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($utilisateurs as $utilisateur)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $utilisateur->nom }}</td>
                <td class="px-4 py-2">{{ $utilisateur->prenom }}</td>
                <td class="px-4 py-2">{{ $utilisateur->email }}</td>
                <td class="px-4 py-2">{{ $utilisateur->telephone }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 text-xs rounded {{ $utilisateur->etat === 'actif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $utilisateur->etat }}
                    </span>
                </td>
                <td class="px-4 py-2">
                    <a href="{{ route('utilisateurs.show', $utilisateur->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('utilisateurs.edit', $utilisateur->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
