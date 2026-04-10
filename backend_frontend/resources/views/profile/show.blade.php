@extends('layouts.app')

@section('page-title', 'Mon Profil')

@section('content')
<div class="max-w-4xl mx-auto space-y-4 md:space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 md:gap-4">
        <div>
            <h1 class="text-xl md:text-2xl font-bold text-gray-900">Mon Profil</h1>
            <p class="text-gray-500 text-sm md:text-base">Gérez vos informations personnelles</p>
        </div>
    </div>

    @if(session('success'))
    <div class="p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
        <i class="fas fa-check-circle text-green-600 mr-3"></i>
        <p class="text-green-700">{{ session('success') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
        <!-- Profile Information -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900">
                    <i class="fas fa-user mr-2"></i>Informations du profil
                </h3>
            </div>
            <div class="p-4 sm:p-6">
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required
                            class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required
                            class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                        @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rôle</label>
                        <input type="text" value="{{ auth()->user()->role ? auth()->user()->role->libelle : 'Non défini' }}" disabled
                            class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 text-sm sm:text-base">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Membre depuis</label>
                        <input type="text" value="{{ auth()->user()->created_at->format('d/m/Y') }}" disabled
                            class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 text-sm sm:text-base">
                    </div>

                    <button type="submit" class="w-full px-4 py-2 sm:py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition text-sm sm:text-base">
                        <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                    </button>
                </form>
            </div>
        </div>

        <!-- Change Password -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900">
                    <i class="fas fa-lock mr-2"></i>Modifier le mot de passe
                </h3>
            </div>
            <div class="p-4 sm:p-6">
                <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe actuel</label>
                        <input type="password" name="current_password" id="current_password" required
                            class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                        @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                        @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                    </div>

                    <button type="submit" class="w-full px-4 py-2 sm:py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition text-sm sm:text-base">
                        <i class="fas fa-key mr-2"></i>Changer le mot de passe
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Activity Log -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-base sm:text-lg font-semibold text-gray-900">
                <i class="fas fa-history mr-2"></i>Activité récente
            </h3>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse(auth()->user()->notifications->take(10) as $notification)
            <div class="px-4 sm:px-6 py-3 sm:py-4 flex items-start space-x-3 sm:space-x-4 hover:bg-gray-50">
                <div class="flex-shrink-0 w-8 h-8 sm:w-10 sm:h-10 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-bell text-blue-600 text-xs sm:text-sm"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $notification->data['title'] ?? 'Notification' }}</p>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1 truncate">{{ $notification->data['message'] ?? '' }}</p>
                </div>
                <span class="text-xs text-gray-400 whitespace-nowrap hidden sm:inline">{{ $notification->created_at->format('d/m/Y H:i') }}</span>
            </div>
            @empty
            <div class="px-4 sm:px-6 py-6 sm:py-8 text-center text-gray-500">
                <i class="fas fa-history text-3xl sm:text-4xl mb-3 text-gray-300"></i>
                <p class="text-sm">Aucune activité récente</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
