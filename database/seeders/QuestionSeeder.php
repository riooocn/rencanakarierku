<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $minat = [
            ["text" => "Aku suka mengulik peralatan", "code" => 1],
            ["text" => "Aku suka mengerjakan puzzle", "code" => 2],
            ["text" => "Aku suka bekerja mandiri", "code" => 3],
            ["text" => "Aku suka bekerja dalam kelompok", "code" => 4],
            ["text" => "Aku suka membuat target untuk diriku sendiri", "code" => 5],
            ["text" => "Aku suka merapikan barang-barang (buku, alat tulis, kamar)", "code" => 6],
            ["text" => "Aku suka menyusun balok/LEGO®", "code" => 1],
            ["text" => "Aku suka membaca buku tentang seni dan musik", "code" => 3],
            ["text" => "Aku suka mengerjakan hal-hal dengan instruksi yang jelas", "code" => 6],
            ["text" => "Aku suka meyakinkan teman untuk mengikuti caraku", "code" => 5],
            ["text" => "Aku suka melakukan percobaan/eksperimen", "code" => 2],
            ["text" => "Aku suka menjelaskan sesuatu kepada teman", "code" => 4],
            ["text" => "Aku suka membantu orang lain memecahkan persoalan", "code" => 4],
            ["text" => "Aku suka memelihara binatang", "code" => 1],
            ["text" => "Aku tidak berkeberatan bekerja melebihi waktu yang ditentukan", "code" => 6],
            ["text" => "Aku suka menjual sesuatu", "code" => 5],
            ["text" => "Aku suka membuat karya berbentuk tulisan", "code" => 3],
            ["text" => "Aku suka sains", "code" => 2],
            ["text" => "Aku suka mendapatkan tantangan baru", "code" => 5],
            ["text" => "Aku suka menghibur teman", "code" => 4],
            ["text" => "Aku suka mencari tahu cara kerja sebuah alat", "code" => 2],
            ["text" => "Aku suka merangkaikan atau merakit benda", "code" => 1],
            ["text" => "Aku adalah orang yang kreatif", "code" => 3],
            ["text" => "Aku suka memperhatikan detail", "code" => 6],
            ["text" => "Aku suka merapikan catatan atau LKS", "code" => 6],
            ["text" => "Aku suka mencari tahu penyebab suatu kejadian", "code" => 2],
            ["text" => "Aku suka memainkan alat musik atau bernyanyi", "code" => 3],
            ["text" => "Aku suka mempelajari budaya berbagai daerah", "code" => 4],
            ["text" => "Aku ingin membuka usaha sendiri suatu saat nanti", "code" => 5],
            ["text" => "Aku suka memasak", "code" => 1],
            ["text" => "Aku suka bermain peran/drama", "code" => 3],
            ["text" => "Aku suka mempraktikkan hal-hal yang aku pelajari", "code" => 1],
            ["text" => "Aku suka mengerjakan soal matematika atau grafik", "code" => 2],
            ["text" => "Aku suka mendiskusikan hal-hal yang terjadi di sekitarku", "code" => 4],
            ["text" => "Aku suka merapikan kamarku", "code" => 6],
            ["text" => "Aku suka memimpin kelompok atau kelas", "code" => 5],
            ["text" => "Aku suka berkegiatan di luar ruangan", "code" => 1],
            ["text" => "Aku suka berkegiatan di dalam ruangan dengan meja-kursi", "code" => 6],
            ["text" => "Aku suka menghitung", "code" => 2],
            ["text" => "Aku suka menolong orang", "code" => 4],
            ["text" => "Aku suka menggambar", "code" => 3],
            ["text" => "Aku suka berbicara di depan umum", "code" => 5]
        ];

        $keterampilan = [
            ["text" => "Mengajar", "code" => 1],
            ["text" => "Mengawasi orang lain", "code" => 1],
            ["text" => "Merawat orang lain", "code" => 1],
            ["text" => "Menerima atau melayani tamu", "code" => 1],
            ["text" => "Memimpin rapat", "code" => 1],
            ["text" => "Memimpin orang lain", "code" => 1],
            ["text" => "Mendengarkan dan memberikan saran atau konsultasi", "code" => 1],
            ["text" => "Menjual barang dan jasa", "code" => 1],
            ["text" => "Mencatat atau membuat rekap keuangan", "code" => 2],
            ["text" => "Melakukan perhitungan statistik", "code" => 2],
            ["text" => "Melakukan penelitian", "code" => 2],
            ["text" => "Menguji coba produk atau ide", "code" => 2],
            ["text" => "Menyelidiki permasalahan", "code" => 2],
            ["text" => "Menyusun program komputer", "code" => 2],
            ["text" => "Mengadakan percobaan ilmiah", "code" => 2],
            ["text" => "Mengumpulkan informasi", "code" => 2],
            ["text" => "Memperbaiki barang", "code" => 3],
            ["text" => "Mengoperasikan mesin atau peralatan", "code" => 3],
            ["text" => "Menyusun rakitan", "code" => 3],
            ["text" => "Menggunakan perkakas", "code" => 3],
            ["text" => "Memasak atau membuat kue/roti", "code" => 3],
            ["text" => "Menggunakan mesin jahit", "code" => 3],
            ["text" => "Membuat barang dari kayu", "code" => 3],
            ["text" => "Mendirikan bangunan", "code" => 3],
            ["text" => "Menulis cerita atau puisi", "code" => 4],
            ["text" => "Menciptakan lagu", "code" => 4],
            ["text" => "Membuat desain produk baru", "code" => 4],
            ["text" => "Menggambar", "code" => 4],
            ["text" => "Menciptakan produk baru", "code" => 4],
            ["text" => "Bermain peran atau menyanyi", "code" => 4],
            ["text" => "Memainkan alat musik", "code" => 4],
            ["text" => "Mengatur perkumpulan atau kegiatan baru", "code" => 4]
        ];

        $mapel = [
            "Pendidikan Agama dan Budi Pekerti", "Pendidikan Pancasila dan Kewarganegaraan", "Bahasa Indonesia", "Matematika",
            "Sejarah", "Bahasa Inggris", "Seni Budaya", "Pendidikan Jasmani, Olahraga dan Kesehatan", "Komputer",
            "Bahasa Mandarin", "Bahasa Daerah", "Biologi", "Fisika", "Kimia", "Ekonomi", "Geografi", "Sosiologi"
        ];

        $nk = [
            ["text" => "Pekerjaan yang memberikan kesempatan berlibur", "code" => 1],
            ["text" => "Pekerjaan yang menyisakan banyak waktu untuk melakukan berbagai hal lain dalam hidup", "code" => 1],
            ["text" => "Pekerjaan dengan irama santai, tidak terburu-buru", "code" => 1],
            ["text" => "Pekerjaan yang cukup bebas dari pengawasan orang lain", "code" => 1],
            ["text" => "Pekerjaan yang berisi tugas-tugas menarik", "code" => 3],
            ["text" => "Pekerjaan yang membuka kesempatan untuk belajar hal baru maupun keterampilan baru", "code" => 3],
            ["text" => "Pekerjaan di mana keterampilan yang dimiliki tidak akan pernah usang", "code" => 3],
            ["text" => "Pekerjaan dimana apa yang kita kerjakan hasil akhirnya dapat dilihat", "code" => 3],
            ["text" => "Pekerjaan yang memanfaatkan keterampilan dan kemampuan diri", "code" => 3],
            ["text" => "Pekerjaan dimana bisa menampilkan diri apa adanya", "code" => 3],
            ["text" => "Pekerjaan yang memberi kesempatan untuk kreatif", "code" => 3],
            ["text" => "Pekerjaan yang memberi kesempatan untuk menolong orang lain secara langsung", "code" => 4],
            ["text" => "Pekerjaan yang memberi manfaat bagi masyarakat", "code" => 4],
            ["text" => "Pekerjaan yang memberi kesempatan untuk menjalin pertemanan", "code" => 5],
            ["text" => "Pekerjaan yang memungkinkan untuk berelasi dengan banyak orang", "code" => 5],
            ["text" => "Pekerjaan dengan status sosial tinggi dan berprestise", "code" => 2],
            ["text" => "Pekerjaan yang dihormati oleh orang lain", "code" => 2],
            ["text" => "Pekerjaan yang memberikan kesempatan untuk menghasilkan banyak uang", "code" => 2],
            ["text" => "Pekerjaan yang memberikan peluang bagus untuk pengembangan karir dan promosi", "code" => 2]
        ];

        $questions = [];

        // Insert Minat using exact codes
        foreach ($minat as $m) {
            $questions[] = [
                'asesmen_type' => 'minat',
                'code' => (string) $m['code'],
                'content' => $m['text'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert Kapasitas 1 (Keterampilan) using exact codes
        foreach ($keterampilan as $k) {
            $questions[] = [
                'asesmen_type' => 'kapasitas_1',
                'code' => (string) $k['code'],
                'content' => $k['text'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert Kapasitas 2 (Mapel) - code is the name of the mapel
        foreach ($mapel as $m) {
            $questions[] = [
                'asesmen_type' => 'kapasitas_2',
                'code' => $m,
                'content' => $m,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert Nilai Karier using exact codes
        foreach ($nk as $n) {
            $questions[] = [
                'asesmen_type' => 'nilai_karier',
                'code' => (string) $n['code'],
                'content' => $n['text'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Reset IDs to ensure they match blade files
        // By disabling foreign key checks, truncating, and inserting.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_answers')->truncate();
        DB::table('asesmen_results')->truncate();
        DB::table('eksplorasi_kariers')->truncate();
        DB::table('keputusan_kariers')->truncate();
        DB::table('assessment_sessions')->truncate();
        DB::table('questions')->truncate();
        DB::table('questions')->insert($questions);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
