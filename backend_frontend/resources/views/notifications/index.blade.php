@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Notifications</h1>
        <a href="{{ route('notifications.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Créer une notification</a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Utilisateur</th>
                <th class="px-4 py-2 text-left">Titre</th>
                <th class="px-4 py-2 text-left">Message</th>
                <th class="px-4 py-2 text-left">Lu</th>
                <th class="px-4 py-2 text-left">Date d'envoi</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notifications as $notification)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $notification->utilisateur_id }}</td>
                <td class="px-4 py-2">{{ $notification->titre }}</td>
                <td class="px-4 py-2">{{ Str::limit($notification->message, 30) }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 text-xs rounded {{ $notification->lu ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $notification->lu ? 'Lu' : 'Non lu' }}
                    </span>
                </td>
                <td class="px-4 py-2">{{ $notification->date_envoi }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('notifications.show', $notification->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('notifications.edit', $notification->id) }}" class="text-yellow-600 hover:underline ml-2">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
