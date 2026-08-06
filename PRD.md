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



tambahin dan koreksi

dibagian peserta :

/perjalanku (menampilkan intro apa yang akan di lakukan peserta, mulai dari asesmen diri, ekplorasi karier dan pengambilan keputusan, seperti ada 3 intro page nanti ada tombol lanjut sampai intro di bagian pengambilan keputusan setelah itu masuk/mulai dibagian /perjalananku/asesmen/minat/)



/perjalananku/asesmen/minat (menampilkan soal asesmen minat)



/perjalananku/asesmen/kapasitas (menampilkan soal asesmen kapasitas)



/perjalananku/asesmen/nilaikarier(menampilkan soal nilai karier)



/dashboard utk peserta dihapus



/hasilkeputusan (menampilkan hasil jawaban dankeputusan dari peserta)



dan setiap bagian akan muncul hasilnya setelah mengerjakan misal hasil asesmen minat, hasil asesmen kapasitas, hasil asesmen nilai karier, hasil ekplorasi karier, hasil pengambilan keputusan dan nanti hasil untuk seluruhnya



A. Aktor: Peserta (Siswa)
Peserta memiliki akses utama untuk merencanakan karier mereka secara bertahap.

Registrasi Akun Peserta: Mendaftarkan diri ke dalam sistem.

Melihat Pengantar Perjalanan Karier: Melalui tahapan intro yang menjelaskan proses asesmen diri, eksplorasi karier, dan pengambilan keputusan sebelum memulai tes (<<include>> Login).

Mengerjakan Asesmen Diri: Wajib (<<include>>) mengerjakan tiga sub-tes secara berurutan dan melihat hasil di setiap akhir sub-tes:

Tes Minat RIASEC & Hasilnya

Tes Kapasitas & Hasilnya

Tes Nilai Karier & Hasilnya

Melakukan Eksplorasi Karier: Mencari tahu tentang berbagai profesi dan melihat hasil dari eksplorasi yang dipilih (<<include>> Login).

Melakukan Pengambilan Keputusan: Menentukan pilihan karier masa depan (<<include>> Login).

Melihat Hasil Keputusan Keseluruhan: Mengakses ringkasan seluruh hasil (jawaban asesmen, eksplorasi, dan keputusan akhir) yang telah dibuat (<<include>> Login).

Mengunduh Hasil Pengambilan Keputusan: Mengunduh dokumen hasil akhir perjalanan karier (<<include>> Login).

B. Aktor: Admin (Instansi/Sekolah)
Admin bertugas memantau perkembangan peserta di instansinya.

Registrasi Akun Admin: Mendaftar sebagai admin instansi.

Melihat Daftar Peserta: Memantau seluruh siswa yang terdaftar (<<include>> Login).

Melihat Detail Hasil Tiap Peserta: Melihat hasil tes dan keputusan spesifik dari masing-masing siswa (<<include>> Login).

C. Aktor: Super Admin
Super Admin adalah pengelola tertinggi sistem.

Menyetujui Akun Admin Instansi: Mengaktifkan atau memverifikasi akun admin baru (<<include>> Login).

Mendekativasi Akun Admin Instansi: Menonaktifkan akun admin yang bermasalah atau tidak aktif (<<include>> Login).

D. General
Login: Titik pusat otentikasi. Hampir semua aksi mewajibkan status logged in (<<include>>).

Logout: Memperluas (<<extend>>) fungsionalitas Login untuk mengakhiri sesi.

3. Struktur Routing & Role
Pembagian Route berdasarkan Use Case (Diimplementasikan pada routes/web.php):

Frontend / Landing Page & Otentikasi
GET / (Welcome Page)

GET /login, POST /login (Halaman Masuk)

GET /register, POST /register (Halaman Daftar Peserta & Admin)

POST /logout (Logout)

GET /complete-profile, POST /complete-profile (Halaman Lengkapi Profil)

Peserta (Role: Peserta)
(Catatan: Route /dashboard dihapus, diganti dengan alur /perjalananku)

Intro & Asesmen Diri:

GET /perjalananku (Menampilkan 3 halaman intro perjalanan karier. Berakhir dengan tombol mulai ke asesmen minat)

GET /perjalananku/asesmen/minat (Menampilkan soal asesmen minat)

POST /perjalananku/asesmen/minat (Memproses jawaban asesmen minat)

GET /perjalananku/asesmen/minat/hasil (Menampilkan hasil asesmen minat)

GET /perjalananku/asesmen/kapasitas (Menampilkan soal asesmen kapasitas)

POST /perjalananku/asesmen/kapasitas (Memproses jawaban asesmen kapasitas)

GET /perjalananku/asesmen/kapasitas/hasil (Menampilkan hasil asesmen kapasitas)

GET /perjalananku/asesmen/nilaikarier (Menampilkan soal asesmen nilai karier)

POST /perjalananku/asesmen/nilaikarier (Memproses jawaban nilai karier)

GET /perjalananku/asesmen/nilaikarier/hasil (Menampilkan hasil asesmen nilai karier)

Eksplorasi & Keputusan:

GET /perjalananku/eksplorasi-karier (Proses pencarian dan eksplorasi karier)

GET /perjalananku/eksplorasi-karier/hasil (Menampilkan hasil eksplorasi karier)

GET /perjalananku/keputusan-karier (Proses pengambilan keputusan karier)

Hasil Akhir Keseluruhan:

GET /hasilkeputusan (Menampilkan rangkuman seluruh hasil: jawaban asesmen, hasil eksplorasi, dan keputusan akhir peserta)

Admin (Role: Admin)
GET /admin (Dashboard Admin)

GET /admin/peserta (Daftar Peserta)

GET /admin/peserta/{id} (Detail Hasil Keseluruhan Peserta)

Super Admin (Role: Super Admin)
GET /superadmin (Dashboard Super Admin)

PATCH /superadmin/admin/{id}/approve (Menyetujui Admin)

PATCH /superadmin/admin/{id}/deactivate (Mendekativasi Admin)

minta .md nya

File .md Anda sudah siap.
Ikon MD
dokumentasi_sistem_karier
 MD 
Buka

Dokumen tersebut berisi pembaruan struktur aktor dan routing aplikasi (termasuk penyesuaian alur /perjalananku dan penghapusan /dashboard untuk peserta) seperti yang Anda instruksikan. Jika ada bagian lain yang perlu ditambahkan atau disesuaikan lagi, beri tahu saya!

superadmin dapat turunan fitur dari admin juga

File .md telah berhasil diperbarui.
Ikon MD
dokumentasi_sistem_karier
 MD 
Buka

Saya sudah menambahkan Mewarisi Fitur Admin pada deskripsi Use Case Super Admin, serta menambahkan route turunan dari Admin (GET /superadmin/peserta dan GET /superadmin/peserta/{id}) ke dalam bagian struktur routing Super Admin agar bisa mengakses seluruh data peserta dari berbagai instansi.

superadmin dapat melihat para admin juga, dan super admin bisa melihat semua peserta yang di kelola di suatu instansi/adminnya

File .md telah berhasil diperbarui lagi.
Ikon MD
dokumentasi_sistem_karier
 MD 
Buka
Ikon MD
dokumentasi_sistem_karier
 MD 
Buka

Saya sudah menambahkan detail tersebut ke dalam Use Case Aktor: Super Admin, yaitu:

Melihat Daftar Admin Instansi: Super Admin dapat memantau seluruh admin yang terdaftar.

Melihat Peserta Per Instansi / Admin: Super Admin bisa melihat daftar peserta berdasarkan instansi atau admin tertentu.

Serta saya tambahkan routing khusus di bagian Super Admin:

GET /superadmin/admin untuk melihat daftar admin.

GET /superadmin/admin/{admin_id}/peserta untuk memfilter dan melihat daftar peserta yang dikelola oleh admin/instansi tersebut.

Ada hal lain yang perlu disempurnakan lagi?

