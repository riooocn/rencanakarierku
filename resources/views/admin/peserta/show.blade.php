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

    @php
        $minat = $peserta->assessmentSessions->where('asesmen_type', 'minat')->last()?->result;
        $kapasitas = $peserta->assessmentSessions->where('asesmen_type', 'kapasitas')->last()?->result;
        $nilaiKarier = $peserta->assessmentSessions->where('asesmen_type', 'nilai_karier')->last()?->result;
    @endphp

    <!-- Identitas -->
    <div class="flex items-center gap-6 mb-10 border-b border-slate-100 pb-8">
        <div class="w-20 h-20 bg-slate-200 text-slate-500 font-bold text-3xl rounded-full flex justify-center items-center">
            {{ strtoupper(substr($peserta->name, 0, 1)) }}
        </div>
        <div class="flex-1">
            <h2 class="text-2xl font-extrabold text-slate-900 mb-1">{{ $peserta->name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-700 mt-4">
                <div><span class="font-semibold w-24 inline-block">Nama:</span> {{ $peserta->name }}</div>
                <div><span class="font-semibold w-24 inline-block">Kelas:</span> {{ $peserta->grade ? (is_numeric($peserta->grade) ? 'Kelas ' . $peserta->grade : $peserta->grade) : '-' }}</div>
                <div><span class="font-semibold w-24 inline-block">Email:</span> {{ $peserta->email }}</div>
                <div><span class="font-semibold w-24 inline-block">No HP:</span> {{ $peserta->phone ?? '-' }}</div>
                <div><span class="font-semibold w-24 inline-block">Tgl Lahir:</span> {{ $peserta->tanggal_lahir ? \Carbon\Carbon::parse($peserta->tanggal_lahir)->format('d M Y') : '-' }}</div>
                <div><span class="font-semibold w-24 inline-block">Kelamin:</span> {{ $peserta->jenis_kelamin ?? '-' }}</div>
            </div>
            <div class="text-slate-500 flex items-center gap-4 text-sm mt-4">
                <span><strong class="font-medium">Tanggal Daftar:</strong> {{ $peserta->created_at->format('d M Y') }}</span>
                <span><strong class="font-medium">Status Tes:</strong> {!! $peserta->keputusanKarier ? '<span class="text-green-600 font-medium">Selesai</span>' : '<span class="text-yellow-600 font-medium">Belum Selesai</span>' !!}</span>
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
                    @if($minat && is_array($minat->top_results))
                        @foreach($minat->top_results as $code)
                            <li>{{ \App\Helpers\AssessmentHelper::getMinatDetail($code)['name'] }}</li>
                        @endforeach
                    @else
                        <li>Belum ada data</li>
                    @endif
                </ul>
            </div>
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                <h4 class="font-bold text-slate-800 mb-3">Kapasitas Dominan</h4>
                <ul class="list-disc pl-5 text-sm text-slate-600 space-y-1">
                    @if($kapasitas && isset($kapasitas->top_results['keterampilan']))
                        @foreach($kapasitas->top_results['keterampilan'] as $code)
                            <li>{{ \App\Helpers\AssessmentHelper::getKapasitas1Detail($code)['name'] }}</li>
                        @endforeach
                    @else
                        <li>Belum ada data</li>
                    @endif
                </ul>
            </div>
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                <h4 class="font-bold text-slate-800 mb-3">Nilai Karier Utama</h4>
                <ul class="list-disc pl-5 text-sm text-slate-600 space-y-1">
                    @if($nilaiKarier && is_array($nilaiKarier->top_results))
                        @foreach($nilaiKarier->top_results as $code)
                            <li>{{ \App\Helpers\AssessmentHelper::getNilaiKarierDetail($code)['name'] }}</li>
                        @endforeach
                    @else
                        <li>Belum ada data</li>
                    @endif
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
            <h4 class="text-2xl font-extrabold text-slate-900 mb-3">{{ $peserta->keputusanKarier->final_choice ?? 'Belum ada keputusan' }}</h4>
            @if($peserta->keputusanKarier)
                <p class="text-slate-700 italic">Tanggal Pengambilan Keputusan: {{ $peserta->keputusanKarier->created_at->format('d M Y, H:i') }}</p>
            @endif
        </div>
    </div>

</div>
@endsection
