@extends('layouts.app')

@section('title', 'Créer une escalade')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Créer une escalade</h1>
    
    <form action="{{ route('escalades.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Ticket</label>
                <input type="number" name="ticket_id" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">De (utilisateur)</label>
                <input type="number" name="de_utilisateur_id" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Vers (utilisateur)</label>
                <input type="number" name="vers_utilisateur_id" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Statut</label>
                <select name="statut" class="w-full border rounded px-3 py-2">
                    <option value="en_attente">En attente</option>
                    <option value="resolue">Résolue</option>
                    <option value="rejetee">Rejetée</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Date d'escalade</label>
                <input type="datetime-local" name="date_escalade" class="w-full border rounded px-3 py-2">
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Motif</label>
                <textarea name="motif" required rows="4" class="w-full border rounded px-3 py-2"></textarea>
            </div>
        </div>
        
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>
            <a href="{{ route('escalades.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
        </div>
    </form>
</div>
@endsection
