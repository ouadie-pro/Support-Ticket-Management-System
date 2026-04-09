@extends('layouts.app')

@section('title', 'Créer une permission')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Créer une permission</h1>
    
    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Code</label>
                <input type="text" name="code" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Libellé</label>
                <input type="text" name="libelle" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
            </div>
        </div>
        
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>
            <a href="{{ route('permissions.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
        </div>
    </form>
</div>
@endsection
