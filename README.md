# 🏡 Portal Digital & Informasi Warga RT 08 RW 02 — Desa Penambangan

[![Laravel Version](https://img.shields.io/badge/Laravel-11.x-red.svg?logo=laravel&style=flat-square)](https://laravel.com)
[![TailwindCSS Version](https://img.shields.io/badge/TailwindCSS-v4.0-38bdf8.svg?logo=tailwind-css&style=flat-square)](https://tailwindcss.com)
[![Vite Version](https://img.shields.io/badge/Vite-v8.x-646cff.svg?logo=vite&style=flat-square)](https://vitejs.dev)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D_8.2-777bb4.svg?logo=php&style=flat-square)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](https://opensource.org/licenses/MIT)

Aplikasi web **Portal Digital Warga RT 08 RW 02 Desa Penambangan** merupakan sistem informasi pelayanan administrasi dan komunikasi warga yang dibangun khusus untuk mendigitalisasi rukun tetangga secara transparan, modern, dan kekeluargaan. Proyek ini dikembangkan sebagai bagian dari program **Kerja Praktik (KP)**.

Sistem ini didesain menggunakan tema **"Desa Hijau & Asri"** yang memadukan estetika modern *glassmorphic* dengan warna hijau zamrud (*emerald*), teal, dan krem lembut (`#FAF9F5`). Skema visual ini ramah mata, berukuran longgar (*elder-friendly*), dan sangat mudah digunakan oleh warga dari segala rentang usia.

---

## 🌟 Fitur Utama Portal Warga

### 🏠 1. Beranda Warga (Bento-Style Dashboard)
* **Sapaan Kekeluargaan**: Menyambut warga secara hangat berdasarkan waktu hari (Pagi/Siang/Sore/Malam).
* **Menu Bento Raksasa**: Navigasi intuitif dengan ikon menarik yang memudahkan akses cepat ke seluruh fitur utama.
* **Sekilas Informasi**: Menampilkan status pengajuan surat aktif dan agenda terdekat warga langsung di halaman utama.

### 📄 2. Pengajuan Surat Pengantar Online
* **Pendaftaran Mandiri**: Warga dapat mengajukan Surat Pengantar RT (untuk keperluan KTP, KK, SKCK, dll) tanpa harus bertatap muka langsung.
* **Pelacakan Transparan**: Status real-time yang informatif (`Menunggu`, `Sedang Dibuat`, `Siap Diambil`, `Perlu Diperbaiki`).
* **Kertas Surat Fisik**: Detail surat disajikan layaknya kertas fisik resmi dan dilengkapi dengan tombol unduh PDF resmi.

### 📢 3. Layanan Pengaduan & Aspirasi Warga
* **Pelaporan Mudah**: Warga dapat mengirimkan aduan lingkungan (keamanan, sampah, infrastruktur) dengan menyertakan bukti foto langsung dari HP.
* **WhatsApp-Style Chat**: Tanggapan dan balasan dari Pak RT disajikan dalam bentuk antarmuka percakapan bergaya balon obrolan WhatsApp yang akrab dan mudah dipahami.
* **Aduan Rahasia**: Opsi untuk menyembunyikan identitas pelapor demi kenyamanan dan keamanan privasi.

### 📌 4. Papan Mading Pengumuman RT
* **Desain Mading Melayang**: Pengumuman dari pengurus RT disajikan dengan tipografi berjarak renggang agar nyaman dibaca oleh lansia.
* **Bagikan ke WhatsApp**: Fitur instan untuk membagikan tautan kabar penting warga langsung ke grup obrolan WhatsApp warga sekali klik.

### 🤝 5. Agenda & Kegiatan Sosial Desa
* **Kalender Kegiatan**: Daftar jadwal kerja bakti, posyandu ceria, rapat RT, dan kegiatan keagamaan secara rapi.
* **Badge Status Aktif**: Status kegiatan berkode warna dinamis (🔴 Hari Ini, Selesai, Mendatang).
* **Kartu Lokasi & Ajakan**: Detail lokasi terperinci dilengkapi spanduk ajakan kekeluargaan yang ramah.

### 👤 6. Profil Warga & Keamanan
* **Integrasi NIK Fisik**: Akun warga terverifikasi secara otomatis dengan database NIK RT 08 fisik.
* **Biodata Terstruktur**: Menampilkan data Kependudukan (KK, Kepala Keluarga, Status Aktif) secara terorganisir.
* **Ganti Sandi Mandiri**: Pengguna dapat memperbarui nama tampilan, email, dan sandi akun secara mandiri.

### 📱 7. Navigasi Khusus Perangkat HP (Mobile Sticky Nav)
* Antarmuka aplikasi mobile-first yang membuang hamburger menu berantakan dan menggantinya dengan **sticky bottom navigation bar** seperti aplikasi native di smartphone umumnya untuk jangkauan jempol yang ideal.

---

## 🛠️ Spesifikasi Teknologi (Tech Stack)

* **Backend**: Laravel 11.x (PHP >= 8.2)
* **Frontend Styles**: TailwindCSS v4.0.0 (menggunakan variabel warna kustom krem asri & visual elegan)
* **Assets Bundler**: Vite v8.x
* **Database**: MySQL 8.x
* **Server Lokal**: Laragon / XAMPP (Windows environment)

---

## 🚀 Panduan Instalasi Lokal

Silakan ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda (menggunakan Laragon/XAMPP):

### 1. Prasyarat Sistem
Pastikan komputer Anda sudah terinstal:
* **PHP >= 8.2**
* **Composer**
* **Node.js & NPM**
* **MySQL / MariaDB**

### 2. Kloning Repositori
```bash
git clone https://github.com/Habib-prdtr/KerjaPraktik_RT.git
cd KerjaPraktik_RT
```

### 3. Instalasi Dependensi PHP & JavaScript
```bash
# Instal dependensi composer backend
composer install

# Instal dependensi npm frontend
npm install
```

### 4. Konfigurasi Lingkungan (`.env`)
Salin file konfigurasi contoh dan sesuaikan pengaturannya:
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan koneksi database MySQL lokal Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kp_rt
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Migrasi Database & Seeding
Jalankan migrasi tabel beserta data awal contoh (seeders) ke database lokal Anda:
```bash
php artisan migrate --seed
```

### 7. Jalankan Server Pengembangan
Jalankan server backend PHP:
```bash
php artisan serve
```
Dan jalankan kompilasi aset frontend Vite (di tab terminal baru):
```bash
# Untuk mode pengembangan (hot reload)
npm run dev

# ATAU untuk membangun berkas produksi statis
npm run build
```

Aplikasi kini dapat diakses di browser melalui alamat: `http://127.0.0.1:8000`

---

## 👥 Pengguna Uji Coba Default (Seeder)

Anda dapat masuk ke dalam portal menggunakan akun contoh berikut setelah menjalankan database seeder:

* **Akun Warga**:
  * Email: `warga@warga.com`
  * Sandi: `password`
* **Akun Admin (Pak RT)**:
  * Email: `admin@admin.com`
  * Sandi: `password`

---

## 📄 Lisensi

Proyek aplikasi web ini bersifat open-source dan berlisensi di bawah **[MIT License](LICENSE)**.

---
<p align="center">
  Dibuat dengan rasa cinta terhadap ketertiban dan kemakmuran warga • <b>RT 08 RW 02 Ds. Penambangan</b> 💚
</p>
