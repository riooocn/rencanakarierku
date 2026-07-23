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
    
@if(session('account_pending'))
<!-- Pending Account Modal -->
<div id="pendingModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-8 transform transition-all translate-y-0 scale-100">
        <div class="flex items-center justify-center w-20 h-20 mx-auto bg-amber-50 rounded-full mb-6 ring-8 ring-amber-50/50">
            <svg class="w-10 h-10 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        
        <h3 class="text-xl font-extrabold text-center text-slate-900 mb-2 tracking-tight">Menunggu Verifikasi</h3>
        <p class="text-center text-slate-600 mb-8 text-sm leading-relaxed">{{ session('account_pending') }}</p>
        
        <div class="flex flex-col gap-3">
            <button onclick="document.getElementById('pendingModal').style.display='none';" class="w-full py-3.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>
@endif

@if(session('account_inactive'))
<!-- Inactive Account Modal -->
<div id="inactiveModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-8 transform transition-all translate-y-0 scale-100">
        <div class="flex items-center justify-center w-20 h-20 mx-auto bg-red-50 rounded-full mb-6 ring-8 ring-red-50/50">
            <svg class="w-10 h-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        
        <h3 class="text-xl font-extrabold text-center text-slate-900 mb-2 tracking-tight">Akun Non-aktif</h3>
        <p class="text-center text-slate-600 mb-8 text-sm leading-relaxed">Akun Anda berstatus non-aktif. Silakan hubungi kontak yang tersedia untuk informasi lebih lanjut.</p>
        
        <div class="flex flex-col gap-3">
            <button onclick="document.getElementById('inactiveModal').style.display='none';" class="w-full py-3.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>
@endif
</body>
</html>
