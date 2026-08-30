@extends('layouts.admin')

@section('title', 'Super Admin Dashboard')
@section('page_title', 'Dashboard Utama')
@section('page_description', 'Ikhtisar statistik dari seluruh instansi dan peserta terdaftar.')

@section('content')
<div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3 md:gap-6 mb-8">
    
    <!-- Card 1 -->
    <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center">
        <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl bg-purple-50 flex justify-center items-center text-purple-600 mb-3 md:mb-0 md:mr-4">
            <svg class="w-5 h-5 md:w-7 md:h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
        </div>
        <div>
            <p class="text-xs md:text-sm font-medium text-slate-500 mb-1">Total Instansi/Sekolah</p>
            <h4 class="text-xl md:text-2xl font-bold text-slate-900">{{ number_format($institutionCount) }}</h4>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center">
        <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl bg-blue-50 flex justify-center items-center text-blue-600 mb-3 md:mb-0 md:mr-4">
            <svg class="w-5 h-5 md:w-7 md:h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
        <div>
            <p class="text-xs md:text-sm font-medium text-slate-500 mb-1">Total Siswa Terdaftar</p>
            <h4 class="text-xl md:text-2xl font-bold text-slate-900">{{ number_format($pesertaCount) }}</h4>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center">
        <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl bg-green-50 flex justify-center items-center text-green-600 mb-3 md:mb-0 md:mr-4">
            <svg class="w-5 h-5 md:w-7 md:h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <p class="text-xs md:text-sm font-medium text-slate-500 mb-1">Siswa Selesai Tes</p>
            <h4 class="text-xl md:text-2xl font-bold text-slate-900">{{ number_format($siswaSelesaiTesCount) }}</h4>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center">
        <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl bg-red-50 flex justify-center items-center text-red-600 mb-3 md:mb-0 md:mr-4">
            <svg class="w-5 h-5 md:w-7 md:h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <div>
            <p class="text-xs md:text-sm font-medium text-slate-500 mb-1">Admin Menunggu Verifikasi</p>
            <h4 class="text-xl md:text-2xl font-bold text-slate-900">{{ $pendingAdminsCount }}</h4>
        </div>
    </div>

    <!-- Card 5 - Akun Segera Expired -->
    <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center">
        <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl bg-amber-50 flex justify-center items-center text-amber-600 mb-3 md:mb-0 md:mr-4">
            <svg class="w-5 h-5 md:w-7 md:h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <p class="text-xs md:text-sm font-medium text-slate-500 mb-1">Akun Segera Expired</p>
            <h4 class="text-xl md:text-2xl font-bold text-slate-900">{{ $soonExpiringCount }}</h4>
            <p class="text-[10px] md:text-xs text-slate-400">Dalam 30 hari ke depan</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
    <div class="flex justify-between items-center mb-6 gap-2">
        <h3 class="font-bold text-slate-900 text-sm md:text-base leading-snug">Pendaftaran Admin Instansi Terbaru</h3>
        <a href="{{ route('superadmin.admin.index') }}" class="text-[11px] md:text-sm text-primary-600 font-medium hover:underline shrink-0 text-right">Kelola Admin &rarr;</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead>
                <tr>
                    <th class="text-left text-xs font-semibold text-slate-500 uppercase py-3">Nama Instansi</th>
                    <th class="text-left text-xs font-semibold text-slate-500 uppercase py-3">Pendaftar</th>
                    <th class="text-left text-xs font-semibold text-slate-500 uppercase py-3">Status</th>
                    <th class="text-right text-xs font-semibold text-slate-500 uppercase py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($pendingAdmins as $admin)
                <tr>
                    <td class="py-3 text-sm font-medium text-slate-900">{{ $admin->institution->name ?? 'Instansi tidak ditemukan' }}</td>
                    <td class="py-3 text-sm text-slate-500">{{ $admin->name }}</td>
                    <td class="py-3 text-sm">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                    </td>
                    <td class="py-3 text-sm text-right">
                        <form action="{{ route('superadmin.admin.approve', $admin->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-green-600 font-medium hover:underline">Verifikasi</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-6 text-center text-sm text-slate-500">
                        Tidak ada pendaftaran admin baru yang menunggu verifikasi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
