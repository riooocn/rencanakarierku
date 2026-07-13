---
name: Rencana Karierku
description: Panduan pengembangan dan dokumentasi proyek Rencana Karierku untuk AI Assistant, dilengkapi dengan Analisis Use Case dan Skema Database MySQL.
---

# Rencana Karierku

**Rencana Karierku** adalah aplikasi web yang dirancang untuk membantu siswa SMA menyusun perencanaan karier dari asesmen diri hingga pengambilan keputusan. Aplikasi ini memberikan panduan terarah agar siswa dapat mengenali diri mereka, mengeksplorasi peluang, dan membuat keputusan karier terbaik.

---

## 1. Tech Stack

Proyek ini menggunakan teknologi berikut:

- **Framework Backend:** Laravel 13.8 (PHP 8.3)
- **Framework Frontend:** Blade Templates + Tailwind CSS v4
- **Asset Bundler:** Vite
- **Database:** MySQL (default konfigurasi lokal & Production)
- **Styling:** Tailwind CSS dengan kustomisasi warna (`primary` dan `accent`)

---

## 2. Analisis Use Case Diagram

Berdasarkan arsitektur sistem pada Use Case Diagram, terdapat 3 (tiga) aktor utama dengan peran dan fungsionalitas spesifik:

### A. Aktor: Peserta (Siswa)
Peserta memiliki akses utama untuk merencanakan karier mereka secara bertahap dan terstruktur.
- **Registrasi Akun Peserta:** Mendaftarkan diri ke dalam sistem untuk membuat akun baru.
- **Melihat Pengantar Perjalanan Karier:** Melalui 3 tahapan halaman intro yang menjelaskan proses dari awal hingga akhir (asesmen diri, eksplorasi karier, hingga pengambilan keputusan) sebelum memulai tes (`<<include>>` Login).
- **Mengerjakan Asesmen Diri:** Wajib (`<<include>>`) mengerjakan tiga sub-tes secara berurutan dan melihat hasil spesifik di setiap akhir sub-tes:
    * *Tes Minat RIASEC* & Hasilnya
    * *Tes Kapasitas* & Hasilnya
    * *Tes Nilai Karier* & Hasilnya
- **Melakukan Eksplorasi Karier:** Mencari tahu tentang berbagai profesi yang relevan dan melihat hasil/ringkasan dari eksplorasi profesi yang dipilih (`<<include>>` Login).
- **Melakukan Pengambilan Keputusan:** Menentukan pilihan karier masa depan berdasarkan hasil asesmen dan eksplorasi (`<<include>>` Login).
- **Melihat Hasil Keputusan Keseluruhan:** Mengakses rangkuman komprehensif dari seluruh hasil jawaban asesmen, hasil eksplorasi, dan keputusan akhir yang telah diambil (`<<include>>` Login).
- **Mengunduh Hasil Pengambilan Keputusan:** Mengunduh dokumen cetak (PDF) hasil akhir perjalanan karier (`<<include>>` Login).

### B. Aktor: Admin (Instansi/Sekolah)
Admin bertugas memantau perkembangan peserta di instansinya.
- **Registrasi Akun Admin:** Mendaftar sebagai admin instansi.
- **Melihat Daftar Peserta:** Memantau seluruh siswa yang terdaftar (`<<include>>` Login).
- **Melihat Detail Hasil Tiap Peserta:** Melihat hasil tes dan keputusan spesifik dari masing-masing siswa (`<<include>>` Login).

