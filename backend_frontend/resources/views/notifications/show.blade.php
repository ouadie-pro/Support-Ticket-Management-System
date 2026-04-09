@extends('layouts.app')

@section('title', 'Notification')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Notification</h1>
        <div class="space-x-2">
            <a href="{{ route('notifications.edit', $notification->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
            <a href="{{ route('notifications.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Retour</a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-500">Utilisateur</label>
            <p class="text-lg">{{ $notification->utilisateur_id }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Titre</label>
            <p class="text-lg">{{ $notification->titre }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Lu</label>
            <span class="px-2 py-1 text-xs rounded {{ $notification->lu ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                {{ $notification->lu ? 'Lu' : 'Non lu' }}
            </span>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Date d'envoi</label>
            <p class="text-lg">{{ $notification->date_envoi }}</p>
        </div>
    </div>
    
    <div class="mt-6">
        <label class="block text-sm font-medium text-gray-500 mb-2">Message</label>
        <div class="bg-gray-50 p-4 rounded">
            <p>{{ $notification->message }}</p>
        </div>
    </div>
    
    <div class="mt-6 border-t pt-6">
        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette notification?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
