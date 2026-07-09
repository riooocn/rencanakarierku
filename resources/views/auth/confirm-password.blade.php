@extends('layouts.auth')

@section('title', 'Konfirmasi Password')

@section('content')
<div class="text-center mb-8">
    <div class="inline-flex justify-center items-center w-16 h-16 rounded-full bg-accent-100 text-accent-600 mb-4">
        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
    </div>
    <h2 class="text-2xl font-bold text-slate-900">Area Terlindungi</h2>
    <p class="mt-2 text-sm text-slate-500">
        Ini adalah area aplikasi yang aman. Silakan konfirmasi kata sandi Anda sebelum melanjutkan.
    </p>
</div>

<form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
    @csrf

    <div>
        <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
        <input type="password" id="password" name="password" required autocomplete="current-password" autofocus
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="••••••••">
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full py-3.5 px-4 mt-2 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 transition-all hover:-translate-y-0.5">
        Konfirmasi
    </button>
</form>
@endsection
