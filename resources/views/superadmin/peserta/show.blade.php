@extends('layouts.admin')

@section('title', 'Detail Peserta (Super Admin)')
@section('page_title', 'Detail Peserta')
@section('page_description', 'Melihat detail perjalanan karier dari peserta secara global.')

@section('content')
<div class="mb-6">
    <a href="{{ url()->previous() }}" class="text-primary-600 font-medium hover:underline">&larr; Kembali</a>
</div>

<!-- Menggunakan struktur yang sama dengan admin peserta show -->
<div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 relative">
    <div class="absolute top-8 right-8">
        <span class="px-3 py-1 bg-primary-100 text-primary-800 text-xs font-bold rounded-lg border border-primary-200">Data Terpusat</span>
    </div>

    <!-- Identitas -->
    <div class="flex items-center gap-6 mb-10 border-b border-slate-100 pb-8">
        <div class="w-20 h-20 bg-slate-200 text-slate-500 font-bold text-3xl rounded-full flex justify-center items-center">
            A
        </div>
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 mb-1">Andi Saputra</h2>
            <div class="text-slate-500 flex flex-wrap items-center gap-4 text-sm">
                <span><strong class="font-medium">Instansi:</strong> SMA N 1 Jakarta</span>
                <span><strong class="font-medium">Kelas:</strong> 12 IPA 1</span>
                <span><strong class="font-medium">Email:</strong> budi@example.com</span>
                <span><strong class="font-medium">Tanggal Tes:</strong> 04 Jul 2026</span>
            </div>
        </div>
    </div>

    <!-- Hasil Asesmen & Keputusan (Sama dengan admin.peserta.show) -->
    <!-- ... Detail ... -->
    <div class="mb-10">
        <h3 class="text-xl font-bold text-primary-900 mb-4 border-b border-slate-200 pb-2">Keputusan Karier</h3>
        <div class="bg-primary-50 p-6 rounded-2xl border-l-4 border-primary-600 shadow-sm">
            <p class="text-sm text-slate-500 font-medium mb-1">Profesi Terpilih:</p>
            <h4 class="text-2xl font-extrabold text-slate-900 mb-3">Software Engineer</h4>
        </div>
    </div>
</div>
@endsection
