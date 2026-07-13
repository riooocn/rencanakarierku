@extends('layouts.admin')

@section('title', 'Detail Peserta - Andi Saputra')
@section('page_title', 'Detail Peserta')
@section('page_description', 'Melihat detail perjalanan karier dari peserta Andi Saputra.')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.peserta.index') }}" class="text-primary-600 font-medium hover:underline">&larr; Kembali ke Daftar Peserta</a>
</div>

<div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 relative">
    
    <!-- Print Button -->
    <div class="absolute top-8 right-8">
        <button class="flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 font-medium rounded-lg hover:bg-slate-200 transition-colors" onclick="window.print()">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak PDF
        </button>
    </div>

    <!-- Identitas -->
    <div class="flex items-center gap-6 mb-10 border-b border-slate-100 pb-8">
        <div class="w-20 h-20 bg-slate-200 text-slate-500 font-bold text-3xl rounded-full flex justify-center items-center">
            A
        </div>
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 mb-1">Andi Saputra</h2>
            <div class="text-slate-500 flex items-center gap-4 text-sm">
                <span><strong class="font-medium">Kelas:</strong> 12 IPA 1</span>
                <span><strong class="font-medium">Email:</strong> budi@example.com</span>
                <span><strong class="font-medium">Tanggal Tes:</strong> 04 Jul 2026</span>
            </div>
        </div>
    </div>

    <!-- Hasil Asesmen -->
    <div class="mb-10">
        <h3 class="text-xl font-bold text-primary-900 mb-4 border-b border-slate-200 pb-2">
            Ringkasan Asesmen Diri
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                <h4 class="font-bold text-slate-800 mb-3">Minat (RIASEC)</h4>
                <ul class="list-disc pl-5 text-sm text-slate-600 space-y-1">
                    <li>Investigative (Tinggi)</li>
                    <li>Artistic (Tinggi)</li>
                    <li>Social (Sedang)</li>
                </ul>
            </div>
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                <h4 class="font-bold text-slate-800 mb-3">Kapasitas Dominan</h4>
                <ul class="list-disc pl-5 text-sm text-slate-600 space-y-1">
                    <li>People</li>
                    <li>Ideas</li>
                </ul>
            </div>
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                <h4 class="font-bold text-slate-800 mb-3">Nilai Karier Utama</h4>
                <ul class="list-disc pl-5 text-sm text-slate-600 space-y-1">
                    <li>Extrinsic Rewards</li>
                    <li>Altruistic Rewards</li>
                    <li>Leisure</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Keputusan Final -->
    <div>
        <h3 class="text-xl font-bold text-primary-900 mb-4 border-b border-slate-200 pb-2">
            Keputusan Karier
        </h3>
        
        <div class="bg-primary-50 p-6 rounded-2xl border-l-4 border-primary-600 shadow-sm">
            <p class="text-sm text-slate-500 font-medium mb-1">Profesi Terpilih:</p>
            <h4 class="text-2xl font-extrabold text-slate-900 mb-3">Software Engineer</h4>
            <p class="text-slate-700 italic">"Saya memilih profesi ini karena sangat sesuai dengan minat analitis (Investigative) saya, serta keinginan saya untuk menciptakan solusi (Ideas) teknologi yang bermanfaat bagi banyak orang."</p>
        </div>
    </div>

</div>
@endsection
