@extends('layouts.admin')

@section('title', 'Daftar Admin Instansi')
@section('page_title', 'Kelola Admin Instansi')
@section('page_description', 'Manajemen persetujuan dan pengaturan akses akun admin sekolah/instansi.')

@section('content')
<div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
        <form action="{{ route('superadmin.admin.index') }}" method="GET" class="relative max-w-sm w-full" id="searchForm">
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="block w-full pl-4 pr-3 py-2 border border-slate-200 rounded-lg bg-white text-sm focus:outline-none focus:ring-2 focus:ring-primary-500" 
                   placeholder="Cari nama instansi atau email..."
                   oninput="clearTimeout(this.delay); this.delay = setTimeout(() => this.form.submit(), 800);"
                   autofocus
                   onfocus="var val = this.value; this.value = ''; this.value = val;">
            <button type="submit" class="hidden">Cari</button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Instansi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Admin Pendaftar</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Jumlah Siswa</th>
                    <th class="relative px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($adminList as $admin)
                <tr class="hover:bg-slate-50/50 {{ $admin->status !== 'active' ? 'bg-yellow-50/20' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-slate-900">{{ $admin->institution->name ?? 'Instansi tidak ditemukan' }}</div>
                        <div class="text-xs text-slate-500">Terdaftar: {{ $admin->created_at->format('d M Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-slate-900">{{ $admin->name }}</div>
                        <div class="text-sm text-slate-500">{{ $admin->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($admin->status === 'active')
                            <form action="{{ route('superadmin.admin.deactivate', $admin->id) }}" method="POST" class="inline" title="Klik untuk menonaktifkan akun">
                                @csrf @method('PATCH')
                                <button type="submit" class="relative inline-flex items-center h-6 rounded-full w-11 bg-green-500 transition-colors focus:outline-none">
                                    <span class="inline-block w-4 h-4 transform translate-x-6 bg-white rounded-full transition-transform"></span>
                                </button>
                                <span class="ml-2 text-xs font-semibold text-green-700">Aktif</span>
                            </form>
                        @elseif($admin->status === 'inactive')
                            <form action="{{ route('superadmin.admin.approve', $admin->id) }}" method="POST" class="inline" title="Klik untuk mengaktifkan akun">
                                @csrf @method('PATCH')
                                <button type="submit" class="relative inline-flex items-center h-6 rounded-full w-11 bg-slate-300 transition-colors focus:outline-none">
                                    <span class="inline-block w-4 h-4 transform translate-x-1 bg-white rounded-full transition-transform"></span>
                                </button>
                                <span class="ml-2 text-xs font-semibold text-slate-500">Non-aktif</span>
                            </form>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Verifikasi</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-semibold">
                        {{ $admin->institution->peserta_count ?? 0 }} Siswa
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex items-center justify-center gap-2">
                            @if($admin->status === 'active')
                                <a href="{{ route('superadmin.admin.peserta', $admin->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 rounded-md text-xs font-semibold transition-colors" title="Lihat Siswa">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    Siswa
                                </a>
                            @elseif($admin->status === 'inactive')
                                <a href="{{ route('superadmin.admin.peserta', $admin->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 rounded-md text-xs font-semibold transition-colors" title="Lihat Siswa">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    Siswa
                                </a>
                            @elseif($admin->status === 'pending')
                                <form action="{{ route('superadmin.admin.approve', $admin->id) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button class="inline-flex items-center px-3 py-1.5 bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 rounded-md text-xs font-semibold transition-colors" title="Verifikasi & Aktifkan">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Verifikasi
                                    </button>
                                </form>
                                <form action="{{ route('superadmin.admin.reject', $admin->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 rounded-md text-xs font-semibold transition-colors" onclick="return confirm('Yakin ingin menolak dan menghapus permintaan pendaftaran admin ini?')" title="Tolak">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        Tolak
                                    </button>
                                </form>
                            @endif
                        </div>
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
