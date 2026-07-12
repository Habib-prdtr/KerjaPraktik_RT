<?php

namespace Database\Seeders;

use App\Models\KartuKeluarga;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * WargaSeeder
 *
 * Seeder ini mengisi tabel `warga` dengan data dummy yang realistis
 * untuk keperluan pengembangan dan pengujian sistem RT.
 *
 * Logika seeding:
 * - Setiap KK yang ada di database akan diisi oleh beberapa anggota keluarga
 * - Anggota pertama pada tiap KK adalah kepala keluarga itu sendiri
 * - Anggota berikutnya adalah pasangan atau anak (sebagai variasi data)
 * - Total warga yang dibuat: ~25 orang (rata-rata 2-3 orang per KK)
 *
 * Kolom yang diisi:
 * - kartu_keluarga_id : relasi ke tabel kartu_keluarga
 * - nik               : 16 digit angka unik (simulasi NIK nasional)
 * - nama              : nama lengkap warga
 * - jenis_kelamin     : 'L' (Laki-laki) atau 'P' (Perempuan)
 * - tanggal_lahir     : format YYYY-MM-DD
 * - agama             : agama warga
 * - pekerjaan         : jenis pekerjaan
 * - status_perkawinan : Menikah / Belum Menikah / Cerai
 * - status            : 'aktif' | 'pindah' | 'meninggal'
 *
 * Cara menjalankan seeder ini saja:
 *   php artisan db:seed --class=WargaSeeder
 *
 * CATATAN: Seeder ini bergantung pada data KartuKeluarga yang sudah ada.
 * Pastikan KartuKeluargaSeeder sudah dijalankan terlebih dahulu, atau
 * jalankan semua seeder sekaligus: php artisan db:seed
 */
