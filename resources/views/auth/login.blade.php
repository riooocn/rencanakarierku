@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
<div class="text-center mb-8">
    <h2 class="text-2xl font-bold text-slate-900">Selamat Datang Kembali!</h2>
    <p class="mt-2 text-sm text-slate-500">Masuk ke akunmu untuk melanjutkan perencanaan karier.</p>
</div>

<form action="#" method="POST" class="space-y-5">
    @csrf
    
    <div>
        <label for="username" class="block text-sm font-medium text-slate-700 mb-1.5">Username</label>
        <input type="text" id="username" name="username" required 
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="Masukkan username kamu">
    </div>

    <div>
        <div class="flex justify-between items-center mb-1.5">
            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
            <a href="#" class="text-sm font-medium text-primary-600 hover:text-primary-700">Lupa password?</a>
        </div>
        <input type="password" id="password" name="password" required 
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="••••••••">
    </div>

    <button type="submit" class="w-full py-3.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 transition-all hover:-translate-y-0.5">
        Masuk
    </button>
</form>

<div class="mt-8">
    <div class="relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-slate-200"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-3 bg-white text-slate-500">Atau masuk dengan</span>
        </div>
    </div>

    <div class="mt-6">
        <a href="#" class="w-full flex items-center justify-center gap-3 px-4 py-3.5 border border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-colors text-slate-700 font-semibold text-sm">
            <svg class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            Google
        </a>
    </div>
</div>

<p class="mt-8 text-center text-sm text-slate-600">
    Belum punya akun? 
    <a href="{{ route('register') }}" class="font-bold text-primary-600 hover:text-primary-700">Daftar sekarang</a>
</p>
@endsection