### C. Aktor: Super Admin
Super Admin adalah pengelola tertinggi sistem secara keseluruhan. Memiliki seluruh hak akses yang dimiliki oleh Admin (turunan fitur Admin), ditambah wewenang khusus untuk manajemen multi-instansi dan multi-admin.
- **Mewarisi Fitur Admin:** Dapat memantau seluruh peserta dari semua instansi dan melihat detail hasil tiap peserta tanpa batasan (`<<include>>` Login).
- **Melihat Daftar Admin Instansi:** Memantau seluruh akun admin instansi/sekolah yang terdaftar di dalam sistem (`<<include>>` Login).
- **Melihat Peserta Per Instansi / Admin:** Mengontrol dan melihat daftar seluruh siswa/peserta yang dikelola di bawah instansi atau admin spesifik tertentu (`<<include>>` Login).
- **Menyetujui Akun Admin Instansi:** Mengaktifkan atau memverifikasi akun admin instansi baru agar bisa mengakses dashboard (`<<include>>` Login).
- **Mendekativasi Akun Admin Instansi:** Menonaktifkan akun admin yang bermasalah, melanggar ketentuan, atau sudah tidak aktif (`<<include>>` Login).

### D. General
- **Login:** Titik pusat otentikasi. Hampir semua aksi mewajibkan status *logged in* (`<<include>>`).
- **Logout:** Memperluas (`<<extend>>`) fungsionalitas Login untuk mengakhiri sesi.

---

## 3. Struktur Routing & Role

Pembagian Route berdasarkan Use Case (Diimplementasikan pada `routes/web.php`):

- **Frontend / Landing Page:**
  - `GET /` (Welcome Page)
- **Otentikasi:**
  - `GET /login` - Halaman Form Masuk.
  - `POST /login` - Proses otentikasi masuk sistem.
  - `GET /register` - Halaman Form Daftar (Pilihan untuk Peserta & Admin).
  - `POST /register` - Proses registrasi akun baru.
  - `POST /logout` - Proses keluar sistem dan penghapusan sesi.
  - `GET /complete-profile` - Halaman Form Lengkapi Profil setelah registrasi awal.
  - `POST /complete-profile` - Proses menyimpan kelengkapan data profil.

- **Peserta (Role: Peserta):**
 **Tahap Intro & Alur Perjalanan:**
  - `GET /perjalananku` - Menampilkan 3 halaman intro interaktif mengenai tahapan perjalanan karier (Asesmen, Eksplorasi, Keputusan) dengan tombol lanjut hingga mulai tes.
  * **Tahap Asesmen Diri (Minat, Kapasitas, Nilai Karier):**
      - `GET /perjalananku/asesmen/minat` - Menampilkan daftar soal Tes Minat RIASEC.
      - `POST /perjalananku/asesmen/minat` - Memproses dan menyimpan jawaban Tes Minat RIASEC.
      - `GET /perjalananku/asesmen/minat/hasil` - Menampilkan hasil analisis Tes Minat RIASEC.
      - `GET /perjalananku/asesmen/kapasitas` - Menampilkan daftar soal Tes Kapasitas.
      - `POST /perjalananku/asesmen/kapasitas` - Memproses dan menyimpan jawaban Tes Kapasitas.
      - `GET /perjalananku/asesmen/kapasitas/hasil` - Menampilkan hasil analisis Tes Kapasitas.
      - `GET /perjalananku/asesmen/nilaikarier` - Menampilkan daftar soal Tes Nilai Karier.
      - `POST /perjalananku/asesmen/nilaikarier` - Memproses dan menyimpan jawaban Tes Nilai Karier.
      - `GET /perjalananku/asesmen/nilaikarier/hasil` - Menampilkan hasil analisis Tes Nilai Karier.
  * **Tahap Eksplorasi & Keputusan:**
      - `GET /perjalananku/eksplorasi-karier` - Halaman interaktif untuk pencarian dan eksplorasi berbagai profesi.
      - `GET /perjalananku/eksplorasi-karier/hasil` - Menampilkan rangkuman profesi yang telah dieksplorasi/diminati oleh peserta.
      - `GET /perjalananku/keputusan-karier` - Halaman proses akhir penentuan pengambilan keputusan karier masa depan.
  * **Hasil Akhir Keseluruhan:**
      - `GET /hasilkeputusan` - Menampilkan rangkuman final seluruh perjalanan (Jawaban & Hasil Asesmen, Hasil Eksplorasi, serta Pilihan Keputusan Akhir).
