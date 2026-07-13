@extends('layouts.admin')

@section('title', 'Daftar Seluruh Peserta')
@section('page_title', 'Daftar Seluruh Peserta (Global)')
@section('page_description', 'Pantau dan kelola hasil tes siswa dari semua instansi terdaftar.')

@section('content')
<!-- Mirip dengan Admin Peserta Index tapi ada kolom Instansi -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
        <div class="relative max-w-sm w-full">
            <input type="text" class="block w-full pl-4 pr-3 py-2 border border-slate-200 rounded-lg bg-white text-sm focus:outline-none focus:ring-2 focus:ring-primary-500" placeholder="Cari nama siswa...">
        </div>
        <select class="block w-full sm:w-48 pl-3 pr-10 py-2 text-sm border border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 appearance-none">
            <option value="">Semua Instansi</option>
            <option value="1">SMA N 1 Jakarta</option>
            <option value="2">SMA N 5 Bandung</option>
        </select>
    </div>
</div>

<div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Data Siswa</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Asal Instansi & Kelas</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Status Asesmen</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Tanggal Tes</th>
                    <th scope="col" class="relative px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                <tr class="hover:bg-slate-50/50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-slate-900">Andi Saputra</div>
                                <div class="text-sm text-slate-500">budi@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-slate-900">SMA N 1 Jakarta</div>
                        <div class="text-sm text-slate-500">Kelas 12 IPA 1</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                        04 Jul 2026
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('superadmin.peserta.show', 1) }}" class="text-primary-600 hover:text-primary-900 font-semibold">Lihat Detail</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
