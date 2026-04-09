@extends('layouts.app')

@section('title', 'Rôle')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Rôle</h1>
        <div class="space-x-2">
            <a href="{{ route('roles.edit', $role->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
            <a href="{{ route('roles.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Retour</a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-500">Code</label>
            <p class="text-lg font-mono">{{ $role->code }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Libellé</label>
            <p class="text-lg">{{ $role->libelle }}</p>
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-500">Description</label>
            <p class="text-lg">{{ $role->description ?? '-' }}</p>
        </div>
    </div>
    
    @if($role->permissions->count() > 0)
    <div class="mt-6">
        <label class="block text-sm font-medium text-gray-500 mb-2">Permissions</label>
        <div class="flex gap-2 flex-wrap">
            @foreach($role->permissions as $permission)
            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm">{{ $permission->libelle }}</span>
            @endforeach
        </div>
    </div>
    @endif
    
    <div class="mt-6 border-t pt-6">
        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('Êtes-vous sûr?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
