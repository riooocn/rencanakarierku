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
                            <thead>
                                <tr>
                                    <th class="w-1/4 p-6 bg-slate-50 border-b border-r border-slate-200 text-slate-500 font-semibold align-bottom">Aspek Eksplorasi</th>
                                    <th class="w-3/8 p-6 bg-blue-50/50 border-b border-r border-slate-200">
                                        <div class="text-center">
                                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold mb-3 uppercase tracking-wider">Karier Pilihan 1</span>
                                            <h4 class="text-2xl font-extrabold text-primary-800">Software Engineer</h4>
                                        </div>
                                    </th>
                                    <th class="w-3/8 p-6 bg-purple-50/50 border-b border-slate-200">
                                        <div class="text-center">
                                            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-bold mb-3 uppercase tracking-wider">Karier Pilihan 2</span>
                                            <h4 class="text-2xl font-extrabold text-accent-800">Desainer UI/UX</h4>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100" id="comparison-body">
                                <!-- Populated by JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-8">
                <a href="{{ route('eksplorasi.index') }}" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-800 transition-colors px-4 py-2">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Edit Data Eksplorasi
                </a>
                
                <a href="{{ route('keputusan.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-lg shadow-primary-600/30 text-lg group">
                    Lanjut Tahap Pengambilan Keputusan
                    <svg class="ml-2 w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

        </div>
    </div>

    <script>
        // Mock data to demonstrate the table layout based on the submitted form
        const urlParams = new URLSearchParams(window.location.search);
        
        // If data exists in URL, use it, else use mock data
        const karier1Name = urlParams.get('karier1') || 'Software Engineer';
        const karier2Name = urlParams.get('karier2') || 'Desainer UI/UX';

        const aspects = [
            { id: "pendidikan", label: "Pendidikan Tinggi Minimal" },
            { id: "jurusan", label: "Jurusan yang paling sesuai" },
            { id: "matkul", label: "Mata kuliah yang perlu dilalui" },
            { id: "keterampilan", label: "Keterampilan yang perlu dikuasai" },
            { id: "pelatihan", label: "Pelatihan formal/pendidikan lain" },
            { id: "sertifikasi", label: "Sertifikasi yang perlu diambil" },
            { id: "peluang", label: "Peluang di masa depan" },
            { id: "tugas", label: "Tugas & Tanggung jawab" },
            { id: "info_lain", label: "Informasi lain yang menarik" }
        ];

        const dummyK1 = [
            "Sarjana (S1)", "Teknik Informatika", "Algoritma, Basis Data, Struktur Data", 
            "Pemrograman, Logika Matematika", "Bootcamp Web Development", 
            "AWS Certified Developer, Google Cloud Engineer", "Sangat terbuka karena semua sektor butuh digitalisasi",
            "Membangun sistem dan aplikasi", "Bisa bekerja remote dari mana saja (WFH)"
        ];

        const dummyK2 = [
            "Sarjana (S1)", "Desain Komunikasi Visual / Sistem Informasi", "Desain Interaksi, Psikologi Pengguna", 
            "Figma, Wireframing, Pemahaman UX", "Kursus UI/UX Design", 
            "Google UX Design Certificate", "Sangat baik seiring berkembangnya startup digital",
            "Membuat antarmuka yang ramah pengguna", "Sangat menghargai kreativitas"
        ];

        let tbody = '';
        aspects.forEach((aspect, index) => {
            const v1 = urlParams.get('k1_' + aspect.id) || dummyK1[index];
            const v2 = urlParams.get('k2_' + aspect.id) || dummyK2[index];
            
            tbody += `
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="p-6 border-r border-slate-200 text-slate-700 font-medium bg-slate-50/50">${aspect.label}</td>
                    <td class="p-6 border-r border-slate-200 text-slate-800">${v1}</td>
                    <td class="p-6 text-slate-800">${v2}</td>
                </tr>
            `;
        });
        
        document.getElementById('comparison-body').innerHTML = tbody;

        // Update headers if custom names provided
        if (urlParams.has('karier1')) {
            const h4s = document.querySelectorAll('thead h4');
            h4s[0].textContent = karier1Name;
            h4s[1].textContent = karier2Name;
        }
    </script>
</x-app-layout>