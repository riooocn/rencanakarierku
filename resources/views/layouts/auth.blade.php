<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Autentikasi') - Rencana Karierku</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-neutral-dark bg-neutral-light selection:bg-primary-500 selection:text-white h-screen flex">
    
    <!-- Left Sidebar: Branding (Hidden on mobile) -->
    <div class="hidden lg:flex w-1/2 bg-primary-900 relative overflow-hidden items-center justify-center">
        <!-- Abstract gradient background -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950"></div>
        <div class="absolute -top-[30%] -left-[10%] w-[70%] h-[70%] rounded-full bg-primary-500/20 blur-3xl mix-blend-screen"></div>
        <div class="absolute -bottom-[20%] -right-[10%] w-[60%] h-[60%] rounded-full bg-accent-500/20 blur-3xl mix-blend-screen"></div>
        
        <div class="relative z-10 text-white px-16 max-w-lg">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3 mb-12 group">
                <div class="w-12 h-12 rounded-xl bg-white/10 backdrop-blur flex items-center justify-center font-bold text-2xl group-hover:bg-white/20 transition-all">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="RencanaKarierku Logo"
                        class="w-10 h-10 object-contain"
                    >
                </div>

                <span class="font-bold text-2xl tracking-tight">
                    Rencana<span class="text-primary-300">Karierku</span>
                </span>
            </a>
            <h1 class="text-4xl font-extrabold mb-6 leading-tight text-white">Langkah Awal Menuju Masa Depan Gemilang</h1>
            <p class="text-primary-100 text-lg leading-relaxed">Bergabunglah dengan ribuan siswa SMA lainnya untuk memetakan karier yang sesuai dengan minat dan potensimu.</p>
        </div>
    </div>

    <!-- Right Side: Auth Form -->
    <div class="w-full lg:w-1/2 flex flex-col p-6 sm:p-12 overflow-y-auto">
        <div class="w-full max-w-md mx-auto my-auto py-6">
            <!-- Mobile Logo -->
            <div class="flex lg:hidden justify-center mb-8">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                    <span class="font-bold text-2xl tracking-tight text-slate-900">
                        Rencana<span class="text-primary-600">Karierku</span>
                    </span>
                </a>
            </div>

            <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-xl shadow-slate-200/50 ring-1 ring-slate-100 relative">
                @yield('content')
            </div>
            
            <p class="mt-8 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} Rencana Karierku. Semua Hak Dilindungi.
            </p>
        </div>
    </div>

    <x-flash-messages />
</body>
</html>
