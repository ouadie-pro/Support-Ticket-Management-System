@extends('layouts.app')

@section('page-title', 'Paramètres')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Paramètres</h2>
        <p class="text-gray-500">Configurez les paramètres du système</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- General Settings -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Paramètres Généraux</h3>
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom de l'application</label>
                    <input type="text" value="SupportPro" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email de contact</label>
                    <input type="email" value="support@example.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                    Enregistrer
                </button>
            </form>
        </div>

        <!-- Notification Settings -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Notifications</h3>
            <div class="space-y-4">
                <label class="flex items-center justify-between">
                    <span class="text-gray-700">Notifications par email</span>
                    <input type="checkbox" checked class="h-5 w-5 text-blue-600 rounded">
                </label>
                <label class="flex items-center justify-between">
                    <span class="text-gray-700">Alertes nouveaux tickets</span>
                    <input type="checkbox" checked class="h-5 w-5 text-blue-600 rounded">
                </label>
                <label class="flex items-center justify-between">
                    <span class="text-gray-700">Alertes nouvelles réclamations</span>
                    <input type="checkbox" checked class="h-5 w-5 text-blue-600 rounded">
                </label>
            </div>
        </div>
    </div>
</div>
@endsection
