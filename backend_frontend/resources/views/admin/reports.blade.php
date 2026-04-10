@extends('layouts.app')

@section('page-title', 'Rapports & Statistiques')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-xl md:text-2xl font-bold text-gray-900">Rapports & Statistiques</h2>
        <p class="text-gray-500 text-sm md:text-base">Analysez les performances du système</p>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 md:gap-6">
        <!-- Tickets by Priority (Pie Chart) -->
        <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
            <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Tickets par Priorité</h3>
            <div class="relative" style="height: 250px;">
                <canvas id="ticketsPrioriteChart"></canvas>
            </div>
        </div>

        <!-- Complaints by Type (Pie Chart) -->
        <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
            <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Réclamations par Type</h3>
            <div class="relative" style="height: 250px;">
                <canvas id="complaintsTypeChart"></canvas>
            </div>
        </div>

        <!-- Tickets by Status (Bar Chart) -->
        <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
            <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Tickets par Statut</h3>
            <div class="relative" style="height: 250px;">
                <canvas id="ticketsStatutChart"></canvas>
            </div>
        </div>

        <!-- Complaints by Status (Bar Chart) -->
        <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
            <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Réclamations par Statut</h3>
            <div class="relative" style="height: 250px;">
                <canvas id="complaintsStatutChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Detailed Lists -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
        <!-- Tickets Details -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                <h3 class="text-base md:text-lg font-semibold text-gray-900">Détails Tickets</h3>
            </div>
            <div class="divide-y divide-gray-200 max-h-64 overflow-y-auto">
                @forelse($tickets_par_statut as $item)
                <div class="px-4 sm:px-6 py-3 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <span class="font-medium text-gray-900 text-sm md:text-base">{{ ucfirst($item->statut) }}</span>
                    </div>
                    <span class="px-2 sm:px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs sm:text-sm font-medium">{{ $item->total }}</span>
                </div>
                @empty
                <div class="px-4 sm:px-6 py-4 text-center text-gray-500 text-sm">Aucune donnée</div>
                @endforelse
            </div>
        </div>

        <!-- Complaints Details -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                <h3 class="text-base md:text-lg font-semibold text-gray-900">Détails Réclamations</h3>
            </div>
            <div class="divide-y divide-gray-200 max-h-64 overflow-y-auto">
                @forelse($complaints_par_statut as $item)
                <div class="px-4 sm:px-6 py-3 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <span class="font-medium text-gray-900 text-sm md:text-base">{{ ucfirst($item->statut) }}</span>
                    </div>
                    <span class="px-2 sm:px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs sm:text-sm font-medium">{{ $item->total }}</span>
                </div>
                @empty
                <div class="px-4 sm:px-6 py-4 text-center text-gray-500 text-sm">Aucune donnée</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chartColors = {
        red: 'rgba(255, 99, 132, 0.7)',
        orange: 'rgba(255, 159, 64, 0.7)',
        yellow: 'rgba(255, 205, 86, 0.7)',
        green: 'rgba(75, 192, 192, 0.7)',
        blue: 'rgba(54, 162, 235, 0.7)',
        purple: 'rgba(153, 102, 255, 0.7)',
        gray: 'rgba(201, 203, 207, 0.7)'
    };

    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, padding: 8 } } }
    };

    // Tickets by Priority (Pie)
    const ticketsPriorite = @json($tickets_par_priorite);
    if (ticketsPriorite.length > 0) {
        new Chart(document.getElementById('ticketsPrioriteChart'), {
            type: 'pie',
            data: {
                labels: ticketsPriorite.map(t => t.priorite.charAt(0).toUpperCase() + t.priorite.slice(1)),
                datasets: [{
                    data: ticketsPriorite.map(t => t.total),
                    backgroundColor: [chartColors.red, chartColors.orange, chartColors.yellow, chartColors.green]
                }]
            },
            options: chartOptions
        });
    } else {
        document.getElementById('ticketsPrioriteChart').parentElement.innerHTML = '<p class="text-gray-500 text-center py-12">Aucune donnée disponible</p>';
    }

    // Complaints by Type (Pie)
    const complaintsType = @json($complaints_par_type);
    if (complaintsType.length > 0) {
        new Chart(document.getElementById('complaintsTypeChart'), {
            type: 'pie',
            data: {
                labels: complaintsType.map(c => c.type.charAt(0).toUpperCase() + c.type.slice(1)),
                datasets: [{
                    data: complaintsType.map(c => c.total),
                    backgroundColor: [chartColors.blue, chartColors.green, chartColors.purple, chartColors.orange]
                }]
            },
            options: chartOptions
        });
    } else {
        document.getElementById('complaintsTypeChart').parentElement.innerHTML = '<p class="text-gray-500 text-center py-12">Aucune donnée disponible</p>';
    }

    // Tickets by Status (Bar)
    const ticketsStatut = @json($tickets_par_statut);
    if (ticketsStatut.length > 0) {
        new Chart(document.getElementById('ticketsStatutChart'), {
            type: 'bar',
            data: {
                labels: ticketsStatut.map(t => t.statut.charAt(0).toUpperCase() + t.statut.slice(1).replace('_', ' ')),
                datasets: [{
                    label: 'Nombre de tickets',
                    data: ticketsStatut.map(t => t.total),
                    backgroundColor: [chartColors.purple, chartColors.blue, chartColors.green, chartColors.gray]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    } else {
        document.getElementById('ticketsStatutChart').parentElement.innerHTML = '<p class="text-gray-500 text-center py-12">Aucune donnée disponible</p>';
    }

    // Complaints by Status (Bar)
    const complaintsStatut = @json($complaints_par_statut);
    if (complaintsStatut.length > 0) {
        new Chart(document.getElementById('complaintsStatutChart'), {
            type: 'bar',
            data: {
                labels: complaintsStatut.map(c => c.statut.charAt(0).toUpperCase() + c.statut.slice(1).replace('_', ' ')),
                datasets: [{
                    label: 'Nombre de réclamations',
                    data: complaintsStatut.map(c => c.total),
                    backgroundColor: [chartColors.yellow, chartColors.blue, chartColors.green, chartColors.red, chartColors.gray]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    } else {
        document.getElementById('complaintsStatutChart').parentElement.innerHTML = '<p class="text-gray-500 text-center py-12">Aucune donnée disponible</p>';
    }
});
</script>
@endpush
