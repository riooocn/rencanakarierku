@extends('layouts.admin')

@section('title', 'Daftar Admin Instansi')
@section('page_title', 'Kelola Admin Instansi')
@section('page_description', 'Manajemen persetujuan dan pengaturan akses akun admin sekolah/instansi.')

@section('content')
<div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center flex-wrap gap-4">
        <form action="{{ route('superadmin.admin.index') }}" method="GET" class="relative max-w-sm w-full" id="searchForm">
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="block w-full pl-4 pr-3 py-2 border border-slate-200 rounded-lg bg-white text-sm focus:outline-none focus:ring-2 focus:ring-primary-500" 
                   placeholder="Cari nama instansi atau email..."
                   oninput="clearTimeout(this.delay); this.delay = setTimeout(() => this.form.submit(), 800);"
                   autofocus
                   onfocus="var val = this.value; this.value = ''; this.value = val;">
            <button type="submit" class="hidden">Cari</button>
        </form>

        <!-- Bulk Action Form UI -->
        <div class="flex items-center gap-2">
            <select id="bulkActionSelect" class="block w-full pl-3 pr-10 py-2 border border-slate-200 rounded-lg bg-white text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                <option value="">-- Aksi Massal --</option>
                <option value="approve">Verifikasi Terpilih</option>
                <option value="activate">Aktifkan Terpilih</option>
                <option value="deactivate">Non-aktifkan Terpilih</option>
                <option value="reject">Tolak/Hapus Terpilih</option>
            </select>
            <button type="button" onclick="submitBulkAction()" class="inline-flex items-center px-4 py-2 bg-slate-800 text-white rounded-lg text-sm font-semibold hover:bg-slate-700 transition-colors">
                Terapkan
            </button>
        </div>
    </div>

    <!-- Hidden form for submitting bulk action -->
    <form id="bulkForm" action="{{ route('superadmin.admin.bulk-action') }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="action" id="bulkActionInput">
        <div id="bulkSelectedIds"></div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left w-12">
                        <input type="checkbox" id="selectAll" class="rounded border-slate-300 text-primary-600 shadow-sm focus:ring-primary-500">
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Instansi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Admin Pendaftar</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Durasi Aktif</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Jumlah Siswa</th>
                    <th class="relative px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($adminList as $admin)
                <tr class="hover:bg-slate-50/50 {{ $admin->status !== 'active' ? 'bg-yellow-50/20' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" class="row-checkbox rounded border-slate-300 text-primary-600 shadow-sm focus:ring-primary-500" value="{{ $admin->id }}">
                    </td>
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

                    {{-- Kolom Durasi Aktif --}}
                    <td class="px-6 py-4">
                        @if($admin->status === 'active')
                            {{-- Status Badge --}}
                            @if($admin->expires_at)
                                @if($admin->isExpired())
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700 mb-1.5">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        Expired
                                    </span>
                                @elseif($admin->remaining_days !== null && $admin->remaining_days <= 30)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 mb-1.5">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $admin->remaining_days }} hari lagi
                                    </span>
                                @endif
                                <div class="text-xs text-slate-400 mb-2">s/d {{ $admin->expires_at_formatted }}</div>
                            @endif

                            {{-- Inline Pill Buttons --}}
                            <div class="flex items-center gap-1">
                                @foreach([3, 6, 12] as $dur)
                                    <form action="{{ route('superadmin.admin.set-duration', $admin->id) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="duration" value="{{ $dur }}">
                                        <button type="submit" class="px-2 py-1 rounded-md text-xs font-semibold border transition-all hover:-translate-y-0.5 {{ $admin->activation_duration_months == $dur ? 'bg-primary-500 text-white border-primary-500 shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:border-primary-300 hover:text-primary-700' }}">
                                            {{ $dur }}bl
                                        </button>
                                    </form>
                                @endforeach
                                @if($admin->activation_duration_months)
                                    <form action="{{ route('superadmin.admin.remove-duration', $admin->id) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="p-1 rounded-md text-slate-400 hover:text-red-500 hover:bg-red-50 border border-transparent hover:border-red-200 transition-all" title="Hapus durasi">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @else
                            <span class="text-xs text-slate-400">—</span>
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
                    <td colspan="7" class="px-6 py-8 text-center text-slate-500">Belum ada admin instansi yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-slate-200">
        {{ $adminList->links() }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.row-checkbox');
        
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => {
                cb.checked = selectAll.checked;
            });
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                const allChecked = Array.from(checkboxes).every(c => c.checked);
                const someChecked = Array.from(checkboxes).some(c => c.checked);
                selectAll.checked = allChecked;
                selectAll.indeterminate = someChecked && !allChecked;
            });
        });
    });

    function submitBulkAction() {
        const action = document.getElementById('bulkActionSelect').value;
        if (!action) {
            alert('Silakan pilih aksi massal terlebih dahulu.');
            return;
        }

        const selectedCheckboxes = document.querySelectorAll('.row-checkbox:checked');
        if (selectedCheckboxes.length === 0) {
            alert('Pilih setidaknya satu baris untuk menerapkan aksi.');
            return;
        }

        if (!confirm(`Anda yakin ingin menerapkan aksi ini ke ${selectedCheckboxes.length} data yang dipilih?`)) {
            return;
        }

        const container = document.getElementById('bulkSelectedIds');
        container.innerHTML = ''; // clear previous

        selectedCheckboxes.forEach(cb => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selected_ids[]';
            input.value = cb.value;
            container.appendChild(input);
        });

        document.getElementById('bulkActionInput').value = action;
        document.getElementById('bulkForm').submit();
    }
</script>
@endsection