buatkan .mdnya untuk cara kerja penilaian assesmen diri bagian minat, kapasitas ada (2), dan nilai karier.

Berikut adalah format teks Markdown yang menjelaskan cara kerja dan perhitungan skor untuk masing-masing bagian asesmen berdasarkan dokumen yang Anda berikan. Anda bisa langsung menyalin isinya.

Penilaian Asesmen Minat
Cara menghitung skor dilakukan dengan merata-rata setiap kode yang ditandai atau dicentang.  
PDF

Perhitungan ini didasarkan pada jumlah masing-masing kode 1, 2, 3, 4, 5, dan 6.  
PDF

Hasil akhir didapatkan dengan memilih 3 kode yang paling tinggi.  
PDF

Hasil 3 kode tertinggi tersebut kemudian ditampilkan di akhir.  
PDF

Kode 1 mewakili minat Realistic.  
PDF

Kode 2 mewakili minat Investigative.  
PDF

Kode 3 mewakili minat Artistic.  
PDF

Kode 4 mewakili minat Social.  
PDF

Kode 5 mewakili minat Enterprising.  
PDF

Kode 6 mewakili minat Conventional.  
PDF

Penilaian Asesmen Kapasitas (Bagian 1)
Skor dihitung dengan merata-rata setiap kode yang ditandai atau dicentang.  
PDF

Nilai rata-rata ini diambil dari jumlah masing-masing kode 1, 2, 3, dan 4.  
PDF

Untuk hasilnya, dipilih 2 kode yang paling tinggi dan ditampilkan.  
PDF

Kode 1 menandakan kapasitas pada People.  
PDF

Kode 2 menandakan kapasitas pada Data.  
PDF

Kode 3 menandakan kapasitas pada Things.  
PDF

Kode 4 menandakan kapasitas pada Ideas.  
PDF

Penilaian Asesmen Kapasitas (Bagian 2 - Mata Pelajaran)
Pada bagian ini, tidak ada kode khusus untuk masing-masing mata pelajaran.  
PDF

Cara menghitung skornya adalah masing-masing jawaban langsung mewakili skor untuk mata pelajaran tersebut.  
PDF

Pilihan "Sangat tidak menguasai" bernilai skor 1.  
PDF

Pilihan "Tidak menguasai" bernilai skor 2.  
PDF

Pilihan "Cukup menguasai" bernilai skor 3.  
PDF

Pilihan "Menguasai" bernilai skor 4.  
PDF

Pilihan "Sangat menguasai" bernilai skor 5.  
PDF

Hasil yang akan ditampilkan ke peserta adalah 5 mata pelajaran dengan skor tertinggi.  
PDF

Penilaian Asesmen Nilai Karier
Cara menghitung skor pada bagian ini adalah masing-masing jawaban mewakili sebuah skor.  
PDF

Jawaban "Sangat tidak penting" diberi skor 1.  
PDF

Jawaban "Tidak penting" diberi skor 2.  
PDF

Jawaban "Ragu-ragu" diberi skor 3.  
PDF

Jawaban "Menguasai" diberi skor 4.  
PDF

Jawaban "Sangat menguasai" diberi skor 5.  
PDF

Skor-skor tersebut kemudian dirata-rata untuk masing-masing kode.  
PDF

Perhitungan didasarkan pada jumlah skor masing-masing kode 1, kode 2, kode 3, kode 4, dan kode 5.  
PDF

Hasil akhirnya akan menampilkan 3 nilai kerja dengan skor tertinggi.  
PDF

Kode 1 dikategorikan sebagai Leisure.  
PDF

Kode 2 dikategorikan sebagai Extrinsic Rewards.  
PDF

Kode 3 dikategorikan sebagai Intrinsic Rewards.  
PDF

Kode 4 dikategorikan sebagai Altruistic Rewards.  
PDF

Kode 5 dikategorikan sebagai Social Rewards.  
PDF

buatkan file .md

Python
content = """# Penilaian Asesmen Diri

## 1. Penilaian Asesmen Minat
* Cara menghitung skor dilakukan dengan merata-rata setiap kode yang ditandai atau dicentang.
* Perhitungan ini didasarkan pada jumlah masing-masing kode 1, 2, 3, 4, 5, dan 6.
* Hasil akhir didapatkan dengan memilih 3 kode yang paling tinggi.
* Hasil 3 kode tertinggi tersebut kemudian ditampilkan di akhir.
* Kode 1 mewakili minat **Realistic**.
* Kode 2 mewakili minat **Investigative**.
* Kode 3 mewakili minat **Artistic**.
* Kode 4 mewakili minat **Social**.
* Kode 5 mewakili minat **Enterprising**.
* Kode 6 mewakili minat **Conventional**.

---

## 2. Penilaian Asesmen Kapasitas (Bagian 1)
* Skor dihitung dengan merata-rata setiap kode yang ditandai atau dicentang.
* Nilai rata-rata ini diambil dari jumlah masing-masing kode 1, 2, 3, dan 4.
* Untuk hasilnya, dipilih 2 kode yang paling tinggi dan ditampilkan.
* Kode 1 menandakan kapasitas pada **People**.
* Kode 2 menandakan kapasitas pada **Data**.
* Kode 3 menandakan kapasitas pada **Things**.
* Kode 4 menandakan kapasitas pada **Ideas**.

---

## 3. Penilaian Asesmen Kapasitas (Bagian 2 - Mata Pelajaran)
* Pada bagian ini, tidak ada kode khusus untuk masing-masing mata pelajaran.
* Cara menghitung skornya adalah masing-masing jawaban langsung mewakili skor untuk mata pelajaran tersebut:
  * **Sangat tidak menguasai** = Skor 1
  * **Tidak menguasai** = Skor 2
  * **Cukup menguasai** = Skor 3
  * **Menguasai** = Skor 4
  * **Sangat menguasai** = Skor 5
* Hasil yang akan ditampilkan ke peserta adalah 5 mata pelajaran dengan skor tertinggi.

---

## 4. Penilaian Asesmen Nilai Karier
* Cara menghitung skor pada bagian ini adalah masing-masing jawaban mewakili sebuah skor:
  * **Sangat tidak penting** = Skor 1
  * **Tidak penting** = Skor 2
  * **Ragu-ragu** = Skor 3
  * **Menguasai** = Skor 4
  * **Sangat menguasai** = Skor 5
* Skor-skor tersebut kemudian dirata-rata untuk masing-masing kode.
* Perhitungan didasarkan pada jumlah skor masing-masing kode 1, kode 2, kode 3, kode 4, dan kode 5.
* Hasil akhirnya akan menampilkan 3 nilai kerja dengan skor tertinggi.
* Kode 1 dikategorikan sebagai **Leisure**.
* Kode 2 dikategorikan sebagai **Extrinsic Rewards**.
* Kode 3 dikategorikan sebagai **Intrinsic Rewards**.
* Kode 4 dikategorikan sebagai **Altruistic Rewards**.
* Kode 5 dikategorikan sebagai **Social Rewards**.
"""

file_path = "cara_kerja_penilaian_asesmen.md"
with open(file_path, "w", encoding="utf-8") as f:
    f.write(content)

print("File successfully generated.")

Output kode
File successfully generated.

File .md berisi cara kerja penilaian asesmen sudah berhasil dibuat.

[file-tag: code-generated-file-5b23b8f6-8208-417d-8521-4f1dd461014e]

mana

Berikut adalah isi dari file cara_kerja_penilaian_asesmen.md yang bisa Anda salin atau simpan:

Markdown
# Penilaian Asesmen Diri

## 1. Penilaian Asesmen Minat
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