- **Admin (Role: Admin):**
  - `GET /admin` (Dashboard Admin)
  - `GET /admin/peserta` (Daftar Peserta)
  - `GET /admin/peserta/{id}` (Detail Hasil Peserta)
- **Super Admin (Role: Super Admin):**
  - `GET /superadmin` - Dashboard Utama Super Admin (Manajemen instansi & statistik global).
  - `GET /superadmin/admin` - Halaman memuat daftar seluruh akun Admin Instansi/Sekolah yang terdaftar.
  - `GET /superadmin/admin/{admin_id}/peserta` - Halaman untuk melihat semua peserta/siswa yang dikelola oleh Admin atau Instansi tertentu.
  - `GET /superadmin/peserta` - Halaman memuat daftar seluruh siswa/peserta dari semua instansi secara global.
  - `GET /superadmin/peserta/{id}` - Halaman detail untuk melihat hasil keseluruhan peserta dari instansi manapun.
  - `PATCH /superadmin/admin/{id}/approve` - Aksi / *endpoint* untuk menyetujui dan mengaktifkan akun Admin Instansi.
  - `PATCH /superadmin/admin/{id}/deactivate` - Aksi / *endpoint* untuk menonaktifkan atau memblokir akun Admin Instansi.

---

## 4. Template & Layouts

Aplikasi ini menggunakan beberapa layout Blade untuk memisahkan struktur halaman:
- `resources/views/layouts/app.blade.php`: Digunakan untuk halaman utama/landing page.
- `resources/views/layouts/auth.blade.php`: Digunakan untuk halaman otentikasi.
- `resources/views/layouts/admin.blade.php`: Digunakan untuk halaman Dashboard Admin & Super Admin.

---

## 5. Panduan Styling (UI/UX)

- **Desain Modern:** Efek glassmorphism (`backdrop-blur`), gradien (`bg-gradient-to-r`), dan border radius (`rounded-2xl`, `rounded-3xl`).
- **Warna Utama:** ```css
  /* primary */
  --color-primary-100: #e7ecf2;
  --color-primary-200: #c2cedd;
  --color-primary-500: #0E2F56; /* Base Deep Corporate Navy */
  --color-primary-600: #0c294c;
  --color-primary-700: #0a213d;

  /* accent */
  --color-accent-100: #fbf2dc;
  --color-accent-200: #f5dfb0;
  --color-accent-500: #D9A036; /* Base Elegant Career Gold */
  --color-accent-600: #c28f2e;
  --color-accent-700: #ab7e27;

  /* Warna Teks Dasar & Netral */
  --color-neutral-dark: #1E242B; /* Charcoal Dark Gray */
  --color-neutral-light: #F8F9FA; /* Off-White Background */
  ```
- **Tipografi:** `font-sans`, dengan penekanan pada ketebalan teks (`font-bold`, `font-extrabold`) dan kerapatan huruf (`tracking-tight`).
- **Komponen Interaktif:** `transition-all`, `hover:-translate-y-0.5`, `shadow-sm`.
- **Logo:** `public/images/logo.png`.

---

## 6. Server Development

Untuk menjalankan proyek secara lokal, gunakan dua terminal yang berbeda:
1. `php artisan serve` (Server PHP Laravel)
2. `npm run dev` (Vite Asset Bundler & Tailwind JIT)

---

## 7. Fokus Pengembangan Selanjutnya

1. Implementasi fungsionalitas Backend (Database MySQL, Model Eloquent, Controller) untuk proses Registrasi (Peserta & Admin), Login multi-role, dan Lengkapi Profil.
2. Implementasi fungsionalitas Backend untuk Asesmen Diri (Logika form untuk RIASEC, Kapasitas, dan Nilai Karier).
3. Manajemen hak akses (Role-based access control) untuk Super Admin (Verifikasi/Deaktivasi Admin), Admin (Lihat Peserta), dan User/Siswa.

