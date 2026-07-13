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
                Asesmen Minat
            </span>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ step: 1, totalSteps: 4 }">
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

                    <form action="{{ route('asesmen.minat.store') }}" method="POST">
                        @csrf
                        
                        <!-- Introduction Step (Step 0 if we wanted, but let's put it on top of step 1) -->
                        <div x-show="step === 1" class="mb-8 bg-primary-50 p-6 rounded-2xl border border-primary-100">
                            <h3 class="text-lg font-bold text-primary-900 mb-3">Pengantar Asesmen Minat (RIASEC)</h3>
                            <p class="text-sm text-gray-700 mb-3">
                                Tahukah kamu menurut Holland (1997 dalam Rounds, Hoff, & Lewis, 2021), terdapat 6 jenis minat pekerjaan, yaitu realistic, investigative, artistic, social, enterprising, dan conventional?
                            </p>
                            <ul class="list-disc list-inside text-sm text-gray-700 space-y-1 mb-3">
                                <li><strong>Realistic</strong>: senang bekerja dengan benda / alat dan terkadang senang bekerja di luar ruangan.</li>
                                <li><strong>Investigative</strong>: senang menganalisis dan menemukan solusi.</li>
                                <li><strong>Artistic</strong>: senang memikirkan ide kreatif dan menciptakan inovasi.</li>
                                <li><strong>Social</strong>: senang membantu dan menolong orang lain.</li>
                                <li><strong>Enterprising</strong>: senang memengaruhi orang lain dan memimpin.</li>
                                <li><strong>Conventional</strong>: senang mengatur segala sesuatu dan bekerja dengan data.</li>
                            </ul>
                            <p class="text-sm text-gray-700 font-medium">
                                Bacalah aktivitas-aktivitas di bawah ini. Tandai aktivitas-aktivitas yang menarik bagimu. Tidak ada jawaban benar maupun salah. Jangan mempertimbangkan pendidikan atau pelatihan yang dibutuhkan atau pun seberapa besar uang yang akan kamu hasilkan.
                            </p>
                        </div>

                        <!-- Halaman 1 -->
                        <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="space-y-4">
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="1" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">1. Aku suka mengulik peralatan</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="2" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">2. Aku suka mengerjakan puzzle</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="3" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">3. Aku suka bekerja mandiri</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="4" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">4. Aku suka bekerja dalam kelompok</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="5" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">5. Aku suka membuat target untuk diriku sendiri</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="6" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">6. Aku suka merapikan barang-barang (buku, alat tulis, kamar)</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="7" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">7. Aku suka menyusun balok/LEGO®</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="8" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">8. Aku suka membaca buku tentang seni dan musik</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="9" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">9. Aku suka mengerjakan hal-hal dengan instruksi yang jelas</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="10" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">10. Aku suka meyakinkan teman untuk mengikuti caraku</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="11" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">11. Aku suka melakukan percobaan/eksperimen</span>
                                </label>
                            </div>
                        </div>

                        <!-- Halaman 2 -->
                        <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="space-y-4">
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="12" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">12. Aku suka menjelaskan sesuatu kepada teman</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="13" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">13. Aku suka membantu orang lain memecahkan persoalan</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="14" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">14. Aku suka memelihara binatang</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="15" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">15. Aku tidak berkeberatan bekerja melebihi waktu yang ditentukan</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="16" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">16. Aku suka menjual sesuatu</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="17" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">17. Aku suka membuat karya berbentuk tulisan</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="18" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">18. Aku suka sains</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="19" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">19. Aku suka mendapatkan tantangan baru</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="20" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">20. Aku suka menghibur teman</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="21" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">21. Aku suka mencari tahu cara kerja sebuah alat</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="22" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">22. Aku suka merangkaikan atau merakit benda</span>
                                </label>
                            </div>
                        </div>

                        <!-- Halaman 3 -->
                        <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="space-y-4">
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="23" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">23. Aku adalah orang yang kreatif</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="24" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">24. Aku suka memperhatikan detail</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="25" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">25. Aku suka merapikan catatan atau LKS</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="26" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">26. Aku suka mencari tahu penyebab suatu kejadian</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="27" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">27. Aku suka memainkan alat musik atau bernyanyi</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="28" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">28. Aku suka mempelajari budaya berbagai daerah</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="29" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">29. Aku ingin membuka usaha sendiri suatu saat nanti</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="30" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">30. Aku suka memasak</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="31" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">31. Aku suka bermain peran/drama</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="32" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">32. Aku suka mempraktikkan hal-hal yang aku pelajari</span>
                                </label>
                            </div>
                        </div>

                        <!-- Halaman 4 -->
                        <div x-show="step === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="space-y-4">
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="33" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">33. Aku suka mengerjakan soal matematika atau grafik</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="34" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">34. Aku suka mendiskusikan hal-hal yang terjadi di sekitarku</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="35" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">35. Aku suka merapikan kamarku</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="36" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">36. Aku suka memimpin kelompok atau kelas</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="37" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">37. Aku suka berkegiatan di luar ruangan</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="38" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">38. Aku suka berkegiatan di dalam ruangan dengan meja-kursi</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="39" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">39. Aku suka menghitung</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="40" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">40. Aku suka menolong orang</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="41" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">41. Aku suka menggambar</span>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-primary-50 hover:border-primary-200 cursor-pointer transition-all">
                                    <input type="checkbox" name="minat[]" value="42" class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-3 text-gray-700">42. Aku suka berbicara di depan umum</span>
                                </label>
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
                            <div x-show="step === 1"></div> <!-- Spacer for flex-between -->

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
