<?php

namespace App\Helpers;

class AssessmentHelper
{
    public static function getMinatDetail($code)
    {
        $map = [
            '1' => [
                'name' => 'Realistic',
                'letter' => 'R',
                'desc' => 'Praktis, suka bekerja dengan alat, mesin, atau aktivitas fisik di luar ruangan.',
                'long_desc' => 'Kamu dengan minat pekerjaan realistic lebih senang dengan pekerjaan yang menggunakan tangan, perkakas, atau pun mesin. Sering kali pekerjaan tersebut berkaitan dengan tanaman, hewan, maupun materi nyata, seperti kayu, perkakas, dan mesin. Kamu yang memiliki minat ini menyukai pekerjaan yang melibatkan pemecahan masalah secara langsung pada benda nyata dan terkadang bekerja di luar ruangan adalah hal yang menyenangkan untukmu.',
                'jobs' => [
                    ['name' => 'Pilot', 'desc' => 'Bertugas mengemudikan pesawat maupun helikopter, memeriksa pesawat sebelum keberangkatan, memantau pengoperasian mesin, bahan bakar, serta fungsi sistem pesawat, termasuk melakukan perhitungan kecepatan mengudara.'],
                    ['name' => 'Insinyur Teknik Sipil', 'desc' => 'Mengelola, mengarahkan, dan memantau kegiatan konstruksi, merancang sistem atau struktur terkait bangunan dengan menggambar atau menggunakan komputer, serta memastikan keselamatan proyek.'],
                    ['name' => 'Ilmuwan Konservasi', 'desc' => 'Merencanakan dan menerapkan prinsip ilmu agronomi, tanah, kehutanan, atau pertanian untuk konservasi, serta memantau proyek dan memberi solusi pada pengguna lahan.'],
                    ['name' => 'Ahli/Pengelola Hutan', 'desc' => 'Merencanakan dan mengawasi proyek hutan sesuai aturan pemerintah serta menentukan metode pengelolaan hutan dengan limbah dan kerusakan hutan yang minim.'],
                    ['name' => 'Insinyur Transportasi', 'desc' => 'Merencanakan serta memeriksa rancangan, desain, atau biaya sistem transportasi, serta berunding dengan kontraktor atau instansi pemerintah.'],
                ]
            ],
            '2' => [
                'name' => 'Investigative',
                'letter' => 'I',
                'desc' => 'Pemikir, analitis, suka memecahkan masalah kompleks dan meneliti sains.',
                'long_desc' => 'Kamu dengan minat pekerjaan investigative lebih senang bekerja dengan ide, mencari tahu sesuatu secara ilmiah, dan melakukan penelitian. Sering kali pekerjaan tersebut membutuhkan banyak pemikiran. Kamu yang memiliki minat ini menyukai pekerjaan yang melibatkan pencarian fakta dan pemecahan masalah secara abstrak.',
                'jobs' => [
                    ['name' => 'Ahli Kimia', 'desc' => 'Melakukan praktik dan analisis senyawa secara kuantitatif dan kualitatif, melakukan kendali mutu, memelihara instrumen laboratorium, serta memecahkan masalah malfungsi.'],
                    ['name' => 'Dokter Hewan', 'desc' => 'Memeriksa penyakit hewan, mengumpulkan sampel jaringan tubuh, merawat dan mengoperasi, serta meresepkan obat bagi hewan yang sakit atau terluka.'],
                    ['name' => 'Insinyur Sistem Komputer', 'desc' => 'Mengembangkan rekayasa perangkat lunak, mengidentifikasi kebutuhan sistem, dan memverifikasi stabilitas serta keamanan sistem komputer klien.'],
                    ['name' => 'Analis Riset Pasar', 'desc' => 'Merancang metode penelitian pasar, mengumpulkan dan menganalisis data untuk mengidentifikasi opini konsumen, serta menyusun laporan temuan untuk strategi pemasaran.'],
                    ['name' => 'Ahli Gizi', 'desc' => 'Mengkaji kebutuhan gizi dan diet, memberikan konseling pada pasien, mengevaluasi tes laboratorium, dan mengembangkan rencana gizi sesuai preferensi budaya atau medis pasien.'],
                ]
            ],
            '3' => [
                'name' => 'Artistic',
                'letter' => 'A',
                'desc' => 'Kreatif, inovatif, suka mengekspresikan diri melalui seni atau ide original.',
                'long_desc' => 'Kamu dengan minat pekerjaan artistic senang dengan pekerjaan yang membebaskan kamu untuk mengekspresikan diri dan menjadi kreatif. Sering kali pekerjaan tersebut berkaitan dengan seni pertunjukan, tulisan, maupun visual. Kamu yang memiliki minat ini menyukai pekerjaan yang berkaitan dengan bentuk, desain, dan pola serta tidak suka mengikuti aturan.',
                'jobs' => [
                    ['name' => 'Musisi dan Penyanyi', 'desc' => 'Tampil secara langsung di hadapan penonton, memainkan instrumen musik, dan bernyanyi solo atau sebagai anggota grup dengan memodifikasi karya musik.'],
                    ['name' => 'Desainer Grafis', 'desc' => 'Berunding dengan klien untuk menentukan desain, membuat konsep visual untuk produk berdasarkan tata letak, estetika, serta menggunakan perangkat lunak grafis.'],
                    ['name' => 'Jurnalis dan Reporter', 'desc' => 'Menentukan topik berita, menganalisis dan menginterpretasikan kejadian, menulis skrip berita, serta mengkoordinasi penyampaian atau siaran berita kepada publik.'],
                    ['name' => 'Desainer Video Game', 'desc' => 'Merancang fitur, alur cerita, misi, mekanisme permainan, mengumpulkan umpan balik, dan menyeimbangkan pengalaman gameplay agar produk sukses.'],
                    ['name' => 'Arsitek', 'desc' => 'Menyiapkan gambar skala dan desain arsitektur dengan unsur estetika struktur (termasuk bahan dan warna) serta berkonsultasi dengan klien terkait desain tersebut.'],
                ]
            ],
            '4' => [
                'name' => 'Social',
                'letter' => 'S',
                'desc' => 'Pemberi bantuan, ramah, suka mengajar, membimbing, atau menyembuhkan orang lain.',
                'long_desc' => 'Kamu dengan minat pekerjaan social senang dengan pekerjaan yang dapat membantu, merawat, maupun mengajari orang lain. Sering kali pekerjaan ini membutuhkan kamu untuk mendampingi atau menyediakan layanan bagi orang lain.',
                'jobs' => [
                    ['name' => 'Perawat', 'desc' => 'Mencatat kondisi kesehatan, mengembangkan rencana perawatan, memberikan informasi kesehatan, menganalisis riwayat sakit, dan merawat keluhan pasien secara langsung.'],
                    ['name' => 'Trainer', 'desc' => 'Melakukan survei kebutuhan klien, menyajikan program pelatihan (ceramah, video, dll), mengembangkan modul atau manual materi, serta mengevaluasi program.'],
                    ['name' => 'Guru', 'desc' => 'Mempersiapkan pembelajaran berdasarkan kurikulum, menyesuaikan metode mengajar dengan minat siswa, mendorong motivasi belajar, dan menjaga ketertiban kelas.'],
                    ['name' => 'Konselor', 'desc' => 'Melakukan asesmen pada klien, mendorong pengungkapan perasaan, membantu klien mengembangkan diri, serta menjaga kerahasiaan data dalam proses konseling.'],
                    ['name' => 'Terapis', 'desc' => 'Memotivasi dan memberikan terapi pada pasien (manual atau teknologi), membantu pergerakan pasien, serta mencatat kemajuan dan peralatan yang digunakan dalam terapi.'],
                ]
            ],
            '5' => [
                'name' => 'Enterprising',
                'letter' => 'E',
                'desc' => 'Penuh ambisi, energik, suka memimpin, memengaruhi orang lain, dan berbisnis.',
                'long_desc' => 'Kamu dengan minat pekerjaan enterprising senang dengan pekerjaan yang berkaitan dengan menjual, mengatur, serta memengaruhi lingkungan sosialmu dan umumnya berkaitan dengan bisnis. Sering kali pekerjaan di bidang ini membutuhkan kamu untuk mengawasi orang, memimpin proyek, dan membuat keputusan.',
                'jobs' => [
                    ['name' => 'Polisi', 'desc' => 'Menjaga keamanan publik, menanggapi keadaan darurat, mengidentifikasi dan menangkap tersangka, meninjau fakta insiden kriminal, dan melakukan dokumentasi hukum.'],
                    ['name' => 'Spesialis Hubungan Masyarakat', 'desc' => 'Merencanakan program komunikasi, menulis siaran pers untuk media, memasang konten di situs web atau sosial media, serta mempertahankan persepsi publik yang baik.'],
                    ['name' => 'Manajer Keuangan', 'desc' => 'Memberikan bantuan terhadap masalah keuangan klien, mengawasi arus keuangan, merencanakan anggaran, serta mengoordinasikan aktivitas finansial institusi atau cabang.'],
                    ['name' => 'Pengacara', 'desc' => 'Menganalisis kasus hukum, memberitahu klien tentang hak dan kewajibannya, melakukan debat/tanya-jawab dengan saksi di persidangan, dan memberikan bukti untuk membela klien.'],
                    ['name' => 'Produser dan Sutradara', 'desc' => 'Merencanakan pergerakan aktor, kamera, dan suara, mengarahkan jalannya rekaman produksi film/program televisi, serta meninjau kesesuaian standar siaran.'],
                ]
            ],
            '6' => [
                'name' => 'Conventional',
                'letter' => 'C',
                'desc' => 'Terorganisir, teliti, suka bekerja dengan data, angka, dan mengikuti prosedur baku.',
                'long_desc' => 'Kamu dengan minat pekerjaan conventional senang dengan pekerjaan yang teratur dan melakukan pengolahan data secara sistematis serta dengan standar yang jelas dan sering kali berkaitan dengan bisnis. Kamu dengan minat pekerjaan di bidang ini senang mengikuti aturan dan memperhatikan detail.',
                'jobs' => [
                    ['name' => 'Pengembang Web', 'desc' => 'Merancang atau memelihara situs web, melakukan pencadangan (backup) file, memilih bahasa pemrograman, serta mengevaluasi kode agar memenuhi standar dan valid.'],
                    ['name' => 'Akuntan dan Auditor', 'desc' => 'Menyiapkan laporan audit, menganalisis data untuk mendeteksi kesalahan atau kecurangan, memeriksa sistem akuntansi, serta mengawasi efisiensi ruang lingkup audit.'],
                    ['name' => 'Aktuaris', 'desc' => 'Mengelola rencana asuransi dan dana pensiun, menghitung premi, memberikan saran kebijakan, dan menganalisis data statistik seperti tingkat kecelakaan atau harapan hidup.'],
                    ['name' => 'Analis Keamanan Informasi', 'desc' => 'Mengembangkan perlindungan sistem, memantau ancaman virus, memasang enkripsi/firewall untuk data rahasia, serta melakukan uji penilaian risiko keamanan jaringan komputer.'],
                    ['name' => 'Analis Anggaran Keuangan', 'desc' => 'Meringkas dan memeriksa perkiraan anggaran agar sesuai regulasi, memberikan rekomendasi persetujuan anggaran, dan menganalisis laporan akuntansi bulanan instansi.'],
                ]
            ],
        ];

        return $map[$code] ?? ['name' => 'Unknown', 'letter' => '?', 'desc' => 'Tidak diketahui.', 'long_desc' => 'Tidak diketahui.', 'jobs' => []];
    }

