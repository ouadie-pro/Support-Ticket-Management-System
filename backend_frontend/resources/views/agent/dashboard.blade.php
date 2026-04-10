@extends('layouts.app')

@section('page-title', 'Espace Agent')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-gray-900">Tableau de bord Agent</h2>
            <p class="text-gray-500 text-sm md:text-base">Gérez vos tickets et réclamations assignés</p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <!-- Tickets Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-800">
                <h3 class="text-base md:text-lg font-semibold text-white">
                    <i class="fas fa-ticket-alt mr-2"></i>Mes Tickets Assignés
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N°</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sujet</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priorité</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Statut</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($tickets as $ticket)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">{{ $ticket->numero }}</td>
                            <td class="px-4 md:px-6 py-4 text-sm text-gray-900 max-w-xs truncate">{{ $ticket->sujet }}</td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($ticket->priorite === 'urgente') bg-red-100 text-red-800
                                    @elseif($ticket->priorite === 'haute') bg-orange-100 text-orange-800
                                    @elseif($ticket->priorite === 'moyenne') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($ticket->priorite) }}
                                </span>
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($ticket->statut === 'ferme') bg-gray-100 text-gray-800
                                    @elseif($ticket->statut === 'resolu') bg-green-100 text-green-800
                                    @elseif($ticket->statut === 'en_cours') bg-blue-100 text-blue-800
                                    @else bg-purple-100 text-purple-800 @endif">
                                    @if($ticket->statut === 'ouvert') Ouvert
                                    @elseif($ticket->statut === 'en_cours') En cours
                                    @elseif($ticket->statut === 'resolu') Résolu
                                    @else Fermé
                                    @endif
                                </span>
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                                    <i class="fas fa-eye"></i> <span class="hidden sm:inline">Voir</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 md:px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-ticket-alt text-4xl mb-3 text-gray-300"></i>
                                <p>Aucun ticket assigné</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($tickets->hasPages())
            <div class="px-4 md:px-6 py-3 md:py-4 border-t border-gray-200">
                {{ $tickets->links() }}
            </div>
            @endif
        </div>

        <!-- New Complaints Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-200 bg-gradient-to-r from-green-500 to-emerald-600">
                <h3 class="text-base md:text-lg font-semibold text-white">
                    <i class="fas fa-inbox mr-2"></i>Nouvelles Réclamations
                </h3>
                <p class="text-green-100 text-xs md:text-sm mt-1">Réclamations non assignées</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N°</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sujet</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Type</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priorité</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($nouvellesComplaints as $complaint)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">{{ $complaint->numero }}</td>
                            <td class="px-4 md:px-6 py-4 text-sm text-gray-900 max-w-xs truncate">{{ $complaint->sujet }}</td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600 hidden sm:table-cell">
                                @if($complaint->type === 'technique') Technique
                                @elseif($complaint->type === 'facturation') Facturation
                                @elseif($complaint->type === 'service') Service
                                @else Autre
                                @endif
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($complaint->priorite === 'urgente') bg-red-100 text-red-800
                                    @elseif($complaint->priorite === 'haute') bg-orange-100 text-orange-800
                                    @elseif($complaint->priorite === 'moyenne') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($complaint->priorite) }}
                                </span>
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('complaints.show', $complaint->id) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                                    <i class="fas fa-eye"></i> <span class="hidden sm:inline">Voir</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 md:px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                <p>Aucune nouvelle réclamation</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($nouvellesComplaints->hasPages())
            <div class="px-4 md:px-6 py-3 md:py-4 border-t border-gray-200">
                {{ $nouvellesComplaints->links() }}
            </div>
            @endif
        </div>

        <!-- My Assigned Complaints Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden xl:col-span-2">
            <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-200 bg-gradient-to-r from-yellow-500 to-orange-500">
                <h3 class="text-base md:text-lg font-semibold text-white">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Mes Réclamations Assignées
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N°</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sujet</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Type</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($complaints as $complaint)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">{{ $complaint->numero }}</td>
                            <td class="px-4 md:px-6 py-4 text-sm text-gray-900 max-w-xs truncate">{{ $complaint->sujet }}</td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600 hidden sm:table-cell">
                                @if($complaint->type === 'technique') Technique
                                @elseif($complaint->type === 'facturation') Facturation
                                @elseif($complaint->type === 'service') Service
                                @else Autre
                                @endif
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($complaint->statut === 'resolu') bg-green-100 text-green-800
                                    @elseif($complaint->statut === 'rejete') bg-red-100 text-red-800
                                    @elseif($complaint->statut === 'en_cours') bg-blue-100 text-blue-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    @if($complaint->statut === 'soumis') Soumis
                                    @elseif($complaint->statut === 'en_attente') En attente
                                    @elseif($complaint->statut === 'en_cours') En cours
                                    @elseif($complaint->statut === 'resolu') Résolu
                                    @else Rejeté
                                    @endif
                                </span>
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('complaints.show', $complaint->id) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                                    <i class="fas fa-eye"></i> <span class="hidden sm:inline">Voir</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 md:px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                <p>Aucune réclamation assignée</p>
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
</div>
@endsection
