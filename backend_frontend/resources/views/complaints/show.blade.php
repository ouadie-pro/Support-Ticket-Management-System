@extends('layouts.app')

@section('page-title', 'Réclamation')

@section('content')
<div class="space-y-4 md:space-y-6">
    <!-- Success Message -->
    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
            <i class="fas fa-check-circle text-green-600 mr-3"></i>
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 md:gap-4">
        <div>
            <h1 class="text-xl md:text-2xl font-bold text-gray-900">Réclamation {{ $complaint->numero }}</h1>
            <p class="text-gray-500 mt-1 text-sm md:text-base">Soumise le {{ $complaint->created_at->format('d/m/Y à H:i') }}</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('complaints.index') }}" class="px-3 sm:px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition text-sm">
                <i class="fas fa-arrow-left mr-2"></i>Retour
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-4 md:space-y-6">
            <!-- Complaint Details -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">{{ $complaint->sujet }}</h3>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="prose max-w-none text-gray-700 whitespace-pre-wrap text-sm sm:text-base">{{ $complaint->description }}</div>
                    
                    @if($complaint->resolution)
                    <div class="mt-4 sm:mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <h4 class="font-semibold text-green-800 mb-2">
                            <i class="fas fa-check-circle mr-2"></i>Résolution
                        </h4>
                        <p class="text-green-700 whitespace-pre-wrap text-sm sm:text-base">{{ $complaint->resolution }}</p>
                        @if($complaint->date_resolution)
                        <p class="text-sm text-green-600 mt-2">Résolue le {{ $complaint->date_resolution->format('d/m/Y à H:i') }}</p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            <!-- Messages Thread -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">
                        <i class="fas fa-comments mr-2"></i>Conversation
                    </h3>
                </div>
                <div class="p-4 sm:p-6 max-h-64 md:max-h-96 overflow-y-auto space-y-4" id="messages-container">
                    @forelse($complaint->comments as $comment)
                    <div class="flex {{ $comment->utilisateur_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[90%] sm:max-w-[80%] rounded-lg p-3 sm:p-4 {{ $comment->utilisateur_id === auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-900' }}">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-semibold text-xs sm:text-sm">
                                    {{ $comment->utilisateur->nom ?? $comment->utilisateur->name ?? 'Utilisateur' }}
                                    @if($comment->utilisateur && $comment->utilisateur->role)
                                        @if($comment->utilisateur->role->code === 'admin')
                                            <span class="ml-1 text-xs opacity-75">(Admin)</span>
                                        @elseif($comment->utilisateur->role->code === 'agent')
                                            <span class="ml-1 text-xs opacity-75">(Agent)</span>
                                        @endif
                                    @endif
                                </span>
                                <span class="text-xs opacity-75">{{ $comment->created_at->format('d/m H:i') }}</span>
                            </div>
                            <p class="whitespace-pre-wrap text-sm">{{ $comment->contenu }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-6 sm:py-8 text-gray-500">
                        <i class="fas fa-comment-dots text-3xl sm:text-4xl mb-3 text-gray-300"></i>
                        <p class="text-sm">Aucune réponse pour le moment</p>
                    </div>
                    @endforelse
                </div>
                
                <!-- Reply Form -->
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-t border-gray-200 bg-gray-50">
                    @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                    <div class="mb-3">
                        <select id="reponse-predefinie" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm"
                            onchange="if(this.value) { document.querySelector('#complaint-contenu').value = this.value; this.value = ''; }">
                            <option value="">-- Insérer une réponse prédéfinie --</option>
                            @foreach($reponsePredefinies as $reponse)
                            <option value="{{ $reponse->contenu }}">{{ $reponse->titre }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('complaints.comments.store', $complaint->id) }}" id="reply-form">
                        @csrf
                        <div class="flex gap-2 sm:gap-3">
                            <textarea name="contenu" id="complaint-contenu" placeholder="Écrire une réponse..." rows="2" required
                                class="flex-1 px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none text-sm"></textarea>
                            <button type="submit" class="px-4 sm:px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition self-end">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-4 md:space-y-6">
            <!-- Info Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">Informations</h3>
                </div>
                <div class="p-4 sm:p-6 space-y-3 sm:space-y-4">
                    <div>
                        <label class="text-sm text-gray-500">Client</label>
                        <p class="font-medium text-gray-900 text-sm sm:text-base">{{ $complaint->user->name ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Type</label>
                        <p class="font-medium text-gray-900 text-sm sm:text-base">
                            @if($complaint->type === 'technique') Technique
                            @elseif($complaint->type === 'facturation') Facturation
                            @elseif($complaint->type === 'service') Service
                            @else Autre
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Assigné à</label>
                        <p class="font-medium text-gray-900 text-sm sm:text-base">{{ $complaint->agent->name ?? 'Non assigné' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Priorité</label>
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full 
                            @if($complaint->priorite === 'urgente') bg-red-100 text-red-800
                            @elseif($complaint->priorite === 'haute') bg-orange-100 text-orange-800
                            @elseif($complaint->priorite === 'moyenne') bg-yellow-100 text-yellow-800
                            @else bg-green-100 text-green-800 @endif">
                            {{ ucfirst($complaint->priorite) }}
                        </span>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Statut</label>
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full 
                            @if($complaint->statut === 'resolu') bg-green-100 text-green-800
                            @elseif($complaint->statut === 'rejete') bg-red-100 text-red-800
                            @elseif($complaint->statut === 'en_cours') bg-blue-100 text-blue-800
                            @elseif($complaint->statut === 'en_attente') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif">
                            @if($complaint->statut === 'soumis') Soumis
                            @elseif($complaint->statut === 'en_attente') En attente
                            @elseif($complaint->statut === 'en_cours') En cours
                            @elseif($complaint->statut === 'resolu') Résolu
                            @elseif($complaint->statut === 'rejete') Rejeté
                            @else {{ ucfirst($complaint->statut) }}
                            @endif
                        </span>
                    </div>
                    @if($complaint->date_resolution)
                    <div>
                        <label class="text-sm text-gray-500">Résolue le</label>
                        <p class="font-medium text-gray-900 text-sm sm:text-base">{{ $complaint->date_resolution->format('d/m/Y à H:i') }}</p>
                    </div>
                    @endif
                </div>
            </div>

            @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
            <!-- Actions Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">Actions</h3>
                </div>
                <div class="p-4 sm:p-6 space-y-4">
                    <!-- Assign Agent -->
                    <form method="POST" action="{{ route('complaints.assign', $complaint->id) }}">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700 mb-2">Assigner à un agent</label>
                        <select name="traite_par" class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-2 text-sm">
                            <option value="">Sélectionner...</option>
                            @foreach($agents as $agent)
                            <option value="{{ $agent->id }}" {{ $complaint->traite_par == $agent->id ? 'selected' : '' }}>
                                {{ $agent->name }}
                            </option>
                            @endforeach
                        </select>
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm">
                            <i class="fas fa-user-plus mr-2"></i>Assigner
                        </button>
                    </form>

                    <!-- Change Priority -->
                    <form method="POST" action="{{ route('complaints.update-priority', $complaint->id) }}">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700 mb-2">Modifier la priorité</label>
                        <select name="priorite" class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-2 text-sm">
                            <option value="faible" {{ $complaint->priorite === 'faible' ? 'selected' : '' }}>Faible</option>
                            <option value="moyenne" {{ $complaint->priorite === 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                            <option value="haute" {{ $complaint->priorite === 'haute' ? 'selected' : '' }}>Haute</option>
                            <option value="urgente" {{ $complaint->priorite === 'urgente' ? 'selected' : '' }}>Urgente</option>
                        </select>
                        <button type="submit" class="w-full px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg text-sm">
                            <i class="fas fa-arrow-up mr-2"></i>Mettre à jour
                        </button>
                    </form>

                    <!-- Change Status -->
                    <form method="POST" action="{{ route('complaints.update-status', $complaint->id) }}">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700 mb-2">Changer le statut</label>
                        <select name="statut" class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-2 text-sm">
                            <option value="soumis" {{ $complaint->statut === 'soumis' ? 'selected' : '' }}>Soumis</option>
                            <option value="en_attente" {{ $complaint->statut === 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="en_cours" {{ $complaint->statut === 'en_cours' ? 'selected' : '' }}>En cours</option>
                            <option value="resolu" {{ $complaint->statut === 'resolu' ? 'selected' : '' }}>Résolu</option>
                            <option value="rejete" {{ $complaint->statut === 'rejete' ? 'selected' : '' }}>Rejeté</option>
                        </select>
                        <button type="submit" class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg text-sm">
                            <i class="fas fa-check mr-2"></i>Mettre à jour
                        </button>
                    </form>

                    <!-- Resolve with Resolution -->
                    @if($complaint->statut !== 'resolu')
                    <div class="border-t pt-4 mt-4">
                        <form method="POST" action="{{ route('complaints.resolve', $complaint->id) }}">
                            @csrf
                            <label class="block text-sm font-medium text-gray-700 mb-2">Résoudre avec résolution</label>
                            <textarea name="resolution" placeholder="Décrivez la résolution..." rows="2" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-2 text-sm"></textarea>
                            <button type="submit" class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg text-sm">
                                <i class="fas fa-check-circle mr-2"></i>Marquer comme résolue
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Status Buttons -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">Actions rapides</h3>
                </div>
                <div class="p-3 sm:p-4 flex flex-wrap gap-2">
                    @if($complaint->statut !== 'en_cours' && $complaint->statut !== 'resolu')
                    <form method="POST" action="{{ route('complaints.update-status', $complaint->id) }}" class="inline">
                        @csrf
                        <input type="hidden" name="statut" value="en_cours">
                        <button type="submit" class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm rounded-lg">
                            <i class="fas fa-play mr-1"></i>Prendre en charge
                        </button>
                    </form>
                    @endif
                    @if($complaint->statut !== 'resolu' && $complaint->statut !== 'rejete')
                    <form method="POST" action="{{ route('complaints.update-status', $complaint->id) }}" class="inline">
                        @csrf
                        <input type="hidden" name="statut" value="resolu">
                        <button type="submit" class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs sm:text-sm rounded-lg">
                            <i class="fas fa-check mr-1"></i>Résoudre
                        </button>
                    </form>
                    @endif
                    @if($complaint->statut !== 'rejete')
                    <form method="POST" action="{{ route('complaints.update-status', $complaint->id) }}" class="inline">
                        @csrf
                        <input type="hidden" name="statut" value="rejete">
                        <button type="submit" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs sm:text-sm rounded-lg">
                            <i class="fas fa-times mr-1"></i>Rejeter
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
