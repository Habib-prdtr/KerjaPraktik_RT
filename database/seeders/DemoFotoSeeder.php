<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pengumuman;
use App\Models\KegiatanRt;
use Illuminate\Database\Seeder;

class DemoFotoSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first() ?? User::first();
        $adminId = $admin ? $admin->id : 1;

        Pengumuman::truncate();
        Pengumuman::create([
            'judul' => 'Kerja Bakti Rutin',
            'isi' => 'Diharapkan seluruh warga RT 01 hadir dalam acara kerja bakti rutin pada hari Minggu besok untuk membersihkan selokan.',
            'tanggal' => now()->toDateString(),
            'foto' => 'https://images.unsplash.com/photo-1588600878108-578307a3cc9d?q=80&w=1200&auto=format&fit=crop',
            'created_by' => $adminId,
        ]);

        Pengumuman::create([
            'judul' => 'Vaksinasi Massal Warga',
            'isi' => 'Pemberitahuan kepada seluruh warga, akan diadakan vaksinasi massal gratis di lapangan serbaguna. Harap membawa KTP dan KK asli.',
            'tanggal' => now()->addDays(2)->toDateString(),
            'created_by' => $adminId,
        ]);

        KegiatanRt::truncate();
        KegiatanRt::create([
            'nama_kegiatan' => 'Rapat Bulanan RT',
            'deskripsi' => 'Pembahasan keamanan lingkungan dan iuran bulanan.',
            'tanggal' => now()->addDays(5)->toDateString(),
            'lokasi' => 'Rumah Ketua RT',
            'foto' => [
                'https://images.unsplash.com/photo-1543269865-cbf427effbad?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?q=80&w=1200&auto=format&fit=crop'
            ],
            'created_by' => $adminId,
        ]);

        KegiatanRt::create([
            'nama_kegiatan' => 'Senam Sehat Minggu Pagi',
            'deskripsi' => 'Mari ikuti senam sehat bersama instruktur profesional. Terbuka untuk semua umur dan gratis.',
            'tanggal' => now()->addDays(7)->toDateString(),
            'lokasi' => 'Lapangan Serbaguna RT 08',
            'foto' => [
                'https://images.unsplash.com/photo-1528605248644-14dd04022da1?q=80&w=1200&auto=format&fit=crop'
            ],
            'created_by' => $adminId,
        ]);
    }
}