## 2. Penilaian Asesmen Kapasitas (Bagian 1)
* Skor dihitung dengan merata-rata setiap kode yang ditandai atau dicentang[cite: 5].
* Nilai rata-rata ini diambil dari jumlah masing-masing kode 1, 2, 3, dan 4[cite: 5].
* Untuk hasilnya, dipilih 2 kode yang paling tinggi dan ditampilkan[cite: 5].
* Kode 1 menandakan kapasitas pada **People**[cite: 5].
* Kode 2 menandakan kapasitas pada **Data**[cite: 5].
* Kode 3 menandakan kapasitas pada **Things**[cite: 5].
* Kode 4 menandakan kapasitas pada **Ideas**[cite: 5].

---

## 3. Penilaian Asesmen Kapasitas (Bagian 2 - Mata Pelajaran)
* Pada bagian ini, tidak ada kode khusus untuk masing-masing mata pelajaran[cite: 5].
* Cara menghitung skornya adalah masing-masing jawaban langsung mewakili skor untuk mata pelajaran tersebut[cite: 5]:
  * **Sangat tidak menguasai** = Skor 1[cite: 5]
  * **Tidak menguasai** = Skor 2[cite: 5]
  * **Cukup menguasai** = Skor 3[cite: 5]
  * **Menguasai** = Skor 4[cite: 5]
  * **Sangat menguasai** = Skor 5[cite: 5]
* Hasil yang akan ditampilkan ke peserta adalah 5 mata pelajaran dengan skor tertinggi[cite: 5].

---

## 4. Penilaian Asesmen Nilai Karier
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
dihasilkan dari nilai rata rata apakah bisa? kecuali yang mata pelajaran

Ya, betul sekali! Berdasarkan dokumen panduan yang Anda berikan sebelumnya, penilaian untuk Asesmen Minat, Kapasitas (Bagian 1), dan Nilai Karier memang dihitung berdasarkan nilai rata-rata dari setiap kode.

Berikut rinciannya sesuai dengan dokumen:


Asesmen Minat: Cara menghitung skornya adalah dengan merata-rata setiap kode yang ditandai atau dicentang (berdasarkan jumlah masing-masing kode 1 hingga 6).  
PDF


Asesmen Kapasitas (Bagian 1): Skor dihitung dengan merata-rata setiap kode yang ditandai atau dicentang (berdasarkan jumlah masing-masing kode 1 hingga 4).  
PDF


Asesmen Nilai Karier: Skor dari setiap jawaban peserta dirata-rata untuk masing-masing kode (jumlah skor masing-masing kode 1 hingga 5).  
PDF

Sedangkan pengecualian yang Anda sebutkan juga sudah sangat tepat. Untuk Asesmen Kapasitas (Bagian 2 - Mata Pelajaran), tidak menggunakan nilai rata-rata, melainkan menggunakan skor langsung dari masing-masing jawaban untuk mencari 5 nilai tertinggi.  
PDF
+ 1

File Markdown (.md) yang saya buatkan di atas juga sudah mengadopsi logika perhitungan rata-rata tersebut. Apakah ada penyesuaian lain yang ingin Anda tambahkan ke dalam dokumennya?

bisakah buatkan alurnya agar AI dapat membacanya di GEMINI.md berdasarkan 2 file tersebut jadi alurnya seperti itu kira kira tetapi cara penilaiannya di file kunci jawaban

Saya telah membuatkan file panduan_alur_dan_penilaian.md yang menyatukan pemahaman AI mengenai bagaimana alur peserta (dari front-end) dan juga bagaimana kalkulasi sistem (di back-end) dilakukan berdasarkan Kunci Jawaban.
Ikon MD
panduan_alur_dan_penilaian
 MD 
Buka

Secara ringkas:

Asesmen Minat, Kapasitas (Bagian 1), dan Nilai Karier dihitung dengan merata-rata kode berdasarkan seberapa banyak peserta menandai checkbox atau menjawab skala.  
PDF

Asesmen Kapasitas (Bagian 2 - Mata Pelajaran) langsung dihitung skor tertingginya untuk menemukan Top 5 Mata Pelajaran tanpa melalui proses rata-rata kode.

Apakah ada detail lain yang perlu saya lengkapi dalam dokumen .md tersebut?

tapi aku mau lengkap seperti didalam penjelasan alur semua soal, dan semua contoh jawaban yang ada di dalam file alur

Saya telah membuatkan file .md yang sangat lengkap dan komprehensif, menggabungkan persis seperti apa yang Anda minta.
Ikon MD
panduan_lengkap_alur_dan_penilaian
 MD 
Buka

Di dalam dokumen tersebut, Anda akan menemukan:

Narasi Lengkap (Pengantar): Semua teks perkenalan (seperti penjelasan Holland, penjelasan tipe Kapasitas, dan tipe Nilai Karier) yang dibaca oleh peserta di UI/UX.  
PDF

Daftar Seluruh Soal & Pilihan Jawaban: Memuat ke-42 soal Asesmen Minat, 32 soal Keterampilan Kapasitas, 17 Mata Pelajaran, hingga 19 soal Nilai Karier beserta mekanisme halamannya (misalnya Halaman 1 untuk soal nomor 1-11, dll).  
PDF
+ 1

Kunci Pemetaan Kode: Tiap-tiap soal sudah saya berikan label "(Kode: X)" di belakangnya sesuai dengan dokumen kunci jawaban (misalnya soal "Aku suka mengulik peralatan" dilabeli "Kode 1").  
PDF

Logika Skoring Detail: Menjelaskan bagaimana sistem merata-rata nilai berdasarkan kodenya dan mencetak hasil terbaik (3 minat teratas, 2 kapasitas teratas, 5 mata pelajaran teratas, dan 3 nilai karier teratas).  
PDF

Deskripsi Hasil Akhir (Popup): Menyertakan teks yang akan keluar setelah peserta selesai (seperti penjelasan Realistic, Investigative, hingga keterangan popup mengenai pekerjaan Pilot, Insinyur, dsb).  
PDF

Dokumen ini sangat terstruktur sehingga mudah dibaca baik oleh AI maupun developer sistem!

yang tadi sudah benar sekarang tambahin untuk eksplorasi karier dan pengambilan keputusan

Mantap! File panduan_lengkap_alur_dan_penilaian.md Anda sudah diperbarui dan sekarang mencakup seluruh alur sistem dari ujung ke ujung.
Ikon MD
panduan_lengkap_alur_dan_penilaian
 MD 
Buka

Saya sudah menambahkan Bagian 5: Eksplorasi Karier dan Bagian 6: Pengambilan Keputusan Karier berdasarkan dokumen PDF yang Anda berikan.  
PDF

Di dalam struktur tersebut sudah tergambar dengan jelas:

Bagaimana peserta diminta memilih 2 karier.  
PDF

Tahapan menyusun rencana eksplorasi dan menginput datanya (Pendidikan, Jurusan, Peluang, dll).  
PDF

Tabel rangkuman komparatif yang menjajarkan hasil input Karier 1 vs Karier 2.  
PDF

Dan bagian paling krusial: bagaimana pengambilan keputusan dilakukan dengan cara "menyorot" atau menekan sel (highlight) untuk menjawab 7 soal komparasi. Sistem kemudian akan menghitung tabel karier mana yang selnya paling banyak di-highlight untuk memunculkan keputusan akhirnya secara otomatis.  
PDF
+ 1

Semuanya sudah lengkap dan terstruktur rapi. Jika tidak ada revisi, dokumen .md ini siap digunakan sebagai prompt atau panduan untuk development!






Brisk ItThis action is currently unavailable

Gemini adalah AI dan dapat melakukan kesalahan.

# Panduan Lengkap Alur dan Penilaian Asesmen Diri, Eksplorasi, & Pengambilan Keputusan

Dokumen ini merupakan panduan komprehensif yang mengintegrasikan alur antarmuka (UI/UX) yang dilalui peserta dengan cara kerja penilaian (skoring) sistem di balik layar (back-end).

---

## 1. ASESMEN MINAT

