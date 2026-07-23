@extends('layouts.admin')

@section('title', 'Detail Peserta - Andi Saputra')
@section('page_title', 'Detail Peserta')
@section('page_description', 'Melihat detail perjalanan karier dari peserta Andi Saputra.')

@section('content')

<style>
    @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        @page {
            size: auto;
            margin: 15mm;
        }
        body {
            background: white !important;
        }
    }
</style>

<div class="mb-6 print:hidden">
    <a href="{{ route('admin.peserta.show', $peserta->id) }}" class="text-primary-600 font-medium hover:underline">&larr; Kembali ke Riwayat Peserta</a>
</div>

<div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 relative">
    
    <!-- Print Button -->
    <div class="absolute top-8 right-8 print:hidden">
        <button class="flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 font-medium rounded-lg hover:bg-slate-200 transition-colors" onclick="window.print()">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak PDF
        </button>
    </div>

    <!-- Header Document (Hanya untuk Print) -->
    <div class="hidden print:flex flex-col items-center mb-12 border-b border-slate-100 pb-8">
        <img src="{{ asset('images/logo.png') }}" alt="Logo RencanaKarierku" class="w-20 h-20 object-contain mb-4">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Dokumen Perencanaan Karier</h1>
        <p class="text-slate-500">Diterbitkan oleh Sistem Rencana Karierku</p>
    </div>


    <!-- Identitas -->
    <div class="flex items-center gap-6 mb-10 border-b border-slate-100 pb-8">
        <div class="w-20 h-20 bg-slate-200 text-slate-500 font-bold text-3xl rounded-full flex justify-center items-center print:hidden">
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

    <!-- Keputusan Final -->
    <div class="mb-10">
        <h3 class="text-xl font-bold text-primary-900 mb-4 border-b border-slate-200 pb-2 flex items-center">
            <span class="bg-primary-600 text-white w-6 h-6 rounded-full inline-flex items-center justify-center text-sm mr-2">1</span>
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

    <!-- Hasil Asesmen -->
    <div class="mb-10">
        <h3 class="text-xl font-bold text-primary-900 mb-4 border-b border-slate-200 pb-2 flex items-center">
            <span class="bg-primary-600 text-white w-6 h-6 rounded-full inline-flex items-center justify-center text-sm mr-2">2</span>
            Ringkasan Asesmen Diri
        </h3>
        
        <div class="space-y-6">
            <!-- Minat (RIASEC) -->
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                <h4 class="font-bold text-slate-800 mb-4 text-lg">Minat (RIASEC)</h4>
                <div class="space-y-5">
                    @if($minat && is_array($minat->top_results))
                        @foreach($minat->top_results as $code)
                            @php $minatDetail = \App\Helpers\AssessmentHelper::getMinatDetail($code); @endphp
                            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm break-inside-avoid">
                                <h5 class="font-bold text-primary-700 text-lg mb-2">{{ $minatDetail['name'] }}</h5>
                                <p class="text-sm text-slate-600 mb-4">{{ $minatDetail['long_desc'] }}</p>
                                
                                <h6 class="font-semibold text-slate-700 text-xs uppercase tracking-wider mb-3">Rekomendasi Pekerjaan:</h6>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($minatDetail['jobs'] as $job)
                                        <div class="bg-slate-50 p-4 rounded-lg border border-slate-100 h-full">
                                            <strong class="text-sm text-slate-800 block mb-1">{{ $job['name'] }}</strong>
                                            <span class="text-xs text-slate-500 line-clamp-3" title="{{ $job['desc'] }}">{{ $job['desc'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-slate-500">Belum ada data</p>
                    @endif
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Kapasitas Dominan -->
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                    <h4 class="font-bold text-slate-800 mb-4 text-lg">Kapasitas Dominan</h4>
                    <ul class="space-y-3">
                        @if($kapasitas && isset($kapasitas->top_results['keterampilan']))
                            @foreach($kapasitas->top_results['keterampilan'] as $code)
                                @php $capDetail = \App\Helpers\AssessmentHelper::getKapasitas1Detail($code); @endphp
                                <li class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm break-inside-avoid">
                                    <strong class="text-slate-800 block text-base">{{ $capDetail['name'] }}</strong>
                                    <span class="text-sm text-slate-600">{{ $capDetail['desc'] }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="text-slate-500">Belum ada data</li>
                        @endif
                    </ul>
                </div>

                <!-- Nilai Karier Utama -->
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                    <h4 class="font-bold text-slate-800 mb-4 text-lg">Nilai Karier Utama</h4>
                    <ul class="space-y-3">
                        @if($nilaiKarier && is_array($nilaiKarier->top_results))
                            @foreach($nilaiKarier->top_results as $code)
                                @php $nkDetail = \App\Helpers\AssessmentHelper::getNilaiKarierDetail($code); @endphp
                                <li class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm break-inside-avoid">
                                    <strong class="text-slate-800 block text-base">{{ $nkDetail['name'] }}</strong>
                                    <span class="text-sm text-slate-600">{{ $nkDetail['desc'] }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="text-slate-500">Belum ada data</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
