@extends('layouts.auth')

@section('title', 'Lengkapi Profil Peserta')

@section('content')
<div class="text-center mb-8">
    <div class="inline-flex justify-center items-center w-16 h-16 rounded-full bg-primary-100 text-primary-600 mb-4">
        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
    </div>
    <h2 class="text-2xl font-bold text-slate-900">Lengkapi Profilmu</h2>
    <p class="mt-2 text-sm text-slate-500">Tinggal satu langkah lagi untuk memulai perencanaan karier impianmu.</p>
</div>

<form action="{{ url('/perjalananku') }}" method="GET" class="space-y-4">
    @csrf
    
    <div>
        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
        <input type="text" id="name" name="name" required value="{{ old('name', 'Budi Santoso') }}"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="John Doe">
        <p class="mt-1 text-xs text-slate-500">Berdasarkan akun Google kamu.</p>
    </div>

    <div>
        <label for="school" class="block text-sm font-medium text-slate-700 mb-1">Asal Sekolah</label>
        <input type="text" id="school" name="school" required 
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="SMA N 1 Jakarta">
    </div>

    <div>
        <label for="grade" class="block text-sm font-medium text-slate-700 mb-1">Kelas</label>
        <select id="grade" name="grade" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors appearance-none">
            <option value="">Pilih Kelas</option>
            <option value="10">Kelas 10</option>
            <option value="11">Kelas 11</option>
            <option value="12">Kelas 12</option>
        </select>
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