### A. Halaman Pengantar (Alur Peserta)
Peserta akan disajikan teks pengantar berikut:
> "Tahukah kamu menurut Holland (1997 dalam Rounds, Hoff, & Lewis, 2021), terdapat 6 jenis minat pekerjaan, yaitu realistic, investigative, artistic, social, enterprising, dan conventional?
> - **Realistic**: senang bekerja dengan benda / alat dan terkadang senang bekerja di luar ruangan.
> - **Investigative**: senang menganalisis dan menemukan solusi.
> - **Artistic**: senang memikirkan ide kreatif dan menciptakan inovasi.
> - **Social**: senang membantu dan menolong orang lain.
> - **Enterprising**: senang memengaruhi orang lain dan memimpin.
> - **Conventional**: senang mengatur segala sesuatu dan bekerja dengan data.
> Menurutmu, manakah minatmu? Ayo ikuti asesmen ini untuk mengetahui secara pasti minatmu.
> Bacalah aktivitas-aktivitas di halaman selanjutnya. Tandai aktivitas-aktivitas yang menarik bagimu atau yang ingin kamu lakukan. Tidak ada jawaban benar maupun salah dalam memilih aktivitas ini. Jangan mempertimbangkan pendidikan atau pelatihan yang dibutuhkan atau pun seberapa besar uang yang akan kamu hasilkan."

### B. Daftar Pernyataan & Kunci Jawaban
Peserta dapat menandai (mencentang) aktivitas. Tidak ada batasan jumlah pilihan.
*Sistem membagi daftar ini menjadi 4 halaman (Halaman 1: no 1-11, Halaman 2: no 12-22, Halaman 3: no 23-32, Halaman 4: no 33-42).*

**Daftar 42 Pernyataan beserta Kodenya (Sistem):**
1. Aku suka mengulik peralatan (Kode: 1)
2. Aku suka mengerjakan puzzle (Kode: 2)
3. Aku suka bekerja mandiri (Kode: 3)
4. Aku suka bekerja dalam kelompok (Kode: 4)
5. Aku suka membuat target untuk diriku sendiri (Kode: 5)
6. Aku suka merapikan barang-barang (buku, alat tulis, kamar) (Kode: 6)
7. Aku suka menyusun balok/LEGO® (Kode: 1)
8. Aku suka membaca buku tentang seni dan musik (Kode: 3)
9. Aku suka mengerjakan hal-hal dengan instruksi yang jelas (Kode: 6)
10. Aku suka meyakinkan teman untuk mengikuti caraku (Kode: 5)
11. Aku suka melakukan percobaan/eksperimen (Kode: 2)
12. Aku suka menjelaskan sesuatu kepada teman (Kode: 4)
13. Aku suka membantu orang lain memecahkan persoalan (Kode: 4)
14. Aku suka memelihara binatang (Kode: 1)
15. Aku tidak berkeberatan bekerja melebihi waktu yang ditentukan (Kode: 6)
16. Aku suka menjual sesuatu (Kode: 5)
17. Aku suka membuat karya berbentuk tulisan (Kode: 3)
18. Aku suka sains (Kode: 2)
19. Aku suka mendapatkan tantangan baru (Kode: 5)
20. Aku suka menghibur teman (Kode: 4)
21. Aku suka mencari tahu cara kerja sebuah alat (Kode: 2)
22. Aku suka merangkaikan atau merakit benda (Kode: 1)
23. Aku adalah orang yang kreatif (Kode: 3)
24. Aku suka memperhatikan detail (Kode: 6)
25. Aku suka merapikan catatan atau LKS (Kode: 6)
26. Aku suka mencari tahu penyebab suatu kejadian (Kode: 2)
27. Aku suka memainkan alat musik atau bernyanyi (Kode: 3)
28. Aku suka mempelajari budaya berbagai daerah (Kode: 4)
29. Aku ingin membuka usaha sendiri suatu saat nanti (Kode: 5)
30. Aku suka memasak (Kode: 1)
31. Aku suka bermain peran/drama (Kode: 3)
32. Aku suka mempraktikkan hal-hal yang aku pelajari (Kode: 1)
33. Aku suka mengerjakan soal matematika atau grafik (Kode: 2)
34. Aku suka mendiskusikan hal-hal yang terjadi di sekitarku (Kode: 4)
35. Aku suka merapikan kamarku (Kode: 6)
36. Aku suka memimpin kelompok atau kelas (Kode: 5)
37. Aku suka berkegiatan di luar ruangan (Kode: 1)
38. Aku suka berkegiatan di dalam ruangan dengan meja-kursi (Kode: 6)
39. Aku suka menghitung (Kode: 2)
40. Aku suka menolong orang (Kode: 4)
41. Aku suka menggambar (Kode: 3)
42. Aku suka berbicara di depan umum (Kode: 5)

### C. Cara Penilaian (Skoring Sistem)
- **Logika:** Dirata-rata setiap kode yang ditandai/dicentang berdasarkan jumlah masing-masing kode 1 hingga 6.
- **Keterangan Kode:**
  - 1 = Realistic
  - 2 = Investigative
  - 3 = Artistic
  - 4 = Social
  - 5 = Enterprising
  - 6 = Conventional
- **Hasil:** Dipilih **3 kode yang paling tinggi** dan ditampilkan hasilnya kepada peserta.

### D. Tampilan Hasil Asesmen Minat
Sistem akan menampilkan 3 minat tertinggi beserta penjelasannya:
- **Realistic:** Kamu dengan minat pekerjaan realistic lebih senang dengan pekerjaan yang menggunakan tangan, perkakas, atau pun mesin. Sering kali pekerjaan tersebut berkaitan dengan tanaman, hewan, maupun materi nyata...
  - *Contoh pekerjaan:* pilot, insinyur teknik sipil, ilmuwan konservasi, ahli/pengelola hutan, insinyur transportasi.
- **Investigative:** Kamu dengan minat pekerjaan investigative lebih senang bekerja dengan ide, mencari tahu sesuatu secara ilmiah, dan melakukan penelitian...
  - *Contoh pekerjaan:* ahli kimia, dokter hewan, insinyur sistem komputer, analis riset pasar, ahli gizi.
- **Artistic:** Kamu dengan minat pekerjaan artistic senang dengan pekerjaan yang membebaskan kamu untuk mengekspresikan diri dan menjadi kreatif...
  - *Contoh pekerjaan:* musisi dan penyanyi, desainer grafis, jurnalis dan reporter, desainer video game, arsitek.
- **Social:** Kamu dengan minat pekerjaan social senang dengan pekerjaan yang dapat membantu, merawat, maupun mengajari orang lain...
  - *Contoh pekerjaan:* perawat, trainer, guru, konselor, terapis.
- **Enterprising:** Kamu dengan minat pekerjaan enterprising senang dengan pekerjaan yang berkaitan dengan menjual, mengatur, serta memengaruhi lingkungan sosialmu...
  - *Contoh pekerjaan:* polisi, spesialis hubungan masyarakat, manajer keuangan, pengacara, produser dan sutradara.
- **Conventional:** Kamu dengan minat pekerjaan conventional senang dengan pekerjaan yang teratur dan melakukan pengolahan data secara sistematis...
  - *Contoh pekerjaan:* pengembang web, akuntan, aktuaris, analis keamanan informasi, analis anggaran keuangan.
*(Terdapat popup deskripsi detail untuk masing-masing contoh pekerjaan ketika kursor diarahkan, misal: Pilot bertugas mengemudikan pesawat, memeriksa mesin, dsb).*

---

## 2. ASESMEN KAPASITAS (Keterampilan)

