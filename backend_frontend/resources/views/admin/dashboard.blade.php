@extends('layouts.app')

@section('page-title', 'Administration')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Total Utilisateurs</p>
                    <p class="text-4xl font-bold mt-2">{{ $stats['total_users'] }}</p>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-700 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">Total Tickets</p>
                    <p class="text-4xl font-bold mt-2">{{ $stats['total_tickets'] }}</p>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-ticket-alt text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-sm">Réclamations</p>
                    <p class="text-4xl font-bold mt-2">{{ $stats['total_complaints'] }}</p>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm">Tickets Ouverts</p>
                    <p class="text-4xl font-bold mt-2">{{ $stats['tickets_ouverts'] }}</p>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-folder-open text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tickets par Statut</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-600">Ouverts</span>
                        <span class="font-medium">{{ $stats['tickets_ouverts'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $stats['total_tickets'] > 0 ? ($stats['tickets_ouverts'] / $stats['total_tickets'] * 100) : 0 }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-600">En cours</span>
                        <span class="font-medium">{{ $stats['tickets_en_cours'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $stats['total_tickets'] > 0 ? ($stats['tickets_en_cours'] / $stats['total_tickets'] * 100) : 0 }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-600">Résolus</span>
                        <span class="font-medium">{{ $stats['tickets_resolus'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ $stats['total_tickets'] > 0 ? ($stats['tickets_resolus'] / $stats['total_tickets'] * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Réclamations par Statut</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-600">Soumis</span>
                        <span class="font-medium">{{ $stats['complaints_soumis'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $stats['total_complaints'] > 0 ? ($stats['complaints_soumis'] / $stats['total_complaints'] * 100) : 0 }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-600">En cours</span>
                        <span class="font-medium">{{ $stats['complaints_en_cours'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $stats['total_complaints'] > 0 ? ($stats['complaints_en_cours'] / $stats['total_complaints'] * 100) : 0 }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-600">Résolus</span>
                        <span class="font-medium">{{ $stats['complaints_resolus'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ $stats['total_complaints'] > 0 ? ($stats['complaints_resolus'] / $stats['total_complaints'] * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Users by Role -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Utilisateurs par Rôle</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($users_par_role as $role)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-tag text-blue-600"></i>
                            </div>
                            <span class="font-medium text-gray-900">{{ ucfirst($role->code) }}</span>
                        </div>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">{{ $role->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Activité Récente</h3>
                <a href="{{ route('admin.reports') }}" class="text-sm text-blue-600 hover:text-blue-700">Voir tout</a>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($activites_recentes as $activite)
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center
                            @if($activite->action === 'create') bg-green-100
                            @elseif($activite->action === 'update' || $activite->action === 'comment_added') bg-blue-100
                            @elseif($activite->action === 'delete') bg-red-100
                            @elseif($activite->action === 'status_changed') bg-purple-100
                            @elseif($activite->action === 'assigned') bg-yellow-100
                            @else bg-gray-100 @endif">
                            @if($activite->action === 'create')
                                <i class="fas fa-plus text-green-600"></i>
                            @elseif($activite->action === 'update')
                                <i class="fas fa-edit text-blue-600"></i>
                            @elseif($activite->action === 'comment_added')
                                <i class="fas fa-comment text-blue-600"></i>
                            @elseif($activite->action === 'delete')
                                <i class="fas fa-trash text-red-600"></i>
                            @elseif($activite->action === 'status_changed')
                                <i class="fas fa-exchange-alt text-purple-600"></i>
                            @elseif($activite->action === 'assigned')
                                <i class="fas fa-user-plus text-yellow-600"></i>
                            @else
                                <i class="fas fa-history text-gray-600"></i>
                            @endif
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">
                                @if($activite->action === 'create') Création
                                @elseif($activite->action === 'update') Modification
                                @elseif($activite->action === 'comment_added') Nouveau commentaire
                                @elseif($activite->action === 'delete') Suppression
                                @elseif($activite->action === 'status_changed') Changement de statut
                                @elseif($activite->action === 'assigned') Assignation
                                @else {{ $activite->action }}
                                @endif
                            </p>
                            <p class="text-sm text-gray-500">
                                @if($activite->utilisateur)
                                    par {{ $activite->utilisateur->name }}
                                @endif
                                - {{ $activite->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                        {{ class_basename($activite->objet_type) ?? 'N/A' }}
                    </span>
                </div>
                @empty
                <div class="px-6 py-8 text-center text-gray-500">
                    <i class="fas fa-history text-4xl mb-3 text-gray-300"></i>
                    <p>Aucune activité récente</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
