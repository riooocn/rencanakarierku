<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-primary-900 leading-tight">
            {{ __('Tahap 2: Eksplorasi Karier') }}
        </h2>
    </x-slot>

    <div class="py-12 relative" x-data="eksplorasiForm()">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <!-- Hero Section -->
            <div class="bg-primary-600 rounded-3xl p-10 mb-8 text-center text-white relative overflow-hidden shadow-xl">
                <div class="absolute inset-0 bg-gradient-to-r from-primary-700 to-primary-500 opacity-80"></div>
                
                <div class="relative z-10">
                    <h3 class="text-3xl font-extrabold mb-4">Rancang Eksplorasimu</h3>
                    <p class="text-primary-100 mb-8 max-w-2xl mx-auto">Gunakan hasil asesmenmu sebagai panduan. Jelajahi 2 (dua) bidang profesi untuk menemukan mana yang paling cocok dengan minat dan kapasitasmu.</p>
                </div>
            </div>

            <!-- Pengingat Asesmen -->
            <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm mb-8">
                <h4 class="font-bold text-slate-800 text-lg mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-accent-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    Pengingat Hasil Asesmen Minatmu
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 bg-blue-50 rounded-2xl border border-blue-100">
                        <h5 class="font-bold text-blue-900 mb-1">1. Investigative</h5>
                        <p class="text-sm text-blue-700">Senang menganalisis, meneliti, dan memecahkan masalah rumit.</p>
                    </div>
                    <div class="p-4 bg-purple-50 rounded-2xl border border-purple-100">
                        <h5 class="font-bold text-purple-900 mb-1">2. Artistic</h5>
                        <p class="text-sm text-purple-700">Senang mengekspresikan diri, berkreasi, dan merancang sesuatu.</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-2xl border border-green-100">
                        <h5 class="font-bold text-green-900 mb-1">3. Ideas (Kapasitas)</h5>
                        <p class="text-sm text-green-700">Unggul dalam menciptakan konsep, desain, dan inovasi baru.</p>
                    </div>
                </div>
            </div>

            <!-- Form Eksplorasi -->
            <form action="{{ route('eksplorasi.hasil') }}" method="GET" class="space-y-8">
                <!-- Input Nama Karier -->
                <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-lg">
                    <h4 class="font-bold text-slate-800 text-xl mb-6">Tentukan Profesi Pilihan</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-2">Pilihan Karier 1</label>
                            <input type="text" name="karier1" x-model="karier1" placeholder="Contoh: Software Engineer" required class="w-full rounded-xl border-slate-300 focus:ring-primary-500 focus:border-primary-500 py-3 px-4 bg-slate-50">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-2">Pilihan Karier 2</label>
                            <input type="text" name="karier2" x-model="karier2" placeholder="Contoh: Desainer UI/UX" required class="w-full rounded-xl border-slate-300 focus:ring-primary-500 focus:border-primary-500 py-3 px-4 bg-slate-50">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl border border-slate-100 shadow-lg overflow-hidden">
                    <div class="bg-slate-50 px-8 py-6 border-b border-slate-200">
                        <h4 class="font-bold text-slate-800 text-xl">Detail Eksplorasi</h4>
                        <p class="text-slate-500 text-sm mt-1">Isilah informasi berikut berdasarkan pencarianmu dari berbagai sumber valid.</p>
                    </div>
                    
                    <div class="p-6 md:p-0">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-0 md:divide-x divide-slate-100">
                            <div class="p-6 md:p-8 bg-blue-50/50 md:bg-blue-50/30 rounded-2xl md:rounded-none border border-blue-100 md:border-none">
                                <h5 class="text-lg font-bold text-primary-700 mb-6" x-text="karier1 || 'Karier 1'"></h5>
                                <div class="space-y-6" id="col-karier-1">
                                    <!-- Populated by JS for Karier 1 -->
                                </div>
                            </div>
                            <div class="p-6 md:p-8 bg-purple-50/50 md:bg-purple-50/30 rounded-2xl md:rounded-none border border-purple-100 md:border-none">
                                <h5 class="text-lg font-bold text-accent-700 mb-6" x-text="karier2 || 'Karier 2'"></h5>
                                <div class="space-y-6" id="col-karier-2">
                                    <!-- Populated by JS for Karier 2 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="inline-flex items-center justify-center px-8 py-4 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-lg shadow-primary-600/30 text-lg group">
                        Simpan & Lihat Rangkuman
                        <svg class="ml-2 w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script to Generate Form Fields -->
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("eksplorasiForm", () => ({
                karier1: "",
                karier2: ""
            }));
        });

        const questions = [
            { id: "pendidikan", label: "Pendidikan Tinggi Minimal", type: "select", options: ["Vokasi (D3/D4)", "Sarjana (S1)", "Lainnya"] },
            { id: "jurusan", label: "Jurusan yang paling sesuai", type: "text", placeholder: "Misal: Teknik Informatika" },
            { id: "matkul", label: "Mata kuliah yang perlu dilalui", type: "text", placeholder: "Misal: Algoritma, Basis Data" },
            { id: "keterampilan", label: "Keterampilan yang dikuasai", type: "text", placeholder: "Misal: Pemrograman, Logika" },
            { id: "pelatihan", label: "Pelatihan / Pendidikan lain", type: "text", placeholder: "Misal: Bootcamp Coding" },
            { id: "sertifikasi", label: "Sertifikasi yang diperlukan", type: "text", placeholder: "Misal: AWS Certified" },
            { id: "peluang", label: "Peluang di masa depan", type: "text", placeholder: "Sangat terbuka lebar..." },
            { id: "tugas", label: "Tugas & Tanggung jawab", type: "textarea", placeholder: "Membangun sistem..." },
            { id: "info_lain", label: "Informasi lain yang menarik", type: "textarea", placeholder: "Gaji cukup tinggi..." }
        ];

        function generateFields(prefix) {
            let html = "";
            questions.forEach(q => {
                html += `<div class="space-y-1.5">`;
                html += `<label class="block text-sm font-semibold text-slate-700">${q.label}</label>`;
                
                if (q.type === "select") {
                    html += `<select required name="${prefix}_${q.id}" class="w-full rounded-xl border-slate-300 focus:ring-primary-500 focus:border-primary-500 py-2.5 px-3 bg-white text-sm">`;
                    html += `<option value="">-- Pilih --</option>`;
                    q.options.forEach(opt => {
                        html += `<option value="${opt}">${opt}</option>`;
                    });
                    html += `</select>`;
                } else if (q.type === "textarea") {
                    html += `<textarea required name="${prefix}_${q.id}" rows="2" class="w-full rounded-xl border-slate-300 focus:ring-primary-500 focus:border-primary-500 py-2.5 px-3 bg-white text-sm" placeholder="${q.placeholder}"></textarea>`;
                } else {
                    html += `<input required type="text" name="${prefix}_${q.id}" class="w-full rounded-xl border-slate-300 focus:ring-primary-500 focus:border-primary-500 py-2.5 px-3 bg-white text-sm" placeholder="${q.placeholder}">`;
                }
                html += `</div>`;
            });
            return html;
        }

        document.getElementById('col-karier-1').innerHTML = generateFields('k1');
        document.getElementById('col-karier-2').innerHTML = generateFields('k2');
    </script>
</x-app-layout>