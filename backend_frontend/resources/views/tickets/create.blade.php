@extends('layouts.app')

@section('page-title', 'Créer un ticket')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-plus-circle mr-2"></i>Créer un nouveau ticket
            </h3>
        </div>
        
        <form action="{{ route('tickets.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <div>
                <label for="sujet" class="block text-sm font-medium text-gray-700 mb-2">Sujet <span class="text-red-500">*</span></label>
                <input type="text" name="sujet" id="sujet" value="{{ old('sujet') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Décrivez brièvement votre problème">
                @error('sujet')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
            <div>
                <label for="categorie_id" class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                <select name="categorie_id" id="categorie_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Sélectionner une catégorie...</option>
                    @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->libelle }}
                    </option>
                    @endforeach
                </select>
                @error('categorie_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            @endif

            <div>
                <label for="priorite" class="block text-sm font-medium text-gray-700 mb-2">Priorité</label>
                <select name="priorite" id="priorite" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="faible" {{ old('priorite') === 'faible' ? 'selected' : '' }}>Faible</option>
                    <option value="moyenne" {{ old('priorite') === 'moyenne' || !old('priorite') ? 'selected' : '' }}>Moyenne</option>
                    <option value="haute" {{ old('priorite') === 'haute' ? 'selected' : '' }}>Haute</option>
                    <option value="urgente" {{ old('priorite') === 'urgente' ? 'selected' : '' }}>Urgente</option>
                </select>
                @error('priorite')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                <textarea name="description" id="description" required rows="6"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Décrivez votre problème en détail...">{{ old('description') }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <a href="{{ route('tickets.index') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>Annuler
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                    <i class="fas fa-paper-plane mr-2"></i>Soumettre le ticket
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
