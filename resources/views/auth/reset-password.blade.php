@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="text-center mb-8">
    <h2 class="text-2xl font-bold text-slate-900">Buat Password Baru</h2>
    <p class="mt-2 text-sm text-slate-500">Silakan masukkan password baru Anda.</p>
</div>

<form method="POST" action="{{ route('password.store') }}" class="space-y-4">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div>
        <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="Masukkan email kamu">
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password Baru</label>
        <input type="password" id="password" name="password" required autocomplete="new-password"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="Minimal 8 karakter">
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="Ulangi password">
        @error('password_confirmation')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full py-3.5 px-4 mt-2 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 transition-all hover:-translate-y-0.5">
        Reset Password
    </button>
</form>
@endsection
