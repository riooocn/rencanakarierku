<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-primary-900 leading-tight">
            {{ __('Hasil Tes Minat (RIASEC)') }}
        </h2>
    </x-slot>

    @php
        $detailsData = [];
        if(isset($result) && is_array($result->top_results)) {
            foreach($result->top_results as $code) {
                $detailsData[$code] = \App\Helpers\AssessmentHelper::getMinatDetail($code);
            }
        }
    @endphp

    <script>
        window.minatDetailsData = {!! json_encode($detailsData) !!};
    </script>

    <div class="py-12 relative" x-data="{ openDetail: false, activeDetail: {} }">
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
                    @if(isset($result) && is_array($result->top_results))
                        @foreach($result->top_results as $index => $code)
                            @php
                                $detail = $detailsData[$code];
                            @endphp
                            
                            <div @click="activeDetail = window.minatDetailsData['{{ $code }}']; openDetail = true" 
                                 class="relative bg-{{ $index === 0 ? 'primary-50' : 'slate-50' }} rounded-2xl p-6 border border-{{ $index === 0 ? 'primary-100' : 'slate-100' }} flex flex-col items-center text-center group hover:bg-primary-600 transition-colors cursor-pointer">
                                @if($index === 0)
                                    <div class="absolute -top-4 bg-accent-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">Tertinggi</div>
                                @endif
                                <div class="w-16 h-16 bg-white {{ $index === 0 ? '' : 'shadow-sm' }} rounded-full flex items-center justify-center text-{{ $index === 0 ? 'primary-600' : 'slate-600' }} font-bold text-2xl mb-4 group-hover:text-primary-900">
                                    {{ $detail['letter'] }}
                                </div>
                                <h4 class="text-xl font-bold text-{{ $index === 0 ? 'primary-900' : 'slate-800' }} mb-2 group-hover:text-white">{{ $detail['name'] }}</h4>
                                <p class="text-sm text-slate-600 group-hover:text-primary-100">{{ $detail['desc'] }}</p>

                                <button class="mt-4 text-xs font-bold text-primary-600 group-hover:text-white underline hover:no-underline">
                                    Detail &gt;
                                </button>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-3 text-center text-slate-500">Hasil tidak ditemukan.</div>
                    @endif
                </div>

                <div class="flex justify-end items-center pt-6 border-t border-slate-100">
                    <a href="{{ route('asesmen.kapasitas') }}" class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-lg shadow-primary-600/30">
                        Lanjut Tes Kapasitas
                        <svg class="ml-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 sm:mx-0 sm:h-12 sm:w-12">
                                <span class="text-primary-600 font-bold text-2xl" x-text="activeDetail.letter"></span>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-2xl leading-6 font-bold text-primary-900" id="modal-title" x-text="activeDetail.name"></h3>
                                <div class="mt-4 mb-6">
                                    <p class="text-sm text-slate-600 leading-relaxed text-justify" x-text="activeDetail.long_desc || 'Penjelasan tidak tersedia.'"></p>
                                </div>
                                
                                <div class="mt-4 space-y-3">
                                    <h4 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-2">Rekomendasi Profesi:</h4>
                                    <div class="grid grid-cols-1 gap-3 max-h-60 overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-slate-200 scrollbar-track-transparent">
                                        <template x-if="activeDetail.jobs && activeDetail.jobs.length > 0">
                                            <template x-for="job in activeDetail.jobs" :key="job.name">
                                                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 text-left group hover:bg-primary-50 hover:border-primary-200 transition-all">
                                                    <p class="text-sm font-bold text-primary-800 mb-1" x-text="job.name"></p>
                                                    <p class="text-xs text-slate-600 leading-relaxed" x-text="job.desc"></p>
                                                </div>
                                            </template>
                                        </template>
                                        <template x-if="!activeDetail.jobs || activeDetail.jobs.length === 0">
                                            <p class="text-sm text-slate-500 italic">Data profesi tidak tersedia.</p>
                                        </template>
                                    </div>
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
