<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Warga;
use App\Models\KartuKeluarga;
use App\Models\Surat;
use App\Models\Pengajuan;
use App\Models\Pengumuman;
use App\Models\KegiatanRt;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Kartu Keluarga (KK)
        $kk1 = KartuKeluarga::create([
            'no_kk' => '1234567890123456',
            'kepala_keluarga' => 'Budi Santoso',
            'alamat' => 'Jl. Merpati No. 10, RT 01 RW 01',
            'rt' => '01',
            'rw' => '01',
        ]);

        $kk2 = KartuKeluarga::create([
            'no_kk' => '1234567890123457',
            'kepala_keluarga' => 'Siti Aminah',
            'alamat' => 'Jl. Merpati No. 12, RT 01 RW 01',
            'rt' => '01',
            'rw' => '01',
        ]);

        // 2. Seed Warga
        $wargaAdmin = Warga::create([
            'kartu_keluarga_id' => $kk1->id,
            'nik' => '3201010101010001',
            'nama' => 'Admin RT',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '1985-05-20',
            'agama' => 'Islam',
            'pekerjaan' => 'Wiraswasta',
            'status_perkawinan' => 'Menikah',
            'status' => 'aktif',
        ]);

        $warga1 = Warga::create([
            'kartu_keluarga_id' => $kk1->id,
            'nik' => '3201010101010002',
            'nama' => 'Budi Santoso',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '1980-01-15',
            'agama' => 'Islam',
            'pekerjaan' => 'PNS',
            'status_perkawinan' => 'Menikah',
            'status' => 'aktif',
        ]);

        $warga2 = Warga::create([
            'kartu_keluarga_id' => $kk2->id,
            'nik' => '3201010101010003',
            'nama' => 'Siti Aminah',
            'jenis_kelamin' => 'P',
            'tanggal_lahir' => '1988-11-10',
            'agama' => 'Islam',
            'pekerjaan' => 'Ibu Rumah Tangga',
            'status_perkawinan' => 'Menikah',
            'status' => 'aktif',
        ]);

        // 3. Seed Users
        // Admin
        $admin = User::create([
            'name' => 'Admin RT',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'warga_id' => $wargaAdmin->id,
        ]);

        // Warga 1
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'warga',
            'warga_id' => $warga1->id,
        ]);

        // 4. Seed Pengumuman
        Pengumuman::create([
            'judul' => 'Kerja Bakti Rutin',
            'isi' => 'Diharapkan seluruh warga RT 01 hadir dalam acara kerja bakti rutin pada hari Minggu besok untuk membersihkan selokan.',
            'tanggal' => now()->toDateString(),
            'created_by' => $admin->id,
        ]);

        // 5. Seed Kegiatan RT
        KegiatanRt::create([
            'nama_kegiatan' => 'Rapat Bulanan RT',
            'deskripsi' => 'Pembahasan keamanan lingkungan dan iuran bulanan.',
            'tanggal' => now()->addDays(5)->toDateString(),
            'lokasi' => 'Rumah Ketua RT',
            'created_by' => $admin->id,
        ]);

        // 6. Seed Surat
        Surat::create([
            'warga_id' => $warga1->id,
            'jenis_surat' => 'Surat Keterangan Domisili',
            'nomor_surat' => 'RT-001/05/2026',
            'keperluan' => 'Pendaftaran Sekolah Anak',
            'status' => 'selesai',
        ]);

        Surat::create([
            'warga_id' => $warga2->id,
            'jenis_surat' => 'Surat Pengantar KTP',
            'nomor_surat' => 'RT-002/05/2026',
            'keperluan' => 'Perpanjangan KTP',
            'status' => 'diajukan',
        ]);

        // 7. Seed Pengajuan (Pengaduan)
        Pengajuan::create([
            'warga_id' => $warga1->id,
            'judul' => 'Lampu Jalan Mati',
            'isi' => 'Lampu jalan di depan rumah No. 10 mati sudah 3 hari, mohon segera diperbaiki karena gelap saat malam.',
            'status' => 'dikirim',
        ]);

        Pengajuan::create([
            'warga_id' => $warga2->id,
            'judul' => 'Sampah Menumpuk',
            'isi' => 'Petugas sampah sudah 2 hari tidak lewat, sampah mulai berbau.',
            'status' => 'diproses',
            'tanggapan_admin' => 'Akan segera dikoordinasikan dengan petugas kebersihan kelurahan.',
        ]);
    }
}
