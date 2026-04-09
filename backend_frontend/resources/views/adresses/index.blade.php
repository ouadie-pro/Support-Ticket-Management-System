@extends('layouts.app')

@section('title', 'Adresses')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Adresses</h1>
        <a href="{{ route('adresses.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Créer une adresse</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Rue</th>
                <th class="px-4 py-2 text-left">Ville</th>
                <th class="px-4 py-2 text-left">Code postal</th>
                <th class="px-4 py-2 text-left">Pays</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adresses as $adresse)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $adresse->rue }}</td>
                <td class="px-4 py-2">{{ $adresse->ville }}</td>
                <td class="px-4 py-2">{{ $adresse->code_postal }}</td>
                <td class="px-4 py-2">{{ $adresse->pays }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('adresses.show', $adresse->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('adresses.edit', $adresse->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
