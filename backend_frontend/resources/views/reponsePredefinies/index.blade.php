@extends('layouts.app')

@section('page-title', 'Réponses prédéfinies')

@section('content')
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="px-4 sm:px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h1 class="text-lg sm:text-xl md:text-2xl font-bold">Réponses prédéfinies</h1>
        <a href="{{ route('reponsePredefinies.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm sm:text-base">
            <i class="fas fa-plus mr-2"></i>Créer
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Titre</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:table-cell">Catégorie</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contenu</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($reponsePredefinies as $reponse)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 sm:px-6 py-4 text-sm font-medium text-gray-900">{{ $reponse->titre }}</td>
                    <td class="px-4 sm:px-6 py-4 text-sm text-gray-600 hidden md:table-cell">{{ $reponse->categorie_id }}</td>
                    <td class="px-4 sm:px-6 py-4 text-sm text-gray-600 max-w-xs truncate">{{ Str::limit($reponse->contenu, 50) }}</td>
                    <td class="px-4 sm:px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('reponsePredefinies.show', $reponse->id) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('reponsePredefinies.edit', $reponse->id) }}" class="text-yellow-600 hover:text-yellow-900 font-medium">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
