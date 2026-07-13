<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-primary-900 leading-tight">
            {{ __('Perjalanan Karierku') }}
        </h2>
    </x-slot>

    <div class="py-12 relative">
        <!-- Decorative Background Background -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-accent-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-32 left-1/2 w-96 h-96 bg-primary-100/40 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10 space-y-8">
            
            <div class="flex flex-col md:flex-row items-center gap-12 mb-16">
                <div class="flex-1 space-y-6 text-center md:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-accent-50 text-accent-700 text-sm font-semibold mb-2 ring-1 ring-inset ring-accent-500/20">
                        <span class="flex w-2 h-2 rounded-full bg-accent-600"></span>
                        Perjalanan Dimulai
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-primary-900 tracking-tight leading-tight">Siap Memetakan Masa Depanmu?</h1>
                    <p class="text-lg text-slate-600 max-w-xl mx-auto md:mx-0 leading-relaxed">Ikuti tiga tahapan perjalanan terstruktur ini untuk menemukan arah karier terbaik yang sesuai dengan minat, kapasitas, dan nilai yang kamu yakini. Bintang masa depanmu menanti di ujung jalan.</p>
                </div>
                <div class="flex-1 relative w-full max-w-md mx-auto md:max-w-none">
                    <div class="absolute inset-0 bg-gradient-to-tr from-primary-500 to-accent-500 rounded-[2.5rem] transform rotate-3 scale-105 opacity-20 blur-xl"></div>
                    <img src="{{ asset('images/career_journey_road.png') }}" alt="Career Journey Road to Star" class="relative rounded-[2rem] shadow-2xl object-cover w-full h-64 md:h-80 border-[6px] border-white/80 backdrop-blur-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Tahap 1: Asesmen -->
                <div class="bg-white/70 backdrop-blur-xl border border-white/40 shadow-xl shadow-slate-200/50 rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-primary-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-primary-900 mb-3">1. Asesmen Diri</h3>
                    <p class="text-slate-600 mb-6 line-clamp-3">Kenali dirimu lebih dalam melalui tiga tes psikologi yang dirancang khusus: Tes Minat (RIASEC), Kapasitas, dan Nilai Karier.</p>
                    <a href="{{ route('asesmen.minat') }}" class="inline-flex items-center justify-center w-full px-4 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-md">
                        Mulai Tes
                        <svg class="ml-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

                <!-- Tahap 2: Eksplorasi -->
                <div class="bg-white/70 backdrop-blur-xl border border-white/40 shadow-xl shadow-slate-200/50 rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 group opacity-75">
                    <div class="w-14 h-14 bg-accent-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-accent-500/30">
                        <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-primary-900 mb-3">2. Eksplorasi Karier</h3>
                    <p class="text-slate-600 mb-6 line-clamp-3">Cari tahu tentang berbagai profesi yang relevan dengan hasil asesmenmu dan pelajari apa yang dibutuhkan untuk mencapainya.</p>
                    <button disabled class="inline-flex items-center justify-center w-full px-4 py-3 bg-slate-200 text-slate-500 font-semibold rounded-xl cursor-not-allowed">
                        Terkunci
                    </button>
                </div>

                <!-- Tahap 3: Keputusan -->
                <div class="bg-white/70 backdrop-blur-xl border border-white/40 shadow-xl shadow-slate-200/50 rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 group opacity-75">
                    <div class="w-14 h-14 bg-green-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-green-500/30">
                        <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-primary-900 mb-3">3. Keputusan Akhir</h3>
                    <p class="text-slate-600 mb-6 line-clamp-3">Mantapkan pilihanmu dengan menentukan profesi impian masa depan dan buat rencana tindakan nyata.</p>
                    <button disabled class="inline-flex items-center justify-center w-full px-4 py-3 bg-slate-200 text-slate-500 font-semibold rounded-xl cursor-not-allowed">
                        Terkunci
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
