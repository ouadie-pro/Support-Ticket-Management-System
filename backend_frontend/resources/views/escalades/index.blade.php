@extends('layouts.app')

@section('title', 'Escalades')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Escalades</h1>
        <a href="{{ route('escalades.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Créer une escalade</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Ticket</th>
                <th class="px-4 py-2 text-left">De</th>
                <th class="px-4 py-2 text-left">Vers</th>
                <th class="px-4 py-2 text-left">Motif</th>
                <th class="px-4 py-2 text-left">Statut</th>
                <th class="px-4 py-2 text-left">Date</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($escalades as $escalade)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $escalade->ticket_id }}</td>
                <td class="px-4 py-2">{{ $escalade->de_utilisateur_id }}</td>
                <td class="px-4 py-2">{{ $escalade->vers_utilisateur_id }}</td>
                <td class="px-4 py-2">{{ Str::limit($escalade->motif, 30) }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 text-xs rounded 
                        @if($escalade->statut === 'resolue') bg-green-100 text-green-800
                        @elseif($escalade->statut === 'rejetee') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        {{ $escalade->statut }}
                    </span>
                </td>
                <td class="px-4 py-2">{{ $escalade->date_escalade }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('escalades.show', $escalade->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('escalades.edit', $escalade->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
