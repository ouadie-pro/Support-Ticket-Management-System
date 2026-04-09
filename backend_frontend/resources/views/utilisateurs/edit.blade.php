@extends('layouts.app')

@section('title', 'Modifier l\'utilisateur')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Modifier l'utilisateur</h1>
    
    <form action="{{ route('utilisateurs.update', $utilisateur->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Nom</label>
                <input type="text" name="nom" value="{{ $utilisateur->nom }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Prénom</label>
                <input type="text" name="prenom" value="{{ $utilisateur->prenom }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ $utilisateur->email }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Téléphone</label>
                <input type="text" name="telephone" value="{{ $utilisateur->telephone }}" class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Nouveau mot de passe</label>
                <input type="password" name="mot_de_passe" class="w-full border rounded px-3 py-2" placeholder="Laisser vide pour garder l'actuel">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">État</label>
                <select name="etat" class="w-full border rounded px-3 py-2">
                    <option value="actif" {{ $utilisateur->etat === 'actif' ? 'selected' : '' }}>Actif</option>
                    <option value="inactif" {{ $utilisateur->etat === 'inactif' ? 'selected' : '' }}>Inactif</option>
                </select>
            </div>
        </div>
        
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mettre à jour</button>
            <a href="{{ route('utilisateurs.show', $utilisateur->id) }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
        </div>
    </form>
</div>
@endsection
