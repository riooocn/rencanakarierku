@extends('layouts.auth')

@section('title', 'Lengkapi Data Instansi')

@section('content')
<div class="text-center mb-8">
    <div class="inline-flex justify-center items-center w-16 h-16 mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-16 object-contain">
    </div>
    <h2 class="text-2xl font-bold text-slate-900">Lengkapi Data Instansi</h2>
    <p class="mt-2 text-sm text-slate-500">Tinggal satu langkah lagi untuk memulai mengelola instansi Anda.</p>
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

    <div x-data="{ isNewSchool: {{ old('new_school') ? 'true' : 'false' }} }">
        <div x-show="!isNewSchool" x-transition>
            <label for="school_id" class="block text-sm font-medium text-slate-700 mb-1">Asal Sekolah</label>
            <select id="school_id" name="school_id" x-bind:required="!isNewSchool" x-bind:disabled="isNewSchool" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors appearance-none">
                <option value="">Pilih Instansi</option>
                @foreach($institutions as $inst)
                    <option value="{{ $inst->id }}" {{ old('school_id') == $inst->id ? 'selected' : '' }}>{{ $inst->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mt-3 flex items-center">
            <input type="checkbox" id="isNewSchool" x-model="isNewSchool" @change="if(isNewSchool) document.getElementById('school_id').value = ''" class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500">
            <label for="isNewSchool" class="ml-2 text-sm text-slate-600 cursor-pointer">Daftar instansi baru</label>
        </div>

        <div x-show="isNewSchool" style="display: none;" class="mt-4">
            <label for="new_school" class="block text-sm font-medium text-slate-700 mb-1">Ketik Nama Instansi Baru</label>
            <input type="text" id="new_school" name="new_school" x-bind:required="isNewSchool" x-bind:disabled="!isNewSchool"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors"
                placeholder="Misal: SMA N 1 Jakarta">
        </div>
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
