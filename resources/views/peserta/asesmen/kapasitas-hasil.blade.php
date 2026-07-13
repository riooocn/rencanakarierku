<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-bold text-2xl text-primary-900 leading-tight">
                {{ __('Tahap 1 : Asesmen diri') }}
            </h2>
            <div class="text-sm font-semibold text-slate-500 bg-slate-100 px-4 py-2 rounded-xl">
                Hasil Asesmen Kapasitas
            </div>
        </div>
    </x-slot>

    <div class="py-12 relative">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 relative z-10 space-y-8">
            
            <div class="bg-white/80 backdrop-blur-xl border border-white shadow-xl shadow-slate-200/50 rounded-3xl p-8 md:p-10">
                <div class="text-center mb-10">
                    <h3 class="text-3xl font-extrabold text-primary-900 mb-2">Potensi & Keahlianmu</h3>
                    <p class="text-slate-600">Berikut adalah area dan mata pelajaran dimana kamu memiliki kapasitas terbaik.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    
                    <!-- Top 2 Kapasitas -->
                    <div class="bg-primary-50 rounded-3xl p-8 border border-primary-100">
                        <h4 class="text-lg font-bold text-primary-900 mb-6 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-primary-200 flex items-center justify-center mr-3 text-primary-700">1</span>
                            Kapasitas Utama (Bidang)
                        </h4>
                        
                        <div class="space-y-4">
                            <!-- People -->
                            <div class="flex items-center justify-between p-4 bg-white rounded-2xl shadow-sm border border-slate-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-accent-100 rounded-lg flex items-center justify-center text-accent-700">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">People</p>
                                        <p class="text-xs text-slate-500">Kapasitas bekerja dengan orang lain</p>
                                    </div>
                                </div>
                                <span class="font-bold text-primary-600 bg-primary-100 px-3 py-1 rounded-full text-sm">Tinggi</span>
                            </div>

                            <!-- Ideas -->
                            <div class="flex items-center justify-between p-4 bg-white rounded-2xl shadow-sm border border-slate-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center text-primary-700">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">Ideas</p>
                                        <p class="text-xs text-slate-500">Kapasitas memikirkan konsep</p>
                                    </div>
                                </div>
                                <span class="font-bold text-primary-600 bg-primary-100 px-3 py-1 rounded-full text-sm">Tinggi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Top 5 Mata Pelajaran -->
                    <div class="bg-accent-50 rounded-3xl p-8 border border-accent-100">
                        <h4 class="text-lg font-bold text-accent-900 mb-6 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-accent-200 flex items-center justify-center mr-3 text-accent-800">2</span>
                            Mata Pelajaran Terkuat
                        </h4>
                        
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 bg-white rounded-xl shadow-sm border border-slate-100">
                                <span class="font-medium text-slate-800">1. Bahasa Inggris</span>
                                <span class="text-accent-600 font-bold">5 / 5</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-white rounded-xl shadow-sm border border-slate-100">
                                <span class="font-medium text-slate-800">2. Matematika</span>
                                <span class="text-accent-600 font-bold">4 / 5</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-white rounded-xl shadow-sm border border-slate-100">
                                <span class="font-medium text-slate-800">3. Biologi</span>
                                <span class="text-accent-600 font-bold">4 / 5</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex justify-between items-center pt-6 border-t border-slate-100">
                    <a href="{{ route('asesmen.minat.hasil') }}" class="text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        &larr; Kembali
                    </a>
                    <a href="{{ route('asesmen.nilaikarier') }}" class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-lg shadow-primary-600/30">
                        Lanjut Tes Nilai Karier
                        <svg class="ml-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
