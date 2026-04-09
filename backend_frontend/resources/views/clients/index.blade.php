@extends('layouts.app')

@section('title', 'Clients')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Clients</h1>
        <a href="{{ route('clients.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Code</th>
                <th class="px-4 py-2 text-left">Nom</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Téléphone</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr class="border-t">
                <td class="px-4 py-2 font-mono text-sm">{{ $client->code }}</td>
                <td class="px-4 py-2">{{ $client->nom }}</td>
                <td class="px-4 py-2">{{ $client->email }}</td>
                <td class="px-4 py-2">{{ $client->telephone }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('clients.show', $client->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('clients.edit', $client->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
