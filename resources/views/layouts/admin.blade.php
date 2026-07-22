<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') - Rencana Karierku</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-neutral-dark bg-neutral-light selection:bg-primary-500 selection:text-white flex h-screen overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col hidden md:flex shrink-0">
        <!-- Logo -->
        <div class="h-16 flex items-center px-6 border-b border-slate-200">
            <a href="{{ Auth::user()->role === 'superadmin' ? route('superadmin.dashboard') : route('admin.dashboard') }}" class="inline-flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                <span class="font-bold text-lg tracking-tight text-slate-900">
                    Rencana<span class="text-primary-600">Karierku</span>
                </span>
            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-4 px-3">
                Menu {{ Auth::user()->role === 'superadmin' ? 'Super Admin' : 'Admin' }}
            </div>
            
            @if(Auth::user()->role === 'superadmin')
                <a href="{{ route('superadmin.dashboard') }}" class="{{ request()->routeIs('superadmin.dashboard') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors mb-1">
                    <svg class="{{ request()->routeIs('superadmin.dashboard') ? 'text-primary-600' : 'text-slate-400 group-hover:text-slate-500' }} mr-3 flex-shrink-0 h-5 w-5 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard Utama
                </a>
                
                <a href="{{ route('superadmin.admin.index') }}" class="{{ request()->routeIs('superadmin.admin.*') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors mb-1">
                    <svg class="{{ request()->routeIs('superadmin.admin.*') ? 'text-primary-600' : 'text-slate-400 group-hover:text-slate-500' }} mr-3 flex-shrink-0 h-5 w-5 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Kelola Admin Instansi
                </a>
                
                <a href="{{ route('superadmin.peserta.index') }}" class="{{ request()->routeIs('superadmin.peserta.*') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors mb-1">
                    <svg class="{{ request()->routeIs('superadmin.peserta.*') ? 'text-primary-600' : 'text-slate-400 group-hover:text-slate-500' }} mr-3 flex-shrink-0 h-5 w-5 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Semua Peserta Global
                </a>
            @else
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors mb-1">
                    <svg class="{{ request()->routeIs('admin.dashboard') ? 'text-primary-600' : 'text-slate-400 group-hover:text-slate-500' }} mr-3 flex-shrink-0 h-5 w-5 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard Admin
                </a>
                
                <a href="{{ route('admin.peserta.index') }}" class="{{ request()->routeIs('admin.peserta.*') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors mb-1">
                    <svg class="{{ request()->routeIs('admin.peserta.*') ? 'text-primary-600' : 'text-slate-400 group-hover:text-slate-500' }} mr-3 flex-shrink-0 h-5 w-5 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Daftar Siswa
                </a>
            @endif

        </nav>

        <!-- Profile / Logout -->
        <div class="p-4 border-t border-slate-200">
            <div class="flex items-center w-full px-3 py-2">
                <div class="w-8 h-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-sm mr-3">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 truncate">
                    <p class="text-sm font-medium text-slate-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-slate-400 hover:text-red-600 transition-colors" title="Logout">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top header for mobile -->
        <header class="md:hidden h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4">
            <a href="{{ Auth::user()->role === 'superadmin' ? route('superadmin.dashboard') : route('admin.dashboard') }}" class="inline-flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
            </a>
            <button class="text-slate-500 hover:text-slate-900 focus:outline-none">
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
