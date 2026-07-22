<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Rencana Karierku') - Perencanaan Karier SMA</title>
    
    <!-- Meta SEO -->
    <meta name="description" content="Aplikasi web untuk membantu siswa SMA menyusun perencanaan karier dari asesmen diri hingga pengambilan keputusan.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-neutral-dark bg-neutral-light selection:bg-primary-500 selection:text-white flex flex-col min-h-screen">
    
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2 text-slate-900 font-semibold">
                <img src="{{ asset('images/logo.png') }}" alt="RencanaKarierku Logo" class="w-8 h-8 object-contain">
                RencanaKarierku
            </div>
            <p class="text-slate-500 text-sm text-center md:text-left">
                &copy; {{ date('Y') }} Rencana Karierku. Semua Hak Dilindungi.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    @stack('scripts')
    
    <x-flash-messages />
</body>
</html>
