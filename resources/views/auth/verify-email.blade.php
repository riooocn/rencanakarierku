@extends('layouts.auth')

@section('title', 'Verifikasi Email')

@section('content')
<div class="text-center mb-8">
    <div class="inline-flex justify-center items-center w-16 h-16 rounded-full bg-primary-100 text-primary-600 mb-4">
        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
    </div>
    <h2 class="text-2xl font-bold text-slate-900">Verifikasi Email Anda</h2>
    <p class="mt-2 text-sm text-slate-500">
        Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan.
    </p>
</div>

@if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-xl border border-green-200">
        Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda berikan saat registrasi.
    </div>
@endif

<div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
    <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
        @csrf
        <button type="submit" class="w-full sm:w-auto py-3 px-6 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-md shadow-primary-500/30 transition-all hover:-translate-y-0.5">
            Kirim Ulang Email
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
        @csrf
        <button type="submit" class="w-full sm:w-auto py-3 px-6 text-sm font-medium text-slate-600 hover:text-slate-900 underline transition-colors">
            Keluar
        </button>
    </form>
</div>
@endsection
