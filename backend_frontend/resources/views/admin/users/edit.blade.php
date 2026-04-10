@extends('layouts.app')

@section('page-title', 'Modifier Utilisateur')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-4 md:mb-6">
        <a href="{{ route('admin.users') }}" class="text-blue-600 hover:text-blue-700 flex items-center text-sm md:text-base">
            <i class="fas fa-arrow-left mr-2"></i>
            Retour aux utilisateurs
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
        <h2 class="text-lg md:text-2xl font-bold text-gray-900 mb-4 md:mb-6">Modifier l'utilisateur</h2>

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-4 md:space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-4 py-2 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm md:text-base">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-4 py-2 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm md:text-base">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe <span class="text-gray-500">(laisser vide pour garder l'actuel)</span></label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm md:text-base">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role_id" class="block text-sm font-medium text-gray-700 mb-2">Rôle</label>
                <select name="role_id" id="role_id" required
                    class="w-full px-4 py-2 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm md:text-base">
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->libelle }}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" class="px-6 py-2 md:py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition text-sm md:text-base">
                    Mettre à jour
                </button>
                <a href="{{ route('admin.users') }}" class="px-6 py-2 md:py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition text-center text-sm md:text-base">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