### A. Halaman Pengantar (Alur Peserta)
Peserta akan membaca:
> "Kapasitas yang kamu miliki dapat dibagi menjadi empat bidang tugas (Prediger & Swaney, 2004):
> - **People**: kapasitas di pekerjaan yang mementingkan kemajuan orang lain/masyarakat.
> - **Data**: kapasitas di pekerjaan yang berkaitan dengan angka, pemrosesan informasi, dan mengikuti prosedur.
> - **Things**: kapasitas di pekerjaan yang berkaitan dengan perkakas, peralatan, dan mesin.
> - **Ideas**: kapasitas yang berkaitan dengan konsep, tema, maupun penemuan-penemuan.
> Tandai keterampilan yang telah kamu miliki sekarang... (dengan bukti nyata, seperti pengakuan, lomba, sertifikat)."

### B. Daftar Pernyataan & Kunci Jawaban
Peserta mencentang keterampilan yang dikuasai. Dibagi menjadi 4 halaman (Hal 1: 1-8, Hal 2: 9-16, Hal 3: 17-24, Hal 4: 25-32).

**Daftar 32 Pernyataan beserta Kodenya:**
1. Mengajar (Kode: 1)
2. Mengawasi orang lain (Kode: 1)
3. Merawat orang lain (Kode: 1)
4. Menerima atau melayani tamu (Kode: 1)
5. Memimpin rapat (Kode: 1)
6. Memimpin orang lain (Kode: 1)
7. Mendengarkan dan memberikan saran atau konsultasi (Kode: 1)
8. Menjual barang dan jasa (Kode: 1)
9. Mencatat atau membuat rekap keuangan (Kode: 2)
10. Melakukan perhitungan statistik (Kode: 2)
11. Melakukan penelitian (Kode: 2)
12. Menguji coba produk atau ide (Kode: 2)
13. Menyelidiki permasalahan (Kode: 2)
14. Menyusun program komputer (Kode: 2)
15. Mengadakan percobaan ilmiah (Kode: 2)
16. Mengumpulkan informasi (Kode: 2)
17. Memperbaiki barang (Kode: 3)
18. Mengoperasikan mesin atau peralatan (Kode: 3)
19. Menyusun rakitan (Kode: 3)
20. Menggunakan perkakas (Kode: 3)
21. Memasak atau membuat kue/roti (Kode: 3)
22. Menggunakan mesin jahit (Kode: 3)
23. Membuat barang dari kayu (Kode: 3)
24. Mendirikan bangunan (Kode: 3)
25. Menulis cerita atau puisi (Kode: 4)
26. Menciptakan lagu (Kode: 4)
27. Membuat desain produk baru (Kode: 4)
28. Menggambar (Kode: 4)
29. Menciptakan produk baru (Kode: 4)
30. Bermain peran atau menyanyi (Kode: 4)
31. Memainkan alat musik (Kode: 4)
32. Mengatur perkumpulan atau kegiatan baru (Kode: 4)

### C. Cara Penilaian (Skoring Sistem)
- **Logika:** Dirata-rata setiap kode yang ditandai/dicentang (jumlah masing-masing kode 1 hingga 4).
- **Keterangan Kode:**
  - 1 = People
  - 2 = Data
  - 3 = Things
  - 4 = Ideas
- **Hasil:** Dipilih **2 kode yang paling tinggi** dan ditampilkan hasilnya. *(Sesuai dengan dokumen Kunci Jawaban)*.

---

## 3. ASESMEN KAPASITAS (Penguasaan Mata Pelajaran)

### A. Halaman Pengantar (Alur Peserta)
Peserta diminta memilih tingkat penguasaan untuk masing-masing pelajaran:
1. Sangat tidak menguasai (0%-20%)
2. Tidak menguasai (21%-40%)
3. Cukup menguasai (41%-60%)
4. Menguasai (61%-80%)
5. Sangat menguasai (81%-100%)

### B. Daftar Mata Pelajaran
1. Pendidikan Agama dan Budi Pekerti
2. Pendidikan Pancasila dan Kewarganegaraan
3. Bahasa Indonesia
4. Matematika
5. Sejarah
6. Bahasa Inggris
7. Seni Budaya
8. Pendidikan Jasmani, Olahraga dan Kesehatan
9. Komputer
10. Bahasa Mandarin
11. Bahasa Daerah
12. Biologi
13. Fisika
14. Kimia
15. Ekonomi
16. Geografi
17. Sosiologi

### C. Cara Penilaian (Skoring Sistem)
- **Logika:** Tidak ada kode. Masing-masing opsi jawaban mewakili skor langsung (Sangat tidak menguasai = 1, dst hingga Sangat menguasai = 5).
- **Hasil:** Sistem akan menampilkan **5 mata pelajaran dengan skor tertinggi**.

---

## 4. ASESMEN NILAI KARIER

### A. Halaman Pengantar (Alur Peserta)
Peserta diperkenalkan dengan 5 kategori nilai karier: Leisure, Extrinsic rewards, Intrinsic rewards, Altruistic rewards, dan Social rewards.
Peserta diminta memilih 1 jawaban skala dari 19 pernyataan (disajikan 1 soal per halaman):
1 = Sangat tidak penting | 2 = Tidak penting | 3 = Ragu-ragu | 4 = Penting / Menguasai | 5 = Sangat penting / Sangat menguasai.

### B. Daftar Pernyataan & Kunci Jawaban
1. Pekerjaan yang memberikan kesempatan berlibur (Kode: 1)
2. Pekerjaan yang menyisakan banyak waktu untuk melakukan berbagai hal lain dalam hidup (Kode: 1)
3. Pekerjaan dengan irama santai, tidak terburu-buru (Kode: 1)
4. Pekerjaan yang cukup bebas dari pengawasan orang lain (Kode: 1)
5. Pekerjaan yang berisi tugas-tugas menarik (Kode: 3)
6. Pekerjaan yang membuka kesempatan untuk belajar hal baru maupun keterampilan baru (Kode: 3)
7. Pekerjaan di mana keterampilan yang dimiliki tidak akan pernah usang (Kode: 3)
8. Pekerjaan di mana apa yang kita kerjakan hasil akhirnya dapat dilihat (Kode: 3)
9. Pekerjaan yang memanfaatkan keterampilan dan kemampuan diri (Kode: 3)
10. Pekerjaan dimana bisa menampilkan diri apa adanya (Kode: 3)
11. Pekerjaan yang memberi kesempatan untuk kreatif (Kode: 3)
12. Pekerjaan yang memberi kesempatan untuk menolong orang lain secara langsung (Kode: 4)
13. Pekerjaan yang memberi manfaat bagi masyarakat (Kode: 4)
14. Pekerjaan yang memberi kesempatan untuk menjalin pertemanan (Kode: 5)
15. Pekerjaan yang memungkinkan untuk berelasi dengan banyak orang (Kode: 5)
16. Pekerjaan dengan status sosial tinggi dan berprestise (Kode: 2)
17. Pekerjaan yang dihormati oleh orang lain (Kode: 2)
18. Pekerjaan yang memberikan kesempatan untuk menghasilkan banyak uang (Kode: 2)
19. Pekerjaan yang memberikan peluang bagus untuk pengembangan karir dan promosi (Kode: 2)

### C. Cara Penilaian (Skoring Sistem)
- **Logika:** Skor dari jawaban peserta (1 hingga 5) dirata-rata untuk masing-masing kode.
- **Keterangan Kode:**
  - 1 = Leisure
  - 2 = Extrinsic Rewards
  - 3 = Intrinsic Rewards
  - 4 = Altruistic Rewards
  - 5 = Social Rewards
- **Hasil:** Menampilkan **3 nilai kerja (kode) dengan skor rata-rata tertinggi**.

---

## 5. EKSPLORASI KARIER

### A. Memilih Pekerjaan untuk Dieksplorasi (Alur Peserta)
1. Peserta disajikan kolom untuk menuliskan **2 pekerjaan** yang sesuai dengan minat mereka untuk dieksplorasi lebih lanjut.
2. Terdapat **pengingat hasil asesmen minat** (menampilkan 3 minat teratas dari hasil asesmen sebelumnya beserta penjelasannya untuk membantu peserta memilih).

