<?php

namespace Database\Seeders;

use App\Models\KegiatanRt;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * KegiatanRtSeeder
 *
 * Seeder ini mengisi tabel `kegiatan_rt` dengan data dummy kegiatan
 * yang realistis untuk keperluan pengembangan dan pengujian sistem RT.
 *
 * Data yang diseed:
 * - 10 kegiatan RT dengan berbagai jenis aktivitas komunitas
 * - Tanggal kegiatan tersebar dari masa lampau hingga masa mendatang
 *   sehingga aplikasi memiliki riwayat dan jadwal yang bervariasi
 * - Setiap kegiatan memiliki foto dari Unsplash (URL publik, bebas pakai)
 *
 * Kategori kegiatan yang diseed:
 * 1. Rapat / musyawarah warga
 * 2. Kerja bakti / gotong royong
 * 3. Kegiatan kesehatan (senam, posyandu, vaksin)
 * 4. Peringatan hari besar nasional
 * 5. Kegiatan sosial dan keagamaan
 *
 * Kolom yang diisi:
 * - nama_kegiatan : nama/judul kegiatan
 * - deskripsi     : penjelasan singkat kegiatan (nullable)
 * - tanggal       : tanggal pelaksanaan (format YYYY-MM-DD)
 * - lokasi        : tempat kegiatan dilaksanakan
 * - foto          : JSON array berisi URL foto dokumentasi
 * - created_by    : ID user admin yang membuat entri
 *
 * Cara menjalankan seeder ini saja:
 *   php artisan db:seed --class=KegiatanRtSeeder
 *
 * CATATAN: Seeder ini bergantung pada user admin yang sudah ada di tabel `users`.
 * Pastikan DatabaseSeeder sudah dijalankan terlebih dahulu, atau
 * jalankan semua seeder sekaligus: php artisan db:seed
 */
class KegiatanRtSeeder extends Seeder
{
    /**
     * Jalankan proses seeding untuk tabel kegiatan_rt.
     *
     * Tanggal kegiatan dihitung relatif dari waktu saat seeder dijalankan
     * menggunakan helper now() agar data tetap relevan kapan pun dijalankan.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key check sementara agar truncate tidak error
        Schema::disableForeignKeyConstraints();
        KegiatanRt::truncate();
        Schema::enableForeignKeyConstraints();

        /**
         * Cari user admin sebagai pembuat kegiatan.
         * Jika tidak ada user dengan role 'admin', gunakan user pertama yang ada.
         * Ini mencegah error foreign key jika admin belum di-seed.
         */
        $admin = User::where('role', 'admin')->first()
            ?? User::first();

        if (!$admin) {
            $this->command->error('❌ KegiatanRtSeeder: Tidak ada user di database. Jalankan DatabaseSeeder terlebih dahulu.');
            return;
        }

