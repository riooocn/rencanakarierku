@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page_title', 'Dashboard')
@section('page_description', 'Selamat datang di Dashboard Admin Instansi. Berikut adalah ringkasan data di sekolah Anda.')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Card 1 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="w-14 h-14 rounded-xl bg-blue-50 flex justify-center items-center text-blue-600 mr-4">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500 mb-1">Total Siswa Terdaftar</p>
            <h4 class="text-2xl font-bold text-slate-900">428</h4>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="w-14 h-14 rounded-xl bg-green-50 flex justify-center items-center text-green-600 mr-4">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500 mb-1">Selesai Tes</p>
            <h4 class="text-2xl font-bold text-slate-900">312</h4>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="w-14 h-14 rounded-xl bg-yellow-50 flex justify-center items-center text-yellow-600 mr-4">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500 mb-1">Sedang Proses</p>
            <h4 class="text-2xl font-bold text-slate-900">85</h4>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="w-14 h-14 rounded-xl bg-primary-50 flex justify-center items-center text-primary-600 mr-4">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500 mb-1">Rata-rata Waktu Tes</p>
            <h4 class="text-2xl font-bold text-slate-900">45 Menit</h4>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-bold text-slate-900">Peserta Terbaru yang Selesai Tes</h3>
        <a href="{{ route('admin.peserta.index') }}" class="text-sm text-primary-600 font-medium hover:underline">Lihat Semua &rarr;</a>
    </div>

    <!-- Mini Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead>
                <tr>
                    <th class="text-left text-xs font-semibold text-slate-500 uppercase py-3">Nama</th>
                    <th class="text-left text-xs font-semibold text-slate-500 uppercase py-3">Kelas</th>
                    <th class="text-left text-xs font-semibold text-slate-500 uppercase py-3">Pilihan Karier</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <tr>
                    <td class="py-3 text-sm font-medium text-slate-900">Andi Saputra</td>
                    <td class="py-3 text-sm text-slate-500">Kelas 12 IPA 1</td>
                    <td class="py-3 text-sm text-slate-900 font-semibold">Software Engineer</td>
                </tr>
                <tr>
                    <td class="py-3 text-sm font-medium text-slate-900">Diana Putri</td>
                    <td class="py-3 text-sm text-slate-500">Kelas 11 IPS 2</td>
                    <td class="py-3 text-sm text-slate-900 font-semibold">Desainer Grafis</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