---

## 8. Penilaian Asesmen Diri

# 1. Penilaian Asesmen Minat
* Cara menghitung skor dilakukan dengan merata-rata setiap kode yang ditandai atau dicentang[cite: 5].
* Perhitungan ini didasarkan pada jumlah masing-masing kode 1, 2, 3, 4, 5, dan 6[cite: 5].
* Hasil akhir didapatkan dengan memilih 3 kode yang paling tinggi[cite: 5].
* Hasil 3 kode tertinggi tersebut kemudian ditampilkan di akhir[cite: 5].
* Kode 1 mewakili minat **Realistic**[cite: 5].
* Kode 2 mewakili minat **Investigative**[cite: 5].
* Kode 3 mewakili minat **Artistic**[cite: 5].
* Kode 4 mewakili minat **Social**[cite: 5].
* Kode 5 mewakili minat **Enterprising**[cite: 5].
* Kode 6 mewakili minat **Conventional**[cite: 5].

---

# 2. Penilaian Asesmen Kapasitas (Bagian 1)
* Skor dihitung dengan merata-rata setiap kode yang ditandai atau dicentang[cite: 5].
* Nilai rata-rata ini diambil dari jumlah masing-masing kode 1, 2, 3, dan 4[cite: 5].
* Untuk hasilnya, dipilih 2 kode yang paling tinggi dan ditampilkan[cite: 5].
* Kode 1 menandakan kapasitas pada **People**[cite: 5].
* Kode 2 menandakan kapasitas pada **Data**[cite: 5].
* Kode 3 menandakan kapasitas pada **Things**[cite: 5].
* Kode 4 menandakan kapasitas pada **Ideas**[cite: 5].

---

# 3. Penilaian Asesmen Kapasitas (Bagian 2 - Mata Pelajaran)
* Pada bagian ini, tidak ada kode khusus untuk masing-masing mata pelajaran[cite: 5].
* Cara menghitung skornya adalah masing-masing jawaban langsung mewakili skor untuk mata pelajaran tersebut[cite: 5]:
  * **Sangat tidak menguasai** = Skor 1[cite: 5]
  * **Tidak menguasai** = Skor 2[cite: 5]
  * **Cukup menguasai** = Skor 3[cite: 5]
  * **Menguasai** = Skor 4[cite: 5]
  * **Sangat menguasai** = Skor 5[cite: 5]
* Hasil yang akan ditampilkan ke peserta adalah 5 mata pelajaran dengan skor tertinggi[cite: 5].

---

# 4. Penilaian Asesmen Nilai Karier
* Cara menghitung skor pada bagian ini adalah masing-masing jawaban mewakili sebuah skor[cite: 5]:
  * **Sangat tidak penting** = Skor 1[cite: 5]
  * **Tidak penting** = Skor 2[cite: 5]
  * **Ragu-ragu** = Skor 3[cite: 5]
  * **Menguasai** = Skor 4[cite: 5]
  * **Sangat menguasai** = Skor 5[cite: 5]
* Skor-skor tersebut kemudian dirata-rata untuk masing-masing kode[cite: 5].
* Perhitungan didasarkan pada jumlah skor masing-masing kode 1, kode 2, kode 3, kode 4, dan kode 5[cite: 5].
* Hasil akhirnya akan menampilkan 3 nilai kerja dengan skor tertinggi[cite: 5].
* Kode 1 dikategorikan sebagai **Leisure**[cite: 5].
* Kode 2 dikategorikan sebagai **Extrinsic Rewards**[cite: 5].
* Kode 3 dikategorikan sebagai **Intrinsic Rewards**[cite: 5].
* Kode 4 dikategorikan sebagai **Altruistic Rewards**[cite: 5].
* Kode 5 dikategorikan sebagai **Social Rewards**[cite: 5].