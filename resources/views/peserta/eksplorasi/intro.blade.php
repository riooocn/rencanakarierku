<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-primary-900 leading-tight">
            {{ __('Tahap 2: Eksplorasi Karier') }}
        </h2>
    </x-slot>

    <div class="py-12 relative">
        <!-- Decorative Background -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-accent-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
        </div>
        
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 relative z-10 space-y-8">
            
            <!-- Hero Section -->
            <div class="bg-primary-600 rounded-3xl p-10 text-center text-white relative overflow-hidden shadow-xl">
                <div class="absolute inset-0 bg-gradient-to-r from-primary-700 to-primary-500 opacity-80"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-extrabold mb-4">Pengantar Eksplorasi Karier</h3>
                    <p class="text-primary-100 mb-2 max-w-3xl mx-auto leading-relaxed">
                        Sebelum menentukan karier yang ingin kamu jalani, kamu perlu melakukan eksplorasi atau mencari tahu mengenai karier-karier tersebut. Eksplorasi ini perlu kamu lakukan untuk mengetahui berbagai informasi karier yang berguna sebagai bahan pertimbanganmu dalam memilih karier nantinya.
                    </p>
                </div>
            </div>

            <div class="text-center pt-4">
                <h3 class="text-2xl font-bold text-primary-900 mb-8">Dari mana kamu dapat mencari informasi tentang karier tersebut?</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Ahli -->
                <div class="bg-white/70 backdrop-blur-xl border border-white/40 shadow-xl shadow-slate-200/50 rounded-3xl p-8 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 bg-accent-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-accent-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-primary-900 mb-3">Orang yang Ahli di Bidangnya</h4>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Kamu dapat mencari informasi tersebut melalui orang-orang di sekitarmu yang ahli di bidang tersebut, seperti orang tua, saudara dan keluarga besar, guru BK, guru mata pelajaran, atau orang lain yang bekerja di bidang tersebut.
                    </p>
                </div>

                <!-- Situs Web -->
                <div class="bg-white/70 backdrop-blur-xl border border-white/40 shadow-xl shadow-slate-200/50 rounded-3xl p-8 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-primary-900 mb-3">Situs Web Terpercaya</h4>
                    <p class="text-slate-600 text-sm leading-relaxed mb-4">
                        Selain itu, kamu juga dapat mencari informasi melalui situs web. Pastikan situs web sebagai sumber informasi tersebut terpercaya. Berikut contoh situs web yang dapat kamu telusuri:
                    </p>
                    <ul class="space-y-2 text-sm">
                        <li><a href="https://www.onetonline.org/" target="_blank" class="text-primary-600 hover:text-primary-800 font-semibold flex items-center gap-2"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg> O*NET</a></li>
                        <li><a href="https://rencanamu.id/profesi" target="_blank" class="text-primary-600 hover:text-primary-800 font-semibold flex items-center gap-2"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg> Rencanamu (Profesi)</a></li>
                        <li><a href="https://rencanamu.id/cari-jurusan" target="_blank" class="text-primary-600 hover:text-primary-800 font-semibold flex items-center gap-2"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg> Rencanamu (Jurusan)</a></li>
                    </ul>
                </div>
            </div>

            <!-- Media Sosial -->
            <div class="bg-white/70 backdrop-blur-xl border border-white/40 shadow-xl shadow-slate-200/50 rounded-3xl p-8 hover:-translate-y-1 transition-all duration-300">
                <div class="flex flex-col md:flex-row items-start gap-6">
                    <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center shrink-0 mb-4 md:mb-0">
                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                           <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </div>
                    <div class="w-full">
                        <h4 class="text-xl font-bold text-primary-900 mb-2">Media Sosial (YouTube)</h4>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            Apabila kamu ingin mencari dari media sosial, sebaiknya kamu mencari tahu dari orang-orang yang ahli di bidangnya atau di media sosial yang juga kredibel. Berikut contoh akun Youtube kredibel yang menyediakan berbagai informasi tentang karier:
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="https://www.youtube.com/@CareerOneStop" target="_blank" class="block p-4 rounded-xl bg-slate-50 border border-slate-200 hover:border-red-300 hover:shadow-md transition-all text-center">
                                <span class="font-bold text-primary-900">CareerOneStop</span>
                            </a>
                            <a href="https://www.youtube.com/playlist?list=PLC4jotN_tSTy0ZCt2X5LqVlmyJmfN4TLd" target="_blank" class="block p-4 rounded-xl bg-slate-50 border border-slate-200 hover:border-red-300 hover:shadow-md transition-all text-center">
                                <span class="font-bold text-primary-900">Student Edge</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buku -->
            <div class="bg-white/70 backdrop-blur-xl border border-white/40 shadow-xl shadow-slate-200/50 rounded-3xl p-8 hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-primary-900">Ingin mencari tahu melalui buku?</h4>
                </div>
                <p class="text-slate-600 text-sm mb-6">Simak sumber-sumber berikut ini yang bisa menjadi referensimu.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Buku 1 -->
                    <div class="flex flex-col items-center justify-center bg-slate-50 p-4 rounded-2xl border border-slate-100 shadow-sm text-center">
                        <div class="w-full h-80 flex items-center justify-center overflow-hidden mb-4 rounded-lg bg-white shadow-md border border-slate-200">
                            <img src="{{ asset('images/buku1.jpg') }}" alt="Jurusan Apa Buat Kamu? SMA IPA" class="max-w-full max-h-full object-contain">
                        </div>
                        <p class="text-sm font-semibold text-primary-900 leading-relaxed">
                            Dinarga. M.S., dkk. (2016).<br>Jurusan Apa Buat Kamu? SMA IPA.<br><span class="font-normal text-slate-500">Surabaya: Andi Publisher.</span>
                        </p>
                    </div>
                    <!-- Buku 2 -->
                    <div class="flex flex-col items-center justify-center bg-slate-50 p-4 rounded-2xl border border-slate-100 shadow-sm text-center">
                        <div class="w-full h-80 flex items-center justify-center overflow-hidden mb-4 rounded-lg bg-white shadow-md border border-slate-200">
                            <img src="{{ asset('images/buku2.jpg') }}" alt="Jurusan Apa Buat Kamu? SMA IPS Bahasa" class="max-w-full max-h-full object-contain">
                        </div>
                        <p class="text-sm font-semibold text-primary-900 leading-relaxed">
                            Dinarga. M.S., dkk. (2019).<br>Jurusan Apa Buat Kamu? SMA IPS Bahasa.<br><span class="font-normal text-slate-500">Surabaya: Andi Publisher.</span>
                        </p>
                    </div>
                    <!-- Buku 3 -->
                    <div class="flex flex-col items-center justify-center bg-slate-50 p-4 rounded-2xl border border-slate-100 shadow-sm text-center">
                        <div class="w-full h-80 flex items-center justify-center overflow-hidden mb-4 rounded-lg bg-white shadow-md border border-slate-200">
                            <img src="{{ asset('images/buku3.jpg') }}" alt="Memahami Program Studi" class="max-w-full max-h-full object-contain">
                        </div>
                        <p class="text-sm font-semibold text-primary-900 leading-relaxed">
                            Andori. (2013).<br>Memahami Program Studi Berdasarkan Bidang Ilmu & Prospek Karirnya.<br><span class="font-normal text-slate-500">Yogyakarta: Paramitra Publishing</span>
                        </p>
                    </div>
                    <!-- Buku 4 -->
                    <div class="flex flex-col items-center justify-center bg-slate-50 p-4 rounded-2xl border border-slate-100 shadow-sm text-center">
                        <div class="w-full h-80 flex items-center justify-center overflow-hidden mb-4 rounded-lg bg-white shadow-md border border-slate-200">
                            <img src="{{ asset('images/buku4.jpg') }}" alt="Mengenal Berbagai Jenis Profesi" class="max-w-full max-h-full object-contain">
                        </div>
                        <p class="text-sm font-semibold text-primary-900 leading-relaxed">
                            Rahadyan B, Nararya. (2013).<br>Mengenal Berbagai Jenis Profesi Sebagai Pilihan Karir Masa Depan.<br><span class="font-normal text-slate-500">Yogyakarta: Paramitra Publishing.</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Lanjut Button -->
            <div class="text-center mt-12 mb-8">
                <a href="{{ route('eksplorasi.rencana') }}" class="inline-flex items-center justify-center px-10 py-4 bg-accent-500 hover:bg-accent-600 text-white text-lg font-bold rounded-full shadow-lg shadow-accent-500/30 transition-transform transform hover:-translate-y-1">
                    Lanjut Susun Rencana Eksplorasi
                    <svg class="ml-3 w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
