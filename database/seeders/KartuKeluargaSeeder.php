<?php

namespace Database\Seeders;

use App\Models\KartuKeluarga;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * KartuKeluargaSeeder
 *
 * Seeder ini mengisi tabel `kartu_keluarga` dengan data dummy yang realistis
 * untuk keperluan pengembangan dan pengujian sistem RT.
 *
 * Data yang diseed:
 * - 10 Kartu Keluarga (KK) dengan no_kk unik 16 digit
 * - Setiap KK memiliki kepala keluarga, alamat, dan nomor RT/RW
 * - Semua KK berada di wilayah RT 08 / RW 03 (atau RT lain sebagai variasi)
 *
 * Cara menjalankan seeder ini saja:
 *   php artisan db:seed --class=KartuKeluargaSeeder
 *
 * Atau jalankan bersama semua seeder via DatabaseSeeder:
 *   php artisan db:seed
 *
 * CATATAN: Seeder ini akan membersihkan (truncate) tabel sebelum mengisi data baru
 * agar tidak ada duplikasi saat dijalankan ulang.
 */
class KartuKeluargaSeeder extends Seeder
{
    /**
     * Jalankan proses seeding untuk tabel kartu_keluarga.
     *
     * Menghapus semua data lama terlebih dahulu, kemudian mengisi dengan
     * 10 data KK baru yang realistis.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key check sementara agar truncate tidak error
        Schema::disableForeignKeyConstraints();
        KartuKeluarga::truncate();
        Schema::enableForeignKeyConstraints();

        /**
         * Data Kartu Keluarga
         * Format no_kk: 16 digit angka (menyerupai format NIK/KK nasional)
         * Format: [kode_wilayah(6)][tanggal_dok(6)][urutan(4)]
         */
        $dataKK = [
            // KK 01 - Kepala keluarga laki-laki
            [
                'no_kk'           => '3201080101010001',
                'kepala_keluarga' => 'Budi Santoso',
                'alamat'          => 'Jl. Merpati No. 10',
                'rt'              => '08',
                'rw'              => '03',
            ],
            // KK 02 - Kepala keluarga perempuan (janda/duda)
            [
                'no_kk'           => '3201080101010002',
                'kepala_keluarga' => 'Siti Aminah',
                'alamat'          => 'Jl. Merpati No. 12',
                'rt'              => '08',
                'rw'              => '03',
            ],
            // KK 03
            [
                'no_kk'           => '3201080101010003',
                'kepala_keluarga' => 'Ahmad Fauzi',
                'alamat'          => 'Jl. Kenanga No. 5',
                'rt'              => '08',
                'rw'              => '03',
            ],
            // KK 04
            [
                'no_kk'           => '3201080101010004',
                'kepala_keluarga' => 'Dewi Rahayu',
                'alamat'          => 'Jl. Kenanga No. 7',
                'rt'              => '08',
                'rw'              => '03',
            ],
            // KK 05
            [
                'no_kk'           => '3201080101010005',
                'kepala_keluarga' => 'Hendra Wijaya',
                'alamat'          => 'Jl. Melati No. 3',
                'rt'              => '08',
                'rw'              => '03',
            ],
            // KK 06
            [
                'no_kk'           => '3201080101010006',
                'kepala_keluarga' => 'Rina Kusuma',
                'alamat'          => 'Jl. Melati No. 9',
                'rt'              => '08',
                'rw'              => '03',
            ],
            // KK 07
            [
                'no_kk'           => '3201080101010007',
                'kepala_keluarga' => 'Joko Purnomo',
                'alamat'          => 'Jl. Dahlia No. 2',
                'rt'              => '08',
                'rw'              => '03',
            ],
            // KK 08
            [
                'no_kk'           => '3201080101010008',
                'kepala_keluarga' => 'Supriyanto',
                'alamat'          => 'Jl. Dahlia No. 8',
                'rt'              => '08',
                'rw'              => '03',
            ],
            // KK 09
            [
                'no_kk'           => '3201080101010009',
                'kepala_keluarga' => 'Lestari Ningrum',
                'alamat'          => 'Jl. Anggrek No. 4',
                'rt'              => '08',
                'rw'              => '03',
            ],
            // KK 10
            [
                'no_kk'           => '3201080101010010',
                'kepala_keluarga' => 'Wahyu Prasetyo',
                'alamat'          => 'Jl. Anggrek No. 11',
                'rt'              => '08',
                'rw'              => '03',
            ],
        ];

        // Masukkan semua data sekaligus menggunakan insert batch
        foreach ($dataKK as $kk) {
            KartuKeluarga::create($kk);
        }

        // Tampilkan info ke konsol saat seeder selesai
        $this->command->info('✅ KartuKeluargaSeeder: ' . count($dataKK) . ' KK berhasil ditambahkan.');
    }
}