### B. Merancang Eksplorasi
Peserta membaca instruksi mengenai pentingnya mencari informasi tentang karier yang diminati (seperti pendidikan tinggi, jurusan, keterampilan, peluang, dll) dan dari mana sumbernya (misal: orang ahli, web O*NET, guru BK).
Selanjutnya, peserta mengisi **Rencana Eksplorasi** (sumber informasinya secara spesifik):
1. Aku akan mencari tahu mengenai pendidikan tinggi, jurusan dan mata kuliah melalui...
2. Aku akan mencari tahu mengenai keterampilan yang perlu aku kuasai melalui...
3. Aku akan mencari tahu mengenai pelatihan formal/pendidikan lanjutan yang perlu aku tempuh melalui...
4. Aku akan mencari tahu mengenai sertifikasi yang perlu aku jalani melalui...
5. Informasi-informasi mengenai peluang karier akan aku peroleh dari...
6. Aku akan mencari tahu mengenai tugas/tanggung jawab dari karier tersebut melalui...
7. Aku akan mencari tahu informasi lainnya melalui...

### C. Menuliskan Hasil Eksplorasi (Input Peserta)
Peserta mengisi hasil pencarian mereka secara spesifik untuk masing-masing dari 2 karier yang telah mereka pilih. Formulir ini muncul 2 kali.
1. Pendidikan tinggi yang harus ditempuh: *(pilihan Vokasi atau Sarjana)*
2. Jurusan yang paling sesuai: *(isian teks)*
3. Mata kuliah yang perlu dilalui: *(isian teks)*
4. Keterampilan yang perlu dikuasai: *(isian teks)*
5. Pelatihan formal/pendidikan lain: *(isian teks)*
6. Sertifikasi yang perlu diambil: *(isian teks)*
7. Peluangnya di masa depan: *(isian teks)*
8. Tugas/tanggung jawab pekerjaan: *(isian teks)*
9. Informasi lain yang menarik/penting: *(isian teks)*

### D. Rangkuman Hasil Eksplorasi
Sistem akan menampilkan tabel rangkuman komparatif yang menyandingkan hasil eksplorasi **Karier 1** dan **Karier 2** secara bersebelahan berdasarkan 9 aspek di atas.

---

## 6. PENGAMBILAN KEPUTUSAN KARIER

### A. Pengantar & Evaluasi Diri (Alur Peserta)
Peserta disambut di tahap Pengambilan Keputusan. Di sini, sistem menyajikan kembali rangkuman dari seluruh asesmen yang telah dilakukan peserta sebelumnya, yang mencakup:
* **Minatku**: 3 hasil teratas (dilengkapi popup penjelasan).
* **Kapasitasku**: 1 bidang tertinggi & 5 mata pelajaran teratas (dilengkapi popup penjelasan).
* **Nilai Karierku**: 3 nilai karier teratas (dilengkapi popup penjelasan).

Serta, sistem menampilkan kembali **Tabel Hasil Eksplorasi Karier** (Perbandingan Karier 1 vs Karier 2).

### B. Proses Komparasi (Alur Penilaian Otomatis & Manual)
Peserta akan dipandu untuk menjawab serangkaian pertanyaan dan membandingkannya dengan tabel Hasil Eksplorasi. **Sistem menyediakan fitur "Highlight" (menandai sel dalam tabel dengan warna).**
Peserta akan menjawab dengan cara menekan sel pada tabel karier 1 atau karier 2 yang paling sesuai, atau memilih opsi "Lewati" jika tidak ada yang sesuai.

**Daftar Pertanyaan Komparasi:**
* **Soal 1:** Bandingkan antara mata pelajaran yang kamu kuasai dengan mata kuliah yang perlu kamu tempuh di masing-masing karier. Apakah mata kuliah di dalamnya sesuai dengan kapasitasmu saat ini?
* **Soal 2:** Bandingkan antara bidang kapasitas yang kamu kuasai dengan keterampilan yang perlu kamu kuasai. Apakah keterampilan tersebut sesuai dengan kapasitasmu saat ini?
* **Soal 3:** Bandingkan antara mata pelajaran dan bidang kapasitas yang kamu kuasai dengan pelatihan formal atau pendidikan lanjut yang perlu kamu tempuh. Apakah pelatihan formal atau pendidikan lanjut tersebut sesuai dengan kapasitasmu saat ini?
* **Soal 4:** Bandingkan antara mata pelajaran dan bidang kapasitas yang kamu kuasai dengan sertifikasi yang perlu kamu ambil. Apakah sertifikasi tersebut sesuai dengan kapasitasmu saat ini?
* **Soal 5:** Bandingkan antara nilai kariermu dengan peluang kariernya. Apakah peluang tersebut sesuai dengan nilai kariermu?
* **Soal 6:** Bandingkan antara minatmu, kapasitasmu, atau nilai kariermu dengan tugas/tanggung jawab dari karier tersebut. Apakah tugas/tanggung jawab tersebut sesuai dengan minatmu, kapasitasmu, atau nilai kariermu?
* **Soal 7:** Bandingkan antara minatmu, kapasitasmu, atau nilai kariermu dengan informasi lain dari karier tersebut. Apakah informasi yang kamu peroleh tersebut sesuai dengan minatmu, kapasitasmu, atau nilai kariermu?

### C. Hasil Keputusan Akhir (Sistem)
- **Logika Sistem:** Sistem akan menghitung secara otomatis karier mana (antara Karier 1 atau Karier 2) yang sel/kolomnya paling banyak di-highlight oleh peserta dari Soal 1 hingga Soal 7.
- **Tampilan Akhir:** Sistem memunculkan teks: *"Berdasarkan perbandingan yang aku lakukan, pekerjaan yang paling banyak sesuai dengan diriku: **[Nama Karier Pemenang]**."*
*(Catatan: Jika jumlah highlight seimbang, sistem akan menampilkan kedua karier tersebut).*
Peserta kemudian dapat mengunduh hasil akhir ini dalam bentuk PDF.


Penjelasan minat kerja
Realistic: Kamu dengan minat pekerjaan realistic lebih senang dengan pekerjaan yang menggunakan tangan, perkakas, atau pun mesin. Sering kali pekerjaan tersebut berkaitan dengan tanaman, hewan, maupun materi nyata, seperti kayu, perkakas, dan mesin. Kamu yang memiliki minat ini menyukai pekerjaan yang melibatkan pemecahan masalah secara langsung pada benda nyata dan terkadang bekerja di luar ruangan adalah hal yang menyenangkan untukmu.
Contoh pekerjaan yang sesuai: pilot, insinyur teknik sipil, ilmuwan konservasi, ahli/pengelola hutan, insinyur transportasi

Investigative
Kamu dengan minat pekerjaan investigative lebih senang bekerja dengan ide, mencari tahu sesuatu secara ilmiah, dan melakukan penelitian. Sering kali pekerjaan tersebut membutuhkan banyak pemikiran. Kamu yang memiliki minat ini menyukai pekerjaan yang melibatkan pencarian fakta dan pemecahan masalah secara abstrak.
Contoh pekerjaan yang sesuai: ahli kimia, dokter hewan, insinyur sistem komputer, analis riset pasar, ahli gizi

Artistic
Kamu dengan minat pekerjaan artistic senang dengan pekerjaan yang membebaskan kamu untuk mengekspresikan diri dan menjadi kreatif. Sering kali pekerjaan tersebut berkaitan dengan seni pertunjukan, tulisan, maupun visual. Kamu yang memiliki minat ini menyukai pekerjaan yang berkaitan dengan bentuk, desain, dan pola serta tidak suka mengikuti aturan.
Contoh pekerjaan yang sesuai: musisi dan penyanyi, desainer grafis, jurnalis dan reporter, desainer video game, arsitek
Social
Kamu dengan minat pekerjaan social senang dengan pekerjaan yang dapat membantu, merawat, maupun mengajari orang lain. Sering kali pekerjaan ini membutuhkan kamu untuk mendampingi atau menyediakan layanan bagi orang lain.
Contoh pekerjaan yang sesuai: perawat, trainer, guru, konselor, terapis