    public static function getKapasitas1Detail($code)
    {
        $map = [
            '1' => [
                'name' => 'People',
                'desc' => 'Kapasitas bekerja dengan orang lain',
            ],
            '2' => [
                'name' => 'Data',
                'desc' => 'Kapasitas bekerja dengan angka dan informasi',
            ],
            '3' => [
                'name' => 'Things',
                'desc' => 'Kapasitas bekerja dengan alat atau objek',
            ],
            '4' => [
                'name' => 'Ideas',
                'desc' => 'Kapasitas memikirkan konsep dan kreativitas',
            ],
        ];

        return $map[$code] ?? ['name' => 'Unknown', 'desc' => 'Tidak diketahui.'];
    }

    public static function getNilaiKarierDetail($code)
    {
        $map = [
            '1' => [
                'name' => 'Leisure',
                'desc' => 'Menginginkan keseimbangan antara kehidupan kerja dan waktu luang.',
            ],
            '2' => [
                'name' => 'Extrinsic Rewards',
                'desc' => 'Menghargai penghasilan yang tinggi, status, dan keamanan finansial.',
            ],
            '3' => [
                'name' => 'Intrinsic Rewards',
                'desc' => 'Termotivasi oleh kepuasan batin dari pekerjaan itu sendiri.',
            ],
            '4' => [
                'name' => 'Altruistic Rewards',
                'desc' => 'Motivasi untuk membantu orang lain dan berkontribusi pada masyarakat.',
            ],
            '5' => [
                'name' => 'Social Rewards',
                'desc' => 'Menghargai interaksi sosial dan lingkungan kerja yang bersahabat.',
            ],
        ];

        return $map[$code] ?? ['name' => 'Unknown', 'desc' => 'Tidak diketahui.'];
    }
}
