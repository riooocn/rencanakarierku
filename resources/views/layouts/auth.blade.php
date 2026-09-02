<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Autentikasi') - Rencana Karierku</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
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
    
@if(session('wa_redirect'))
<!-- WhatsApp Verification Modal -->
<div id="waModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-8 transform transition-all translate-y-0 scale-100">
        <div class="flex items-center justify-center w-20 h-20 mx-auto bg-green-50 rounded-full mb-6 ring-8 ring-green-50/50">
            <svg class="w-10 h-10 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.888-.788-1.489-1.761-1.663-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
        </div>
        
        <h3 class="text-xl font-extrabold text-center text-slate-900 mb-2 tracking-tight">Verifikasi Akun Admin</h3>
        <p class="text-center text-slate-600 mb-8 text-sm leading-relaxed">Kirim pesan WhatsApp sekarang untuk mempercepat proses verifikasi akun admin instansi Anda oleh Super Admin?</p>
        
        <div class="flex flex-col gap-3">
            <a href="{!! session('wa_redirect') !!}" target="_blank" onclick="setTimeout(function(){ document.getElementById('waModal').style.display='none'; window.location.href='{{ url('/login') }}'; }, 300);" class="w-full flex justify-center items-center gap-2.5 py-3.5 px-4 bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold rounded-xl shadow-lg shadow-green-500/30 transition-all hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.888-.788-1.489-1.761-1.663-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Kirim Pesan WhatsApp
            </a>
            <button onclick="document.getElementById('waModal').style.display='none'; window.location.href='{{ url('/login') }}';" class="w-full py-3.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors">
                Nanti Saja
            </button>
        </div>
    </div>
</div>
@endif

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
            @if(session('login_wa_redirect'))
            <a href="{!! session('login_wa_redirect') !!}" target="_blank" onclick="document.getElementById('pendingModal').style.display='none';" class="w-full flex justify-center items-center gap-2.5 py-3.5 px-4 bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold rounded-xl shadow-lg shadow-green-500/30 transition-all hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.888-.788-1.489-1.761-1.663-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Kirim Pesan WhatsApp
            </a>
            <button onclick="document.getElementById('pendingModal').style.display='none';" class="w-full py-3.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors">
                Tutup
            </button>
            @else
            <button onclick="document.getElementById('pendingModal').style.display='none';" class="w-full py-3.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 transition-colors">
                Tutup
            </button>
            @endif
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
