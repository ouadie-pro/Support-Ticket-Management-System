@extends('layouts.app')

@section('page-title', 'Réponse prédéfinie')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-4 sm:mb-6">
            <h1 class="text-lg sm:text-xl md:text-2xl font-bold">Réponse prédéfinie</h1>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('reponsePredefinies.edit', $reponse->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 text-sm sm:text-base">
                    Modifier
                </a>
                <a href="{{ route('reponsePredefinies.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 text-sm sm:text-base">
                    Retour
                </a>
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Titre</label>
                <p class="text-base sm:text-lg text-gray-900">{{ $reponse->titre }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Catégorie</label>
                <p class="text-base sm:text-lg text-gray-900">{{ $reponse->categorie_id }}</p>
            </div>
        </div>
        
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-500 mb-2">Contenu</label>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-900 whitespace-pre-wrap text-sm sm:text-base">{{ $reponse->contenu }}</p>
            </div>
        </div>
        
        <div class="mt-6 border-t pt-6">
            <form action="{{ route('reponsePredefinies.destroy', $reponse->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm sm:text-base" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réponse?')">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
