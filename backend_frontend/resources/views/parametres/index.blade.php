@extends('layouts.app')

@section('title', 'Paramètres')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Paramètres</h1>
        <a href="{{ route('parametres.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Créer un paramètre</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Clé</th>
                <th class="px-4 py-2 text-left">Valeur</th>
                <th class="px-4 py-2 text-left">Description</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parametres as $parametre)
            <tr class="border-t">
                <td class="px-4 py-2 font-mono text-sm">{{ $parametre->cle }}</td>
                <td class="px-4 py-2">{{ $parametre->valeur }}</td>
                <td class="px-4 py-2">{{ Str::limit($parametre->description, 50) }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('parametres.show', $parametre->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('parametres.edit', $parametre->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
