@extends('layouts.admin')

@section('title', 'Daftar Peserta Siswa')
@section('page_title', 'Daftar Peserta')
@section('page_description', 'Pantau dan kelola hasil tes minat, kapasitas, dan nilai karier siswa di instansi Anda.')

@section('content')
<!-- Filter & Action -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 flex-wrap">
    <form action="{{ route('admin.peserta.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
        <div class="relative max-w-sm w-full">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-lg bg-white text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" 
                   placeholder="Cari nama siswa..."
                   oninput="clearTimeout(this.delay); this.delay = setTimeout(() => this.form.submit(), 800);"
                   autofocus
                   onfocus="var val = this.value; this.value = ''; this.value = val;">
        </div>
        <select name="grade" onchange="this.form.submit()" class="block w-full sm:w-40 pl-3 pr-10 py-2 text-sm border border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 appearance-none cursor-pointer">
            <option value="">Semua Kelas</option>
            <option value="10" {{ request('grade') == '10' ? 'selected' : '' }}>Kelas 10</option>
            <option value="11" {{ request('grade') == '11' ? 'selected' : '' }}>Kelas 11</option>
            <option value="12" {{ request('grade') == '12' ? 'selected' : '' }}>Kelas 12</option>
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

        <a href="{{ route('admin.peserta.export') }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-lg shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
            <svg class="-ml-1 mr-2 h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Export Excel
        </a>
    </div>
</div>

<!-- Hidden form for submitting bulk action -->
<form id="bulkForm" action="{{ route('admin.peserta.bulk-action') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="action" id="bulkActionInput">
    <div id="bulkSelectedIds"></div>
</form>

<!-- Table -->
<div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left w-12">
                        <input type="checkbox" id="selectAll" class="rounded border-slate-300 text-primary-600 shadow-sm focus:ring-primary-500">
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Data Siswa</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kelas</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tgl Lahir</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Asesmen</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Status Akun</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Tes</th>
                    <th scope="col" class="relative px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($pesertaList as $peserta)
                <tr class="hover:bg-slate-50/50 transition-colors {{ $peserta->status !== 'active' ? 'bg-yellow-50/20' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" class="row-checkbox rounded border-slate-300 text-primary-600 shadow-sm focus:ring-primary-500" value="{{ $peserta->id }}">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-500">
                                {{ strtoupper(substr($peserta->name, 0, 1)) }}
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-slate-900">{{ $peserta->name }}</div>
                                <div class="text-sm text-slate-500">{{ $peserta->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-slate-900">{{ $peserta->grade ? (is_numeric($peserta->grade) ? 'Kelas ' . $peserta->grade : $peserta->grade) : '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-slate-900">{{ $peserta->tanggal_lahir ? \Carbon\Carbon::parse($peserta->tanggal_lahir)->format('d M Y') : '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            {{ $peserta->assessmentSessions ? $peserta->assessmentSessions->count() : 0 }} / 3
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($peserta->status === 'active')
                            <form action="{{ route('admin.peserta.deactivate', $peserta->id) }}" method="POST" class="inline" title="Klik untuk menonaktifkan akun">
                                @csrf @method('PATCH')
                                <button type="submit" class="relative inline-flex items-center h-6 rounded-full w-11 bg-green-500 transition-colors focus:outline-none">
                                    <span class="inline-block w-4 h-4 transform translate-x-6 bg-white rounded-full transition-transform"></span>
                                </button>
                                <span class="ml-2 text-xs font-semibold text-green-700">Aktif</span>
                            </form>
                        @elseif($peserta->status === 'inactive')
                            <form action="{{ route('admin.peserta.approve', $peserta->id) }}" method="POST" class="inline" title="Klik untuk mengaktifkan akun">
                                @csrf @method('PATCH')
                                <button type="submit" class="relative inline-flex items-center h-6 rounded-full w-11 bg-slate-300 transition-colors focus:outline-none">
                                    <span class="inline-block w-4 h-4 transform translate-x-1 bg-white rounded-full transition-transform"></span>
                                </button>
                                <span class="ml-2 text-xs font-semibold text-slate-500">Non-aktif</span>
                            </form>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu Verifikasi
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="text-sm text-slate-900">{{ $peserta->created_at->format('d M Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex items-center justify-center gap-2">
                            @if($peserta->status !== 'pending')
                                <a href="{{ route('admin.peserta.show', $peserta->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 rounded-md text-xs font-semibold transition-colors" title="Lihat Detail">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    Detail
                                </a>
                            @endif
                            @if($peserta->status === 'pending')
                                <form action="{{ route('admin.peserta.approve', $peserta->id) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 rounded-md text-xs font-semibold transition-colors" title="Verifikasi & Aktifkan">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Verifikasi
                                    </button>
                                </form>
                                <form action="{{ route('admin.peserta.reject', $peserta->id) }}" method="POST" class="inline">
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
                    <td colspan="8" class="px-6 py-8 text-center text-slate-500">Belum ada peserta yang terdaftar di instansi Anda.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="bg-white px-4 py-3 border-t border-slate-200">
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
