@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Bienvenue dans le système de gestion des tickets</h1>
    
    @auth
    <div class="mb-8">
        <p class="text-gray-600">Bonjour, <span class="font-semibold">{{ Auth::user()->name }}</span> !</p>
        <p class="text-gray-500">Utilisez le menu de navigation pour accéder aux différentes sections.</p>
    </div>
    @else
    <div class="mb-8">
        <p class="text-gray-600 mb-4">Connectez-vous pour accéder à votre espace personnel.</p>
        <div class="flex space-x-4">
            <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                <i class="fas fa-sign-in-alt mr-2"></i>Connexion
            </a>
            <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition">
                <i class="fas fa-user-plus mr-2"></i>Inscription
            </a>
        </div>
    </div>
    @endauth
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="{{ route('utilisateurs.index') }}" class="block p-6 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
            <h2 class="text-lg font-semibold text-blue-700">Utilisateurs</h2>
            <p class="text-sm text-gray-600">Gérer les utilisateurs du système</p>
        </a>
        
        <a href="{{ route('clients.index') }}" class="block p-6 bg-green-50 rounded-lg hover:bg-green-100 transition">
            <h2 class="text-lg font-semibold text-green-700">Clients</h2>
            <p class="text-sm text-gray-600">Gérer les clients</p>
        </a>
        
        <a href="{{ route('tickets.index') }}" class="block p-6 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
            <h2 class="text-lg font-semibold text-purple-700">Tickets</h2>
            <p class="text-sm text-gray-600">Gérer les tickets de support</p>
        </a>
        
        <a href="{{ route('categorieTickets.index') }}" class="block p-6 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
            <h2 class="text-lg font-semibold text-yellow-700">Catégories</h2>
            <p class="text-sm text-gray-600">Gérer les catégories de tickets</p>
        </a>
        
        <a href="{{ route('roles.index') }}" class="block p-6 bg-red-50 rounded-lg hover:bg-red-100 transition">
            <h2 class="text-lg font-semibold text-red-700">Rôles</h2>
            <p class="text-sm text-gray-600">Gérer les rôles</p>
        </a>
        
        <a href="{{ route('permissions.index') }}" class="block p-6 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
            <h2 class="text-lg font-semibold text-indigo-700">Permissions</h2>
            <p class="text-sm text-gray-600">Gérer les permissions</p>
        </a>
        
        <a href="{{ route('slas.index') }}" class="block p-6 bg-teal-50 rounded-lg hover:bg-teal-100 transition">
            <h2 class="text-lg font-semibold text-teal-700">SLA</h2>
            <p class="text-sm text-gray-600">Gérer les accords de niveau de service</p>
        </a>
        
        <a href="{{ route('satisfactions.index') }}" class="block p-6 bg-pink-50 rounded-lg hover:bg-pink-100 transition">
            <h2 class="text-lg font-semibold text-pink-700">Satisfactions</h2>
            <p class="text-sm text-gray-600">Gérer les satisfactions clients</p>
        </a>
        
        <a href="{{ route('reponsePredefinies.index') }}" class="block p-6 bg-orange-50 rounded-lg hover:bg-orange-100 transition">
            <h2 class="text-lg font-semibold text-orange-700">Réponses prédéfinies</h2>
            <p class="text-sm text-gray-600">Gérer les réponses prédéfinies</p>
        </a>
        
        <a href="{{ route('pieceJointes.index') }}" class="block p-6 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
            <h2 class="text-lg font-semibold text-gray-700">Pièces jointes</h2>
            <p class="text-sm text-gray-600">Gérer les pièces jointes</p>
        </a>
        
        <a href="{{ route('notifications.index') }}" class="block p-6 bg-cyan-50 rounded-lg hover:bg-cyan-100 transition">
            <h2 class="text-lg font-semibold text-cyan-700">Notifications</h2>
            <p class="text-sm text-gray-600">Gérer les notifications</p>
        </a>
        
        <a href="{{ route('historiqueTickets.index') }}" class="block p-6 bg-amber-50 rounded-lg hover:bg-amber-100 transition">
            <h2 class="text-lg font-semibold text-amber-700">Historique</h2>
            <p class="text-sm text-gray-600">Voir l'historique des tickets</p>
        </a>
    </div>
</div>
@endsection
