@extends('layouts.app')

@section('page-title', 'Mes Réclamations')

@section('content')
<div class="space-y-4 md:space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 md:gap-4">
        <div>
            <h2 class="text-lg md:text-2xl font-bold text-gray-900">Mes Réclamations</h2>
            <p class="text-gray-500 text-sm md:text-base">Gérez toutes vos réclamations</p>
        </div>
        <a href="{{ route('complaints.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-md text-sm md:text-base">
            <i class="fas fa-plus mr-2"></i>
            Nouvelle Réclamation
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
            <i class="fas fa-check-circle text-green-600 mr-3"></i>
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Search and Filter -->
    <div class="bg-white rounded-xl shadow-md p-3 sm:p-4">
        <form method="GET" action="{{ route('complaints.index') }}" class="space-y-3 md:space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 md:gap-4">
                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Numéro ou sujet..." 
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="statut" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">Tous</option>
                        <option value="soumis" {{ request('statut') === 'soumis' ? 'selected' : '' }}>Soumis</option>
                        <option value="en_attente" {{ request('statut') === 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="en_cours" {{ request('statut') === 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="resolu" {{ request('statut') === 'resolu' ? 'selected' : '' }}>Résolu</option>
                        <option value="rejete" {{ request('statut') === 'rejete' ? 'selected' : '' }}>Rejeté</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Priorité</label>
                    <select name="priorite" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">Toutes</option>
                        <option value="urgente" {{ request('priorite') === 'urgente' ? 'selected' : '' }}>Urgente</option>
                        <option value="haute" {{ request('priorite') === 'haute' ? 'selected' : '' }}>Haute</option>
                        <option value="moyenne" {{ request('priorite') === 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                        <option value="faible" {{ request('priorite') === 'faible' ? 'selected' : '' }}>Faible</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">Tous</option>
                        <option value="technique" {{ request('type') === 'technique' ? 'selected' : '' }}>Technique</option>
                        <option value="facturation" {{ request('type') === 'facturation' ? 'selected' : '' }}>Facturation</option>
                        <option value="service" {{ request('type') === 'service' ? 'selected' : '' }}>Service</option>
                        <option value="autre" {{ request('type') === 'autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition text-sm">
                    <i class="fas fa-filter mr-2"></i>Filtrer
                </button>
                <a href="{{ route('complaints.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition text-sm">
                    <i class="fas fa-times mr-2"></i>Réinitialiser
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">N°</th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Sujet</th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden sm:table-cell">Type</th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Priorité</th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:table-cell">Statut</th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden lg:table-cell">Date</th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($complaints as $complaint)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $complaint->numero }}</td>
                        <td class="px-4 md:px-6 py-4 text-sm text-gray-600 max-w-xs truncate">{{ $complaint->sujet }}</td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600 hidden sm:table-cell">
                            @if($complaint->type === 'technique') Technique
                            @elseif($complaint->type === 'facturation') Facturation
                            @elseif($complaint->type === 'service') Service
                            @else Autre
                            @endif
                        </td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                            @php
                                $prioriteColors = [
                                    'urgente' => 'bg-red-100 text-red-800',
                                    'haute' => 'bg-orange-100 text-orange-800',
                                    'moyenne' => 'bg-yellow-100 text-yellow-800',
                                    'faible' => 'bg-green-100 text-green-800'
                                ];
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $prioriteColors[$complaint->priorite] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($complaint->priorite) }}
                            </span>
                        </td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap hidden md:table-cell">
                            @php
                                $statutColors = [
                                    'resolu' => 'bg-green-100 text-green-800',
                                    'rejete' => 'bg-red-100 text-red-800',
                                    'en_cours' => 'bg-blue-100 text-blue-800',
                                    'en_attente' => 'bg-yellow-100 text-yellow-800',
                                    'soumis' => 'bg-gray-100 text-gray-800'
                                ];
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statutColors[$complaint->statut] ?? 'bg-gray-100 text-gray-800' }}">
                                @if($complaint->statut === 'soumis') Soumis
                                @elseif($complaint->statut === 'en_attente') En attente
                                @elseif($complaint->statut === 'en_cours') En cours
                                @elseif($complaint->statut === 'resolu') Résolu
                                @elseif($complaint->statut === 'rejete') Rejeté
                                @else {{ ucfirst($complaint->statut) }}
                                @endif
                            </span>
                        </td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden lg:table-cell">{{ $complaint->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('complaints.show', $complaint->id) }}" class="text-blue-600 hover:text-blue-900 font-medium inline-flex items-center">
                                <i class="fas fa-eye mr-1"></i> <span class="hidden sm:inline">Voir</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 md:px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                            <p>Aucune réclamation trouvée</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($complaints->hasPages())
        <div class="px-4 md:px-6 py-3 md:py-4 border-t border-gray-200">
            {{ $complaints->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