Enterprising
Kamu dengan minat pekerjaan enterprising senang dengan pekerjaan yang berkaitan dengan menjual, mengatur, serta memengaruhi lingkungan sosialmu dan umumnya berkaitan dengan bisnis. Sering kali pekerjaan di bidang ini membutuhkan kamu untuk mengawasi orang, memimpin proyek, dan membuat keputusan.
Contoh pekerjaan yang sesuai: polisi, spesialis hubungan masyarakat, manajer keuangan, pengacara, produser dan sutradara

Conventional
Kamu dengan minat pekerjaan conventional senang dengan pekerjaan yang teratur dan melakukan pengolahan data secara sistematis serta dengan standar yang jelas dan sering kali berkaitan dengan bisnis. Kamu dengan minat pekerjaan di bidang ini senang mengikuti aturan dan memperhatikan detail.
Contoh pekerjaan yang sesuai: pengembang web, akuntan, aktuaris, analis keamanan informasi, analis anggaran keuangan 

Ketika kursor digeser ke pekerjaan, akan muncul pop up keterangan:
Pilot: Ketika kamu bekerja sebagai pilot, kamu bertugas untuk mengemudikan pesawat maupun helikopter, memeriksa pesawat sebelum keberangkatan, memantau pengoperasian mesin, bahan bakar, serta fungsi sistem pesawat, dan termasuk melakukan perhitungan kecepatan mengudara dengan berbagai pertimbangan. 

Insinyur teknik sipil: Ketika kamu bekerja sebagai insinyur teknik sipil, kamu bertugas untuk mengelola, mengarahkan, dan memantau kegiatan konstruksi, termasuk memastikan pemeliharaan lokasi proyek, keselamatan, dan mengikuti peraturan pemerintah, melakukan perhitungan terkait spesifikasi desain bangunan, dan merancang sistem atau struktur terkait bangunan dengan menggambar atau menggunakan komputer.

Ilmuwan konservasi: Kamu yang memilih profesi ilmuwan konservasi perlu merencanakan dan menerapkan secara langsung prinsip ilmu agronomi, ilmu tanah, kehutanan, atau pertanian untuk melakukan konservasi. Selain itu, kamu juga perlu memantau proyek secara langsung, memberikan solusi pada pengguna lahan konservasi.

Ahli/pengelola hutan: Ketika kamu menjadi seorang ahli/pengelola hutan, kamu bertugas untuk merencanakan dan mengawasi proyek hutan sesuai aturan pemerintah serta menentukan metode pengelolaan hutan dengan limbah dan kerusakan hutan yang minim.

Insinyur transportasi: Ketika menjadi insinyur transportasi, kamu perlu merencanakan serta memeriksa rancangan, desain, atau biaya untuk memastikan kelengkapan, akurasi, atau kesesuaian standar proyek sistem transportasi dan berunding dengan kontraktor, perusahaan utilitas atau instansi pemerintah untuk membahas perencanaan proyek.

Ahli kimia: Apabila kamu memilih menjadi ahli kimia, kamu perlu melakukan praktik dan analisis senyawa dengan menggunakan teknik tertentu, baik secara kuantitatif dan kualitatif, melakukan kendali mutu, memelihara dan menyiapkan instrumen serta bahan laboratorium, memastikan prosedur penelitian yang tepat, serta memecahkan masalah malfungsi yang terjadi.

Dokter hewan: Ketika kamu memilih profesi dokter hewan, kamu bertugas untuk memeriksa penyakit hewan, mengumpulkan jaringan tubuh (termasuk feses, darah, urin atau cairan lainnya) untuk diperiksa, merawat (termasuk melakukan operasi) serta meresepkan obat bagi hewan yang terluka, dan menggunakan peralatan yang mendukung pemeriksaan atau perawatan terhadap hewan.

Insinyur sistem komputer: Kamu yang bekerja sebagai insinyur sistem komputer bertugas untuk mengembangkan rekayasa perangkat lunak, mengidentifikasi data sistem, perangkat keras maupun komponen perangkat lunak untuk memenuhi kebutuhan pelanggan, berkomunikasi dengan rekan kerja/klien untuk memahami persyaratan sistem tertentu, dan memverifikasi stabilitas, keamanan, maupun aspek lain terkait sistem komputer.

Analis riset pasar: Apabila kamu menjadi analis riset pasar, kamu merancang metode dan prosedur penelitian terhadap pasar, mengumpulkan data serta menganalisis data untuk mengidentifikasi opini konsumen, pasar potensial, maupun strategi pemasaran, berkolaborasi dengan profesional lainnya yang berkaitan (ahli statistik, lembaga survei, dll), mengevaluasi penelitian, dan menyiapkan serta menyampaikan laporan dari temuan.

Ahli gizi: Seorang ahli gizi perlu mengkaji kebutuhan gizi dan diet, menerapkan rencana diet, dan memberikan konseling maupun saran pada pasien dan keluarga, melakukan evaluasi tes laboratorium untuk menyusun rekomendasi gizi, serta menggabungkan preferensi budaya, etnis, atau agama dalam mengembangkan rencana gizi.

Musisi dan penyanyi: Kamu yang ingin menjadi musisi atau penyanyi perlu mampu tampil secara langsung di hadapan penonton, menerapkan pengetahuan tentang musik untuk memodifikasi musik agar minat penonton tetap bertahan, memainkan instrumen musik tertentu, dan bernyanyi solo atau sebagai anggota grup.

Desainer grafis: Apabila kamu seorang desainer grafis, kamu perlu berunding dengan klien untuk menentukan desain, membuat konsep dan desain grafis untuk ilustrasi produk  dengan menentukan ukuran, gaya, atau bahan berdasarkan prinsip tata letak dan konsep desain estetika, serta menggunakan perangkat lunak untuk menghasilkan gambar.

Analis berita, jurnalis dan reporter: Ketika kamu menjadi analis berita, jurnalis maupun reporter, kamu perlu menentukan topik yang akan diberitakan, memeriksa isi berita, menganalisis, dan menginterpretasikan berita, menuliskan dan mengembangkan skrip berita, serta mengkoordinasi dan menjadi anchor dalam siaran berita.

Desainer video game: Kamu yang berprofesi sebagai desainer video game perlu merancang fitur, alur cerita dan misi, mekanisme permainan, dan biografi karakter, mengumpulkan umpan balik dan melakukan tinjauan desain selama pengembangan game, serta menyeimbangkan dan menyesuaikan pengalaman gameplay agar produk sukses. 

Arsitek: Arsitek memiliki tugas untuk menyiapkan gambar skala dan desain arsitektur yang mencakup unsur estetika dari struktur atau detail kontruksi (termasuk bahan, warna, peralatan, perkiraan biaya, dan waktu konstruksi), serta berkonsultasi dengan klien untuk mendiskusikan gambar arsitektur.

Perawat: Jika kamu menjadi perawat, kamu perlu mencatat secara terperinci mengenai kesehatan pasien, mengembangkan rencana perawatan sesuai standar perawatan, memberikan informasi kesehatan kepada pasien, menganalisis dan menerjemahkan riwayat sakit pasien, dan mengobati pasien.

Trainer: Jika kamu menjadi trainer, kamu perlu melakukan survei atau wawancara untuk mengetahui kebutuhan klien, menawarkan program pelatihan sesuai kebutuhan, menyajikan pelatihan dengan berbagai bentuk (ceramah, diskusi, video, dll), membuat dan mengembangkan manual dan materi pelatihan, serta mengevaluasi pelatihan. 

