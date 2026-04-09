@extends('layouts.app')

@section('title', 'Évaluations de satisfaction')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Évaluations de satisfaction</h1>
        <a href="{{ route('satisfactions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Créer une évaluation</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Ticket</th>
                <th class="px-4 py-2 text-left">Client</th>
                <th class="px-4 py-2 text-left">Note</th>
                <th class="px-4 py-2 text-left">Commentaire</th>
                <th class="px-4 py-2 text-left">Date</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($satisfactions as $satisfaction)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $satisfaction->ticket_id }}</td>
                <td class="px-4 py-2">{{ $satisfaction->client_id }}</td>
                <td class="px-4 py-2">{{ $satisfaction->note }}</td>
                <td class="px-4 py-2">{{ $satisfaction->commentaire }}</td>
                <td class="px-4 py-2">{{ $satisfaction->date_evaluation }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('satisfactions.show', $satisfaction->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('satisfactions.edit', $satisfaction->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
