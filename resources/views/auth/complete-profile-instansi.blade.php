@extends('layouts.auth')

@section('title', 'Lengkapi Data Instansi')

@section('content')
<div class="text-center mb-8">
    <div class="inline-flex justify-center items-center w-16 h-16 rounded-full bg-purple-100 text-purple-600 mb-4">
        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
        </svg>
    </div>
    <h2 class="text-2xl font-bold text-slate-900">Lengkapi Data Instansi</h2>
    <p class="mt-2 text-sm text-slate-500">Tinggal satu langkah lagi untuk memulai mengelola instansi Anda.</p>
</div>

<form action="{{ url('/admin') }}" method="GET" class="space-y-4">
    @csrf
    
    <div>
        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
        <input type="text" id="name" name="name" required value="{{ old('name', 'Budi Santoso') }}"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="John Doe">
        <p class="mt-1 text-xs text-slate-500">Berdasarkan akun Google kamu.</p>
    </div>

    <div>
        <label for="school" class="block text-sm font-medium text-slate-700 mb-1">Nama Instansi / Sekolah</label>
        <input type="text" id="school" name="school" required 
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="SMA N 1 Jakarta">
    </div>

    <div>
        <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">No HP</label>
        <input type="tel" id="phone" name="phone" required 
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="081234567890">
    </div>

    <button type="submit" class="w-full py-3.5 px-4 mt-6 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 transition-all hover:-translate-y-0.5">
        Simpan Profil
    </button>
</form>
@endsection
