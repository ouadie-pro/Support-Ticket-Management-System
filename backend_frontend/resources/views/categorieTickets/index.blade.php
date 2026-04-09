@extends('layouts.app')

@section('title', 'Catégories de tickets')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Catégories de tickets</h1>
        <a href="{{ route('categorieTickets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Code</th>
                <th class="px-4 py-2 text-left">Libellé</th>
                <th class="px-4 py-2 text-left">SLA (heures)</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorieTickets as $categorie)
            <tr class="border-t">
                <td class="px-4 py-2 font-mono text-sm">{{ $categorie->code }}</td>
                <td class="px-4 py-2">{{ $categorie->libelle }}</td>
                <td class="px-4 py-2">{{ $categorie->sla_heures ?? '-' }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('categorieTickets.show', $categorie->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('categorieTickets.edit', $categorie->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
