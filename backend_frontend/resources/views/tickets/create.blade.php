@extends('layouts.app')

@section('title', 'Créer un ticket')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Créer un ticket</h1>
    
    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Sujet</label>
                <input type="text" name="sujet" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Client</label>
                <input type="number" name="client_id" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Catégorie</label>
                <input type="number" name="categorie_id" class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Assigné à</label>
                <input type="number" name="assigne_a" class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Priorité</label>
                <select name="priorite" class="w-full border rounded px-3 py-2">
                    <option value="faible">Faible</option>
                    <option value="moyenne" selected>Moyenne</option>
                    <option value="haute">Haute</option>
                    <option value="urgente">Urgente</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Statut</label>
                <select name="statut" class="w-full border rounded px-3 py-2">
                    <option value="ouvert" selected>Ouvert</option>
                    <option value="en_cours">En cours</option>
                    <option value="resolu">Résolu</option>
                    <option value="ferme">Fermé</option>
                </select>
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="description" required rows="4" class="w-full border rounded px-3 py-2"></textarea>
            </div>
        </div>
        
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>
            <a href="{{ route('tickets.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
        </div>
    </form>
</div>
@endsection
