@extends('layouts.app')

@section('page-title', 'Mes Tickets')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Mes Tickets</h2>
            <p class="text-gray-500">Gérez tous vos tickets de support</p>
        </div>
        <a href="{{ route('tickets.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-md">
            <i class="fas fa-plus mr-2"></i>
            Nouveau Ticket
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">N°</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Sujet</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Catégorie</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Priorité</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($tickets as $ticket)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono font-medium text-gray-900">{{ $ticket->numero }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">{{ $ticket->sujet }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $ticket->client->nom ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $ticket->categorie->libelle ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $prioriteColors = [
                                    'urgente' => 'bg-red-100 text-red-800',
                                    'haute' => 'bg-orange-100 text-orange-800',
                                    'moyenne' => 'bg-yellow-100 text-yellow-800',
                                    'faible' => 'bg-green-100 text-green-800'
                                ];
                            @endphp
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $prioriteColors[$ticket->priorite] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $ticket->priorite }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statutColors = [
                                    'ferme' => 'bg-gray-100 text-gray-800',
                                    'resolu' => 'bg-green-100 text-green-800',
                                    'en_cours' => 'bg-blue-100 text-blue-800',
                                    'ouvert' => 'bg-purple-100 text-purple-800'
                                ];
                            @endphp
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $statutColors[$ticket->statut] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $ticket->statut }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                            <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="text-yellow-600 hover:text-yellow-900 font-medium">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-ticket-alt text-4xl mb-3 text-gray-300"></i>
                            <p>Aucun ticket trouvé</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(method_exists($tickets, 'hasPages') && $tickets->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $tickets->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
