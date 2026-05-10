<?php

namespace App\Http\Controllers;

use App\Models\KegiatanRt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KegiatanRtController extends Controller
{
    // =============================
    // [ADMIN] Daftar semua kegiatan
    // =============================
    public function index(Request $request)
    {
        $query = KegiatanRt::with('user');

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_kegiatan', 'like', "%{$keyword}%")
                  ->orWhere('lokasi', 'like', "%{$keyword}%");
            });
        }

        // Filter: akan datang / sudah lewat
        if ($request->filled('filter')) {
            if ($request->filter === 'mendatang') {
                $query->where('tanggal', '>=', now()->toDateString());
            } elseif ($request->filter === 'lewat') {
                $query->where('tanggal', '<', now()->toDateString());
            }
        }

        $kegiatan = $query->orderByDesc('tanggal')->paginate(10)->withQueryString();

        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    // =============================
    // [ADMIN] Form tambah kegiatan
    // =============================
    public function create()
    {
        return view('admin.kegiatan.create');
    }

    // =============================
    // [ADMIN] Simpan kegiatan
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:150',
            'deskripsi'     => 'nullable|string|max:1000',
            'tanggal'       => 'required|date',
            'lokasi'        => 'required|string|max:150',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi.',
            'nama_kegiatan.max'      => 'Nama kegiatan maksimal 150 karakter.',
            'tanggal.required'       => 'Tanggal wajib diisi.',
            'tanggal.date'           => 'Format tanggal tidak valid.',
            'lokasi.required'        => 'Lokasi wajib diisi.',
            'foto.image'             => 'File harus berupa gambar.',
            'foto.max'               => 'Ukuran foto maksimal 10MB.',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fileName = 'kegiatan_' . time() . '.' . $request->file('foto')->extension();
            $fotoPath = $request->file('foto')->storeAs('kegiatan', $fileName, 'public');
        }

        KegiatanRt::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'deskripsi'     => $request->deskripsi,
            'tanggal'       => $request->tanggal,
            'lokasi'        => $request->lokasi,
            'foto'          => $fotoPath,
            'created_by'    => Auth::id(),
        ]);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan RT berhasil ditambahkan.');
    }

    // =============================
    // [ADMIN] Detail kegiatan
    // =============================
    public function show(KegiatanRt $kegiatan)
    {
        $kegiatan->load('user');
        return view('admin.kegiatan.show', compact('kegiatan'));
    }

    // =============================
    // [ADMIN] Form edit kegiatan
    // =============================
    public function edit(KegiatanRt $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    // =============================
    // [ADMIN] Update kegiatan
    // =============================
    public function update(Request $request, KegiatanRt $kegiatan)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:150',
            'deskripsi'     => 'nullable|string|max:1000',
            'tanggal'       => 'required|date',
            'lokasi'        => 'required|string|max:150',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi.',
            'tanggal.required'       => 'Tanggal wajib diisi.',
            'lokasi.required'        => 'Lokasi wajib diisi.',
            'foto.image'             => 'File harus berupa gambar.',
            'foto.max'               => 'Ukuran foto maksimal 10MB.',
        ]);

        $data = $request->only(['nama_kegiatan', 'deskripsi', 'tanggal', 'lokasi']);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($kegiatan->foto && Storage::disk('public')->exists($kegiatan->foto)) {
                Storage::disk('public')->delete($kegiatan->foto);
            }
            $fileName = 'kegiatan_' . time() . '.' . $request->file('foto')->extension();
            $data['foto'] = $request->file('foto')->storeAs('kegiatan', $fileName, 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan RT berhasil diperbarui.');
    }

    // =============================
    // [ADMIN] Hapus kegiatan
    // =============================
    public function destroy(KegiatanRt $kegiatan)
    {
        if ($kegiatan->foto && Storage::disk('public')->exists($kegiatan->foto)) {
            Storage::disk('public')->delete($kegiatan->foto);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan RT berhasil dihapus.');
    }

    // =============================
    // [WARGA] Lihat daftar kegiatan
    // =============================
    public function listWarga(Request $request)
    {
        $query = KegiatanRt::query();

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_kegiatan', 'like', "%{$keyword}%")
                  ->orWhere('lokasi', 'like', "%{$keyword}%");
            });
        }

        $kegiatan           = $query->orderByDesc('tanggal')->paginate(10)->withQueryString();
        $kegiatanMendatang  = KegiatanRt::where('tanggal', '>=', now()->toDateString())
                                ->orderBy('tanggal')
                                ->take(5)
                                ->get();

        return view('warga.kegiatan.index', compact('kegiatan', 'kegiatanMendatang'));
    }

    // =============================
    // [WARGA] Detail kegiatan
    // =============================
    public function showWarga(KegiatanRt $kegiatan)
    {
        return view('warga.kegiatan.show', compact('kegiatan'));
    }
}
