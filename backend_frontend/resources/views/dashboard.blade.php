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

    <!-- Notifications -->
    @if(auth()->user()->unreadNotifications->count() > 0)
    <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-yellow-500">
        <div class="px-6 py-4 bg-yellow-50 border-b border-yellow-100">
            <h3 class="text-lg font-semibold text-yellow-800">
                <i class="fas fa-bell mr-2"></i>Notifications ({{ auth()->user()->unreadNotifications->count() }})
            </h3>
        </div>
        <div class="divide-y divide-gray-200">
            @foreach(auth()->user()->unreadNotifications->take(5) as $notification)
            <div class="px-6 py-4 flex items-start space-x-4 hover:bg-gray-50">
                <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-bell text-blue-600"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">{{ $notification->data['title'] ?? 'Notification' }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ $notification->data['message'] ?? $notification->data['title'] ?? '' }}</p>
                    @if($notification->data['type'] === 'ticket')
                    <a href="{{ route('tickets.show', $notification->data['id']) }}" class="text-sm text-blue-600 hover:text-blue-800 mt-1 inline-block">
                        <i class="fas fa-external-link-alt mr-1"></i>Voir le ticket
                    </a>
                    @elseif($notification->data['type'] === 'complaint')
                    <a href="{{ route('complaints.show', $notification->data['id']) }}" class="text-sm text-blue-600 hover:text-blue-800 mt-1 inline-block">
                        <i class="fas fa-external-link-alt mr-1"></i>Voir la réclamation
                    </a>
                    @endif
                </div>
                <span class="text-xs text-gray-400 whitespace-nowrap">{{ $notification->created_at->diffForHumans() }}</span>
            </div>
            @endforeach
        </div>
        @if(auth()->user()->unreadNotifications->count() > 5)
        <div class="px-6 py-3 bg-gray-50 text-center">
            <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Voir toutes les notifications</a>
        </div>
        @endif
    </div>
    @endif

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
                <a href="{{ route('tickets.show', $ticket->id) }}" class="block px-6 py-4 flex items-center justify-between hover:bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-ticket-alt text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $ticket->sujet }}</p>
                            <p class="text-sm text-gray-500">{{ $ticket->numero }}</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium rounded-full 
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
                </a>
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
                <a href="{{ route('complaints.show', $complaint->id) }}" class="block px-6 py-4 flex items-center justify-between hover:bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $complaint->sujet }}</p>
                            <p class="text-sm text-gray-500">{{ $complaint->numero }}</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium rounded-full 
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
                </a>
                @empty
                <div class="px-6 py-4 text-center text-gray-500">Aucune réclamation</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
