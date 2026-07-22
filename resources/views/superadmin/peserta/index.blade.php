@extends('layouts.admin')

@section('title', isset($admin) ? 'Peserta: ' . ($admin->institution->name ?? 'Instansi') : 'Daftar Seluruh Peserta')
@section('page_title', isset($admin) ? 'Daftar Peserta - ' . ($admin->institution->name ?? 'Instansi') : 'Daftar Seluruh Peserta (Global)')
@section('page_description', isset($admin) ? 'Daftar seluruh siswa yang berada di bawah pengelolaan instansi ini.' : 'Pantau dan kelola hasil tes siswa dari semua instansi terdaftar.')

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
    
    <a href="{{ route('superadmin.peserta.export') }}{{ isset($admin) ? '?institution_id=' . $admin->institution_id : '' }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-lg shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
        <svg class="-ml-1 mr-2 h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        Export Excel ({{ isset($admin) ? 'Instansi Ini' : 'Semua Instansi' }})
    </a>
</div>

<div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Data Siswa</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Asal Instansi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kelas</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tgl Lahir</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status Asesmen</th>
                    <th scope="col" class="relative px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($pesertaList as $siswa)
                <tr class="hover:bg-slate-50/50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-slate-900">{{ $siswa->name }}</div>
                                <div class="text-sm text-slate-500">{{ $siswa->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-slate-900">{{ $siswa->institution->name ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-slate-900">{{ $siswa->grade ? (is_numeric($siswa->grade) ? 'Kelas ' . $siswa->grade : $siswa->grade) : '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-slate-900">{{ $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') : '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($siswa->keputusanKarier)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Belum Selesai</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('superadmin.peserta.show', $siswa->id) }}" class="text-primary-600 hover:text-primary-900 font-semibold">Lihat Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-slate-500">Belum ada peserta yang terdaftar di sistem.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-slate-200">
        {{ $pesertaList->links() }}
    </div>
</div>
@endsection
