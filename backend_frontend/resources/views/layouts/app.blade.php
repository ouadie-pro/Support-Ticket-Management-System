<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion Tickets & Réclamations')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link:hover { background-color: rgba(255,255,255,0.1); }
        .sidebar-link.active { background-color: rgba(255,255,255,0.15); border-left: 3px solid #fff; }
        .sidebar-overlay { transition: opacity 0.3s ease; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex" x-data="{ sidebarOpen: false }">
        <!-- Mobile Sidebar Overlay -->
        <div 
            x-show="sidebarOpen" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-black/50 z-40 md:hidden sidebar-overlay"
        ></div>

        <!-- Sidebar -->
        @auth
        <aside 
            x-show="sidebarOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            @click.away="sidebarOpen = false"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-slate-800 to-slate-900 transform md:hidden"
        >
            <div class="p-6 border-b border-slate-700 flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-headset text-white text-lg"></i>
                    </div>
                    <span class="text-white text-lg font-semibold">SupportPro</span>
                </a>
                <button @click="sidebarOpen = false" class="text-slate-400 hover:text-white p-2">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto max-h-[calc(100vh-180px)]">
                <a href="{{ route('dashboard') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-300 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('tickets.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-300 {{ request()->routeIs('tickets.*') ? 'active' : '' }}">
                    <i class="fas fa-ticket-alt w-5"></i>
                    <span>Tickets</span>
                </a>
                
                <a href="{{ route('complaints.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-300 {{ request()->routeIs('complaints.*') ? 'active' : '' }}">
                    <i class="fas fa-exclamation-triangle w-5"></i>
                    <span>Réclamations</span>
                </a>

                @if(Auth::user()->isAdmin())
                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Administration</p>
                </div>
                
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-300 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-cogs w-5"></i>
                    <span>Tableau de bord</span>
                </a>
                
                <a href="{{ route('admin.users') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-300 {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    <span>Utilisateurs</span>
                </a>

                <a href="{{ route('admin.reports') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-300 {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar w-5"></i>
                    <span>Rapports</span>
                </a>
                @endif

                @if(Auth::user()->isAgent())
                <a href="{{ route('agent.dashboard') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-300 {{ request()->routeIs('agent.*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie w-5"></i>
                    <span>Espace Agent</span>
                </a>
                @endif
            </nav>

            <div class="p-4 border-t border-slate-700 space-y-1">
                <a href="{{ route('profile.show') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg text-slate-300 hover:bg-white/10 transition">
                    <i class="fas fa-user-circle w-5"></i>
                    <span>Mon Profil</span>
                </a>
                <div class="flex items-center space-x-3 px-4 py-2">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ Auth::user()->role ? Auth::user()->role->libelle : 'Utilisateur' }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Desktop Sidebar -->
        <aside class="hidden md:flex flex-col w-64 bg-gradient-to-b from-slate-800 to-slate-900 min-h-screen flex-shrink-0">
            <div class="p-6 border-b border-slate-700">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-headset text-white text-lg"></i>
                    </div>
                    <span class="text-white text-lg font-semibold">SupportPro</span>
                </a>
            </div>
            
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-300 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('tickets.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-300 {{ request()->routeIs('tickets.*') ? 'active' : '' }}">
                    <i class="fas fa-ticket-alt w-5"></i>
                    <span>Tickets</span>
                </a>
                
                <a href="{{ route('complaints.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-300 {{ request()->routeIs('complaints.*') ? 'active' : '' }}">
                    <i class="fas fa-exclamation-triangle w-5"></i>
                    <span>Réclamations</span>
                </a>

                @if(Auth::user()->isAdmin())
                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Administration</p>
                </div>
                
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-300 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-cogs w-5"></i>
                    <span>Tableau de bord</span>
                </a>
                
                <a href="{{ route('admin.users') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-300 {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    <span>Utilisateurs</span>
                </a>

                <a href="{{ route('admin.reports') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-300 {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar w-5"></i>
                    <span>Rapports</span>
                </a>
                @endif

                @if(Auth::user()->isAgent())
                <a href="{{ route('agent.dashboard') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-slate-300 {{ request()->routeIs('agent.*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie w-5"></i>
                    <span>Espace Agent</span>
                </a>
                @endif
            </nav>

            <div class="p-4 border-t border-slate-700 space-y-1">
                <a href="{{ route('profile.show') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg text-slate-300 hover:bg-white/10 transition">
                    <i class="fas fa-user-circle w-5"></i>
                    <span>Mon Profil</span>
                </a>
                <div class="flex items-center space-x-3 px-4 py-2">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ Auth::user()->role ? Auth::user()->role->libelle : 'Utilisateur' }}</p>
                    </div>
                </div>
            </div>
        </aside>
        @endauth

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-4 md:px-6 py-3 md:py-4">
                    <div class="flex items-center space-x-3">
                        <button @click="sidebarOpen = true" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-bars text-gray-600 text-lg"></i>
                        </button>
                        <h1 class="text-lg md:text-xl font-semibold text-gray-800 truncate">@yield('page-title', 'Tableau de bord')</h1>
                    </div>
                    
                    <div class="flex items-center gap-2 md:gap-4">
                        @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="p-2 rounded-lg hover:bg-gray-100 relative">
                                <i class="fas fa-bell text-gray-600"></i>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">{{ auth()->user()->unreadNotifications->count() > 9 ? '9+' : auth()->user()->unreadNotifications->count() }}</span>
                                @endif
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute right-0 mt-2 w-72 md:w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                                <div class="p-3 border-b border-gray-200 flex justify-between items-center">
                                    <h3 class="font-semibold text-gray-900">Notifications</h3>
                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="text-xs text-red-600 font-medium">{{ auth()->user()->unreadNotifications->count() }} non lue(s)</span>
                                    @endif
                                </div>
                                <div class="max-h-64 md:max-h-80 overflow-y-auto">
                                    @forelse(auth()->user()->notifications->take(10) as $notification)
                                    <div class="p-3 border-b border-gray-100 hover:bg-gray-50 {{ $notification->read_at ? 'opacity-60' : '' }}">
                                        @if(isset($notification->data['type']) && isset($notification->data['id']))
                                            @if($notification->data['type'] === 'ticket')
                                                <a href="{{ route('tickets.show', $notification->data['id']) }}" class="block">
                                            @elseif($notification->data['type'] === 'complaint')
                                                <a href="{{ route('complaints.show', $notification->data['id']) }}" class="block">
                                            @endif
                                        @endif
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-bell text-blue-600 text-xs"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">{{ $notification->data['title'] ?? 'Notification' }}</p>
                                                <p class="text-xs text-gray-500 mt-0.5 truncate">{{ $notification->data['message'] ?? '' }}</p>
                                                <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                            @if(!$notification->read_at)
                                            <span class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0 mt-2"></span>
                                            @endif
                                        </div>
                                        @if(isset($notification->data['type']) && isset($notification->data['id']))
                                        </a>
                                        @endif
                                    </div>
                                    @empty
                                    <div class="p-6 text-center text-gray-500 text-sm">
                                        <i class="fas fa-bell-slash text-3xl mb-2 text-gray-300"></i>
                                        <p>Aucune notification</p>
                                    </div>
                                    @endforelse
                                </div>
                                @if(auth()->user()->notifications->count() > 0)
                                <div class="p-2 border-t border-gray-200">
                                    <form method="POST" action="{{ route('notifications.markRead') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-center text-sm text-blue-600 hover:text-blue-700 font-medium">
                                            Tout marquer comme lu
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endauth
                        
                        @auth
                        <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                            @csrf
                            <button type="submit" class="flex items-center space-x-2 px-3 md:px-4 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="hidden md:inline">Déconnexion</span>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('logout') }}" class="sm:hidden">
                            @csrf
                            <button type="submit" class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-blue-600">Connexion</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition">Inscription</a>
                        @endauth
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 md:p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
