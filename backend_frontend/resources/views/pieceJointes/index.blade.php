@extends('layouts.app')

@section('title', 'Pièces jointes')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Pièces jointes</h1>
        <a href="{{ route('pieceJointes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Créer une pièce jointe</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Ticket</th>
                <th class="px-4 py-2 text-left">Nom du fichier</th>
                <th class="px-4 py-2 text-left">Type</th>
                <th class="px-4 py-2 text-left">Taille</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pieceJointes as $piece)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $piece->ticket_id }}</td>
                <td class="px-4 py-2">{{ $piece->nom_fichier }}</td>
                <td class="px-4 py-2">{{ $piece->type_fichier }}</td>
                <td class="px-4 py-2">{{ $piece->taille_fichier }} octets</td>
                <td class="px-4 py-2">
                    <a href="{{ route('pieceJointes.show', $piece->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('pieceJointes.edit', $piece->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
