<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-primary-900 leading-tight">
            {{ __('Hasil Tes Minat (RIASEC)') }}
        </h2>
    </x-slot>

    <div class="py-12 relative">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 relative z-10 space-y-8">
            
            <div class="bg-white/80 backdrop-blur-xl border border-white shadow-xl shadow-slate-200/50 rounded-3xl p-8 md:p-10 overflow-hidden relative">
                <!-- Decorative Gold Sparkles -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-accent-200/50 rounded-bl-[100px] -z-10"></div>
                
                <div class="text-center mb-10">
                    <h3 class="text-3xl font-extrabold text-primary-900 mb-2">Profil Minat Kariermu</h3>
                    <p class="text-slate-600">Berdasarkan jawabanmu, berikut adalah 3 tipe minat paling dominan (RIASEC) yang mencerminkan dirimu.</p>
                </div>

                <!-- 3 Top Scores -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <!-- Rank 1 -->
                    <div class="relative bg-primary-50 rounded-2xl p-6 border border-primary-100 flex flex-col items-center text-center group hover:bg-primary-600 transition-colors">
                        <div class="absolute -top-4 bg-accent-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">Tertinggi</div>
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-primary-600 font-bold text-2xl mb-4 group-hover:text-primary-900">
                            I
                        </div>
                        <h4 class="text-xl font-bold text-primary-900 mb-2 group-hover:text-white">Investigative</h4>
                        <p class="text-sm text-slate-600 group-hover:text-primary-100">Pemikir, analitis, suka memecahkan masalah kompleks dan meneliti sains.</p>
                    </div>

                    <!-- Rank 2 -->
                    <div class="relative bg-slate-50 rounded-2xl p-6 border border-slate-100 flex flex-col items-center text-center group hover:bg-primary-600 transition-colors">
                        <div class="w-16 h-16 bg-white shadow-sm rounded-full flex items-center justify-center text-slate-600 font-bold text-2xl mb-4 group-hover:text-primary-900">
                            A
                        </div>
                        <h4 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-white">Artistic</h4>
                        <p class="text-sm text-slate-600 group-hover:text-primary-100">Kreatif, inovatif, suka mengekspresikan diri melalui seni atau ide original.</p>
                    </div>

                    <!-- Rank 3 -->
                    <div class="relative bg-slate-50 rounded-2xl p-6 border border-slate-100 flex flex-col items-center text-center group hover:bg-primary-600 transition-colors">
                        <div class="w-16 h-16 bg-white shadow-sm rounded-full flex items-center justify-center text-slate-600 font-bold text-2xl mb-4 group-hover:text-primary-900">
                            S
                        </div>
                        <h4 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-white">Social</h4>
                        <p class="text-sm text-slate-600 group-hover:text-primary-100">Pemberi bantuan, ramah, suka mengajar, membimbing, atau menyembuhkan orang lain.</p>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-slate-100">
                    <a href="{{ route('perjalananku.index') }}" class="text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        &larr; Kembali ke Perjalanan
                    </a>
                    <a href="{{ route('asesmen.kapasitas') }}" class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-lg shadow-primary-600/30">
                        Lanjut Tes Kapasitas
                        <svg class="ml-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
