@extends('layouts.app')

@section('title', 'SLAs')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">SLAs</h1>
        <a href="{{ route('slas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Nom</th>
                <th class="px-4 py-2 text-left">Temps de réponse (min)</th>
                <th class="px-4 py-2 text-left">Temps de résolution (min)</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($slas as $sla)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $sla->nom }}</td>
                <td class="px-4 py-2">{{ $sla->temps_reponse_min }}</td>
                <td class="px-4 py-2">{{ $sla->temps_resolution_min }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('slas.show', $sla->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('slas.edit', $sla->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
