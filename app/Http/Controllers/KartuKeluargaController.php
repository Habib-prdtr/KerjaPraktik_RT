<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use Illuminate\Http\Request;

class KartuKeluargaController extends Controller
{
    // =============================
    // Daftar semua KK
    // =============================
    public function index(Request $request)
    {
        $query = KartuKeluarga::withCount('warga');

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('no_kk', 'like', "%{$keyword}%")
                  ->orWhere('kepala_keluarga', 'like', "%{$keyword}%")
                  ->orWhere('alamat', 'like', "%{$keyword}%");
            });
        }

        $kartuKeluarga = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

        return view('admin.kartu-keluarga.index', compact('kartuKeluarga'));
    }

    // =============================
    // Form tambah KK
    // =============================
    public function create()
    {
        return view('admin.kartu-keluarga.create');
    }

    // =============================
    // Simpan KK baru
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'no_kk'          => 'required|string|size:16|unique:kartu_keluarga,no_kk',
            'kepala_keluarga'=> 'required|string|max:100',
            'alamat'         => 'required|string|max:255',
            'rt'             => 'required|string|max:10',
            'rw'             => 'required|string|max:10',
        ], [
            'no_kk.required'          => 'No. KK wajib diisi.',
            'no_kk.size'              => 'No. KK harus 16 digit.',
            'no_kk.unique'            => 'No. KK sudah terdaftar.',
            'kepala_keluarga.required'=> 'Nama kepala keluarga wajib diisi.',
            'alamat.required'         => 'Alamat wajib diisi.',
            'rt.required'             => 'RT wajib diisi.',
            'rw.required'             => 'RW wajib diisi.',
        ]);

        KartuKeluarga::create($request->only([
            'no_kk', 'kepala_keluarga', 'alamat', 'rt', 'rw'
        ]));

        return redirect()->route('kartu-keluarga.index')
            ->with('success', 'Data Kartu Keluarga berhasil ditambahkan.');
    }

    // =============================
    // Detail KK beserta anggota
    // =============================
    public function show(KartuKeluarga $kartuKeluarga)
    {
        $kartuKeluarga->load('warga');
        return view('admin.kartu-keluarga.show', compact('kartuKeluarga'));
    }

    // =============================
    // Form edit KK
    // =============================
    public function edit(KartuKeluarga $kartuKeluarga)
    {
        return view('admin.kartu-keluarga.edit', compact('kartuKeluarga'));
    }

    // =============================
    // Update KK
    // =============================
    public function update(Request $request, KartuKeluarga $kartuKeluarga)
    {
        $request->validate([
            'no_kk'          => 'required|string|size:16|unique:kartu_keluarga,no_kk,' . $kartuKeluarga->id,
            'kepala_keluarga'=> 'required|string|max:100',
            'alamat'         => 'required|string|max:255',
            'rt'             => 'required|string|max:10',
            'rw'             => 'required|string|max:10',
        ], [
            'no_kk.required'          => 'No. KK wajib diisi.',
            'no_kk.size'              => 'No. KK harus 16 digit.',
            'no_kk.unique'            => 'No. KK sudah terdaftar.',
            'kepala_keluarga.required'=> 'Nama kepala keluarga wajib diisi.',
            'alamat.required'         => 'Alamat wajib diisi.',
            'rt.required'             => 'RT wajib diisi.',
            'rw.required'             => 'RW wajib diisi.',
        ]);

        $kartuKeluarga->update($request->only([
            'no_kk', 'kepala_keluarga', 'alamat', 'rt', 'rw'
        ]));

        return redirect()->route('kartu-keluarga.index')
            ->with('success', 'Data Kartu Keluarga berhasil diperbarui.');
    }

    // =============================
    // Hapus KK
    // =============================
    public function destroy(KartuKeluarga $kartuKeluarga)
    {
        // Cek apakah masih ada anggota warga
        if ($kartuKeluarga->warga()->exists()) {
            return back()->with('error', 'Kartu Keluarga tidak dapat dihapus karena masih memiliki anggota warga.');
        }

        $kartuKeluarga->delete();

        return redirect()->route('kartu-keluarga.index')
            ->with('success', 'Data Kartu Keluarga berhasil dihapus.');
    }
}
