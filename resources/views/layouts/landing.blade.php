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
    <header class="fixed top-0 inset-x-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <!-- Logo -->
                    <img src="{{ asset('images/logo.png') }}" alt="RencanaKarierku Logo" class="w-8 h-8 object-contain">

                    <a href="{{ url('/') }}" class="font-bold text-xl tracking-tight text-slate-900">
                        Rencana<span class="text-primary-600">Karierku</span>
                    </a>
                </div>
                
                <nav class="hidden md:flex gap-8">
                    <a href="{{ url('/') }}" class="text-sm font-medium text-slate-600 hover:text-primary-600 transition-colors">Home</a>
                    <a href="{{ route('perjalananku.index') }}" class="text-sm font-medium text-slate-600 hover:text-primary-600 transition-colors">Perjalananku</a>
                    <a href="{{ route('contact') }}" class="text-sm font-medium text-slate-600 hover:text-primary-600 transition-colors">Contact</a>
                </nav>

                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-primary-600 transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-full hover:bg-primary-700 shadow-sm shadow-primary-500/30 transition-all hover:-translate-y-0.5">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </header>

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

</body>
</html>