Guru: Jika kamu menjadi guru, kamu perlu mempersiapkan tujuan belajar berdasarkan kurikulum dan dikomunikasikan pada siswa, menyesuaikan metode dan materi pengajaran sesuai kebutuhan dan minat siswa, mendorong dan mempersiapkan siswa untuk belajar di tingkat selanjutnya, serta menegakkan aturan dan menjaga ketertiban kelas.

Konselor: Ketika kamu menjadi konselor, kamu perlu melakukan asesmen/tes pada klien, mendorong klien mengungkapkan perasaannya, mendiskusikan dan membantu klien untuk mengembangkan diri, melakukan konseling individu maupun kelompok, serta menjaga kerahasiaan data klien, mempersiapkan dan menjaga catatan intervensi klien.

Terapis: Apabila kamu memilih menjadi terapis, kamu perlu memotivasi, melindungi dan memberikan terapi pada pasien, baik secara manual maupun dengan teknologi tertentu, membawa pasien ke dan dari area terapi dengan kursi roda, mencatat perawatan yang diberikan dan peralatan yang digunakan, serta membersihkan area kerja dan alat terapi.

Polisi: Ketika kamu menjadi polisi, kamu perlu menjaga keamanan publik, menanggapi keadaan darurat serta memberikan bantuan pada korban kecelakaan, mengidentifikasi, mengejar dan menangkap tersangka, meninjau fakta insiden untuk menentukan tindakan kriminal atau pelanggaran undang-undang, serta membuat catatan dokumentasi insiden.

Spesialis hubungan masyarakat: Kamu yang berprofesi sebagai spesialis hubungan masyarakat perlu merencanakan dan mengomunikasikan program untuk mempertahankan persepsi publik, menulis siaran pers dan menanggapi media luar, memasang dan memperbarui konten di situs web atau media sosial, serta bekerjasama dengan publik.

Manajer keuangan: Kamu yang memilih berprofesi sebagai manajer keuangan memiliki tugas untuk memeliharan hubungan dengan klien serta memberikan bantuan terhadap masalah keuangan klien, mengawasi dan mengevaluasi arus keuangan untuk merencanakan anggaran, merencanakan, mengarahkan, atau mengoordinasikan aktivitas keuangan di kantor pusat, cabang, bahkan juga merekrut staf keuangan.

Pengacara: Pengacara memiliki tugas untuk menganalisis kasus, memberitahu klien mengenai tanggung jawab, tuntutan hukum, hak dan kewajiban hukum, melakukan debat dan bertanya pada saksi selama persidangan, menafsirkan hukum atau keputusan pada klien, dan memberikan bukti untuk membela klien atau menuntut terdakwa.

Produser dan sutradara: Apabila kamu menjadi produser atau sutradara, kamu perlu merencanakan secara detail pergerakan aktor, pergerakan kamera dan suara untuk setiap adegan, berkomunikasi dengan aktor terkait akting yang diperlukan, melakukan siaran langsung, rekaman film atau program televisi, melakukan penelitian terkait topik yang akan diproduksi serta meninjau kesesuaian standar produksi dan penyiaran.

Pengembang web: Apabila kamu menjadi pengembang web, kamu perlu merancang atau memelihara situs web dengan menggunakan koding atau aplikasi yang membantu, menyimpan cadangan file dari situs web ke direktori lokal untuk pemulihan instan ketika terjadi masalah, memilih bahasa pemrograman serta alat atau aplikasi desain, serta mengevaluasi koding agar memenuhi standar, valid, dan dapat berjalan dengan baik.

Akuntan dan auditor: Ketika kamu menjadi akuntan atau auditor, kamu perlu menyiapkan laporan audit secara rinci, melaporkan hasil audit dan merekomendasikan aktivitas keuangan, mengumpulkan dan menganalisis data untuk mendeteksi kesalahan dalam keuangan (kontrol yang kurang, penipuan, dll), memeriksa buku rekening dan sistem akuntansi agar efektif dan efisien, serta mengawasi dan menentukan ruang lingkup audit.

Aktuaris: Aktuaris memiliki tugas untuk merancang, meninjau, dan membantu mengelola rencana asuransi dan dana pensiun, menentukan kesehatan keuangan, dan menghitung premi serta memberikan saran pada klien terkait keuangannya, membantu menentukan kebijakan dan menjelasan masalah teknis terkait polis keuangan, dan menganalisis informasi statistik mengenai tingkat kematian, kecelakaan, sakit, cacat, dan pensiun.

Analis keamanan informasi: Kamu yang ingin berprofesi menjadi analis keamanan informasi memiliki tugas untuk mengembangkan rencana perlindungan informasi komputer, memantau perkembangan virus komputer untuk menentukan pembaharuan sistem perlindungan, mengenkripsi atau memasang firewall untuk menyembunyikan informasi rahasia untuk mencegah kebocoran data, melakukan uji coba dan penilaian risiko pemrosesan data, serta memodifikasi keamanan komputer.

Analis anggaran keuangan: Ketika kamu menjadi analis anggaran keuangan, kamu perlu meringkas anggaran, memeriksa perkiraan anggara dan kesesuaiannya dengan peraturan, menentukan persetujuan atau penolakan terhadap anggaran, menganalisis laporan anggaran serta akuntansi bulanan untuk mengontrol pengeluaran, serta memberikan saran terhadap analisis biaya dan persiapan anggaran.

Keterangan Kapasitas:
People
Kamu dengan kapasitas di bidang pekerjaan people berarti kamu memiliki kemampuan atau keterampilan di bidang yang dapat bekerja dengan orang atau membantu orang lain. Bidang pekerjaan ini mementingkan kemajuan orang lain/masyarakat.

Data
Kamu dengan kapasitas di bidang pekerjaan data berarti kamu memiliki kemampuan atau keterampilan di bidang yang dapat bekerja dengan data dan angka. Kamu juga memiliki kapasitas dalam mengolah informasi, mengikuti aturan atau prosedur.

Things
Kamu dengan kapasitas di bidang pekerjaan things berarti kamu memiliki kemampuan atau keterampilan di pekerjaan yang berkaitan dengan benda. Kamu juga memiliki kapasitas dalam menggunakan perkakas, peralatan, maupun mesin.

Ideas
Kamu dengan kapasitas di bidang pekerjaan ideas berarti kamu memiliki kemampuan atau keterampilan di pekerjaan yang berkaitan dengan ide, konsep ataupun tema. Kamu juga memiliki kapasitas untuk membuat suatu penemuan atau kreasi.

KETERANGAN NILAI KARIR DETAIL

Leisure
Kamu dengan nilai kerja leisure lebih senang karier yang memberikan waktu untuk kamu berkumpul dengan keluarga atau menjalani kehidupan personal. Kamu mengharapkan pekerjaan yang dapat dilakukan jarak jauh atau fleksibel, sehingga kamu dapat menghabiskan waktu untuk keluarga dan teman.

Extrinsic rewards
Kamu dengan nilai kerja extrinsic rewards menyukai pekerjaan dengan adanya imbalan yang diberikan oleh orang lain. Penghargaan tersebut dapat berupa gaji, harta benda, maupun prestise/kehormatan.

Intrinsic rewards
Apabila kamu memiliki nilai kerja intrinsic rewards, kamu menganggap hal penting dari pekerjaan adalah adanya imbalan dari dalam diri sebagai motivasi kamu bekerja. Imbalan tersebut dapat berupa pekerjaan yang terasa menantang dan adanya peningkatan keterampilan atau pengembangan diri.

Altruistic rewards
Apabila kamu memiliki nilai kerja altruistic rewards, artinya kamu mementingkan bekerja untuk membantu orang lain. Kamu lebih mengutamakan pekerjaan yang dapat menolong orang lain dibandingkan mementingkan diri sendiri.

Social rewards
Kamu dengan nilai karier social rewards lebih menyukai pekerjaan yang dapat berelasi dengan orang lain dalam waktu lama. Kamu senang apabila pekerjaanmu dapat membuatmu terhubung dengan beragam kelompok sosial.
