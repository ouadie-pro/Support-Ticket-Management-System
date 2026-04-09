@extends('layouts.app')

@section('title', 'Adresse')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Adresse</h1>
        <div class="space-x-2">
            <a href="{{ route('adresses.edit', $adresse->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
            <a href="{{ route('adresses.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Retour</a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-500">Rue</label>
            <p class="text-lg">{{ $adresse->rue }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Ville</label>
            <p class="text-lg">{{ $adresse->ville }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Code postal</label>
            <p class="text-lg">{{ $adresse->code_postal }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Pays</label>
            <p class="text-lg">{{ $adresse->pays }}</p>
        </div>
    </div>
    
    <div class="mt-6 border-t pt-6">
        <form action="{{ route('adresses.destroy', $adresse->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette adresse?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
