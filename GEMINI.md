---
name: Rencana Karierku
description: Panduan pengembangan dan dokumentasi proyek Rencana Karierku untuk AI Assistant.
---

# Rencana Karierku

**Rencana Karierku** adalah aplikasi web yang dirancang untuk membantu siswa SMA menyusun perencanaan karier dari asesmen diri hingga pengambilan keputusan. Aplikasi ini memberikan panduan terarah agar siswa dapat mengenali diri mereka, mengeksplorasi peluang, dan membuat keputusan karier terbaik.

## Tech Stack

Proyek ini menggunakan teknologi berikut:

- **Framework Backend:** Laravel 13.8 (PHP 8.3)
- **Framework Frontend:** Blade Templates + Tailwind CSS v4
- **Asset Bundler:** Vite
- **Database:** MySQL (default konfigurasi lokal) / MySQL (Production)
- **Styling:** Tailwind CSS dengan kustomisasi warna (`primary` dan `accent`)

## Struktur Routing & Role (Saat Ini)

- **Frontend / Landing Page:**
  - `GET /` (Welcome Page)
- **Otentikasi:**
  - `GET /login` (Halaman Masuk)
  - `GET /register` (Halaman Daftar)
  - `GET /complete-profile` (Halaman Lengkapi Profil)
- **Admin (Role: Admin):**
  - `GET /admin` (Dashboard Admin)
- **Super Admin (Role: Super Admin):**
  - `GET /superadmin` (Dashboard Super Admin / Kelola Admin)

## Template & Layouts

Aplikasi ini menggunakan beberapa layout Blade untuk memisahkan struktur halaman:
- `resources/views/layouts/app.blade.php`: Digunakan untuk halaman utama/landing page.
- `resources/views/layouts/auth.blade.php`: Digunakan untuk halaman otentikasi (Login, Register, Complete Profile).
- `resources/views/layouts/admin.blade.php`: Digunakan untuk halaman Dashboard Admin.
- `resources/views/layouts/superadmin.blade.php`: Digunakan untuk halaman Dashboard Super Admin.

## Panduan Styling (UI/UX)

- **Desain Modern:** Menggunakan elemen modern seperti efek glassmorphism (`backdrop-blur`), gradien (`bg-gradient-to-r`), dan border radius yang halus (`rounded-2xl`, `rounded-3xl`).
- **Warna Utama:** 
  - `primary`
  - `accent` 
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
  --color-neutral-dark: #1E242B; /* Charcoal Dark Gray (Anti-Lelah untuk Soal Panjang) */
  --color-neutral-light: #F8F9FA; /* Off-White Background */

- **Tipografi:** Menggunakan font *sans-serif* (`font-sans`), dengan penekanan pada ketebalan teks (`font-bold`, `font-extrabold`) dan kerapatan huruf (`tracking-tight`) untuk *headings*.
- **Komponen Interaktif:** Tombol dan tautan harus memiliki transisi yang halus (`transition-all`, `hover:-translate-y-0.5`, `shadow-sm`).
- **Logo:** Logo utama diletakkan di `public/images/logo.png`.

## Server Development

Untuk menjalankan proyek secara lokal, gunakan dua terminal yang berbeda (atau perintah *concurrently*):
1. `php artisan serve` (Server PHP Laravel)
2. `npm run dev` (Vite Asset Bundler & Tailwind JIT)

## Fokus Pengembangan Selanjutnya

*(AI Assistant harus merujuk ke file ini setiap kali ingin menambahkan fitur baru agar konsisten dengan struktur yang sudah ada.)*
- Implementasi fungsionalitas Backend (Database, Model, Controller) untuk proses Registrasi, Login, dan Lengkapi Profil.
- Implementasi fungsionalitas Backend untuk Asesmen Diri.
- Manajemen hak akses (Role-based access control) untuk Super Admin, Admin, dan User (Siswa).