        /**
         * Data Kegiatan RT
         *
         * Tanggal menggunakan now() dengan addDays() / subDays():
         * - subDays(n) = n hari yang lalu  → kegiatan sudah berlangsung (riwayat)
         * - addDays(n) = n hari mendatang  → kegiatan belum berlangsung (jadwal)
         *
         * Foto menggunakan picsum.photos dengan seed string agar gambar konsisten
         * setiap kali seeder dijalankan. Format: https://picsum.photos/seed/{string}/lebar/tinggi
         * Model KegiatanRt menyimpan foto sebagai JSON array di kolom `foto`.
         */
        $dataKegiatan = [

            // ── 1. Rapat Bulanan RT (sudah berlangsung: 30 hari lalu) ─────────
            [
                'nama_kegiatan' => 'Rapat Bulanan RT',
                'deskripsi'     => 'Pembahasan keamanan lingkungan, iuran bulanan warga, dan rencana perbaikan jalan gang belakang. '
                    . 'Seluruh warga diharap hadir untuk memberikan masukan.',
                'tanggal'       => now()->subDays(30)->toDateString(),
                'lokasi'        => 'Rumah Ketua RT 08',
                'foto'          => json_encode([
                    'https://loremflickr.com/1200/800/community,meeting?lock=1',
                    'https://loremflickr.com/1200/800/discussion,group?lock=2',
                ]),
                'created_by'    => $admin->id,
            ],

            // ── 2. Kerja Bakti Selokan (sudah berlangsung: 21 hari lalu) ─────
            [
                'nama_kegiatan' => 'Kerja Bakti Bersih Selokan',
                'deskripsi'     => 'Gotong royong membersihkan selokan sepanjang Jl. Merpati dan Jl. Kenanga yang tersumbat '
                    . 'akibat musim hujan. Kegiatan dimulai pukul 07.00 WIB.',
                'tanggal'       => now()->subDays(21)->toDateString(),
                'lokasi'        => 'Sepanjang Jl. Merpati & Jl. Kenanga RT 08',
                'foto'          => json_encode([
                    'https://loremflickr.com/1200/800/volunteer,cleaning?lock=3',
                    'https://loremflickr.com/1200/800/community,environment?lock=4',
                ]),
                'created_by'    => $admin->id,
            ],

            // ── 3. Posyandu Balita (sudah berlangsung: 14 hari lalu) ─────────
            [
                'nama_kegiatan' => 'Posyandu Balita & Lansia',
                'deskripsi'     => 'Pemeriksaan kesehatan rutin untuk balita (timbang berat badan, imunisasi) '
                    . 'dan cek kesehatan gratis untuk warga lanjut usia. Didukung oleh Puskesmas setempat.',
                'tanggal'       => now()->subDays(14)->toDateString(),
                'lokasi'        => 'Balai RW 03',
                'foto'          => json_encode([
                    'https://loremflickr.com/1200/800/healthcare,children?lock=5',
                ]),
                'created_by'    => $admin->id,
            ],

            // ── 4. Senam Pagi Minggu (sudah berlangsung: 7 hari lalu) ─────────
            [
                'nama_kegiatan' => 'Senam Sehat Minggu Pagi',
                'deskripsi'     => 'Senam bersama dipandu instruktur profesional dari Sanggar Sehat Bahagia. '
                    . 'Terbuka untuk semua usia, gratis, dan disediakan minuman jus segar.',
                'tanggal'       => now()->subDays(7)->toDateString(),
                'lokasi'        => 'Lapangan Serbaguna RT 08',
                'foto'          => json_encode([
                    'https://loremflickr.com/1200/800/exercise,aerobics?lock=6',
                    'https://loremflickr.com/1200/800/fitness,outdoor?lock=7',
                ]),
                'created_by'    => $admin->id,
            ],

            // ── 5. Pemasangan CCTV (sudah berlangsung: 3 hari lalu) ──────────
            [
                'nama_kegiatan' => 'Pemasangan CCTV Keamanan Lingkungan',
                'deskripsi'     => 'Pemasangan 4 unit kamera CCTV di titik-titik strategis lingkungan RT 08 '
                    . 'untuk meningkatkan keamanan warga. Hasil iuran gotong royong warga selama 3 bulan.',
                'tanggal'       => now()->subDays(3)->toDateString(),
                'lokasi'        => 'Pos Kamling & Pintu Masuk RT 08',
                'foto'          => json_encode([
                    'https://loremflickr.com/1200/800/security,camera?lock=8',
                ]),
                'created_by'    => $admin->id,
            ],

            // ── 6. Sosialisasi Pemilahan Sampah (sudah berlangsung: kemarin) ─
            [
                'nama_kegiatan' => 'Sosialisasi Pemilahan Sampah',
                'deskripsi'     => 'Penyuluhan cara memilah sampah organik, anorganik, dan B3 (Bahan Berbahaya '
                    . 'dan Beracun) oleh petugas Dinas Lingkungan Hidup. Disertai pembagian tong sampah gratis.',
                'tanggal'       => now()->subDays(1)->toDateString(),
                'lokasi'        => 'Rumah Ketua RT 08',
                'foto'          => json_encode([
                    'https://loremflickr.com/1200/800/recycling,waste?lock=9',
                    'https://loremflickr.com/1200/800/environment,ecology?lock=10',
                ]),
                'created_by'    => $admin->id,
            ],

            // ── 7. Vaksinasi Massal (akan datang: 3 hari lagi) ───────────────
            [
                'nama_kegiatan' => 'Vaksinasi Massal Warga RT 08',
                'deskripsi'     => 'Program vaksinasi gratis untuk seluruh warga RT 08 yang belum mendapatkan '
                    . 'vaksin booster. Harap membawa KTP dan buku vaksinasi. Didukung Puskesmas Kecamatan.',
                'tanggal'       => now()->addDays(3)->toDateString(),
                'lokasi'        => 'Balai RW 03',
                'foto'          => json_encode([
                    'https://loremflickr.com/1200/800/vaccine,injection?lock=11',
                ]),
                'created_by'    => $admin->id,
            ],

            // ── 8. Musyawarah Pengurus RT (akan datang: 7 hari lagi) ─────────
            [
                'nama_kegiatan' => 'Musyawarah Pembentukan Pengurus RT Baru',
                'deskripsi'     => 'Rapat musyawarah untuk pemilihan dan pembentukan kepengurusan RT 08 periode baru. '
                    . 'Seluruh kepala keluarga wajib hadir. Satu keluarga satu suara.',
                'tanggal'       => now()->addDays(7)->toDateString(),
                'lokasi'        => 'Aula Kelurahan',
                'foto'          => json_encode([
                    'https://loremflickr.com/1200/800/election,voting?lock=12',
                ]),
                'created_by'    => $admin->id,
            ],

            // ── 9. Peringatan HUT RI (akan datang: 14 hari lagi) ─────────────
            [
                'nama_kegiatan' => 'Peringatan HUT RI ke-81',
                'deskripsi'     => 'Perayaan HUT Kemerdekaan RI ke-81 dengan berbagai lomba: balap karung, '
                    . 'makan kerupuk, tarik tambang, dan fashion show pakaian adat. Dimeriahkan dengan '
                    . 'penampilan seni dari anak-anak RT 08.',
                'tanggal'       => now()->addDays(14)->toDateString(),
                'lokasi'        => 'Lapangan Serbaguna RT 08',
                'foto'          => json_encode([
                    'https://loremflickr.com/1200/800/celebration,festival?lock=13',
                    'https://loremflickr.com/1200/800/competition,fun?lock=14',
                ]),
                'created_by'    => $admin->id,
            ],

            // ── 10. Pengajian Rutin Bulanan (akan datang: 21 hari lagi) ──────
            [
                'nama_kegiatan' => 'Pengajian Rutin Bulanan',
                'deskripsi'     => 'Pengajian bulanan warga RT 08 dengan tema "Memperkuat Ukhuwah Islamiyah di '
                    . 'Lingkungan RT". Menghadirkan ustadz dari pesantren setempat. Terbuka untuk umum.',
                'tanggal'       => now()->addDays(21)->toDateString(),
                'lokasi'        => 'Masjid Al-Ikhlas RT 08',
                'foto'          => json_encode([
                    'https://loremflickr.com/1200/800/mosque,prayer?lock=15',
                ]),
                'created_by'    => $admin->id,
            ],
        ];

        // Masukkan semua data kegiatan
        foreach ($dataKegiatan as $kegiatan) {
            KegiatanRt::create($kegiatan);
        }

        $this->command->info('✅ KegiatanRtSeeder: ' . count($dataKegiatan) . ' kegiatan RT berhasil ditambahkan.');
    }
}
