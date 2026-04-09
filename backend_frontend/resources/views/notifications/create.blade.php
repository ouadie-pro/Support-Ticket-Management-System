@extends('layouts.app')

@section('title', 'Créer une notification')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Créer une notification</h1>
    
    <form action="{{ route('notifications.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Utilisateur</label>
                <input type="number" name="utilisateur_id" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Titre</label>
                <input type="text" name="titre" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Message</label>
                <textarea name="message" required rows="4" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Lu</label>
                <select name="lu" class="w-full border rounded px-3 py-2">
                    <option value="0">Non</option>
                    <option value="1">Oui</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Date d'envoi</label>
                <input type="datetime-local" name="date_envoi" class="w-full border rounded px-3 py-2">
            </div>
        </div>
        
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>
            <a href="{{ route('notifications.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
        </div>
    </form>
</div>
@endsection
