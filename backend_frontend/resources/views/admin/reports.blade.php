@extends('layouts.app')

@section('page-title', 'Rapports & Statistiques')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Rapports & Statistiques</h2>
        <p class="text-gray-500">Analysez les performances du système</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Tickets by Priority -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tickets par Priorité</h3>
            <div class="space-y-3">
                @forelse($tickets_par_priorite as $item)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-flag text-gray-600"></i>
                        </div>
                        <span class="font-medium text-gray-900">{{ ucfirst($item->priorite) }}</span>
                    </div>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">{{ $item->total }}</span>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Aucune donnée</p>
                @endforelse
            </div>
        </div>

        <!-- Complaints by Type -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Réclamations par Type</h3>
            <div class="space-y-3">
                @forelse($complaints_par_type as $item)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-tags text-gray-600"></i>
                        </div>
                        <span class="font-medium text-gray-900">{{ ucfirst($item->type) }}</span>
                    </div>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">{{ $item->total }}</span>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Aucune donnée</p>
                @endforelse
            </div>
        </div>

        <!-- Tickets by Status -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tickets par Statut</h3>
            <div class="space-y-3">
                @forelse($tickets_par_statut as $item)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <span class="font-medium text-gray-900">{{ ucfirst($item->statut) }}</span>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">{{ $item->total }}</span>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Aucune donnée</p>
                @endforelse
            </div>
        </div>

        <!-- Complaints by Status -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Réclamations par Statut</h3>
            <div class="space-y-3">
                @forelse($complaints_par_statut as $item)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <span class="font-medium text-gray-900">{{ ucfirst($item->statut) }}</span>
                    </div>
                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">{{ $item->total }}</span>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Aucune donnée</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
