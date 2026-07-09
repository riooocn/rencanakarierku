@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('content')
<div class="text-center mb-8">
    <h2 class="text-2xl font-bold text-slate-900">Lupa Password?</h2>
    <p class="mt-2 text-sm text-slate-500">Tidak masalah. Cukup beritahu kami alamat email Anda dan kami akan mengirimkan tautan pengaturan ulang kata sandi.</p>
</div>

<!-- Session Status -->
@if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-xl border border-green-200">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}" class="space-y-5">
    @csrf

    <div>
        <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="Masukkan email kamu">
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full py-3.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 transition-all hover:-translate-y-0.5">
        Kirim Link Reset Password
    </button>
</form>

<p class="mt-8 text-center text-sm text-slate-600">
    Ingat password Anda? 
    <a href="{{ route('login') }}" class="font-bold text-primary-600 hover:text-primary-700">Kembali untuk Masuk</a>
</p>
@endsection
