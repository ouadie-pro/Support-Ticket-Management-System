@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Réclamation #{{ $complaint->numero }}</h1>
        <a href="{{ route('complaints.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition duration-200">
            Retour
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Détails</h3>
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-semibold text-gray-900 mb-3">{{ $complaint->sujet }}</h4>
                    <p class="text-gray-600 whitespace-pre-wrap">{{ $complaint->description }}</p>
                    
                    @if($complaint->resolution)
                    <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <strong class="text-green-800">Résolution:</strong>
                        <p class="text-green-700 mt-1">{{ $complaint->resolution }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Commentaires</h3>
                </div>
                <div class="p-6">
                    @forelse($complaint->comments as $comment)
                    <div class="border-b border-gray-200 pb-4 mb-4 last:border-b-0">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-medium text-gray-900">{{ $comment->utilisateur->name ?? 'Utilisateur' }}</span>
                            <span class="text-sm text-gray-500">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <p class="text-gray-600">{{ $comment->contenu }}</p>
                    </div>
                    @empty
                    <p class="text-gray-500">Aucun commentaire.</p>
                    @endforelse

                    <form method="POST" action="{{ route('complaints.comments.store', $complaint->id) }}" class="mt-4">
                        @csrf
                        <textarea name="contenu" placeholder="Ajouter un commentaire..." rows="2"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 mb-2"></textarea>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
                            Envoyer
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Informations</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <span class="text-sm text-gray-500">Statut</span>
                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $complaint->statut === 'resolu' ? 'bg-green-100 text-green-800' : ($complaint->statut === 'rejete' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ $complaint->statut }}
                        </span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">Type</span>
                        <p class="font-medium text-gray-900">{{ ucfirst($complaint->type) }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">Priorité</span>
                        <p class="font-medium text-gray-900">{{ ucfirst($complaint->priorite) }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">Soumise le</span>
                        <p class="font-medium text-gray-900">{{ $complaint->created_at->format('d/m/Y') }}</p>
                    </div>
                    @if($complaint->date_resolution)
                    <div>
                        <span class="text-sm text-gray-500">Résolue le</span>
                        <p class="font-medium text-gray-900">{{ $complaint->date_resolution->format('d/m/Y') }}</p>
                    </div>
                    @endif
                </div>
            </div>

            @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Actions Admin</h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('complaints.assign', $complaint->id) }}" class="mb-4">
                        @csrf
                        <select name="traite_par" class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-2 text-sm">
                            <option value="">Assigner à...</option>
                        </select>
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm">
                            Assigner
                        </button>
                    </form>

                    @if($complaint->statut !== 'resolu')
                    <form method="POST" action="{{ route('complaints.resolve', $complaint->id) }}">
                        @csrf
                        <textarea name="resolution" placeholder="Résolution..." rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-2 text-sm"></textarea>
                        <button type="submit" class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg text-sm">
                            Marquer résolue
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
