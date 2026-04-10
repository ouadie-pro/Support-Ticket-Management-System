@extends('layouts.app')

@section('page-title', 'Créer une réponse prédéfinie')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
        <div class="mb-4 sm:mb-6">
            <a href="{{ route('reponsePredefinies.index') }}" class="text-blue-600 hover:text-blue-700 flex items-center text-sm sm:text-base">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour
            </a>
        </div>
        
        <h1 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6">Créer une réponse prédéfinie</h1>
        
        <form action="{{ route('reponsePredefinies.store') }}" method="POST" class="space-y-4 sm:space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Titre</label>
                    <input type="text" name="titre" required class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                    <input type="number" name="categorie_id" class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                </div>
                
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Contenu</label>
                    <textarea name="contenu" required rows="5" class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"></textarea>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" class="px-6 py-2 sm:py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm sm:text-base">
                    Enregistrer
                </button>
                <a href="{{ route('reponsePredefinies.index') }}" class="px-6 py-2 sm:py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 text-center text-sm sm:text-base">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
