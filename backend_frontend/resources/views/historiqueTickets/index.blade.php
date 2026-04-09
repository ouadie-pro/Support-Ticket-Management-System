@extends('layouts.app')

@section('title', 'Historique des tickets')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Historique des tickets</h1>
        <a href="{{ route('historiqueTickets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Créer une entrée</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Ticket</th>
                <th class="px-4 py-2 text-left">Utilisateur</th>
                <th class="px-4 py-2 text-left">Action</th>
                <th class="px-4 py-2 text-left">Date</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($historiqueTickets as $historique)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $historique->ticket_id }}</td>
                <td class="px-4 py-2">{{ $historique->utilisateur_id }}</td>
                <td class="px-4 py-2">{{ $historique->action }}</td>
                <td class="px-4 py-2">{{ $historique->date_action }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('historiqueTickets.show', $historique->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('historiqueTickets.edit', $historique->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
