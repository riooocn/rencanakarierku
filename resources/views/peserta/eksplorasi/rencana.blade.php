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

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10 space-y-8">
            
            <!-- Header Card -->
            <div class="bg-primary-600 rounded-3xl p-10 text-white relative overflow-hidden shadow-xl">
                <div class="absolute inset-0 bg-gradient-to-r from-primary-700 to-primary-500 opacity-80"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-extrabold mb-4 text-center">Rencana Eksplorasiku</h3>
                    <p class="text-primary-100 text-center leading-relaxed">
                        Sebelum kamu mencari tahu berbagai informasi karier, ayo tuliskan terlebih dahulu rencanamu. Tuliskan secara spesifik sumber informasimu, baik melalui tokoh, situs web, media sosial atau buku. 
                    </p>
                    <div class="mt-4 bg-primary-800/50 rounded-xl p-4 border border-primary-500/30 text-sm">
                        <strong>Contoh:</strong> "Aku akan mencari tahu mengenai tugas/tanggung jawab dari karier tersebut melalui rekan kerja ayahku dan situs web O*NET."
                    </div>
                </div>
            </div>

            <!-- Form Rencana -->
            <div class="bg-white/80 backdrop-blur-xl border border-white shadow-xl shadow-slate-200/50 rounded-3xl p-8 md:p-10">
                <p class="text-slate-600 mb-8 italic">Tuliskan rencanamu pada kotak di bawah ini (lembar kerja mandiri):</p>

                <div class="space-y-6">
                    <!-- Soal 1 -->
                    <div>
                        <label class="block text-primary-900 font-semibold mb-2">
                            1. Aku akan mencari tahu mengenai pendidikan tinggi, jurusan dan mata kuliah yang berkaitan dengan karier tersebut melalui…
                        </label>
                        <textarea rows="2" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 transition-colors" placeholder="Ketik rencanamu di sini..."></textarea>
                    </div>

                    <!-- Soal 2 -->
                    <div>
                        <label class="block text-primary-900 font-semibold mb-2">
                            2. Aku akan mencari tahu mengenai keterampilan yang perlu aku kuasai melalui…
                        </label>
                        <textarea rows="2" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 transition-colors" placeholder="Ketik rencanamu di sini..."></textarea>
                    </div>

                    <!-- Soal 3 -->
                    <div>
                        <label class="block text-primary-900 font-semibold mb-2">
                            3. Aku akan mencari tahu mengenai pelatihan formal/pendidikan lanjutan yang perlu aku tempuh melalui…
                        </label>
                        <textarea rows="2" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 transition-colors" placeholder="Ketik rencanamu di sini..."></textarea>
                    </div>

                    <!-- Soal 4 -->
                    <div>
                        <label class="block text-primary-900 font-semibold mb-2">
                            4. Aku akan mencari tahu mengenai sertifikasi yang perlu aku jalani melalui…
                        </label>
                        <textarea rows="2" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 transition-colors" placeholder="Ketik rencanamu di sini..."></textarea>
                    </div>

                    <!-- Soal 5 -->
                    <div>
                        <label class="block text-primary-900 font-semibold mb-2">
                            5. Informasi-informasi mengenai peluang karier akan aku peroleh dari…
                        </label>
                        <textarea rows="2" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 transition-colors" placeholder="Ketik rencanamu di sini..."></textarea>
                    </div>

                    <!-- Soal 6 -->
                    <div>
                        <label class="block text-primary-900 font-semibold mb-2">
                            6. Aku akan mencari tahu mengenai tugas/tanggung jawab dari karier tersebut melalui…
                        </label>
                        <textarea rows="2" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 transition-colors" placeholder="Ketik rencanamu di sini..."></textarea>
                    </div>

                    <!-- Soal 7 -->
                    <div>
                        <label class="block text-primary-900 font-semibold mb-2">
                            7. Aku akan mencari tahu informasi lainnya melalui…
                        </label>
                        <textarea rows="2" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 transition-colors" placeholder="Ketik rencanamu di sini..."></textarea>
                    </div>
                </div>

                <!-- Footer Rencana -->
                <div class="mt-10 text-center">
                    <h4 class="text-2xl font-bold text-accent-600 mb-8">Semangat mencari! 🚀</h4>
                    <a href="{{ route('eksplorasi.form') }}" class="inline-flex items-center justify-center px-10 py-4 bg-primary-600 hover:bg-primary-700 text-white text-lg font-bold rounded-full shadow-lg shadow-primary-600/30 transition-transform transform hover:-translate-y-1">
                        Mulai Pengisian Eksplorasi Karier
                        <svg class="ml-3 w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
