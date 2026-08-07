<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-primary-900 leading-tight">
            {{ __('Selamat! Keputusan Karier') }}
        </h2>
    </x-slot>

    <div class="py-12 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white rounded-3xl border border-slate-100 shadow-2xl p-10 text-center">
                <div class="w-24 h-24 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner">
                    <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-4xl font-extrabold text-primary-900 mb-4">Selamat! Kamu Telah Memilih</h3>
                <p class="text-lg text-slate-600 mb-8">Berdasarkan perbandingan yang kamu lakukan, pekerjaan yang paling banyak sesuai dengan diriku adalah:</p>
                
                <div class="inline-block bg-gradient-to-r from-primary-600 to-accent-600 p-1 rounded-2xl mb-12 shadow-xl">
                    <div class="bg-white px-12 py-6 rounded-xl">
                        <h2 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-primary-700 to-accent-600">{{ $keputusan->final_choice }}</h2>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('hasilkeputusan.show', $keputusan->id) }}" class="inline-flex items-center justify-center px-8 py-4 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-lg shadow-primary-600/30 text-lg group">
                        Simpan & Lihat Rangkuman Detail
                        <svg class="ml-2 w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
