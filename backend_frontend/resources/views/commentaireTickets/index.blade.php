@extends('layouts.app')

@section('title', 'Commentaires de tickets')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Commentaires de tickets</h1>
        <a href="{{ route('commentaireTickets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Créer un commentaire</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Ticket</th>
                <th class="px-4 py-2 text-left">Utilisateur</th>
                <th class="px-4 py-2 text-left">Contenu</th>
                <th class="px-4 py-2 text-left">Date</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commentaireTickets as $commentaire)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $commentaire->ticket_id }}</td>
                <td class="px-4 py-2">{{ $commentaire->utilisateur_id }}</td>
                <td class="px-4 py-2">{{ Str::limit($commentaire->contenu, 50) }}</td>
                <td class="px-4 py-2">{{ $commentaire->date_commentaire }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('commentaireTickets.show', $commentaire->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('commentaireTickets.edit', $commentaire->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
