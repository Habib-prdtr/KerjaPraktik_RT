<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use App\Models\KegiatanRt;
use App\Models\Pengajuan;
use App\Models\Pengumuman;
use App\Models\Surat;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // =============================
    // Dashboard Admin
    // =============================
    public function adminDashboard()
    {
        $stats = [
            'total_warga'        => Warga::where('status', 'aktif')->count(),
            'total_kk'           => KartuKeluarga::count(),
            'surat_diajukan'     => Surat::where('status', 'diajukan')->count(),
            'surat_diproses'     => Surat::where('status', 'diproses')->count(),
            'surat_selesai'      => Surat::where('status', 'selesai')->count(),
            'pengaduan_masuk'    => Pengajuan::where('status', 'dikirim')->count(),
            'pengaduan_diproses' => Pengajuan::where('status', 'diproses')->count(),
            'total_pengumuman'   => Pengumuman::count(),
            'total_kegiatan'     => KegiatanRt::count(),
        ];

        // 5 surat terbaru
        $suratTerbaru = Surat::with('warga')
            ->latest()
            ->take(5)
            ->get();

        // 5 pengaduan terbaru
        $pengaduanTerbaru = Pengajuan::with('warga')
            ->latest()
            ->take(5)
            ->get();

        // Kegiatan mendatang
        $kegiatanMendatang = KegiatanRt::where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal')
            ->take(5)
            ->get();

        // Pengumuman terbaru
        $pengumumanTerbaru = Pengumuman::with('user')
            ->latest()
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'suratTerbaru',
            'pengaduanTerbaru',
            'kegiatanMendatang',
            'pengumumanTerbaru'
        ));
    }

    // =============================
    // Dashboard Warga
    // =============================
    public function wargaDashboard()
    {
        $user  = Auth::user();
        $warga = $user->warga;

        // Jika user belum terhubung ke data warga
        if (!$warga) {
            return view('warga.dashboard', [
                'warga'            => null,
                'suratSaya'        => collect(),
                'pengaduanSaya'    => collect(),
                'pengumumanTerbaru'=> collect(),
                'kegiatanMendatang'=> collect(),
            ]);
        }

        $suratSaya = Surat::where('warga_id', $warga->id)
            ->latest()
            ->take(5)
            ->get();

        $pengaduanSaya = Pengajuan::where('warga_id', $warga->id)
            ->latest()
            ->take(5)
            ->get();

        $pengumumanTerbaru = Pengumuman::latest()->take(5)->get();

        $kegiatanMendatang = KegiatanRt::where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal')
            ->take(5)
            ->get();

        return view('warga.dashboard', compact(
            'warga',
            'suratSaya',
            'pengaduanSaya',
            'pengumumanTerbaru',
            'kegiatanMendatang'
        ));
    }
}
