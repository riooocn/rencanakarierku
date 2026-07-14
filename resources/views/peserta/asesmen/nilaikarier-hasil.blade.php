<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-bold text-2xl text-primary-900 leading-tight">
                {{ __('Tahap 1 : Asesmen diri') }}
            </h2>
            <div class="text-sm font-semibold text-slate-500 bg-slate-100 px-4 py-2 rounded-xl">
                Hasil Asesmen Nilai Karier
            </div>
        </div>
    </x-slot>

    <div class="py-12 relative">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 relative z-10 space-y-8">
            
            <div class="bg-white/80 backdrop-blur-xl border border-white shadow-xl shadow-slate-200/50 rounded-3xl p-8 md:p-10">
                <div class="text-center mb-10">
                    <h3 class="text-3xl font-extrabold text-primary-900 mb-2">Prioritas Nilai Kariermu</h3>
                    <p class="text-slate-600">Berikut adalah 3 hal yang paling penting dan memotivasimu dalam sebuah pekerjaan.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    @if(isset($result) && is_array($result->top_results))
                        @foreach($result->top_results as $index => $code)
                            @php
                                $detail = \App\Helpers\AssessmentHelper::getNilaiKarierDetail($code);
                            @endphp
                            <!-- Top {{ $index + 1 }} -->
                            @if($index === 0)
                            <div class="relative bg-gradient-to-br from-accent-500 to-accent-600 rounded-2xl p-6 text-white text-center shadow-lg transform hover:-translate-y-2 transition-transform">
                                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold mb-2">{{ $detail['name'] }}</h4>
                                <p class="text-sm text-accent-100">{{ $detail['desc'] }}</p>
                            </div>
                            @else
                            <div class="relative bg-white rounded-2xl p-6 text-center shadow-sm border border-slate-200 hover:-translate-y-2 transition-transform">
                                <div class="w-16 h-16 bg-primary-50 rounded-full flex items-center justify-center mx-auto mb-4 text-primary-600">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-slate-900 mb-2">{{ $detail['name'] }}</h4>
                                <p class="text-sm text-slate-500">{{ $detail['desc'] }}</p>
                            </div>
                            @endif
                        @endforeach
                    @else
                        <div class="col-span-3 text-center text-slate-500">Hasil tidak ditemukan.</div>
                    @endif
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-slate-100">
                    <a href="{{ route('asesmen.kapasitas.hasil') }}" class="text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        &larr; Kembali
                    </a>
                    
                    <!-- Lanjut ke Tahap 2: Eksplorasi -->
                    <a href="{{ route('eksplorasi.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-lg shadow-primary-600/30 group">
                        Lanjut ke Eksplorasi Karier
                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
