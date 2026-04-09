@extends('layouts.app')

@section('title', 'Rôles')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Rôles</h1>
        <a href="{{ route('roles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Code</th>
                <th class="px-4 py-2 text-left">Libellé</th>
                <th class="px-4 py-2 text-left">Description</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr class="border-t">
                <td class="px-4 py-2 font-mono text-sm">{{ $role->code }}</td>
                <td class="px-4 py-2">{{ $role->libelle }}</td>
                <td class="px-4 py-2">{{ $role->description }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('roles.show', $role->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('roles.edit', $role->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
