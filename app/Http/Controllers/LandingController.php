<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Ambil 3 pengumuman terbaru untuk ditampilkan di mading landing page
        $pengumuman = Pengumuman::with('user')->orderByDesc('tanggal')->take(3)->get();
        
        // Ambil 3 kegiatan terbaru
        $kegiatan = \App\Models\KegiatanRt::with('user')->orderByDesc('tanggal')->take(3)->get();
        
        return view('landing', compact('pengumuman', 'kegiatan'));
    }
}
