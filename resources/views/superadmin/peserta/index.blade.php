@extends('layouts.admin')

@section('title', isset($admin) ? 'Peserta: ' . ($admin->institution->name ?? 'Instansi') : 'Daftar Seluruh Peserta')
@section('page_title', isset($admin) ? 'Daftar Peserta - ' . ($admin->institution->name ?? 'Instansi') : 'Daftar Seluruh Peserta (Global)')
@section('page_description', isset($admin) ? 'Daftar seluruh siswa yang berada di bawah pengelolaan instansi ini.' : 'Pantau dan kelola hasil tes siswa dari semua instansi terdaftar.')

@section('content')
<!-- Mirip dengan Admin Peserta Index tapi ada kolom Instansi -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 flex-wrap">
    <form action="{{ route('superadmin.peserta.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
        <div class="relative max-w-sm w-full">
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="block w-full pl-4 pr-3 py-2 border border-slate-200 rounded-lg bg-white text-sm focus:outline-none focus:ring-2 focus:ring-primary-500" 
                   placeholder="Cari nama siswa..."
                   oninput="clearTimeout(this.delay); this.delay = setTimeout(() => this.form.submit(), 800);"
                   autofocus
                   onfocus="var val = this.value; this.value = ''; this.value = val;">
        </div>
        <select name="institution_id" onchange="this.form.submit()" class="block w-full sm:w-72 pl-3 pr-10 py-2 text-sm border border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 appearance-none cursor-pointer">
            <option value="">Semua Instansi</option>
            @foreach(\App\Models\Institution::all() as $inst)
                <option value="{{ $inst->id }}" {{ request('institution_id') == $inst->id ? 'selected' : '' }}>{{ $inst->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="hidden">Cari</button>
    </form>
    
    <div class="flex items-center gap-2 flex-wrap">
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

        <a href="{{ route('superadmin.peserta.export') }}{{ isset($admin) ? '?institution_id=' . $admin->institution_id : '' }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-lg shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
            <svg class="-ml-1 mr-2 h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Export Excel
        </a>
    </div>
</div>

<!-- Hidden form for submitting bulk action -->
<form id="bulkForm" action="{{ route('superadmin.peserta.bulk-action') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="action" id="bulkActionInput">
    <div id="bulkSelectedIds"></div>
</form>

<div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left w-12">
                        <input type="checkbox" id="selectAll" class="rounded border-slate-300 text-primary-600 shadow-sm focus:ring-primary-500">
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Data Siswa</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Asal Instansi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kelas</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tgl Lahir</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Asesmen</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Status Akun</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Durasi Aktif</th>
                    <th scope="col" class="relative px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($pesertaList as $siswa)
                <tr class="hover:bg-slate-50/50 {{ $siswa->status !== 'active' ? 'bg-yellow-50/20' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" class="row-checkbox rounded border-slate-300 text-primary-600 shadow-sm focus:ring-primary-500" value="{{ $siswa->id }}">
                    </td>
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
                        <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            {{ $siswa->assessmentSessions ? $siswa->assessmentSessions->count() : 0 }} / 3
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($siswa->status === 'active')
                            <form action="{{ route('superadmin.peserta.deactivate', $siswa->id) }}" method="POST" class="inline" title="Klik untuk menonaktifkan akun">
                                @csrf @method('PATCH')
                                <button type="submit" class="relative inline-flex items-center h-6 rounded-full w-11 bg-green-500 transition-colors focus:outline-none">
                                    <span class="inline-block w-4 h-4 transform translate-x-6 bg-white rounded-full transition-transform"></span>
                                </button>
                                <span class="ml-2 text-xs font-semibold text-green-700">Aktif</span>
                            </form>
                        @elseif($siswa->status === 'inactive')
                            <form action="{{ route('superadmin.peserta.approve', $siswa->id) }}" method="POST" class="inline" title="Klik untuk mengaktifkan akun">
                                @csrf @method('PATCH')
                                <button type="submit" class="relative inline-flex items-center h-6 rounded-full w-11 bg-slate-300 transition-colors focus:outline-none">
                                    <span class="inline-block w-4 h-4 transform translate-x-1 bg-white rounded-full transition-transform"></span>
                                </button>
                                <span class="ml-2 text-xs font-semibold text-slate-500">Non-aktif</span>
                            </form>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                        @endif
                    </td>

                    {{-- Kolom Durasi Aktif --}}
                    <td class="px-6 py-4">
                        @if($siswa->status === 'active')
                            {{-- Status Badge --}}
                            @if($siswa->expires_at)
                                @if($siswa->isExpired())
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700 mb-1.5">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        Expired
                                    </span>
                                @elseif($siswa->remaining_days !== null && $siswa->remaining_days <= 30)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 mb-1.5">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $siswa->remaining_days }} hari lagi
                                    </span>
                                @endif
                                <div class="text-xs text-slate-400 mb-2">s/d {{ $siswa->expires_at_formatted }}</div>
                            @endif

                            {{-- Inline Pill Buttons --}}
                            <div class="flex items-center gap-1">
                                @foreach([3, 6, 12] as $dur)
                                    <form action="{{ route('superadmin.peserta.set-duration', $siswa->id) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="duration" value="{{ $dur }}">
                                        <button type="submit" class="px-2 py-1 rounded-md text-xs font-semibold border transition-all hover:-translate-y-0.5 {{ $siswa->activation_duration_months == $dur ? 'bg-primary-500 text-white border-primary-500 shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:border-primary-300 hover:text-primary-700' }}">
                                            {{ $dur }}bl
                                        </button>
                                    </form>
                                @endforeach
                                @if($siswa->activation_duration_months)
                                    <form action="{{ route('superadmin.peserta.remove-duration', $siswa->id) }}" method="POST" class="inline">
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

                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex items-center justify-center gap-2">
                            @if($siswa->status !== 'pending')
                                <a href="{{ route('superadmin.peserta.show', $siswa->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 rounded-md text-xs font-semibold transition-colors" title="Lihat Detail">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    Detail
                                </a>
                            @endif
                            @if($siswa->status === 'pending')
                                <form action="{{ route('superadmin.peserta.approve', $siswa->id) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 rounded-md text-xs font-semibold transition-colors" title="Verifikasi & Aktifkan">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Verifikasi
                                    </button>
                                </form>
                                <form action="{{ route('superadmin.peserta.reject', $siswa->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 rounded-md text-xs font-semibold transition-colors" onclick="return confirm('Yakin ingin menolak dan menghapus permintaan pendaftaran ini?')" title="Tolak">
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
                    <td colspan="9" class="px-6 py-8 text-center text-slate-500">Belum ada peserta yang terdaftar di sistem.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-slate-200">
        {{ $pesertaList->links() }}
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
