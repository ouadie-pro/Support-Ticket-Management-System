@extends('layouts.app')

@section('title', 'Utilisateur')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Utilisateur</h1>
        <div class="space-x-2">
            <a href="{{ route('utilisateurs.edit', $utilisateur->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
            <a href="{{ route('utilisateurs.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Retour</a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-500">Nom</label>
            <p class="text-lg">{{ $utilisateur->nom }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Prénom</label>
            <p class="text-lg">{{ $utilisateur->prenom }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Email</label>
            <p class="text-lg">{{ $utilisateur->email }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Téléphone</label>
            <p class="text-lg">{{ $utilisateur->telephone ?? '-' }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">État</label>
            <span class="px-2 py-1 text-xs rounded {{ $utilisateur->etat === 'actif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $utilisateur->etat }}
            </span>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">UUID</label>
            <p class="text-sm font-mono">{{ $utilisateur->uuid }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Dernière connexion</label>
            <p class="text-lg">{{ $utilisateur->derniere_connexion_at ?? 'Jamais' }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-500">Créé le</label>
            <p class="text-lg">{{ $utilisateur->created_at }}</p>
        </div>
    </div>
    
    @if($utilisateur->roles->count() > 0)
    <div class="mt-6">
        <label class="block text-sm font-medium text-gray-500 mb-2">Rôles</label>
        <div class="flex gap-2">
            @foreach($utilisateur->roles as $role)
            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">{{ $role->libelle }}</span>
            @endforeach
        </div>
    </div>
    @endif
    
    <div class="mt-6 border-t pt-6">
        <form action="{{ route('utilisateurs.destroy', $utilisateur->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
