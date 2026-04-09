@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="min-h-screen flex">
    <!-- Left Side - Branding -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-slate-900 via-slate-800 to-blue-900 flex-col justify-center items-center p-12">
        <div class="text-center">
            <div class="w-20 h-20 bg-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-8 shadow-lg">
                <i class="fas fa-headset text-white text-4xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-4">SupportPro</h1>
            <p class="text-xl text-slate-300 mb-8">Plateforme de Gestion des Tickets et Réclamations</p>
            
            <div class="space-y-4 text-slate-400">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-ticket-alt text-blue-400"></i>
                    </div>
                    <span>Gestion centralisée des tickets</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                    </div>
                    <span>Suivi des réclamations</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-green-400"></i>
                    </div>
                    <span>Statistiques en temps réel</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
        <div class="w-full max-w-md">
            <div class="lg:hidden text-center mb-8">
                <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-white text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">SupportPro</h1>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Bon retour</h2>
                    <p class="text-gray-500 mt-2">Connectez-vous à votre compte</p>
                </div>

                @error('email')
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    </div>
                @enderror

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-gray-50"
                                placeholder="vous@exemple.com">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" type="password" name="password" required
                                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-gray-50"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                        </label>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Mot de passe oublié?</a>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center space-x-2">
                        <span>Se connecter</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">Pas encore de compte?
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium">Créer un compte</a>
                    </p>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-xs text-center text-gray-500">Comptes de test:</p>
                    <div class="mt-2 flex flex-wrap justify-center gap-2 text-xs">
                        <span class="px-2 py-1 bg-slate-100 text-slate-600 rounded">admin@example.com</span>
                        <span class="px-2 py-1 bg-slate-100 text-slate-600 rounded">agent@example.com</span>
                        <span class="px-2 py-1 bg-slate-100 text-slate-600 rounded">client@example.com</span>
                    </div>
                    <p class="text-xs text-center text-gray-400 mt-1">Mot de passe: password</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
