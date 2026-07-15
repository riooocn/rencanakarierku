@extends('layouts.admin')

@section('title', 'Daftar Admin Instansi')
@section('page_title', 'Kelola Admin Instansi')
@section('page_description', 'Manajemen persetujuan dan pengaturan akses akun admin sekolah/instansi.')

@section('content')
<div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
        <div class="relative max-w-sm w-full">
            <input type="text" class="block w-full pl-4 pr-3 py-2 border border-slate-200 rounded-lg bg-white text-sm focus:outline-none focus:ring-2 focus:ring-primary-500" placeholder="Cari nama instansi atau email...">
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Instansi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Admin Pendaftar</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Jumlah Siswa</th>
                    <th class="relative px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($adminList as $admin)
                <tr class="hover:bg-slate-50/50 {{ !$admin->is_active ? 'bg-yellow-50/20' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-slate-900">{{ $admin->institution->name ?? 'Instansi tidak ditemukan' }}</div>
                        <div class="text-xs text-slate-500">Terdaftar: {{ $admin->created_at->format('d M Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-slate-900">{{ $admin->name }}</div>
                        <div class="text-sm text-slate-500">{{ $admin->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($admin->is_active)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Aktif
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu Verifikasi
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-semibold">
                        {{ $admin->institution->peserta_count ?? 0 }} Siswa
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                        @if($admin->is_active)
                            <a href="{{ route('superadmin.admin.peserta', $admin->id) }}" class="text-blue-600 hover:text-blue-900">Lihat Siswa</a>
                            <form action="{{ route('superadmin.admin.deactivate', $admin->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button class="text-red-600 hover:text-red-900">Blokir</button>
                            </form>
                        @else
                            <form action="{{ route('superadmin.admin.approve', $admin->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button class="text-green-600 hover:text-green-900">Verifikasi & Aktifkan</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada admin instansi yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-slate-200">
        {{ $adminList->links() }}
    </div>
</div>
@endsection
