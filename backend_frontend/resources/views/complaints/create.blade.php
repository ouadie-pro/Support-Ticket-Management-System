@extends('layouts.app')

@section('page-title', 'Nouvelle Réclamation')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-4 sm:py-8">
    <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 mb-4 sm:mb-8">Nouvelle Réclamation</h1>

    <div class="bg-white shadow-lg rounded-xl sm:rounded-lg p-4 sm:p-6">
        <form method="POST" action="{{ route('complaints.store') }}" class="space-y-4 sm:space-y-6">
            @csrf

            <div>
                <label for="sujet" class="block text-sm font-medium text-gray-700 mb-2">Sujet</label>
                <input type="text" name="sujet" id="sujet" value="{{ old('sujet') }}" required
                    class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base @error('sujet') border-red-500 @enderror">
                @error('sujet')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select name="type" id="type" required
                    class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base @error('type') border-red-500 @enderror">
                    <option value="">Sélectionner un type</option>
                    <option value="technique">Technique</option>
                    <option value="facturation">Facturation</option>
                    <option value="service">Service</option>
                    <option value="autre">Autre</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="priorite" class="block text-sm font-medium text-gray-700 mb-2">Priorité</label>
                <select name="priorite" id="priorite"
                    class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base @error('priorite') border-red-500 @enderror">
                    <option value="faible">Faible</option>
                    <option value="moyenne" selected>Moyenne</option>
                    <option value="haute">Haute</option>
                    <option value="urgente">Urgente</option>
                </select>
                @error('priorite')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="4" required
                    class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <button type="submit" class="px-6 py-2 sm:py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200 text-sm sm:text-base">
                    Soumettre
                </button>
                <a href="{{ route('complaints.index') }}" class="px-6 py-2 sm:py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition duration-200 text-center text-sm sm:text-base">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
