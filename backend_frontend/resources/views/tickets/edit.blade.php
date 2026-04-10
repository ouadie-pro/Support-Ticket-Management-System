@extends('layouts.app')

@section('title', 'Modifier le ticket')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
        <h1 class="text-lg sm:text-2xl font-bold mb-4 sm:mb-6">Modifier le ticket</h1>
        
        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="space-y-4 sm:space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sujet</label>
                    <input type="text" name="sujet" value="{{ $ticket->sujet }}" required class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Client ID</label>
                    <input type="number" name="client_id" value="{{ $ticket->client_id }}" required class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie ID</label>
                    <input type="number" name="categorie_id" value="{{ $ticket->categorie_id }}" class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Assigné à ID</label>
                    <input type="number" name="assigne_a" value="{{ $ticket->assigne_a }}" class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Priorité</label>
                    <select name="priorite" class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                        <option value="faible" {{ $ticket->priorite === 'faible' ? 'selected' : '' }}>Faible</option>
                        <option value="moyenne" {{ $ticket->priorite === 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                        <option value="haute" {{ $ticket->priorite === 'haute' ? 'selected' : '' }}>Haute</option>
                        <option value="urgente" {{ $ticket->priorite === 'urgente' ? 'selected' : '' }}>Urgente</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                    <select name="statut" class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                        <option value="ouvert" {{ $ticket->statut === 'ouvert' ? 'selected' : '' }}>Ouvert</option>
                        <option value="en_cours" {{ $ticket->statut === 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="resolu" {{ $ticket->statut === 'resolu' ? 'selected' : '' }}>Résolu</option>
                        <option value="ferme" {{ $ticket->statut === 'ferme' ? 'selected' : '' }}>Fermé</option>
                    </select>
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" required rows="4" class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">{{ $ticket->description }}</textarea>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" class="px-6 py-2 sm:py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition text-sm sm:text-base">
                    Mettre à jour
                </button>
                <a href="{{ route('tickets.show', $ticket->id) }}" class="px-6 py-2 sm:py-3 bg-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-400 transition text-center text-sm sm:text-base">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
