<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-primary-900 leading-tight">
            {{ __('Hasil Eksplorasi Karier') }}
        </h2>
    </x-slot>

    <div class="py-12 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <div class="bg-white rounded-3xl border border-slate-100 shadow-xl overflow-hidden">
                <!-- Header -->
                <div class="bg-primary-600 px-8 py-10 text-center text-white relative">
                    <div class="absolute inset-0 bg-gradient-to-b from-primary-700 to-primary-600 opacity-50"></div>
                    <div class="relative z-10">
                        <h3 class="text-3xl font-extrabold mb-4">Rangkuman Eksplorasi</h3>
                        <p class="text-primary-100 max-w-2xl mx-auto text-lg">Berikut adalah perbandingan dua bidang profesi yang telah kamu rancang.</p>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="p-0">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[800px]">
                            @php
                                $k1 = $eksplorasi->where('option', 1)->first();
                                $k2 = $eksplorasi->where('option', 2)->first();
                                
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
                            <thead>
                                <tr>
                                    <th class="w-1/4 p-6 bg-slate-50 border-b border-r border-slate-200 text-slate-500 font-semibold align-bottom">Aspek Eksplorasi</th>
                                    <th class="w-3/8 p-6 bg-blue-50/50 border-b border-r border-slate-200">
                                        <div class="text-center">
                                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold mb-3 uppercase tracking-wider">Karier Pilihan 1</span>
                                            <h4 class="text-2xl font-extrabold text-primary-800">{{ $k1 ? $k1->career_name : 'Karier 1' }}</h4>
                                        </div>
                                    </th>
                                    <th class="w-3/8 p-6 bg-purple-50/50 border-b border-slate-200">
                                        <div class="text-center">
                                            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-bold mb-3 uppercase tracking-wider">Karier Pilihan 2</span>
                                            <h4 class="text-2xl font-extrabold text-accent-800">{{ $k2 ? $k2->career_name : 'Karier 2' }}</h4>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($aspects as $aspect)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="p-6 border-r border-slate-200 text-slate-700 font-medium bg-slate-50/50">{{ $aspect['label'] }}</td>
                                    <td class="p-6 border-r border-slate-200 text-slate-800">{{ $k1 ? $k1->{$aspect['id']} : '-' }}</td>
                                    <td class="p-6 text-slate-800">{{ $k2 ? $k2->{$aspect['id']} : '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-8">
                @if(!$isKeputusanUpToDate)
                    <a href="{{ route('eksplorasi.index') }}" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-800 transition-colors px-4 py-2">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Edit Data Eksplorasi
                    </a>
                @else
                    <div></div>
                @endif
                
                <a href="{{ $isKeputusanUpToDate ? route('keputusan.winner', $latestKeputusan->id) : route('keputusan.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-lg shadow-primary-600/30 text-lg group">
                    {{ $isKeputusanUpToDate ? 'Lihat Hasil Keputusan' : 'Lanjut Tahap Pengambilan Keputusan' }}
                    <svg class="ml-3 w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

        </div>
    </div>

    <!-- Data rendered by Blade -->
</x-app-layout>