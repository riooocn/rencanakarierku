<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-primary-900 leading-tight">
            {{ __('Tahap 3: Keputusan Akhir') }}
        </h2>
    </x-slot>

    <div class="py-12 relative" x-data="keputusanApp()">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <!-- Hero Section -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-xl overflow-hidden mb-12" x-show="!showResult">
                <div class="bg-primary-600 px-8 py-10 text-center text-white relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-700 to-primary-500 opacity-80"></div>
                    <div class="relative z-10">
                        <h3 class="text-3xl font-extrabold mb-4">Evaluasi & Pengambilan Keputusan</h3>
                        <p class="text-primary-100 max-w-3xl mx-auto text-lg">
                            Bandingkan kedua pilihan kariermu dengan minat, kapasitas, dan nilai yang kamu miliki. 
                            Jawab 7 pertanyaan di bawah dengan menekan sel tabel yang paling sesuai, atau pilih "Lewati".
                        </p>
                    </div>
                </div>

                <div class="p-8 bg-slate-50 border-b border-slate-200">
                    @php
                        $k1 = isset($eksplorasi) ? $eksplorasi->where('option', 1)->first() : null;
                        $k2 = isset($eksplorasi) ? $eksplorasi->where('option', 2)->first() : null;
                        
                        $aspects = [
                            ['id' => 'pendidikan', 'label' => 'Pendidikan Tinggi Minimal'],
                            ['id' => 'jurusan', 'label' => 'Jurusan yang paling sesuai'],
                            ['id' => 'matkul', 'label' => 'Mata kuliah yang perlu dilalui'],
                            ['id' => 'keterampilan', 'label' => 'Keterampilan yang perlu dikuasai'],
                            ['id' => 'pelatihan', 'label' => 'Pelatihan formal/pendidikan lain'],
                            ['id' => 'sertifikasi', 'label' => 'Sertifikasi yang perlu diambil'],
                            ['id' => 'peluang', 'label' => 'Peluang di masa depan'],
                            ['id' => 'tugas', 'label' => 'Tugas & Tanggung jawab'],
                            ['id' => 'info_lain', 'label' => 'Informasi lain yang menarik']
                        ];
                    @endphp
                    <h4 class="font-bold text-slate-800 text-xl mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-accent-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                        Ringkasan Diriku (Berdasarkan Asesmen)
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white p-5 rounded-2xl border border-blue-100 shadow-sm">
                            <h5 class="font-bold text-blue-900 mb-3 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-blue-500"></span> 3 Minat Teratas</h5>
                            <ul class="text-sm space-y-2">
                                @if(isset($minat) && is_array($minat->top_results))
                                    @foreach($minat->top_results as $code)
                                        @php $minatDetail = \App\Helpers\AssessmentHelper::getMinatDetail($code); @endphp
                                        <li @click="showDetail(`{{ $minatDetail['name'] }}`, `{{ addslashes($minatDetail['long_desc']) }}`)" class="cursor-pointer group flex items-center justify-between p-2 rounded-lg bg-slate-50 border border-slate-100 hover:bg-blue-50 hover:border-blue-200 transition-colors">
                                            <span class="font-medium text-slate-700 group-hover:text-blue-700">{{ $minatDetail['name'] }}</span>
                                            <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        </li>
                                    @endforeach
                                @else
                                    <li>Belum ada data</li>
                                @endif
                            </ul>
                        </div>
                        <div class="bg-white p-5 rounded-2xl border border-green-100 shadow-sm">
                            <h5 class="font-bold text-green-900 mb-3 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-green-500"></span> Kapasitas Utama</h5>
                            <ul class="text-sm space-y-2">
                                @if(isset($kapasitas) && isset($kapasitas->top_results['keterampilan']))
                                    @foreach($kapasitas->top_results['keterampilan'] as $code)
                                        @php $capDetail = \App\Helpers\AssessmentHelper::getKapasitas1Detail($code); @endphp
                                        <li @click="showDetail(`{{ $capDetail['name'] }}`, `{{ addslashes($capDetail['desc']) }}`)" class="cursor-pointer group flex items-center justify-between p-2 rounded-lg bg-slate-50 border border-slate-100 hover:bg-green-50 hover:border-green-200 transition-colors">
                                            <span class="font-medium text-slate-700 group-hover:text-green-700">{{ $capDetail['name'] }}</span>
                                            <svg class="w-4 h-4 text-slate-400 group-hover:text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        </li>
                                    @endforeach
                                @else
                                    <li>Belum ada data</li>
                                @endif
                            </ul>
                        </div>
                        <div class="bg-white p-5 rounded-2xl border border-purple-100 shadow-sm">
                            <h5 class="font-bold text-purple-900 mb-3 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-purple-500"></span> Nilai Karier</h5>
                            <ul class="text-sm space-y-2">
                                @if(isset($nilaiKarier) && is_array($nilaiKarier->top_results))
                                    @foreach($nilaiKarier->top_results as $code)
                                        @php $nkDetail = \App\Helpers\AssessmentHelper::getNilaiKarierDetail($code); @endphp
                                        <li @click="showDetail(`{{ $nkDetail['name'] }}`, `{{ addslashes($nkDetail['long_desc']) }}`)" class="cursor-pointer group flex items-center justify-between p-2 rounded-lg bg-slate-50 border border-slate-100 hover:bg-purple-50 hover:border-purple-200 transition-colors">
                                            <span class="font-medium text-slate-700 group-hover:text-purple-700">{{ $nkDetail['name'] }}</span>
                                            <svg class="w-4 h-4 text-slate-400 group-hover:text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        </li>
                                    @endforeach
                                @else
                                    <li>Belum ada data</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <!-- The Interactive Question Box -->
                    <div class="bg-accent-50 border border-accent-200 p-6 rounded-2xl mb-8 relative shadow-inner">
                        <div class="absolute -top-3 left-6 bg-accent-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                            Pertanyaan <span x-text="step + 1"></span> dari 7
                        </div>
                        <h4 class="text-xl font-bold text-accent-900 mt-2 mb-4" x-text="questions[step].text"></h4>
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <p class="text-sm text-accent-700 font-medium">Pilih (klik) salah satu jawaban di tabel bawah, atau:</p>
                            <div class="flex flex-wrap gap-2 w-full md:w-auto">
                                <button x-show="step > 0" @click="step--" class="flex-1 sm:flex-none justify-center px-4 py-2 bg-white border border-slate-300 text-slate-600 font-semibold rounded-lg hover:bg-slate-50 transition-colors shadow-sm text-sm whitespace-nowrap">
                                    &larr; Kembali
                                </button>
                                <button @click="answer('skip')" class="flex-1 sm:flex-none justify-center px-4 py-2 bg-white border border-slate-300 text-slate-600 font-semibold rounded-lg hover:bg-slate-50 transition-colors shadow-sm text-sm whitespace-nowrap">
                                    Lewati Pertanyaan Ini
                                </button>
                                <button x-show="step === questions.length - 1" @click="finish()" class="flex-1 sm:flex-none justify-center px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition-colors shadow-sm text-sm whitespace-nowrap">
                                    Selesai & Lihat Hasil
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- The Interactive Table -->
                    <div class="overflow-x-auto relative">
                        <table class="w-full text-left border-collapse min-w-[800px] border border-slate-200 rounded-xl hidden md:table">
                            <thead>
                                <tr>
                                    <th class="w-1/4 p-4 bg-slate-100 border-b border-r border-slate-200 text-slate-700 font-bold align-bottom">Aspek Eksplorasi</th>
                                    <th class="w-3/8 p-4 bg-blue-50 border-b border-r border-blue-100 text-center">
                                        <span class="text-xs font-bold text-blue-600 uppercase tracking-wider block mb-1">Profesi Pilihan 1</span>
                                        <span class="text-xl font-extrabold text-primary-900">{{ $k1 ? $k1->career_name : 'Profesi Pilihan 1' }}</span>
                                    </th>
                                    <th class="w-3/8 p-4 bg-purple-50 border-b border-purple-100 text-center">
                                        <span class="text-xs font-bold text-purple-600 uppercase tracking-wider block mb-1">Profesi Pilihan 2</span>
                                        <span class="text-xl font-extrabold text-accent-900">{{ $k2 ? $k2->career_name : 'Profesi Pilihan 2' }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <template x-for="(row, index) in tableData" :key="index">
                                    <tr :class="{ 'bg-yellow-50 ring-2 ring-yellow-400 ring-inset shadow-lg z-10 relative': questions[step].targetRow === index, 'opacity-40': questions[step].targetRow !== index && questions[step].targetRow !== -1 }">
                                        <td class="p-4 border-r border-slate-200 font-medium text-slate-700 bg-slate-50" x-text="row.label"></td>
                                        
                                        <!-- Cell Karier 1 -->
                                        <td @click="if(questions[step].targetRow === index) answer(1)" 
                                            :class="{'cursor-pointer hover:bg-blue-100': questions[step].targetRow === index, 'bg-blue-500 text-white font-bold': selections[index] === 1}"
                                            class="p-4 border-r border-slate-200 text-slate-800 transition-colors relative">
                                            <span x-text="row.k1"></span>
                                            <div x-show="selections[index] === 1" class="absolute top-2 right-2 w-6 h-6 bg-white text-blue-500 rounded-full flex items-center justify-center shadow-md">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                            </div>
                                        </td>

                                        <!-- Cell Karier 2 -->
                                        <td @click="if(questions[step].targetRow === index) answer(2)" 
                                            :class="{'cursor-pointer hover:bg-purple-100': questions[step].targetRow === index, 'bg-purple-500 text-white font-bold': selections[index] === 2}"
                                            class="p-4 text-slate-800 transition-colors relative">
                                            <span x-text="row.k2"></span>
                                            <div x-show="selections[index] === 2" class="absolute top-2 right-2 w-6 h-6 bg-white text-purple-500 rounded-full flex items-center justify-center shadow-md">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        
                        <div class="md:hidden p-4 bg-red-50 text-red-700 rounded-xl border border-red-200 text-center font-medium">
                            Mohon gunakan perangkat desktop/tablet atau putar layar (landscape) untuk menggunakan fitur ini secara optimal.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Result Section -->
            <div x-show="showResult" class="bg-white rounded-3xl border border-slate-100 shadow-2xl p-10 text-center" style="display: none;">
                <div class="w-24 h-24 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner">
                    <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-4xl font-extrabold text-primary-900 mb-4">Selamat! Kamu Telah Memilih</h3>
                <p class="text-lg text-slate-600 mb-8">Berdasarkan perbandingan yang kamu lakukan, pekerjaan yang paling banyak sesuai dengan diriku adalah:</p>
                
                <div class="inline-block bg-gradient-to-r from-primary-600 to-accent-600 p-1 rounded-2xl mb-12 shadow-xl">
                    <div class="bg-white px-12 py-6 rounded-xl">
                        <h2 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-primary-700 to-accent-600" x-text="winner"></h2>
                    </div>
                </div>

                <div class="flex justify-center gap-4">
                    <form id="keputusanForm" action="{{ route('keputusan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="winner" x-model="winner">
                        <!-- We can also send the selections array as JSON if needed -->
                        <button type="submit" class="inline-flex items-center justify-center w-full sm:w-auto px-8 py-4 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-lg shadow-primary-600/30 text-lg group">
                            Simpan & Lihat Rangkuman
                            <svg class="ml-2 w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </form>
                </div>
                </div>
            </div>

            <!-- Global Detail Modal -->
            <div x-show="detailModalOpen" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                    <div x-show="detailModalOpen" @click="detailModalOpen = false" x-transition.opacity class="fixed inset-0 bg-slate-900/75 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>

                    <div x-show="detailModalOpen" x-transition class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full relative z-[101]">
                        <div class="bg-white px-6 pt-6 pb-6">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-2xl leading-6 font-bold text-primary-900" id="modal-title" x-text="activeDetail.title"></h3>
                                    <div class="mt-4 mb-2">
                                        <p class="text-sm text-slate-600 leading-relaxed text-justify" x-text="activeDetail.desc"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-6 py-4 flex flex-row-reverse border-t border-slate-100">
                            <button @click="detailModalOpen = false" type="button" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-6 py-2 bg-primary-600 text-base font-semibold text-white hover:bg-primary-700 sm:ml-3 sm:w-auto sm:text-sm transition-colors cursor-pointer">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("keputusanApp", () => ({
                step: 0,
                showResult: false,
                winner: "",
                scores: { 1: 0, 2: 0 },
                selections: {}, // Maps rowIndex -> 1 or 2
                detailModalOpen: false,
                activeDetail: { title: '', desc: '' },
                
                showDetail(title, desc) {
                    this.activeDetail = { title, desc };
                    this.detailModalOpen = true;
                },
                
                tableData: [
                    @foreach($aspects as $aspect)
                    { 
                        label: {!! json_encode($aspect['label']) !!}, 
                        k1: {!! json_encode($k1 ? $k1->{$aspect['id']} : '-') !!}, 
                        k2: {!! json_encode($k2 ? $k2->{$aspect['id']} : '-') !!} 
                    },
                    @endforeach
                ],

                questions: [
                    { text: "Bandingkan antara mata pelajaran yang kamu kuasai dengan mata kuliah. Apakah mata kuliah di dalamnya sesuai dengan kapasitasmu?", targetRow: 2 },
                    { text: "Bandingkan antara bidang kapasitas dengan keterampilan yang perlu dikuasai. Tandai keterampilan yang sesuai dengan kapasitasmu.", targetRow: 3 },
                    { text: "Bandingkan kapasitasmu dengan pelatihan formal/pendidikan lanjut. Apakah pelatihan tersebut sesuai dengan kapasitasmu?", targetRow: 4 },
                    { text: "Bandingkan kapasitasmu dengan sertifikasi yang perlu diambil. Apakah sertifikasi tersebut sesuai dengan kapasitasmu?", targetRow: 5 },
                    { text: "Bandingkan antara nilai kariermu dengan peluang kariernya. Apakah peluang tersebut sesuai dengan nilai kariermu?", targetRow: 6 },
                    { text: "Bandingkan minat, kapasitas, atau nilai kariermu dengan tugas/tanggung jawab karier. Apakah tugas tersebut sesuai dengan dirimu?", targetRow: 7 },
                    { text: "Bandingkan minat, kapasitas, atau nilai kariermu dengan informasi lain dari karier tersebut. Apakah informasi tersebut sesuai dengan dirimu?", targetRow: 8 }
                ],

                answer(choice) {
                    if (choice === 1 || choice === 2) {
                        this.scores[choice]++;
                        this.selections[this.questions[this.step].targetRow] = choice;
                    }
                    
                    if (this.step < this.questions.length - 1) {
                        this.step++;
                    }
                },

                finish() {
                    let c1 = {!! json_encode($k1 ? $k1->career_name : 'Profesi Pilihan 1') !!};
                    let c2 = {!! json_encode($k2 ? $k2->career_name : 'Profesi Pilihan 2') !!};

                    if (this.scores[1] > this.scores[2]) {
                        this.winner = c1;
                    } else if (this.scores[2] > this.scores[1]) {
                        this.winner = c2;
                    } else {
                        this.winner = c1 + " & " + c2 + " (Seimbang)";
                    }
                    this.showResult = true;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            }));
        });
    </script>
</x-app-layout>