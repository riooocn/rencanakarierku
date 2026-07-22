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
                Asesmen Nilai Karier
            </span>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ step: 0, totalSteps: 19 }">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-sm sm:rounded-3xl border border-white">
                <div class="p-8 text-neutral-dark">
                    <!-- Progress Bar (Only show if step > 0) -->
                    <div class="mb-8" x-show="step > 0" style="display: none;">
                        <div class="flex justify-between text-sm font-medium text-primary-600 mb-2">
                            <span>Soal <span x-text="step"></span> dari <span x-text="totalSteps"></span></span>
                            <span x-text="Math.round((step / totalSteps) * 100) + '%'"></span>
                        </div>
                        <div class="w-full bg-primary-100 rounded-full h-2.5">
                            <div class="bg-primary-500 h-2.5 rounded-full transition-all duration-300" :style="'width: ' + ((step / totalSteps) * 100) + '%'"></div>
                        </div>
                    </div>

                    <form action="{{ route('asesmen.nilaikarier.store') }}" method="POST">
                        @csrf
                        
                        <!-- Pengantar (Step 0) -->
                        <div x-show="step === 0" class="mb-8" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                            <div class="bg-primary-50 p-6 rounded-2xl border border-primary-100 mb-8">
                                <h3 class="text-lg font-bold text-primary-900 mb-3">Pengantar Asesmen Nilai Karier</h3>
                                <p class="text-sm text-gray-700 mb-3">
                                    Terdapat 5 kategori nilai karier yang akan diukur: <strong>Leisure, Extrinsic Rewards, Intrinsic Rewards, Altruistic Rewards, dan Social Rewards</strong>.
                                </p>
                                <p class="text-sm text-gray-700 font-medium mt-4 mb-4">
                                    Setelah menekan tombol "Mulai Asesmen", kamu akan diberikan beberapa pernyataan. Isilah kotak pilihan yang tersedia di setiap pernyataan dengan angka 1 sampai 5 berdasarkan pedoman skala berikut:
                                </p>
                                <div class="flex flex-col gap-3">
                                    <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm"><span class="font-bold text-primary-600">1</span> = Sangat tidak penting</div>
                                    <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm"><span class="font-bold text-primary-600">2</span> = Tidak penting</div>
                                    <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm"><span class="font-bold text-primary-600">3</span> = Ragu-ragu</div>
                                    <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm"><span class="font-bold text-primary-600">4</span> = Penting</div>
                                    <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm"><span class="font-bold text-primary-600">5</span> = Sangat penting</div>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <button type="button" @click="step = 1" class="px-8 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all shadow-sm hover:-translate-y-0.5 text-lg">
                                    Mulai Asesmen
                                </button>
                            </div>
                        </div>

                        <!-- Soal 1 -->
                        <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan yang memberikan kesempatan berlibur"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[1]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[1]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[1]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[1]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[1]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 2 -->
                        <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan yang menyisakan banyak waktu untuk melakukan berbagai hal lain dalam hidup"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[2]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[2]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[2]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[2]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[2]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 3 -->
                        <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan dengan irama santai, tidak terburu-buru"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[3]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[3]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[3]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[3]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[3]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 4 -->
                        <div x-show="step === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan yang cukup bebas dari pengawasan orang lain"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[4]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[4]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[4]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[4]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[4]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 5 -->
                        <div x-show="step === 5" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan yang berisi tugas-tugas menarik"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[5]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[5]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[5]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[5]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[5]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 6 -->
                        <div x-show="step === 6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan yang membuka kesempatan untuk belajar hal baru maupun keterampilan baru"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[6]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[6]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[6]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[6]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[6]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 7 -->
                        <div x-show="step === 7" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan di mana keterampilan yang dimiliki tidak akan pernah usang"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[7]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[7]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[7]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[7]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[7]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 8 -->
                        <div x-show="step === 8" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan di mana apa yang kita kerjakan hasil akhirnya dapat dilihat"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[8]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[8]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[8]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[8]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[8]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 9 -->
                        <div x-show="step === 9" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan yang memanfaatkan keterampilan dan kemampuan diri"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[9]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[9]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[9]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[9]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[9]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 10 -->
                        <div x-show="step === 10" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan dimana bisa menampilkan diri apa adanya"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[10]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[10]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[10]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[10]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[10]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 11 -->
                        <div x-show="step === 11" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan yang memberi kesempatan untuk kreatif"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[11]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[11]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[11]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[11]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[11]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 12 -->
                        <div x-show="step === 12" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan yang memberi kesempatan untuk menolong orang lain secara langsung"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[12]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[12]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[12]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[12]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[12]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 13 -->
                        <div x-show="step === 13" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan yang memberi manfaat bagi masyarakat"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[13]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[13]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[13]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[13]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[13]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 14 -->
                        <div x-show="step === 14" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan yang memberi kesempatan untuk menjalin pertemanan"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[14]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[14]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[14]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[14]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[14]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 15 -->
                        <div x-show="step === 15" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan yang memungkinkan untuk berelasi dengan banyak orang"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[15]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[15]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[15]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[15]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[15]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 16 -->
                        <div x-show="step === 16" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan dengan status sosial tinggi dan berprestise"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[16]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[16]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[16]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[16]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[16]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 17 -->
                        <div x-show="step === 17" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan yang dihormati oleh orang lain"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[17]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[17]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[17]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[17]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[17]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 18 -->
                        <div x-show="step === 18" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan yang memberikan kesempatan untuk menghasilkan banyak uang"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[18]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[18]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[18]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[18]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[18]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Soal 19 -->
                        <div x-show="step === 19" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-primary-900 mb-6 text-center leading-relaxed">
                                    "Pekerjaan yang memberikan peluang bagus untuk pengembangan karir dan promosi"
                                </h3>
                                <div class="flex flex-col gap-3 max-w-md mx-auto">
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[19]" value="1" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">1 - Sangat tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[19]" value="2" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">2 - Tidak penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[19]" value="3" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">3 - Ragu-ragu</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[19]" value="4" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">4 - Penting</span>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all group">
                                        <input type="radio" name="nilaikarier[19]" value="5" class="text-primary-600 focus:ring-primary-500 w-5 h-5">
                                        <span class="ml-3 font-medium text-gray-700 group-hover:text-primary-700">5 - Sangat penting</span>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <!-- Navigation Buttons (Only show if step > 0) -->
                        <div x-show="step > 0" class="mt-8 flex justify-between items-center border-t border-gray-100 pt-6" style="display: none;">
                            <button type="button" 
                                    @click="step--" 
                                    class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all">
                                Sebelumnya
                            </button>

                            <button type="button" 
                                    x-show="step < totalSteps" 
                                    @click="document.querySelector('input[name=\'nilaikarier[' + step + ']\']:checked') ? step++ : alert('Silahkan pilih jawaban terlebih dahulu.')" 
                                    class="px-6 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all shadow-sm hover:-translate-y-0.5">
                                Selanjutnya
                            </button>

                            <button type="submit" 
                                    x-show="step === totalSteps"
                                    @click.prevent="document.querySelector('input[name=\'nilaikarier[' + step + ']\']:checked') ? $el.closest('form').submit() : alert('Silahkan pilih jawaban terlebih dahulu.')"
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
