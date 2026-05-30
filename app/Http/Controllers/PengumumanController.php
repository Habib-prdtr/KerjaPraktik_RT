<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    // =============================
    // [ADMIN] Daftar semua pengumuman
    // =============================
    public function index(Request $request)
    {
        $query = Pengumuman::with('user');

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('isi', 'like', "%{$keyword}%");
            });
        }

        $pengumuman = $query->orderByDesc('tanggal')->paginate(10)->withQueryString();

        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    // =============================
    // [ADMIN] Form tambah pengumuman
    // =============================
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    // =============================
    // [ADMIN] Simpan pengumuman
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:150',
            'isi'     => 'required|string',
            'tanggal' => 'required|date',
        ], [
            'judul.required'   => 'Judul pengumuman wajib diisi.',
            'judul.max'        => 'Judul maksimal 150 karakter.',
            'isi.required'     => 'Isi pengumuman wajib diisi.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date'     => 'Format tanggal tidak valid.',
        ]);

        Pengumuman::create([
            'judul'      => $request->judul,
            'isi'        => $request->isi,
            'tanggal'    => $request->tanggal,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    // =============================
    // [ADMIN] Detail pengumuman
    // =============================
    public function show(Pengumuman $pengumuman)
    {
        $pengumuman->load('user');
        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    // =============================
    // [ADMIN] Form edit pengumuman
    // =============================
    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    // =============================
    // [ADMIN] Update pengumuman
    // =============================
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul'   => 'required|string|max:150',
            'isi'     => 'required|string',
            'tanggal' => 'required|date',
        ], [
            'judul.required'   => 'Judul pengumuman wajib diisi.',
            'isi.required'     => 'Isi pengumuman wajib diisi.',
            'tanggal.required' => 'Tanggal wajib diisi.',
        ]);

        $pengumuman->update($request->only(['judul', 'isi', 'tanggal']));

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    // =============================
    // [ADMIN] Hapus pengumuman
    // =============================
    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }

    // =============================
    // [WARGA] Lihat daftar pengumuman
    // =============================
    public function listWarga(Request $request)
    {
        $query = Pengumuman::query();

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('isi', 'like', "%{$keyword}%");
            });
        }

        $pengumuman = $query->orderByDesc('tanggal')->paginate(10)->withQueryString();

        return view('warga.pengumuman.index', compact('pengumuman'));
    }

    // =============================
    // [WARGA] Detail pengumuman
    // =============================
    public function showWarga(Pengumuman $pengumuman)
    {
        return view('warga.pengumuman.show', compact('pengumuman'));
    }
}
