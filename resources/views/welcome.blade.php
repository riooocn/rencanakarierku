@extends('layouts.landing')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-white">
    <div class="absolute inset-y-0 w-full h-full bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary-50 via-white to-white -z-10"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-24 md:pt-32 md:pb-36 text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-50 text-primary-700 text-sm font-semibold mb-6 ring-1 ring-inset ring-primary-500/20">
            <span class="flex w-2 h-2 rounded-full bg-primary-600"></span>
            Rancang Masa Depanmu
        </div>
        <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight max-w-4xl mx-auto leading-tight">
            Rancang Hari Ini <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-accent-500">Wujudkan</span> Esok Hari
        </h1>
        <p class="mt-6 text-lg md:text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed">
            Rencana Karierku hadir untuk membantumu menyusun perencanaan karier secara terarah. Kenali dirimu, eksplorasi peluang, dan buat keputusan terbaik.
        </p>
        <div class="mt-10 flex flex-col sm:flex-row justify-center items-center gap-4 w-full px-4 sm:px-0">
            <a href="{{ route('register') }}" class="w-full sm:w-auto text-center px-8 py-3.5 text-base font-semibold text-white bg-primary-600 rounded-full hover:bg-primary-700 shadow-lg shadow-primary-500/30 transition-all hover:-translate-y-1">
                Mulai Sekarang - Gratis
            </a>
            <a href="#asesmen" class="w-full sm:w-auto text-center px-8 py-3.5 text-base font-semibold text-slate-700 bg-white border border-slate-200 rounded-full hover:bg-slate-50 transition-all hover:-translate-y-1">
                Pelajari Tahapannya
            </a>
        </div>
    </div>
</section>

<!-- Tahapan Section -->
<section class="py-24 bg-slate-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-slate-900">3 Tahapan Perencanaan Karier</h2>
            <p class="mt-4 text-slate-600 max-w-2xl mx-auto">Kami merancang alur yang mudah diikuti agar kamu tidak kebingungan dalam menentukan langkah kariermu setelah lulus.</p>
        </div>

        <div class="flex md:grid md:grid-cols-3 gap-6 md:gap-8 overflow-x-auto snap-x snap-mandatory pb-8 md:pb-0 -mx-4 px-4 md:mx-0 md:px-0 md:overflow-visible relative [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            <!-- Line connector -->
            <div class="hidden md:block absolute top-12 left-1/6 right-1/6 h-0.5 bg-gradient-to-r from-primary-200 via-primary-400 to-primary-200 z-0"></div>

            <!-- Asesmen Diri -->
            <div id="asesmen" class="w-[85vw] sm:w-[320px] shrink-0 md:w-auto snap-center relative z-10 group bg-white rounded-3xl p-8 shadow-sm ring-1 ring-slate-200 hover:shadow-xl hover:shadow-primary-500/10 hover:ring-primary-500/30 transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center mb-6 group-hover:bg-primary-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">1. Asesmen Diri</h3>
                <p class="text-slate-600 leading-relaxed">
                    Belajar untuk mengenal dirimu melalui asesmen minat, kapasitas, dan nilai karier. Pahami apa yang benar-benar sesuai dengan potensimu.
                </p>
            </div>

            <!-- Eksplorasi Karier -->
            <div id="eksplorasi" class="w-[85vw] sm:w-[320px] shrink-0 md:w-auto snap-center relative z-10 group bg-white rounded-3xl p-8 shadow-sm ring-1 ring-slate-200 hover:shadow-xl hover:shadow-accent-500/10 hover:ring-accent-500/30 transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 rounded-2xl bg-accent-50 text-accent-600 flex items-center justify-center mb-6 group-hover:bg-accent-500 group-hover:text-white transition-colors duration-300">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">2. Eksplorasi Karier</h3>
                <p class="text-slate-600 leading-relaxed">
                    Mempersiapkan proses pencaritahuan dari berbagai sumber terpercaya seperti orang tua, guru BK, literatur, maupun internet.
                </p>
            </div>

            <!-- Pengambilan Keputusan -->
            <div id="keputusan" class="w-[85vw] sm:w-[320px] shrink-0 md:w-auto snap-center relative z-10 group bg-white rounded-3xl p-8 shadow-sm ring-1 ring-slate-200 hover:shadow-xl hover:shadow-primary-500/10 hover:ring-primary-500/30 transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center mb-6 group-hover:bg-primary-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">3. Pengambilan Keputusan</h3>
                <p class="text-slate-600 leading-relaxed">
                    Buat keputusan dengan membandingkan informasi tentang dirimu dan karier. Temukan satu pilihan yang paling tepat.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 bg-white overflow-hidden relative">
    <!-- Decorative background element -->
    <div class="absolute inset-0 bg-primary-600 mix-blend-multiply opacity-5 rounded-[4rem] transform -rotate-3 scale-110"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-3xl font-bold text-slate-900">Siap Menentukan Arah Masa Depanmu?</h2>
        <p class="mt-4 text-xl text-slate-600">Bergabunglah bersama siswa SMA lainnya dan mulai petakan karier yang sesuai dengan minat dan potensimu hari ini juga.</p>
        <div class="mt-8">
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white bg-gradient-to-r from-primary-600 to-accent-600 rounded-full hover:from-primary-700 hover:to-accent-700 shadow-xl shadow-primary-500/30 transition-all hover:scale-105">
                Buat Akun Sekarang
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </div>
</section>
@endsection
