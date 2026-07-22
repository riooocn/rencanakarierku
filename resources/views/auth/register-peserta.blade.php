@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
<div class="text-center mb-8">
    <h2 class="text-2xl font-bold text-slate-900">Buat Akun Baru</h2>
    <p class="mt-2 text-sm text-slate-500">Mulai langkah pertamamu dalam merencanakan masa depan.</p>
</div>

<!-- Opsi Daftar Google -->
<a href="{{ route('google.redirect', ['role' => 'peserta']) }}" class="w-full flex items-center justify-center gap-3 px-4 py-3.5 mb-6 border border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-colors text-slate-700 font-semibold text-sm">
    <svg class="w-5 h-5" viewBox="0 0 24 24">
        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
    </svg>
    Daftar dengan Google
</a>

<div class="relative mb-6">
    <div class="absolute inset-0 flex items-center">
        <div class="w-full border-t border-slate-200"></div>
    </div>
    <div class="relative flex justify-center text-sm">
        <span class="px-3 bg-white text-slate-500">Atau daftar manual</span>
    </div>
</div>

<form action="{{ route('register') }}" method="POST" class="space-y-4">
    @csrf
    <input type="hidden" name="role" value="peserta">
    
    <div>
        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
        <input type="text" id="name" name="name" required value="{{ old('name') }}" autofocus autocomplete="name"
            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="John Doe">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="tanggal_lahir" class="block text-sm font-medium text-slate-700 mb-1">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}"
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors">
            @error('tanggal_lahir')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="jenis_kelamin" class="block text-sm font-medium text-slate-700 mb-1">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors appearance-none">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="school_id" class="block text-sm font-medium text-slate-700 mb-1">Asal Sekolah</label>
            @if($institutions->isEmpty())
                <div class="w-full px-4 py-2.5 rounded-xl border border-red-200 bg-red-50 text-red-600 text-sm">
                    Belum ada instansi terdaftar. Silakan hubungi admin sekolah Anda.
                </div>
            @else
                <select id="school_id" name="school_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors appearance-none">
                    <option value="">Pilih Instansi</option>
                    @foreach($institutions as $inst)
                        <option value="{{ $inst->id }}" {{ old('school_id') == $inst->id ? 'selected' : '' }}>{{ $inst->name }}</option>
                    @endforeach
                </select>
            @endif
            @error('school_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="grade" class="block text-sm font-medium text-slate-700 mb-1">Kelas</label>
            <select id="grade" name="grade" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors appearance-none">
                <option value="">Pilih Kelas</option>
                <option value="10" {{ old('grade') == '10' ? 'selected' : '' }}>Kelas 10</option>
                <option value="11" {{ old('grade') == '11' ? 'selected' : '' }}>Kelas 11</option>
                <option value="12" {{ old('grade') == '12' ? 'selected' : '' }}>Kelas 12</option>
                <option value="Lainnya" {{ old('grade') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
            @error('grade')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">No HP</label>
        <input type="tel" id="phone" name="phone" required value="{{ old('phone') }}"
            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="081234567890">
        @error('phone')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
        <input type="email" id="email" name="email" required value="{{ old('email') }}" autocomplete="username"
            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="john@example.com">
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
        <input type="password" id="password" name="password" required autocomplete="new-password"
            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="Minimal 8 karakter">
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="Ulangi password">
        @error('password_confirmation')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" @if($institutions->isEmpty()) disabled @endif class="w-full py-3.5 px-4 mt-6 @if($institutions->isEmpty()) bg-slate-400 @else bg-primary-600 hover:bg-primary-700 hover:-translate-y-0.5 shadow-primary-500/30 @endif text-white font-bold rounded-xl shadow-lg transition-all">
        Daftar Sebagai Peserta
    </button>
</form>

<p class="mt-8 text-center text-sm text-slate-600">
    Sudah punya akun? 
    <a href="{{ route('login') }}" class="font-bold text-primary-600 hover:text-primary-700">Masuk di sini</a>
</p>
@endsection
