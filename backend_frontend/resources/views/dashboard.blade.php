@extends('layouts.app')

@section('page-title', 'Mon Tableau de bord')

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold mb-2">Bienvenue, {{ auth()->user()->name }}!</h2>
                <p class="text-blue-100">Gérez vos tickets et réclamations en toute simplicité</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-circle text-4xl text-white/80"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="{{ route('tickets.create') }}" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition border-l-4 border-blue-500 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Nouveau Ticket</p>
                    <p class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition">Créer un ticket</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-plus text-blue-600"></i>
                </div>
            </div>
        </a>

        <a href="{{ route('complaints.create') }}" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition border-l-4 border-yellow-500 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Nouvelle Réclamation</p>
                    <p class="text-lg font-semibold text-gray-900 group-hover:text-yellow-600 transition">Soumettre</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                </div>
            </div>
        </a>

        <a href="{{ route('tickets.index') }}" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition border-l-4 border-purple-500 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Mes Tickets</p>
                    <p class="text-lg font-semibold text-gray-900 group-hover:text-purple-600 transition">Voir tous</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-ticket-alt text-purple-600"></i>
                </div>
            </div>
        </a>

        <a href="{{ route('complaints.index') }}" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition border-l-4 border-red-500 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Mes Réclamations</p>
                    <p class="text-lg font-semibold text-gray-900 group-hover:text-red-600 transition">Voir toutes</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-list-alt text-red-600"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Role Info & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Role Card -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations du compte</h3>
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-gray-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Nom</p>
                        <p class="font-medium text-gray-900">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-envelope text-gray-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium text-gray-900">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-id-badge text-gray-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Rôle</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ auth()->user()->role ? auth()->user()->role->libelle : 'Non défini' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistiques</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <p class="text-3xl font-bold text-blue-600">{{ $ticketsCount }}</p>
                    <p class="text-sm text-gray-600">Tickets</p>
                </div>
                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                    <p class="text-3xl font-bold text-yellow-600">{{ $complaintsCount }}</p>
                    <p class="text-sm text-gray-600">Réclamations</p>
                </div>
            </div>
        </div>

        <!-- Help -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Aide</h3>
            <div class="space-y-3">
                <a href="#" class="flex items-center space-x-3 text-gray-600 hover:text-blue-600 transition">
                    <i class="fas fa-book w-5"></i>
                    <span>Documentation</span>
                </a>
                <a href="#" class="flex items-center space-x-3 text-gray-600 hover:text-blue-600 transition">
                    <i class="fas fa-question-circle w-5"></i>
                    <span>FAQ</span>
                </a>
                <a href="#" class="flex items-center space-x-3 text-gray-600 hover:text-blue-600 transition">
                    <i class="fas fa-envelope w-5"></i>
                    <span>Contacter le support</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Tickets Récents</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($recentTickets as $ticket)
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-ticket-alt text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $ticket->sujet }}</p>
                            <p class="text-sm text-gray-500">{{ $ticket->numero }}</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-{{ $ticket->statut === 'resolu' ? 'green' : 'yellow' }}-100 text-{{ $ticket->statut === 'resolu' ? 'green' : 'yellow' }}-800">
                        {{ $ticket->statut }}
                    </span>
                </div>
                @empty
                <div class="px-6 py-4 text-center text-gray-500">Aucun ticket</div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Réclamations Récentes</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($recentComplaints as $complaint)
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $complaint->sujet }}</p>
                            <p class="text-sm text-gray-500">{{ $complaint->numero }}</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-{{ $complaint->statut === 'resolu' ? 'green' : 'yellow' }}-100 text-{{ $complaint->statut === 'resolu' ? 'green' : 'yellow' }}-800">
                        {{ $complaint->statut }}
                    </span>
                </div>
                @empty
                <div class="px-6 py-4 text-center text-gray-500">Aucune réclamation</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
