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
Peserta memiliki akses utama untuk merencanakan karier mereka.
- **Registrasi Akun Peserta:** Mendaftarkan diri ke dalam sistem.
- **Mengerjakan Asesmen Diri:** Wajib (`<<include>>`) mengerjakan tiga sub-tes:
  - *Tes Minat RIASEC*
  - *Tes Kapasitas*
  - *Tes Nilai Karier*
- **Melakukan Eksplorasi Karier:** Mencari tahu tentang berbagai profesi (`<<include>>` Login).
- **Melakukan Pengambilan Keputusan:** Menentukan pilihan karier masa depan (`<<include>>` Login).
- **Melihat Hasil Perencanaan:** Mengakses ringkasan hasil perencanaan yang telah dibuat (`<<include>>` Login).
- **Mengunduh Hasil Pengambilan Keputusan:** Mengunduh dokumen hasil akhir (`<<include>>` Login).

### B. Aktor: Admin (Instansi/Sekolah)
Admin bertugas memantau perkembangan peserta di instansinya.
- **Registrasi Akun Admin:** Mendaftar sebagai admin instansi.
- **Melihat Daftar Peserta:** Memantau seluruh siswa yang terdaftar (`<<include>>` Login).
- **Melihat Detail Hasil Tiap Peserta:** Melihat hasil tes dan keputusan spesifik dari masing-masing siswa (`<<include>>` Login).

### C. Aktor: Super Admin
Super Admin adalah pengelola tertinggi sistem.
- **Menyetujui Akun Admin Instansi:** Mengaktifkan atau memverifikasi akun admin baru (`<<include>>` Login).
- **Mendekativasi Akun Admin Instansi:** Menonaktifkan akun admin yang bermasalah atau tidak aktif (`<<include>>` Login).

### D. General
- **Login:** Titik pusat otentikasi. Hampir semua aksi mewajibkan status *logged in* (`<<include>>`).
- **Logout:** Memperluas (`<<extend>>`) fungsionalitas Login untuk mengakhiri sesi.

---

## 3. Struktur Routing & Role

Pembagian Route berdasarkan Use Case (Diimplementasikan pada `routes/web.php`):

- **Frontend / Landing Page:**
  - `GET /` (Welcome Page)
- **Otentikasi:**
  - `GET /login`, `POST /login` (Halaman Masuk)
  - `GET /register`, `POST /register` (Halaman Daftar Peserta & Admin)
  - `POST /logout` (Logout)
  - `GET /complete-profile`, `POST /complete-profile` (Halaman Lengkapi Profil)
- **Peserta (Role: Peserta):**
  - `GET /dashboard`
  - `GET /asesmen` (Menampilkan tes RIASEC, Kapasitas, Nilai Karier)
  - `GET /eksplorasi-karier`
  - `GET /keputusan-karier`
  - `GET /hasil-perencanaan`
- **Admin (Role: Admin):**
  - `GET /admin` (Dashboard Admin)
  - `GET /admin/peserta` (Daftar Peserta)
  - `GET /admin/peserta/{id}` (Detail Hasil Peserta)
- **Super Admin (Role: Super Admin):**
  - `GET /superadmin` (Dashboard Super Admin)
  - `PATCH /superadmin/admin/{id}/approve` (Menyetujui Admin)
  - `PATCH /superadmin/admin/{id}/deactivate` (Mendekativasi Admin)

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