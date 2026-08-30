<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-primary-900 leading-tight">
            {{ __('Hasil Akhir Perjalanan Karierku') }}
        </h2>
    </x-slot>

    <style>
        @media print {
            * {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            @page {
                size: auto;
                margin: 15mm;
            }
            body {
                background: white !important;
            }
        }
    </style>

    <div class="py-12 relative">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-2xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden print:overflow-visible print:shadow-none print:border-none">
                
                <!-- Print Button and Back Link -->
                <div class="flex flex-col-reverse sm:flex-row justify-between items-center mb-8 gap-4 print:hidden">
                    <a href="{{ route('hasilkeputusan') }}" class="flex items-center gap-2 px-4 py-2 text-primary-600 font-medium hover:bg-primary-50 rounded-lg transition-colors w-full sm:w-auto justify-center">
                        &larr; Kembali ke Riwayat
                    </a>
                    <button class="flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 font-medium rounded-lg hover:bg-slate-200 transition-colors w-full sm:w-auto justify-center" onclick="window.print()">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Cetak PDF
                    </button>
                </div>

                <!-- Header Document -->
                <div class="text-center mb-12 border-b border-slate-100 pb-8 flex flex-col items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo RencanaKarierku" class="w-20 h-20 object-contain mb-4">
                    <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Dokumen Perencanaan Karier</h1>
                    <p class="text-slate-500">Diterbitkan oleh Sistem Rencana Karierku</p>
                </div>

                <!-- 1. Identitas -->
                <div class="mb-10">
                    <h3 class="text-xl font-bold text-primary-900 mb-4 flex items-center border-b border-slate-200 pb-2">
                        <span class="bg-primary-600 text-white w-6 h-6 rounded-full inline-flex items-center justify-center text-sm mr-2">1</span>
                        Profil Peserta
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-700">
                        <div class="flex items-start"><span class="font-semibold w-32 shrink-0">Nama:</span> <span class="break-words min-w-0">{{ Auth::user()->name }}</span></div>
                        <div class="flex items-start"><span class="font-semibold w-32 shrink-0">Asal Sekolah:</span> <span class="break-words min-w-0">{{ Auth::user()->institution->name ?? '-' }}</span></div>
                        <div class="flex items-start"><span class="font-semibold w-32 shrink-0">Kelas:</span> <span>{{ Auth::user()->grade ? (is_numeric(Auth::user()->grade) ? 'Kelas ' . Auth::user()->grade : Auth::user()->grade) : '-' }}</span></div>
                        <div class="flex items-start"><span class="font-semibold w-32 shrink-0">Email:</span> <span class="break-words min-w-0">{{ Auth::user()->email }}</span></div>
                        <div class="flex items-start"><span class="font-semibold w-32 shrink-0">Tanggal Lahir:</span> <span>{{ Auth::user()->tanggal_lahir ? \Carbon\Carbon::parse(Auth::user()->tanggal_lahir)->format('d M Y') : '-' }}</span></div>
                        <div class="flex items-start"><span class="font-semibold w-32 shrink-0">Jenis Kelamin:</span> <span>{{ Auth::user()->jenis_kelamin ?? '-' }}</span></div>
                    </div>
                </div>

                <!-- 2. Keputusan Final -->
                <div class="mb-10">
                    <h3 class="text-xl font-bold text-primary-900 mb-4 flex items-center border-b border-slate-200 pb-2">
                        <span class="bg-primary-600 text-white w-6 h-6 rounded-full inline-flex items-center justify-center text-sm mr-2">2</span>
                        Keputusan Karier Masa Depan
                    </h3>
                    
                    <div class="bg-gradient-to-r from-primary-50 to-white p-8 rounded-2xl border-l-4 border-primary-600 shadow-sm">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 font-medium mb-1">Profesi Terpilih:</p>
                                <h4 class="text-3xl font-extrabold text-slate-900 mb-3">{{ $keputusan->final_choice ?? 'Belum memilih' }}</h4>
                                <p class="text-slate-700 leading-relaxed italic">"Pilihan profesi ini disimpulkan pada akhir sesi perjalanan karier berdasarkan seluruh rangkaian asesmen dan eksplorasi yang telah dilakukan."</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Hasil Asesmen -->
                <div class="mb-10">
                    <h3 class="text-xl font-bold text-primary-900 mb-4 flex items-center border-b border-slate-200 pb-2">
                        <span class="bg-primary-600 text-white w-6 h-6 rounded-full inline-flex items-center justify-center text-sm mr-2">3</span>
                        Ringkasan Asesmen Diri
                    </h3>
                    
                    <div class="space-y-6">
                        <!-- Minat (RIASEC) -->
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <h4 class="font-bold text-slate-800 mb-4 text-lg">Minat (RIASEC)</h4>
                            <div class="space-y-5">
                                @if(isset($minat) && is_array($minat->top_results))
                                    @foreach($minat->top_results as $code)
                                        @php $minatDetail = \App\Helpers\AssessmentHelper::getMinatDetail($code); @endphp
                                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm break-inside-avoid">
                                            <h5 class="font-bold text-primary-700 text-lg mb-2">{{ $minatDetail['name'] }}</h5>
                                            <p class="text-sm text-slate-600 mb-4">{{ $minatDetail['long_desc'] }}</p>
                                            
                                            <h6 class="font-semibold text-slate-700 text-xs uppercase tracking-wider mb-3">Rekomendasi Pekerjaan:</h6>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                                @foreach($minatDetail['jobs'] as $job)
                                                    <div class="bg-slate-50 p-4 rounded-lg border border-slate-100 h-full">
                                                        <strong class="text-sm text-slate-800 block mb-1">{{ $job['name'] }}</strong>
                                                        <span class="text-xs text-slate-500 line-clamp-3" title="{{ $job['desc'] }}">{{ $job['desc'] }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-slate-500">Data tidak tersedia</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 print:block print:space-y-6">
                            <!-- Kapasitas Dominan -->
                            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                                <h4 class="font-bold text-slate-800 mb-4 text-lg">Kapasitas Dominan</h4>
                                <ul class="space-y-3">
                                    @if(isset($kapasitas) && isset($kapasitas->top_results['keterampilan']))
                                        @foreach($kapasitas->top_results['keterampilan'] as $code)
                                            @php $capDetail = \App\Helpers\AssessmentHelper::getKapasitas1Detail($code); @endphp
                                            <li class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm break-inside-avoid">
                                                <strong class="text-slate-800 block text-base">{{ $capDetail['name'] }}</strong>
                                                <span class="text-sm text-slate-600">{{ $capDetail['desc'] }}</span>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="text-slate-500">Data tidak tersedia</li>
                                    @endif
                                </ul>
                            </div>

                            <!-- Nilai Karier Utama -->
                            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                                <h4 class="font-bold text-slate-800 mb-4 text-lg">Nilai Karier Utama</h4>
                                <ul class="space-y-3">
                                    @if(isset($nilaiKarier) && is_array($nilaiKarier->top_results))
                                        @foreach($nilaiKarier->top_results as $code)
                                            @php $nkDetail = \App\Helpers\AssessmentHelper::getNilaiKarierDetail($code); @endphp
                                            <li class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm break-inside-avoid">
                                                <strong class="text-slate-800 block text-base">{{ $nkDetail['name'] }}</strong>
                                                <span class="text-sm text-slate-600">{{ $nkDetail['desc'] }}</span>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="text-slate-500">Data tidak tersedia</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center pt-8 border-t border-slate-100 flex flex-col items-center gap-4">
                    <p class="text-slate-500 font-medium italic">"Masa depanmu diciptakan oleh apa yang kamu lakukan hari ini, bukan besok."</p>
                    <a href="{{ route('hasilkeputusan') }}" class="inline-flex items-center justify-center px-6 py-3 bg-primary-100 text-primary-700 font-bold rounded-xl hover:bg-primary-200 transition-colors shadow-sm print:hidden">
                        Lihat Semua Riwayat Perjalanan
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
