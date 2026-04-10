@extends('layouts.app')

@section('page-title', 'Catégorie')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-4 sm:mb-6">
            <h1 class="text-lg sm:text-xl md:text-2xl font-bold">Catégorie</h1>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('categorieTickets.edit', $categorieTicket->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 text-sm sm:text-base">
                    Modifier
                </a>
                <a href="{{ route('categorieTickets.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 text-sm sm:text-base">
                    Retour
                </a>
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Code</label>
                <p class="text-base sm:text-lg font-mono text-gray-900">{{ $categorieTicket->code }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Libellé</label>
                <p class="text-base sm:text-lg text-gray-900">{{ $categorieTicket->libelle }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">SLA (heures)</label>
                <p class="text-base sm:text-lg text-gray-900">{{ $categorieTicket->sla_heures ?? '-' }}</p>
            </div>
        </div>
        
        <div class="mt-6 border-t pt-6">
            <form action="{{ route('categorieTickets.destroy', $categorieTicket->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm sm:text-base" onclick="return confirm('Êtes-vous sûr?')">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
