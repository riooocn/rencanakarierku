<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center gap-4">
                <a href="{{ route('perjalananku.index') }}" class="p-2 rounded-full hover:bg-primary-100 transition-colors">
                    <svg class="w-6 h-6 text-primary-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h2 class="font-bold text-2xl text-primary-900 leading-tight">
                    {{ __('Tahap 1 : Asesmen Diri') }}
                </h2>
            </div>
            <span class="text-sm font-medium bg-accent-100 text-accent-700 px-3 py-1 rounded-full shadow-sm border border-accent-200">
                Asesmen Kapasitas
            </span>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ step: 1, totalSteps: 5 }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-sm sm:rounded-3xl border border-white">
                <div class="p-8 text-neutral-dark">
                    <!-- Progress Bar -->
                    <div class="mb-8">
                        <div class="flex justify-between text-sm font-medium text-primary-600 mb-2">
                            <span>Progres Pengisian</span>
                            <span x-text="Math.round((step / totalSteps) * 100) + '%'"></span>
                        </div>
                        <div class="w-full bg-primary-100 rounded-full h-2.5">
                            <div class="bg-primary-500 h-2.5 rounded-full transition-all duration-300" :style="'width: ' + ((step / totalSteps) * 100) + '%'"></div>
                        </div>
                    </div>

                    <form action="{{ route('asesmen.kapasitas.store') }}" method="POST">
                        @csrf
                        
                        <!-- Pengantar Bagian 1: Keterampilan -->
                        <div x-show="step <= 4" class="mb-8 bg-primary-50 p-6 rounded-2xl border border-primary-100">
                            <h3 class="text-lg font-bold text-primary-900 mb-3">Bagian 1: Asesmen Keterampilan</h3>
                            <p class="text-sm text-gray-700 mb-3">
                                Kapasitas yang kamu miliki dapat dibagi menjadi empat bidang tugas (Prediger & Swaney, 2004):
                            </p>
                            <ul class="list-disc list-inside text-sm text-gray-700 space-y-1 mb-3">
                                <li><strong>People</strong>: kapasitas di pekerjaan yang mementingkan kemajuan orang lain/masyarakat.</li>
                                <li><strong>Data</strong>: kapasitas di pekerjaan yang berkaitan dengan angka, pemrosesan informasi, dan mengikuti prosedur.</li>
                                <li><strong>Things</strong>: kapasitas di pekerjaan yang berkaitan dengan perkakas, peralatan, dan mesin.</li>
                                <li><strong>Ideas</strong>: kapasitas yang berkaitan dengan konsep, tema, maupun penemuan-penemuan.</li>
                            </ul>
                            <p class="text-sm text-gray-700 font-medium">
                                Tandai keterampilan yang telah kamu miliki sekarang (dengan bukti nyata, seperti pengakuan, lomba, sertifikat).
                            </p>
                        </div>

                        <!-- Halaman 1 (Keterampilan) -->
                        <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="space-y-4">
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="1" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">1. Mengajar</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="2" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">2. Mengawasi orang lain</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="3" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">3. Merawat orang lain</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="4" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">4. Menerima atau melayani tamu</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="5" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">5. Memimpin rapat</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="6" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">6. Memimpin orang lain</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="7" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">7. Mendengarkan dan memberikan saran atau konsultasi</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="8" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">8. Menjual barang dan jasa</span>
                                </label>
                            </div>
                        </div>

                        <!-- Halaman 2 (Keterampilan) -->
                        <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="space-y-4">
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="9" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">9. Mencatat atau membuat rekap keuangan</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="10" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">10. Melakukan perhitungan statistik</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="11" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">11. Melakukan penelitian</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="12" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">12. Menguji coba produk atau ide</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="13" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">13. Menyelidiki permasalahan</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="14" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">14. Menyusun program komputer</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="15" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">15. Mengadakan percobaan ilmiah</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="16" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">16. Mengumpulkan informasi</span>
                                </label>
                            </div>
                        </div>

                        <!-- Halaman 3 (Keterampilan) -->
                        <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="space-y-4">
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="17" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">17. Memperbaiki barang</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="18" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">18. Mengoperasikan mesin atau peralatan</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="19" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">19. Menyusun rakitan</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="20" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">20. Menggunakan perkakas</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="21" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">21. Memasak atau membuat kue/roti</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="22" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">22. Menggunakan mesin jahit</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="23" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">23. Membuat barang dari kayu</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="24" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">24. Mendirikan bangunan</span>
                                </label>
                            </div>
                        </div>

                        <!-- Halaman 4 (Keterampilan) -->
                        <div x-show="step === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="space-y-4">
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="25" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">25. Menulis cerita atau puisi</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="26" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">26. Menciptakan lagu</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="27" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">27. Membuat desain produk baru</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="28" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">28. Menggambar</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="29" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">29. Menciptakan produk baru</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="30" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">30. Bermain peran atau menyanyi</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="31" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">31. Memainkan alat musik</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="keterampilan[]" value="32" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">32. Mengatur perkumpulan atau kegiatan baru</span>
                                </label>
                            </div>
                        </div>


                        <!-- Halaman 5 (Mata Pelajaran) -->
                        <div x-show="step === 5" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8 bg-accent-50 p-6 rounded-2xl border border-accent-100">
                                <h3 class="text-lg font-bold text-accent-700 mb-3">Bagian 2: Penguasaan Mata Pelajaran</h3>
                                <p class="text-sm text-gray-700 font-medium mb-3">
                                    Pilih tingkat penguasaanmu untuk masing-masing pelajaran di bawah ini:
                                </p>
                                <ul class="list-none text-sm text-gray-700 space-y-1">
                                    <li><strong>1</strong> = Sangat tidak menguasai (0%-20%)</li>
                                    <li><strong>2</strong> = Tidak menguasai (21%-40%)</li>
                                    <li><strong>3</strong> = Cukup menguasai (41%-60%)</li>
                                    <li><strong>4</strong> = Menguasai (61%-80%)</li>
                                    <li><strong>5</strong> = Sangat menguasai (81%-100%)</li>
                                </ul>
                            </div>
                            
                            <div class="space-y-6">
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">1. Pendidikan Agama dan Budi Pekerti</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[1]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[1]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[1]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[1]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[1]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">2. Pendidikan Pancasila dan Kewarganegaraan</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[2]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[2]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[2]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[2]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[2]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">3. Bahasa Indonesia</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[3]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[3]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[3]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[3]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[3]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">4. Matematika</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[4]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[4]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[4]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[4]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[4]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">5. Sejarah</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[5]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[5]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[5]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[5]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[5]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">6. Bahasa Inggris</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[6]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[6]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[6]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[6]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[6]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">7. Seni Budaya</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[7]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[7]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[7]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[7]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[7]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">8. Pendidikan Jasmani, Olahraga dan Kesehatan</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[8]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[8]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[8]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[8]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[8]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">9. Komputer</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[9]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[9]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[9]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[9]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[9]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">10. Bahasa Mandarin</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[10]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[10]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[10]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[10]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[10]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">11. Bahasa Daerah</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[11]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[11]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[11]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[11]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[11]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">12. Biologi</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[12]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[12]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[12]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[12]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[12]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">13. Fisika</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[13]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[13]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[13]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[13]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[13]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">14. Kimia</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[14]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[14]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[14]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[14]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[14]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">15. Ekonomi</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[15]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[15]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[15]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[15]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[15]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">16. Geografi</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[16]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[16]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[16]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[16]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[16]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-5 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-primary-200 transition-colors">
                                    <p class="font-semibold text-gray-800 mb-3">17. Sosiologi</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[17]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">1</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[17]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">2</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[17]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">3</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[17]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">4</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="mapel[17]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                            <span class="text-sm text-gray-600 group-hover:text-primary-600">5</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="mt-8 flex justify-between items-center border-t border-gray-100 pt-6">
                            <button type="button" 
                                    x-show="step > 1" 
                                    @click="step--" 
                                    class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all">
                                Sebelumnya
                            </button>
                            <div x-show="step === 1"></div>

                            <button type="button" 
                                    x-show="step < totalSteps" 
                                    @click="step++" 
                                    class="px-6 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all shadow-sm hover:-translate-y-0.5">
                                Selanjutnya
                            </button>

                            <button type="submit" 
                                    x-show="step === totalSteps" 
                                    class="px-6 py-2.5 bg-accent-500 text-white font-bold rounded-xl hover:bg-accent-600 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:ring-offset-2 transition-all shadow-sm hover:-translate-y-0.5" style="display: none;">
                                Selesai & Lihat Hasil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
