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

    @php
        $detailsData = [];
        if(isset($result) && is_array($result->top_results)) {
            foreach($result->top_results as $code) {
                $detailsData[$code] = \App\Helpers\AssessmentHelper::getNilaiKarierDetail($code);
            }
        }
    @endphp

    <script>
        window.nilaiKarierDetailsData = {!! json_encode($detailsData) !!};
    </script>

    <div class="py-12 relative" x-data="{ openDetail: false, activeDetail: {} }">
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
                            <div @click="activeDetail = window.nilaiKarierDetailsData['{{ $code }}']; openDetail = true" 
                                 class="relative bg-white rounded-2xl p-6 text-center shadow-sm border border-slate-200 hover:-translate-y-2 transition-colors cursor-pointer group hover:bg-accent-500 hover:border-accent-600">
                                <div class="w-16 h-16 bg-primary-50 rounded-full flex items-center justify-center mx-auto mb-4 text-primary-600 group-hover:bg-white/20 group-hover:text-white transition-colors">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-white transition-colors">{{ $detail['name'] }}</h4>
                                <p class="text-sm text-slate-500 group-hover:text-accent-100 transition-colors">{{ $detail['desc'] }}</p>
                                
                                <button class="mt-4 text-xs font-bold text-accent-600 group-hover:text-white underline hover:no-underline transition-colors">
                                    Detail &gt;
                                </button>
                            </div>
                            @else
                            <div @click="activeDetail = window.nilaiKarierDetailsData['{{ $code }}']; openDetail = true" 
                                 class="relative bg-white rounded-2xl p-6 text-center shadow-sm border border-slate-200 hover:-translate-y-2 transition-colors cursor-pointer group hover:bg-accent-500 hover:border-accent-600">
                                <div class="w-16 h-16 bg-primary-50 rounded-full flex items-center justify-center mx-auto mb-4 text-primary-600 group-hover:bg-white/20 group-hover:text-white transition-colors">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-white transition-colors">{{ $detail['name'] }}</h4>
                                <p class="text-sm text-slate-500 group-hover:text-accent-100 transition-colors">{{ $detail['desc'] }}</p>
                                
                                <button class="mt-4 text-xs font-bold text-accent-600 group-hover:text-white underline hover:no-underline transition-colors">
                                    Detail &gt;
                                </button>
                            </div>
                            @endif
                        @endforeach
                    @else
                        <div class="col-span-3 text-center text-slate-500">Hasil tidak ditemukan.</div>
                    @endif
                </div>

                <div class="flex justify-end items-center pt-6 border-t border-slate-100">
                    <!-- Lanjut ke Tahap 2: Eksplorasi -->
                    <a href="{{ $isEksplorasiUpToDate ? route('eksplorasi.hasil') : route('eksplorasi.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-lg shadow-primary-600/30 group">
                        {{ $isEksplorasiUpToDate ? 'Lihat Hasil Eksplorasi' : 'Lanjut ke Eksplorasi Karier' }}
                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        <!-- Global Modal -->
        <div x-show="openDetail" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                <div x-show="openDetail" @click="openDetail = false" x-transition.opacity class="fixed inset-0 bg-slate-900/75 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>

                <div x-show="openDetail" x-transition class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full relative z-[101]">
                    <div class="bg-white px-6 pt-6 pb-6">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-2xl leading-6 font-bold text-primary-900" id="modal-title" x-text="activeDetail.name"></h3>
                                <div class="mt-4 mb-2">
                                    <p class="text-sm text-slate-600 leading-relaxed text-justify" x-text="activeDetail.long_desc || 'Penjelasan tidak tersedia.'"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-6 py-4 flex flex-row-reverse border-t border-slate-100">
                        <button @click="openDetail = false" type="button" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-6 py-2 bg-primary-600 text-base font-semibold text-white hover:bg-primary-700 sm:ml-3 sm:w-auto sm:text-sm transition-colors cursor-pointer">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
