@extends('layouts.app')

@section('title', 'Ticket')

@section('content')
<div class="space-y-4 md:space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 md:gap-4">
        <div>
            <h1 class="text-xl md:text-2xl font-bold text-gray-900">Ticket {{ $ticket->numero }}</h1>
            <p class="text-gray-500 mt-1 text-sm md:text-base">Créé le {{ $ticket->created_at->format('d/m/Y à H:i') }}</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('tickets.index') }}" class="px-3 sm:px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition text-sm">
                <i class="fas fa-arrow-left mr-2"></i>Retour
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-4 md:space-y-6">
            <!-- Ticket Details -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">{{ $ticket->sujet }}</h3>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="prose max-w-none text-gray-700 whitespace-pre-wrap text-sm sm:text-base">{{ $ticket->description }}</div>
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
                    @forelse($ticket->commentaires as $comment)
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
                            @if($comment->utilisateur_id === auth()->id())
                            <div class="mt-2 text-right">
                                <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs opacity-50 hover:opacity-100" onclick="return confirm('Supprimer ce message?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @endif
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
                            onchange="if(this.value) { document.querySelector('#ticket-contenu').value = this.value; this.value = ''; }">
                            <option value="">-- Insérer une réponse prédéfinie --</option>
                            @foreach($reponsePredefinies as $reponse)
                            <option value="{{ $reponse->contenu }}">{{ $reponse->titre }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('tickets.comments.store', $ticket->id) }}" id="reply-form">
                        @csrf
                        <div class="flex gap-2 sm:gap-3">
                            <textarea name="contenu" id="ticket-contenu" placeholder="Écrire une réponse..." rows="2" required
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
                        <p class="font-medium text-gray-900 text-sm sm:text-base">{{ $ticket->client->nom ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Catégorie</label>
                        <p class="font-medium text-gray-900 text-sm sm:text-base">{{ $ticket->categorie->libelle ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Assigné à</label>
                        <p class="font-medium text-gray-900 text-sm sm:text-base">{{ $ticket->agent->nom ?? 'Non assigné' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Priorité</label>
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full 
                            @if($ticket->priorite === 'urgente') bg-red-100 text-red-800
                            @elseif($ticket->priorite === 'haute') bg-orange-100 text-orange-800
                            @elseif($ticket->priorite === 'moyenne') bg-yellow-100 text-yellow-800
                            @else bg-green-100 text-green-800 @endif">
                            {{ ucfirst($ticket->priorite) }}
                        </span>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Statut</label>
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full 
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
                    </div>
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
                    <form method="POST" action="{{ route('tickets.assign', $ticket->id) }}">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700 mb-2">Assigner à un agent</label>
                        <select name="assigne_a" class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-2 text-sm">
                            <option value="">Sélectionner un agent...</option>
                            @foreach($agents as $agent)
                            <option value="{{ $agent->id }}" {{ $ticket->assigne_a == $agent->id ? 'selected' : '' }}>
                                {{ $agent->name }}
                            </option>
                            @endforeach
                        </select>
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm">
                            <i class="fas fa-user-plus mr-2"></i>Assigner
                        </button>
                    </form>

                    <!-- Change Priority -->
                    <form method="POST" action="{{ route('tickets.update', $ticket->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="sujet" value="{{ $ticket->sujet }}">
                        <input type="hidden" name="description" value="{{ $ticket->description }}">
                        <input type="hidden" name="client_id" value="{{ $ticket->client_id }}">
                        <input type="hidden" name="categorie_id" value="{{ $ticket->categorie_id }}">
                        <input type="hidden" name="assigne_a" value="{{ $ticket->assigne_a }}">
                        <input type="hidden" name="statut" value="{{ $ticket->statut }}">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Modifier la priorité</label>
                        <select name="priorite" class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-2 text-sm">
                            <option value="faible" {{ $ticket->priorite === 'faible' ? 'selected' : '' }}>Faible</option>
                            <option value="moyenne" {{ $ticket->priorite === 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                            <option value="haute" {{ $ticket->priorite === 'haute' ? 'selected' : '' }}>Haute</option>
                            <option value="urgente" {{ $ticket->priorite === 'urgente' ? 'selected' : '' }}>Urgente</option>
                        </select>
                        <button type="submit" class="w-full px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg text-sm">
                            <i class="fas fa-arrow-up mr-2"></i>Mettre à jour
                        </button>
                    </form>

                    <!-- Change Status -->
                    <form method="POST" action="{{ route('tickets.update-status', $ticket->id) }}">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700 mb-2">Changer le statut</label>
                        <select name="statut" class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-2 text-sm">
                            <option value="ouvert" {{ $ticket->statut === 'ouvert' ? 'selected' : '' }}>Ouvert</option>
                            <option value="en_cours" {{ $ticket->statut === 'en_cours' ? 'selected' : '' }}>En cours</option>
                            <option value="resolu" {{ $ticket->statut === 'resolu' ? 'selected' : '' }}>Résolu</option>
                            <option value="ferme" {{ $ticket->statut === 'ferme' ? 'selected' : '' }}>Fermé</option>
                        </select>
                        <button type="submit" class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg text-sm">
                            <i class="fas fa-check mr-2"></i>Mettre à jour
                        </button>
                    </form>
                </div>
            </div>

            <!-- Quick Status Buttons -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">Actions rapides</h3>
                </div>
                <div class="p-3 sm:p-4 flex flex-wrap gap-2">
                    @if($ticket->statut !== 'en_cours')
                    <form method="POST" action="{{ route('tickets.update-status', $ticket->id) }}" class="inline">
                        @csrf
                        <input type="hidden" name="statut" value="en_cours">
                        <button type="submit" class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm rounded-lg">
                            <i class="fas fa-play mr-1"></i>Prendre en charge
                        </button>
                    </form>
                    @endif
                    @if($ticket->statut !== 'resolu')
                    <form method="POST" action="{{ route('tickets.update-status', $ticket->id) }}" class="inline">
                        @csrf
                        <input type="hidden" name="statut" value="resolu">
                        <button type="submit" class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs sm:text-sm rounded-lg">
                            <i class="fas fa-check mr-1"></i>Résoudre
                        </button>
                    </form>
                    @endif
                    @if($ticket->statut !== 'ferme')
                    <form method="POST" action="{{ route('tickets.update-status', $ticket->id) }}" class="inline">
                        @csrf
                        <input type="hidden" name="statut" value="ferme">
                        <button type="submit" class="px-3 py-2 bg-gray-600 hover:bg-gray-700 text-white text-xs sm:text-sm rounded-lg">
                            <i class="fas fa-lock mr-1"></i>Fermer
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