class WargaSeeder extends Seeder
{
    /**
     * Jalankan proses seeding untuk tabel warga.
     *
     * Data warga dikelompokkan berdasarkan KK masing-masing.
     * NIK dibuat unik dengan menggabungkan kode KK dan nomor urut anggota.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key check sementara agar truncate tidak error
        Schema::disableForeignKeyConstraints();
        Warga::truncate();
        Schema::enableForeignKeyConstraints();

        // Ambil semua KK yang tersedia, diurutkan berdasarkan ID
        $semua_kk = KartuKeluarga::orderBy('id')->get();

        /**
         * Daftar warga per KK.
         * Struktur array: indeks sesuai urutan KK (0 = KK pertama, dst.)
         * Setiap KK memiliki array berisi data anggota keluarganya.
         *
         * Format NIK: [kode_wilayah(6)][tanggal_lahir(6)][urutan(4)]
         * Contoh: 3201080115800001 = wilayah 320108, lahir 15-01-1980, urutan 0001
         */
        $wargaPerKK = [

            // ── KK 00: Solichin ────────────────────────────────────────────
            [
                [
                    'nik'               => '3201080115800001',
                    'nama'              => 'Solichin',
                    'jenis_kelamin'     => 'L',
                    'tanggal_lahir'     => '1980-01-15',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'PNS',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201080210850002',
                    'nama'              => 'Sri Mulyani',
                    'jenis_kelamin'     => 'P',
                    'tanggal_lahir'     => '1985-02-10',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Ibu Rumah Tangga',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201081005100003',
                    'nama'              => 'Reza Solichin',
                    'jenis_kelamin'     => 'L',
                    'tanggal_lahir'     => '2010-05-10',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Pelajar',
                    'status_perkawinan' => 'Belum Menikah',
                    'status'            => 'aktif',
                ],
            ],

            // ── KK 01: Siti Aminah ────────────────────────────────────────────
            [
                [
                    'nik'               => '3201081110880004',
                    'nama'              => 'Siti Aminah',
                    'jenis_kelamin'     => 'P',
                    'tanggal_lahir'     => '1988-11-10',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Guru',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201080507820005',
                    'nama'              => 'Darmanto',
                    'jenis_kelamin'     => 'L',
                    'tanggal_lahir'     => '1982-07-05',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Wiraswasta',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201082003120006',
                    'nama'              => 'Nadia Putri',
                    'jenis_kelamin'     => 'P',
                    'tanggal_lahir'     => '2012-03-20',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Pelajar',
                    'status_perkawinan' => 'Belum Menikah',
                    'status'            => 'aktif',
                ],
            ],

            // ── KK 02: Ahmad Fauzi ────────────────────────────────────────────
            [
                [
                    'nik'               => '3201081203790007',
                    'nama'              => 'Ahmad Fauzi',
                    'jenis_kelamin'     => 'L',
                    'tanggal_lahir'     => '1979-03-12',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Pedagang',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201082508810008',
                    'nama'              => 'Fatimah Zahra',
                    'jenis_kelamin'     => 'P',
                    'tanggal_lahir'     => '1981-08-25',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Ibu Rumah Tangga',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
            ],

            // ── KK 03: Dewi Rahayu ────────────────────────────────────────────
            [
                [
                    'nik'               => '3201080109900009',
                    'nama'              => 'Dewi Rahayu',
                    'jenis_kelamin'     => 'P',
                    'tanggal_lahir'     => '1990-09-01',
                    'agama'             => 'Kristen',
                    'pekerjaan'         => 'Karyawan Swasta',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201081406860010',
                    'nama'              => 'Rudi Hartono',
                    'jenis_kelamin'     => 'L',
                    'tanggal_lahir'     => '1986-06-14',
                    'agama'             => 'Kristen',
                    'pekerjaan'         => 'Teknisi',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201080115140011',
                    'nama'              => 'Kevin Hartono',
                    'jenis_kelamin'     => 'L',
                    'tanggal_lahir'     => '2014-01-15',
                    'agama'             => 'Kristen',
                    'pekerjaan'         => 'Pelajar',
                    'status_perkawinan' => 'Belum Menikah',
                    'status'            => 'aktif',
                ],
            ],

            // ── KK 04: Hendra Wijaya ─────────────────────────────────────────
            [
                [
                    'nik'               => '3201082211770012',
                    'nama'              => 'Hendra Wijaya',
                    'jenis_kelamin'     => 'L',
                    'tanggal_lahir'     => '1977-11-22',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Kontraktor',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201080304800013',
                    'nama'              => 'Yuni Astuti',
                    'jenis_kelamin'     => 'P',
                    'tanggal_lahir'     => '1980-04-03',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Bidan',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201080709050014',
                    'nama'              => 'Dinda Wijaya',
                    'jenis_kelamin'     => 'P',
                    'tanggal_lahir'     => '2005-09-07',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Mahasiswa',
                    'status_perkawinan' => 'Belum Menikah',
                    'status'            => 'aktif',
                ],
            ],

            // ── KK 05: Rina Kusuma ───────────────────────────────────────────
            [
                [
                    'nik'               => '3201080512920015',
                    'nama'              => 'Rina Kusuma',
                    'jenis_kelamin'     => 'P',
                    'tanggal_lahir'     => '1992-12-05',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Apoteker',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201081803880016',
                    'nama'              => 'Eko Prasetya',
                    'jenis_kelamin'     => 'L',
                    'tanggal_lahir'     => '1988-03-18',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Dokter',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
            ],

            // ── KK 06: Joko Purnomo ──────────────────────────────────────────
            [
                [
                    'nik'               => '3201082705750017',
                    'nama'              => 'Joko Purnomo',
                    'jenis_kelamin'     => 'L',
                    'tanggal_lahir'     => '1975-05-27',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Pensiunan',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201081906780018',
                    'nama'              => 'Marini',
                    'jenis_kelamin'     => 'P',
                    'tanggal_lahir'     => '1978-06-19',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Ibu Rumah Tangga',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201083110000019',
                    'nama'              => 'Bagas Purnomo',
                    'jenis_kelamin'     => 'L',
                    'tanggal_lahir'     => '2000-10-31',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Mahasiswa',
                    'status_perkawinan' => 'Belum Menikah',
                    'status'            => 'aktif',
                ],
            ],

            // ── KK 07: Supriyanto ────────────────────────────────────────────
            [
                [
                    'nik'               => '3201081501830020',
                    'nama'              => 'Supriyanto',
                    'jenis_kelamin'     => 'L',
                    'tanggal_lahir'     => '1983-01-15',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Sopir',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201082802870021',
                    'nama'              => 'Endang Susilawati',
                    'jenis_kelamin'     => 'P',
                    'tanggal_lahir'     => '1987-02-28',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Penjahit',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
            ],

            // ── KK 08: Lestari Ningrum ───────────────────────────────────────
            [
                [
                    'nik'               => '3201080708930022',
                    'nama'              => 'Lestari Ningrum',
                    'jenis_kelamin'     => 'P',
                    'tanggal_lahir'     => '1993-08-07',
                    'agama'             => 'Katolik',
                    'pekerjaan'         => 'Desainer Grafis',
                    'status_perkawinan' => 'Belum Menikah',
                    'status'            => 'aktif',
                ],
                // Nenek/orang tua yang tinggal serumah
                [
                    'nik'               => '3201082103600023',
                    'nama'              => 'Tukimin',
                    'jenis_kelamin'     => 'L',
                    'tanggal_lahir'     => '1960-03-21',
                    'agama'             => 'Katolik',
                    'pekerjaan'         => 'Tidak Bekerja',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
            ],

            // ── KK 09: Wahyu Prasetyo ────────────────────────────────────────
            [
                [
                    'nik'               => '3201081209910024',
                    'nama'              => 'Wahyu Prasetyo',
                    'jenis_kelamin'     => 'L',
                    'tanggal_lahir'     => '1991-09-12',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Programmer',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201082504930025',
                    'nama'              => 'Annisa Fitriani',
                    'jenis_kelamin'     => 'P',
                    'tanggal_lahir'     => '1993-04-25',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Akuntan',
                    'status_perkawinan' => 'Menikah',
                    'status'            => 'aktif',
                ],
                [
                    'nik'               => '3201081507190026',
                    'nama'              => 'Zahra Prasetyo',
                    'jenis_kelamin'     => 'P',
                    'tanggal_lahir'     => '2019-07-15',
                    'agama'             => 'Islam',
                    'pekerjaan'         => 'Belum/Tidak Bekerja',
                    'status_perkawinan' => 'Belum Menikah',
                    'status'            => 'aktif',
                ],
            ],
        ];

        // Iterasi setiap KK berdasarkan urutan index
        foreach ($wargaPerKK as $indexKK => $anggotaList) {
            // Ambil KK sesuai urutan (index 0 = KK pertama dari hasil query)
            if (!isset($semua_kk[$indexKK])) {
                // Lewati jika KK tidak tersedia (misal data KK tidak lengkap)
                $this->command->warn("⚠️  KK index {$indexKK} tidak ditemukan, data warga dilewati.");
                continue;
            }

            $kk = $semua_kk[$indexKK];

            foreach ($anggotaList as $dataWarga) {
                // Tambahkan relasi ke KK yang sesuai
                $dataWarga['kartu_keluarga_id'] = $kk->id;
                Warga::create($dataWarga);
            }
        }

        // Hitung total warga yang berhasil dibuat
        $total = Warga::count();
        $this->command->info("✅ WargaSeeder: {$total} warga berhasil ditambahkan.");
    }
}
