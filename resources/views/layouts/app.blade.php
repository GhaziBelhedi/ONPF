<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONPF</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="h-full overflow-hidden">
<div class="flex h-screen bg-gray-100">

    <!-- Sidebar -->
    <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-64 border-r border-gray-200 bg-white shadow-sm">
            <div class="flex flex-col flex-grow pt-6 pb-4 overflow-y-auto">

                <!-- Logo -->
                <div class="flex items-center flex-shrink-0 px-6 mb-8">
                    <span class="text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-violet-600">ONPF</span>
                </div>

                <nav class="flex-1 px-4 space-y-1">

                    <!-- Stock — tous les rôles -->
                    <a href="{{ route('articles.index') }}"
                       class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-150
                              {{ request()->routeIs('articles.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ request()->routeIs('articles.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        Stock
                    </a>

                    <!-- Navigation selon le rôle -->
                    @if(Auth::user()->role === 'magasinier')

                        <a href="{{ route('demandes.index') }}"
                           class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-150
                                  {{ request()->routeIs('demandes.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ request()->routeIs('demandes.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                            Mes Demandes
                        </a>

                        <a href="{{ route('magasinier.commandes.index') }}"
                           class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-150
                                  {{ request()->routeIs('magasinier.commandes.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ request()->routeIs('magasinier.commandes.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                            Bons de Sortie
                        </a>

                    @elseif(Auth::user()->role === 'direction_centrale')

                        <a href="{{ route('admin.demandes.index') }}"
                           class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-150
                                  {{ request()->routeIs('admin.demandes.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.demandes.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Demandes Reçues
                        </a>

                        <a href="{{ route('central.commandes.index') }}"
                           class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-150
                                  {{ request()->routeIs('central.commandes.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ request()->routeIs('central.commandes.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            Validation & Expédition
                        </a>

                    @elseif(Auth::user()->role === 'administratif')

                        <a href="{{ route('admin.demandes.index') }}"
                           class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-150
                                  {{ request()->routeIs('admin.demandes.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.demandes.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Demandes Reçues
                        </a>

                        <a href="{{ route('admin.commandes.index') }}"
                           class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-150
                                  {{ request()->routeIs('admin.commandes.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.commandes.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Commandes
                        </a>

                    @endif

                    <!-- Compte -->
                    <div class="pt-4 mt-4 border-t border-gray-100">
                        <span class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Compte</span>

                        <a href="{{ route('profile.edit') }}"
                           class="mt-2 group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-150
                                  {{ request()->routeIs('profile.edit') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="mr-3 h-5 w-5 flex-shrink-0 {{ request()->routeIs('profile.edit') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profil
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full group flex items-center px-3 py-2.5 text-sm font-medium text-red-600 rounded-lg hover:bg-red-50 transition-all duration-150">
                                <svg class="mr-3 h-5 w-5 text-red-400 group-hover:text-red-500 flex-shrink-0"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </nav>
            </div>

            <!-- User info -->
            <div class="flex-shrink-0 border-t border-gray-200 p-4 bg-gray-50">
                <div class="flex items-center">
                    <div class="h-9 w-9 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="ml-3 min-w-0">
                        <p class="text-sm font-medium text-gray-800 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="flex flex-col w-0 flex-1 overflow-hidden">

        <!-- Mobile header -->
        <div class="md:hidden flex items-center justify-between bg-white border-b border-gray-200 px-4 py-3">
            <span class="text-xl font-bold text-indigo-600">ONPF</span>
            <button class="text-gray-500 hover:text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </button>
        </div>

        <main class="flex-1 relative overflow-y-auto focus:outline-none">
            <div class="py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                    <!-- Flash messages -->
                    @if(session('success'))
                        <div class="mb-6 flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm">
                            <svg class="h-5 w-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 flex items-start gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">
                            <svg class="h-5 w-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="mb-6 flex items-start gap-3 bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-lg text-sm">
                            <svg class="h-5 w-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <span>{{ session('warning') }}</span>
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>
