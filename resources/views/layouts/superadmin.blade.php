<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Super Admin') - Rencana Karierku</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-neutral-dark bg-neutral-light selection:bg-primary-500 selection:text-white flex h-screen overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col hidden md:flex shrink-0 text-white">
        <!-- Logo -->
        <div class="h-16 flex items-center px-6 border-b border-slate-800 bg-slate-950">
            <a href="{{ Auth::user()->role === 'superadmin' ? route('superadmin.dashboard') : route('admin.dashboard') }}" class="inline-flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                <span class="font-bold text-lg tracking-tight text-white">
                    Rencana<span class="text-primary-400">Karierku</span>
                </span>
            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-4 px-3">Super Admin</div>
            
            <a href="{{ route('superadmin.dashboard') }}" class="{{ request()->routeIs('superadmin.*') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors">
                <svg class="{{ request()->routeIs('superadmin.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-300' }} mr-3 flex-shrink-0 h-5 w-5 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Kelola Admin
            </a>
        </nav>

        <!-- Profile / Logout -->
        <div class="p-4 border-t border-slate-800 bg-slate-950">
            <div class="flex items-center w-full px-3 py-2">
                <div class="w-8 h-8 rounded-full bg-primary-900 text-primary-200 flex items-center justify-center font-bold text-sm mr-3">
                    SA
                </div>
                <div class="flex-1 truncate">
                    <p class="text-sm font-medium text-white truncate">Super Admin</p>
                    <p class="text-xs text-slate-400 truncate">super@example.com</p>
                </div>
                <button class="text-slate-400 hover:text-red-500 transition-colors" title="Logout">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top header for mobile -->
        <header class="md:hidden h-16 bg-slate-900 border-b border-slate-800 flex items-center justify-between px-4">
            <a href="{{ Auth::user()->role === 'superadmin' ? route('superadmin.dashboard') : route('admin.dashboard') }}" class="inline-flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
            </a>
            <button class="text-slate-400 hover:text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
            <div class="max-w-7xl mx-auto">
                <div class="mb-6 md:mb-8">
                    <h1 class="text-2xl md:text-3xl font-bold text-slate-900">@yield('page_title')</h1>
                    @hasSection('page_description')
                        <p class="mt-1 text-sm md:text-base text-slate-500">@yield('page_description')</p>
                    @endif
                </div>
                
                @yield('content')
            </div>
        </main>
    </div>

    <x-flash-messages />
</body>
</html>
