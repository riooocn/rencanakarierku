@extends('layouts.admin')

@section('title', 'Hasil Asesmen Siswa')
@section('page_title', 'Hasil Asesmen')
@section('page_description', 'Pantau dan kelola hasil tes minat, kapasitas, dan nilai karier siswa.')

@section('content')
<!-- Filter & Action -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
        <div class="relative max-w-sm w-full">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-lg bg-white text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="Cari nama siswa...">
        </div>
        <select class="block w-full sm:w-48 pl-3 pr-10 py-2 text-sm border border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 appearance-none">
            <option value="">Semua Sekolah</option>
            <option value="1">SMA N 1 Jakarta</option>
            <option value="2">SMA N 2 Jakarta</option>
        </select>
        <select class="block w-full sm:w-32 pl-3 pr-10 py-2 text-sm border border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 appearance-none">
            <option value="">Semua Kelas</option>
            <option value="10">Kelas 10</option>
            <option value="11">Kelas 11</option>
            <option value="12">Kelas 12</option>
        </select>
    </div>
    
    <button class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-lg shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
        <svg class="-ml-1 mr-2 h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        Export PDF/Excel
    </button>
</div>

<!-- Table -->
<div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Data Siswa</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Sekolah & Kelas</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Skor Minat</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Skor Kapasitas</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Tes</th>
                    <th scope="col" class="relative px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                <!-- Data Row 1 -->
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-500">
                                A
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-slate-900">Andi Saputra</div>
                                <div class="text-sm text-slate-500">08123456789</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-slate-900">SMA N 1 Jakarta</div>
                        <div class="text-sm text-slate-500">Kelas 12</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="text-sm font-semibold text-slate-700 mr-2">85%</span>
                            <div class="w-16 bg-slate-200 rounded-full h-1.5">
                                <div class="bg-green-500 h-1.5 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="text-sm font-semibold text-slate-700 mr-2">78%</span>
                            <div class="w-16 bg-slate-200 rounded-full h-1.5">
                                <div class="bg-primary-500 h-1.5 rounded-full" style="width: 78%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                        04 Jul 2026
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-primary-600 hover:text-primary-900 transition-colors font-semibold">Lihat Detail</button>
                    </td>
                </tr>

                <!-- Data Row 2 -->
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-500">
                                D
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-slate-900">Diana Putri</div>
                                <div class="text-sm text-slate-500">08561234987</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-slate-900">SMA N 2 Jakarta</div>
                        <div class="text-sm text-slate-500">Kelas 11</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="text-sm font-semibold text-slate-700 mr-2">60%</span>
                            <div class="w-16 bg-slate-200 rounded-full h-1.5">
                                <div class="bg-yellow-500 h-1.5 rounded-full" style="width: 60%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="text-sm font-semibold text-slate-700 mr-2">92%</span>
                            <div class="w-16 bg-slate-200 rounded-full h-1.5">
                                <div class="bg-green-500 h-1.5 rounded-full" style="width: 92%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                        03 Jul 2026
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-primary-600 hover:text-primary-900 transition-colors font-semibold">Lihat Detail</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    
    <!-- Pagination (Mock) -->
    <div class="bg-white px-4 py-3 border-t border-slate-200 flex items-center justify-between sm:px-6">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-slate-700">
                    Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">2</span> dari <span class="font-medium">24</span> hasil
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-slate-300 bg-white text-sm font-medium text-slate-500 hover:bg-slate-50">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-slate-300 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50">1</a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-slate-300 bg-primary-50 text-sm font-medium text-primary-600">2</a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-slate-300 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50">3</a>
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-slate-300 bg-white text-sm font-medium text-slate-500 hover:bg-slate-50">
                        <span class="sr-only">Next</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
