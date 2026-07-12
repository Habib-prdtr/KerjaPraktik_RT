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
use Illuminate\Support\Facades\Schema;

/**
 * DatabaseSeeder
 *
 * Entry point utama untuk seluruh proses seeding database.
 * Seeder ini mengorkestrasi urutan pemanggilan semua seeder
 * yang diperlukan agar data antar tabel konsisten (tidak melanggar
 * foreign key constraint).
 *
 * ┌─────────────────────────────────────────────────────────────────┐
 * │                    URUTAN SEEDING                               │
 * ├────┬────────────────────────────┬────────────────────────────── │
 * │ #  │ Seeder                     │ Keterangan                     │
 * ├────┼────────────────────────────┼────────────────────────────── │
 * │ 1  │ KartuKeluargaSeeder        │ 10 KK — tidak bergantung tabel lain│
 * │ 2  │ WargaSeeder                │ ~26 warga — bergantung KK     │
 * │ 3  │ User admin & warga         │ Inline di sini — bergantung Warga│
 * │ 4  │ Pengumuman                 │ Inline di sini — bergantung User│
 * │ 5  │ KegiatanRtSeeder           │ 10 kegiatan — bergantung User │
 * │ 6  │ Surat                      │ Inline di sini — bergantung Warga│
 * │ 7  │ Pengajuan (Pengaduan)      │ Inline di sini — bergantung Warga│
 * └────┴────────────────────────────┴────────────────────────────── ┘
 *
 * Cara menjalankan semua seeder:
 *   php artisan db:seed
 *
 * Cara reset database dan jalankan ulang semua seeder:
 *   php artisan migrate:fresh --seed
 *
 * Cara menjalankan seeder spesifik saja:
 *   php artisan db:seed --class=KartuKeluargaSeeder
 *   php artisan db:seed --class=WargaSeeder
 *   php artisan db:seed --class=KegiatanRtSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan semua seeder secara berurutan.
     *
     * PENTING: Urutan pemanggilan tidak boleh diubah sembarangan
     * karena ada ketergantungan data antar tabel (foreign key).
     */
    public function run(): void
    {
        // ──────────────────────────────────────────────────────────────
        // STEP 1: Seed Kartu Keluarga (10 KK)
        // Harus dijalankan PERTAMA karena Warga bergantung pada KK.
        // ──────────────────────────────────────────────────────────────
        $this->call(KartuKeluargaSeeder::class);


        // ──────────────────────────────────────────────────────────────
        // STEP 2: Seed Warga (~26 orang, tersebar di 10 KK)
        // Harus dijalankan SETELAH KartuKeluargaSeeder.
        // ──────────────────────────────────────────────────────────────
        $this->call(WargaSeeder::class);


        // ──────────────────────────────────────────────────────────────
        // STEP 3: Seed Users (Admin & Beberapa Warga)
        // Menggunakan data warga yang sudah ada dari WargaSeeder.
        // User admin dihubungkan ke warga pertama (Solichin / KK 00).
        // ──────────────────────────────────────────────────────────────

        // User admin dihubungkan ke warga pertama (Solichin / KK 00).
        // ---------------------------------------------------
        $wargaAdmin   = Warga::where('nik', '3201080115800001')->first(); // Solichin
        $wargaBudi    = Warga::where('nik', '3201080115800001')->first(); // Solichin (sama, sebagai admin)
        $wargaSiti    = Warga::where('nik', '3201081110880004')->first(); // Siti Aminah
        $wargaHendra  = Warga::where('nik', '3201082211770012')->first(); // Hendra Wijaya
        $wargaWahyu   = Warga::where('nik', '3201081209910024')->first(); // Wahyu Prasetyo

        // Buat user admin RT
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Solichin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
                'warga_id' => $wargaAdmin?->id,
            ]
        );

        // Buat user warga biasa (Siti Aminah)
        User::firstOrCreate(
            ['email' => 'siti@gmail.com'],
            [
                'name'     => 'Siti Aminah',
                'password' => Hash::make('password'),
                'role'     => 'warga',
                'warga_id' => $wargaSiti?->id,
            ]
        );

        // Buat user warga biasa (Hendra Wijaya)
        User::firstOrCreate(
            ['email' => 'hendra@gmail.com'],
            [
                'name'     => 'Hendra Wijaya',
                'password' => Hash::make('password'),
                'role'     => 'warga',
                'warga_id' => $wargaHendra?->id,
            ]
        );

        // Buat user warga biasa (Wahyu Prasetyo)
        User::firstOrCreate(
            ['email' => 'wahyu@gmail.com'],
            [
                'name'     => 'Wahyu Prasetyo',
                'password' => Hash::make('password'),
                'role'     => 'warga',
                'warga_id' => $wargaWahyu?->id,
            ]
        );

        $this->command->info('✅ UserSeeder: User admin dan warga berhasil dibuat.');


        // ──────────────────────────────────────────────────────────────
        // STEP 4: Seed Pengumuman (4 pengumuman)
        // Bergantung pada user admin yang sudah dibuat di Step 3.
        // ──────────────────────────────────────────────────────────────
        Schema::disableForeignKeyConstraints();
        Pengumuman::truncate();
        Schema::enableForeignKeyConstraints();

        Pengumuman::create([
            'judul'      => 'Kerja Bakti Rutin Minggu Depan',
            'isi'        => 'Diharapkan seluruh warga RT 08 hadir dalam acara kerja bakti rutin pada '
                . 'hari Minggu depan pukul 07.00 WIB untuk membersihkan selokan dan '
                . 'merapikan taman lingkungan.',
            'tanggal'    => now()->toDateString(),
            'foto'       => 'https://loremflickr.com/1200/800/volunteer,community?lock=20',
            'created_by' => $admin->id,
        ]);

        Pengumuman::create([
            'judul'      => 'Vaksinasi Massal Gratis',
            'isi'        => 'Pemberitahuan kepada seluruh warga RT 08, akan diadakan vaksinasi massal '
                . 'gratis di Balai RW 02 pada tanggal ' . now()->addDays(3)->format('d F Y') . '. '
                . 'Harap membawa KTP dan buku vaksinasi.',
            'tanggal'    => now()->addDays(2)->toDateString(),
            'foto'       => 'https://loremflickr.com/1200/800/vaccine,injection?lock=21',
            'created_by' => $admin->id,
        ]);

        Pengumuman::create([
            'judul'      => 'Pembayaran Iuran Keamanan Bulan Ini',
            'isi'        => 'Mengingatkan kepada seluruh warga untuk segera membayar iuran keamanan '
                . 'bulan ini sebesar Rp 30.000. Pembayaran dapat dilakukan langsung kepada '
                . 'petugas ronda atau melalui transfer ke rekening RT.',
            'tanggal'    => now()->subDays(2)->toDateString(),
            'foto'       => 'https://loremflickr.com/1200/800/money,payment?lock=22',
            'created_by' => $admin->id,
        ]);

        Pengumuman::create([
            'judul'      => 'Perbaikan Jalan Gang Belakang',
            'isi'        => 'Diberitahukan bahwa perbaikan jalan gang di belakang Jl. Anggrek akan '
                . 'dilaksanakan pada minggu depan. Mohon warga untuk sementara menggunakan '
                . 'jalur alternatif melalui Jl. Dahlia.',
            'tanggal'    => now()->subDays(5)->toDateString(),
            'foto'       => 'https://loremflickr.com/1200/800/road,construction?lock=23',
            'created_by' => $admin->id,
        ]);

        $this->command->info('✅ PengumumanSeeder: 4 pengumuman berhasil dibuat.');


        // ──────────────────────────────────────────────────────────────
        // STEP 5: Seed Kegiatan RT (10 kegiatan)
        // Bergantung pada user admin yang sudah dibuat di Step 3.
        // ──────────────────────────────────────────────────────────────
        $this->call(KegiatanRtSeeder::class);


        // ──────────────────────────────────────────────────────────────
        // STEP 6: Seed Surat (pengajuan surat warga)
        // Bergantung pada data warga yang sudah ada.
        // ──────────────────────────────────────────────────────────────
        Schema::disableForeignKeyConstraints();
        Surat::truncate();
        Schema::enableForeignKeyConstraints();

        // Ambil beberapa warga untuk data surat
        $warga1 = Warga::where('nik', '3201080115800001')->first(); // Solichin
        $warga2 = Warga::where('nik', '3201081110880004')->first(); // Siti Aminah
        $warga3 = Warga::where('nik', '3201082211770012')->first(); // Hendra Wijaya
        $warga4 = Warga::where('nik', '3201081209910024')->first(); // Wahyu Prasetyo

        Surat::create([
            'warga_id'    => $warga1?->id,
            'jenis_surat' => 'Surat Keterangan Domisili',
            'nomor_surat' => 'RT-001/05/2026',
            'keperluan'   => 'Pendaftaran Sekolah Anak',
            'status'      => 'selesai',
        ]);

        Surat::create([
            'warga_id'    => $warga2?->id,
            'jenis_surat' => 'Surat Pengantar KTP',
            'nomor_surat' => 'RT-002/05/2026',
            'keperluan'   => 'Perpanjangan KTP',
            'status'      => 'selesai',
        ]);

        Surat::create([
            'warga_id'    => $warga3?->id,
            'jenis_surat' => 'Surat Keterangan Tidak Mampu',
            'nomor_surat' => 'RT-003/06/2026',
            'keperluan'   => 'Beasiswa Pendidikan Anak',
            'status'      => 'diproses',
        ]);

        Surat::create([
            'warga_id'    => $warga4?->id,
            'jenis_surat' => 'Surat Keterangan Usaha',
            'nomor_surat' => 'RT-004/06/2026',
            'keperluan'   => 'Pendaftaran Izin Usaha UMKM',
            'status'      => 'diajukan',
        ]);

        $this->command->info('✅ SuratSeeder: 4 surat berhasil dibuat.');


        // ──────────────────────────────────────────────────────────────
        // STEP 7: Seed Pengajuan / Pengaduan Warga
        // Bergantung pada data warga yang sudah ada.
        // ──────────────────────────────────────────────────────────────
        Schema::disableForeignKeyConstraints();
        Pengajuan::truncate();
        Schema::enableForeignKeyConstraints();

        Pengajuan::create([
            'warga_id' => $warga1?->id,
            'judul'    => 'Lampu Jalan Mati',
            'isi'      => 'Lampu jalan di depan rumah No. 10 Jl. Merpati sudah mati selama 3 hari, '
                . 'mohon segera diperbaiki karena area sangat gelap saat malam dan rawan kecelakaan.',
            'foto'     => 'https://loremflickr.com/1200/800/streetlight,night?lock=24',
            'status'   => 'dikirim',
        ]);

        Pengajuan::create([
            'warga_id'        => $warga2?->id,
            'judul'           => 'Sampah Menumpuk di TPS',
            'isi'             => 'Petugas pengangkut sampah sudah 2 hari tidak lewat, '
                . 'sampah di TPS depan gang mulai berbau menyengat dan dikhawatirkan menjadi sarang nyamuk.',
            'foto'            => 'https://loremflickr.com/1200/800/garbage,waste?lock=25',
            'status'          => 'diproses',
            'tanggapan_admin' => 'Sudah dikoordinasikan dengan Dinas Kebersihan setempat. '
                . 'Pengangkutan akan dilakukan besok pagi.',
        ]);

        Pengajuan::create([
            'warga_id' => $warga3?->id,
            'judul'    => 'Jalan Berlubang Berbahaya',
            'isi'      => 'Terdapat lubang besar di Jl. Dahlia No. 5 yang sudah ada sejak musim hujan lalu. '
                . 'Lubang sudah menyebabkan 2 pengendara motor tergelincir. Mohon segera ditangani.',
            'foto'     => 'https://loremflickr.com/1200/800/road,pothole?lock=26',
            'status'   => 'selesai',
            'tanggapan_admin' => 'Perbaikan jalan sudah dilaksanakan pada tanggal '
                . now()->subDays(5)->format('d F Y') . '. Terima kasih atas laporannya.',
        ]);

        Pengajuan::create([
            'warga_id' => $warga4?->id,
            'judul'    => 'Gangguan Kebisingan Malam Hari',
            'isi'      => 'Ada kegiatan musik keras di rumah No. 8 Jl. Dahlia hampir setiap malam '
                . 'hingga pukul 02.00 WIB, sangat mengganggu istirahat warga sekitar.',
            'foto'     => 'https://loremflickr.com/1200/800/speaker,noise?lock=27',
            'status'   => 'dikirim',
        ]);

        $this->command->info('✅ PengaduanSeeder: 4 pengaduan berhasil dibuat.');
        $this->command->line('');
        $this->command->info('🎉 Semua seeder berhasil dijalankan!');
        $this->command->table(
            ['Tabel', 'Jumlah Data'],
            [
                ['kartu_keluarga', \App\Models\KartuKeluarga::count()],
                ['warga',          \App\Models\Warga::count()],
                ['users',          \App\Models\User::count()],
                ['pengumuman',     \App\Models\Pengumuman::count()],
                ['kegiatan_rt',    \App\Models\KegiatanRt::count()],
                ['surat',          \App\Models\Surat::count()],
                ['pengajuan',      \App\Models\Pengajuan::count()],
            ]
        );
    }
}
