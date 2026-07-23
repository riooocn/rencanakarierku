@extends('layouts.auth')

@section('title', 'Lengkapi Profil Peserta')

@section('content')
<div class="text-center mb-8">
    <div class="inline-flex justify-center items-center w-16 h-16 mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-16 object-contain">
    </div>
    <h2 class="text-2xl font-bold text-slate-900">Lengkapi Profilmu</h2>
    <p class="mt-2 text-sm text-slate-500">Tinggal satu langkah lagi untuk memulai perencanaan karier impianmu.</p>
</div>

<form action="{{ route('complete-profile.store') }}" method="POST" class="space-y-4">
    @csrf
    
    <div>
        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
        <input type="text" id="name" name="name" required value="{{ old('name', auth()->user()->name) }}"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="{{ auth()->user()->name }}">
        <p class="mt-1 text-xs text-slate-500">Berdasarkan akun Google kamu.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="tanggal_lahir" class="block text-sm font-medium text-slate-700 mb-1">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors">
            @error('tanggal_lahir')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="jenis_kelamin" class="block text-sm font-medium text-slate-700 mb-1">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors appearance-none">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="school_id" class="block text-sm font-medium text-slate-700 mb-1">Asal Sekolah</label>
        @if($institutions->isEmpty())
            <div class="w-full px-4 py-3 rounded-xl border border-red-200 bg-red-50 text-red-600 text-sm">
                Belum ada instansi terdaftar. Silakan hubungi admin sekolah Anda.
            </div>
        @else
            <select id="school_id" name="school_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors appearance-none">
                <option value="">Pilih Instansi</option>
                @foreach($institutions as $inst)
                    <option value="{{ $inst->id }}" {{ old('school_id') == $inst->id ? 'selected' : '' }}>{{ $inst->name }}</option>
                @endforeach
            </select>
        @endif
    </div>

    <div>
        <label for="grade" class="block text-sm font-medium text-slate-700 mb-1">Kelas</label>
        <select id="grade" name="grade" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors appearance-none">
            <option value="">Pilih Kelas</option>
            <option value="10">Kelas 10</option>
            <option value="11">Kelas 11</option>
            <option value="12">Kelas 12</option>
            <option value="Lainnya">Lainnya</option>
        </select>
    </div>

    <div>
        <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">No HP</label>
        <input type="tel" id="phone" name="phone" required 
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
            placeholder="081234567890">
    </div>

    <button type="submit" @if($institutions->isEmpty()) disabled @endif class="w-full py-3.5 px-4 mt-6 @if($institutions->isEmpty()) bg-slate-400 @else bg-primary-600 hover:bg-primary-700 hover:-translate-y-0.5 shadow-primary-500/30 @endif text-white font-bold rounded-xl shadow-lg transition-all">
        Simpan Profil
    </button>
</form>
@endsection
