@extends('layouts.app')

@section('title', 'Modifier l\'évaluation de satisfaction')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Modifier l'évaluation de satisfaction</h1>
    
    <form action="{{ route('satisfactions.update', $satisfaction->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Ticket</label>
                <input type="number" name="ticket_id" value="{{ $satisfaction->ticket_id }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Client</label>
                <input type="number" name="client_id" value="{{ $satisfaction->client_id }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Note</label>
                <input type="number" name="note" step="0.01" value="{{ $satisfaction->note }}" class="w-full border rounded px-3 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Commentaire</label>
                <textarea name="commentaire" rows="3" class="w-full border rounded px-3 py-2">{{ $satisfaction->commentaire }}</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Date d'évaluation</label>
                <input type="date" name="date_evaluation" value="{{ $satisfaction->date_evaluation }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>
        
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mettre à jour</button>
            <a href="{{ route('satisfactions.show', $satisfaction->id) }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
        </div>
    </form>
</div>
@endsection
