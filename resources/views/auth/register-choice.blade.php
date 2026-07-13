@extends('layouts.auth')

@section('title', 'Pilih Jenis Akun')

@section('content')
<div class="text-center mb-8">
    <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Buat Akun Baru</h2>
    <p class="text-slate-500">Silakan pilih jenis akun yang ingin Anda buat untuk melanjutkan.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
    <a href="{{ route('register.peserta') }}" class="group relative bg-white border border-slate-200 rounded-2xl p-6 hover:border-primary-500 hover:shadow-lg hover:shadow-primary-500/10 transition-all text-left">
        <div class="w-12 h-12 bg-blue-50 text-primary-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary-500 group-hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-2">Peserta / Siswa</h3>
        <p class="text-sm text-slate-500">Mulai perjalanan kariermu, kerjakan asesmen, dan temukan profesi impianmu.</p>
    </a>

    <a href="{{ route('register.instansi') }}" class="group relative bg-white border border-slate-200 rounded-2xl p-6 hover:border-accent-500 hover:shadow-lg hover:shadow-accent-500/10 transition-all text-left">
        <div class="w-12 h-12 bg-purple-50 text-accent-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-accent-500 group-hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-2">Admin Instansi</h3>
        <p class="text-sm text-slate-500">Kelola dan pantau perkembangan siswa dari instansi atau sekolah Anda.</p>
    </a>
</div>

<p class="text-center text-sm text-slate-600 mt-8">
    Sudah punya akun? 
    <a href="{{ route('login') }}" class="font-bold text-primary-600 hover:text-primary-700">Masuk di sini</a>
</p>
@endsection
