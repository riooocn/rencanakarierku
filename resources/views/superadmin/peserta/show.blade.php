@extends('layouts.admin')

@section('title', 'Detail Peserta - ' . $peserta->name)
@section('page_title', 'Detail Peserta')
@section('page_description', 'Riwayat perjalanan karier dari peserta ' . $peserta->name . '.')

@section('content')

<div class="mb-6">
    <a href="{{ route('superadmin.peserta.index') }}" class="text-primary-600 font-medium hover:underline">&larr; Kembali ke Daftar Peserta</a>
</div>

<div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
    <div class="mb-8 border-b border-slate-100 pb-6 flex items-center gap-6">
        <div class="w-16 h-16 bg-slate-200 text-slate-500 font-bold text-2xl rounded-full flex justify-center items-center">
            {{ strtoupper(substr($peserta->name, 0, 1)) }}
        </div>
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">{{ $peserta->name }}</h2>
            <p class="mt-1 text-slate-500">{{ $peserta->email }} • {{ $peserta->grade ?? '-' }}</p>
        </div>
    </div>

    <div class="mb-6">
        <h3 class="text-xl font-bold text-slate-900">Riwayat Perjalanan Karier</h3>
        <p class="text-sm text-slate-500 mt-1">Daftar rekaman seluruh sesi pengambilan keputusan karier yang pernah dilakukan oleh peserta ini.</p>
    </div>

    @if($riwayatList->isEmpty())
        <div class="bg-slate-50 rounded-2xl p-10 text-center border border-slate-100">
            <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900 mb-2">Belum Ada Riwayat</h3>
            <p class="text-slate-500">Peserta ini belum menyelesaikan satupun perjalanan karier.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($riwayatList as $index => $riwayat)
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-md hover:border-primary-200 transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center flex-shrink-0 font-bold text-lg">
                            #{{ $index + 1 }}
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                                {{ $riwayat->display_title ?? $riwayat->final_choice }}
                                @if($riwayat->test_type === 'eksplorasi_saja')
                                    <span class="px-2 py-0.5 rounded text-xs font-semibold bg-accent-100 text-accent-700 border border-accent-200">Eksplorasi Saja</span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-xs font-semibold bg-primary-100 text-primary-700 border border-primary-200">Full Test</span>
                                @endif
                            </h3>
                            <div class="text-sm text-slate-500 flex items-center gap-2 mt-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $riwayat->created_at->translatedFormat('d F Y, H:i') }} WIB
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('superadmin.peserta.history.show', ['id' => $peserta->id, 'history_id' => $riwayat->id]) }}" class="inline-flex items-center justify-center px-4 py-2 bg-slate-100 text-slate-700 hover:bg-primary-50 hover:text-primary-700 font-medium rounded-xl transition-colors w-full sm:w-auto">
                            Lihat Detail
                            <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
