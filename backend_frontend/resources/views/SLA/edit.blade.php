@extends('layouts.app')

@section('title', 'Modifier le SLA')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Modifier le SLA</h1>
    
    <form action="{{ route('slas.update', $sla->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Catégorie Ticket ID</label>
                <input type="number" name="categorie_ticket_id" value="{{ $sla->categorie_ticket_id }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Délai première réponse (h)</label>
                <input type="number" name="delai_premiere_reponse_h" value="{{ $sla->delai_premiere_reponse_h }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Délai résolution (h)</label>
                <input type="number" name="delai_resolution_h" value="{{ $sla->delai_resolution_h }}" required class="w-full border rounded px-3 py-2">
            </div>
        </div>
        
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mettre à jour</button>
            <a href="{{ route('slas.show', $sla->id) }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
        </div>
    </form>
</div>
@endsection
