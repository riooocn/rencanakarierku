<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-primary-900 leading-tight">
            {{ __('Hasil Akhir Perjalanan Karierku') }}
        </h2>
    </x-slot>

    <div class="py-12 relative">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-2xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
                
                <!-- Print Button -->
                <div class="absolute top-8 right-8">
                    <button class="flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 font-medium rounded-lg hover:bg-slate-200 transition-colors" onclick="window.print()">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Cetak PDF
                    </button>
                </div>

                <!-- Header Document -->
                <div class="text-center mb-12 border-b border-slate-100 pb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-100 text-primary-600 rounded-2xl mb-4 font-bold text-2xl">
                        R
                    </div>
                    <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Dokumen Perencanaan Karier</h1>
                    <p class="text-slate-500">Diterbitkan oleh Sistem Rencana Karierku</p>
                </div>

                <!-- 1. Identitas -->
                <div class="mb-10">
                    <h3 class="text-xl font-bold text-primary-900 mb-4 flex items-center border-b border-slate-200 pb-2">
                        <span class="bg-primary-600 text-white w-6 h-6 rounded-full inline-flex items-center justify-center text-sm mr-2">1</span>
                        Profil Peserta
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-slate-700">
                        <div><strong class="inline-block w-32">Nama:</strong> Budi Santoso</div>
                        <div><strong class="inline-block w-32">Sekolah:</strong> SMA Negeri 1 Jakarta</div>
                        <div><strong class="inline-block w-32">Email:</strong> budi@example.com</div>
                        <div><strong class="inline-block w-32">Tanggal Selesai:</strong> 13 Juli 2026</div>
                    </div>
                </div>

                <!-- 2. Hasil Asesmen -->
                <div class="mb-10">
                    <h3 class="text-xl font-bold text-primary-900 mb-4 flex items-center border-b border-slate-200 pb-2">
                        <span class="bg-primary-600 text-white w-6 h-6 rounded-full inline-flex items-center justify-center text-sm mr-2">2</span>
                        Ringkasan Asesmen Diri
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                            <h4 class="font-bold text-slate-800 mb-3">Minat (RIASEC)</h4>
                            <ul class="list-disc pl-5 text-sm text-slate-600 space-y-1">
                                <li>Investigative (Tinggi)</li>
                                <li>Artistic (Tinggi)</li>
                                <li>Social (Sedang)</li>
                            </ul>
                        </div>
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                            <h4 class="font-bold text-slate-800 mb-3">Kapasitas Dominan</h4>
                            <ul class="list-disc pl-5 text-sm text-slate-600 space-y-1">
                                <li>People</li>
                                <li>Ideas</li>
                            </ul>
                        </div>
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                            <h4 class="font-bold text-slate-800 mb-3">Nilai Karier Utama</h4>
                            <ul class="list-disc pl-5 text-sm text-slate-600 space-y-1">
                                <li>Extrinsic Rewards</li>
                                <li>Altruistic Rewards</li>
                                <li>Leisure</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- 3. Keputusan Final -->
                <div class="mb-10">
                    <h3 class="text-xl font-bold text-primary-900 mb-4 flex items-center border-b border-slate-200 pb-2">
                        <span class="bg-primary-600 text-white w-6 h-6 rounded-full inline-flex items-center justify-center text-sm mr-2">3</span>
                        Keputusan Karier Masa Depan
                    </h3>
                    
                    <div class="bg-gradient-to-r from-primary-50 to-white p-8 rounded-2xl border-l-4 border-primary-600 shadow-sm">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 font-medium mb-1">Profesi Terpilih:</p>
                                <h4 class="text-3xl font-extrabold text-slate-900 mb-3">Software Engineer</h4>
                                <p class="text-slate-700 leading-relaxed italic">"Saya memilih profesi ini karena sangat sesuai dengan minat analitis (Investigative) saya, serta keinginan saya untuk menciptakan solusi (Ideas) teknologi yang bermanfaat bagi banyak orang."</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center pt-8 border-t border-slate-100">
                    <p class="text-slate-500 font-medium italic">"Masa depanmu diciptakan oleh apa yang kamu lakukan hari ini, bukan besok."</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
