@extends('layouts.app')

@section('page-title', 'Mes Réclamations')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Mes Réclamations</h2>
            <p class="text-gray-500">Gérez toutes vos réclamations</p>
        </div>
        <a href="{{ route('complaints.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-md">
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

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">N°</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Sujet</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Priorité</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($complaints as $complaint)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $complaint->numero }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">{{ $complaint->sujet }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ ucfirst($complaint->type) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $prioriteColors = [
                                    'urgente' => 'bg-red-100 text-red-800',
                                    'haute' => 'bg-orange-100 text-orange-800',
                                    'moyenne' => 'bg-blue-100 text-blue-800',
                                    'faible' => 'bg-gray-100 text-gray-800'
                                ];
                            @endphp
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $prioriteColors[$complaint->priorite] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $complaint->priorite }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statutColors = [
                                    'resolu' => 'bg-green-100 text-green-800',
                                    'rejete' => 'bg-red-100 text-red-800',
                                    'en_cours' => 'bg-blue-100 text-blue-800',
                                    'en_attente' => 'bg-yellow-100 text-yellow-800',
                                    'soumis' => 'bg-gray-100 text-gray-800'
                                ];
                            @endphp
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $statutColors[$complaint->statut] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $complaint->statut }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $complaint->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('complaints.show', $complaint->id) }}" class="text-blue-600 hover:text-blue-900 font-medium inline-flex items-center">
                                <i class="fas fa-eye mr-1"></i> Voir
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                            <p>Aucune réclamation trouvée</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($complaints->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $complaints->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
