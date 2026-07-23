@extends('layouts.landing')

@section('title', 'Contact Us')

@section('content')
<section class="relative min-h-[70vh] flex items-center justify-center bg-white overflow-hidden py-24">
    <!-- Background Decor -->
    <div class="absolute inset-y-0 w-full h-full bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary-50 via-white to-white -z-10"></div>
    <div class="absolute top-1/4 -right-1/4 w-96 h-96 bg-primary-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute -bottom-8 -left-1/4 w-96 h-96 bg-accent-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-50 text-primary-700 text-sm font-semibold mb-6 ring-1 ring-inset ring-primary-500/20">
                <span class="flex w-2 h-2 rounded-full bg-primary-600"></span>
                Hubungi Kami
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
                Ada Pertanyaan?
            </h1>
            <p class="mt-4 text-lg text-slate-600 max-w-2xl mx-auto">
                Kami siap membantu. Kirimkan pesan Anda melalui form di bawah ini untuk terhubung langsung via WhatsApp, atau hubungi email kami.
            </p>
        </div>

        <div class="grid lg:grid-cols-5 gap-12">
            
            <!-- Contact Info (Left Column) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Email Card -->
                <a href="mailto:halo@rencanakarierku.com" class="group block bg-white/80 backdrop-blur-xl rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-primary-500/10 hover:border-primary-100 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center mb-6 group-hover:bg-primary-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Kirim Email</h3>
                    <p class="text-slate-500 mb-4">Cocok untuk pertanyaan umum, penawaran kerja sama, dan bantuan teknis.</p>
                    <span class="text-primary-600 font-semibold group-hover:text-primary-700">halo@rencanakarierku.com</span>
                </a>

                <!-- Info Box -->
                <div class="bg-accent-50 rounded-3xl p-8 border border-accent-100">
                    <h3 class="text-lg font-bold text-accent-900 mb-2">Jam Operasional</h3>
                    <p class="text-accent-700 mb-4">Tim kami aktif membalas pesan pada:</p>
                    <ul class="space-y-2 text-sm text-accent-800 font-medium">
                        <li class="flex justify-between"><span>Senin - Jumat:</span> <span>08.00 - 17.00 WIB</span></li>
                        <li class="flex justify-between"><span>Sabtu:</span> <span>09.00 - 13.00 WIB</span></li>
                        <li class="flex justify-between"><span>Minggu / Libur:</span> <span>Tutup</span></li>
                    </ul>
                </div>
            </div>

            <!-- WhatsApp Form (Right Column) -->
            <div class="lg:col-span-3" x-data="contactForm()">
                <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 p-8 md:p-10">
                    <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <svg class="w-8 h-8 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964 1.005-3.588c-.608-1.065-.928-2.294-.929-3.568.001-3.921 3.19-7.112 7.113-7.112 3.924 0 7.114 3.19 7.114 7.112.001 3.923-3.189 7.111-7.114 7.112z"/>
                        </svg>
                        Hubungi via WhatsApp
                    </h3>
                    
                    <form @submit.prevent="sendWA" class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                                <input type="text" x-model="name" required placeholder="Contoh: Budi Santoso" class="w-full rounded-xl border-slate-300 focus:ring-primary-500 focus:border-primary-500 py-3 px-4 bg-slate-50">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Asal Sekolah / Instansi</label>
                                <template x-if="!isUnregistered">
                                    <select x-model="school" required class="w-full rounded-xl border-slate-300 focus:ring-primary-500 focus:border-primary-500 py-3 px-4 bg-slate-50 appearance-none">
                                        <option value="">-- Pilih Instansi --</option>
                                        @foreach($institutions as $inst)
                                            <option value="{{ $inst->name }}">{{ $inst->name }}</option>
                                        @endforeach
                                    </select>
                                </template>
                                <template x-if="isUnregistered">
                                    <input type="text" x-model="customSchool" required placeholder="Tuliskan nama instansi..." class="w-full rounded-xl border-slate-300 focus:ring-primary-500 focus:border-primary-500 py-3 px-4 bg-slate-50">
                                </template>
                                <div class="mt-2 flex items-center">
                                    <input type="checkbox" id="unregistered" x-model="isUnregistered" @change="school = ''; customSchool = ''" class="rounded border-slate-300 text-primary-600 focus:ring-primary-500 h-4 w-4">
                                    <label for="unregistered" class="ml-2 text-sm text-slate-600">Instansi belum terdaftar</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Keperluan</label>
                            <select x-model="subject" required class="w-full rounded-xl border-slate-300 focus:ring-primary-500 focus:border-primary-500 py-3 px-4 bg-slate-50 appearance-none">
                                <option value="">-- Pilih Keperluan --</option>
                                <option value="Bantuan Teknis / Kesalahan Web">Bantuan Teknis / Kesalahan Web</option>
                                <option value="Konsultasi Hasil Asesmen">Konsultasi Hasil Asesmen</option>
                                <option value="Kerja Sama Sekolah/Instansi">Kerja Sama Sekolah/Instansi</option>
                                <option value="Lainnya">Pertanyaan Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Pesan Anda</label>
                            <textarea x-model="message" required rows="4" placeholder="Tuliskan pesan atau pertanyaan Anda di sini..." class="w-full rounded-xl border-slate-300 focus:ring-primary-500 focus:border-primary-500 py-3 px-4 bg-slate-50"></textarea>
                        </div>

                        <button type="submit" class="w-full inline-flex items-center justify-center px-8 py-4 bg-[#25D366] text-white font-bold rounded-xl hover:bg-[#20b858] transition-colors shadow-lg shadow-[#25D366]/30 text-lg group">
                            Kirim Pesan ke WhatsApp
                            <svg class="ml-2 w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                        <p class="text-xs text-center text-slate-500 mt-3">
                            Anda akan diarahkan ke aplikasi WhatsApp dengan pesan yang sudah terisi otomatis.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("contactForm", () => ({
            name: '',
            school: '',
            customSchool: '',
            isUnregistered: false,
            subject: '',
            message: '',

            sendWA() {
                const targetNumber = '6281914945188';
                const finalSchool = this.isUnregistered ? this.customSchool : this.school;
                
                // Constructing the message text
                let text = `Halo Tim Rencana Karierku,%0A%0A`;
                text += `Perkenalkan saya *${this.name}* dari *${finalSchool}*.%0A`;
                text += `Keperluan: ${this.subject}%0A%0A`;
                text += `${this.message}`;

                // Redirect to WhatsApp
                const waUrl = `https://wa.me/${targetNumber}?text=${text}`;
                window.open(waUrl, '_blank');
            }
        }));
    });
</script>
@endsection
