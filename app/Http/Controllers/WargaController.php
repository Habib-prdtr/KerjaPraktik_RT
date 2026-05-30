<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    // =============================
    // Daftar semua warga
    // =============================
    public function index(Request $request)
    {
        $query = Warga::with('kartuKeluarga');

        // Filter pencarian
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('nik', 'like', "%{$keyword}%")
                  ->orWhere('nama', 'like', "%{$keyword}%");
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $warga = $query->orderBy('nama')->paginate(10)->withQueryString();

        return view('admin.warga.index', compact('warga'));
    }

    // =============================
    // Form tambah warga
    // =============================
    public function create()
    {
        $kartuKeluarga = KartuKeluarga::orderBy('kepala_keluarga')->get();
        return view('admin.warga.create', compact('kartuKeluarga'));
    }

    // =============================
    // Simpan warga baru
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'kartu_keluarga_id' => 'required|exists:kartu_keluarga,id',
            'nik'               => 'required|string|size:16|unique:warga,nik',
            'nama'              => 'required|string|max:100',
            'jenis_kelamin'     => 'required|in:L,P',
            'tanggal_lahir'     => 'required|date|before:today',
            'agama'             => 'required|string|max:20',
            'pekerjaan'         => 'required|string|max:50',
            'status_perkawinan' => 'required|string|max:30',
            'status'            => 'required|in:aktif,pindah,meninggal',
        ], [
            'kartu_keluarga_id.required' => 'Kartu Keluarga wajib dipilih.',
            'kartu_keluarga_id.exists'   => 'Kartu Keluarga tidak ditemukan.',
            'nik.required'               => 'NIK wajib diisi.',
            'nik.size'                   => 'NIK harus 16 digit.',
            'nik.unique'                 => 'NIK sudah terdaftar.',
            'nama.required'              => 'Nama wajib diisi.',
            'jenis_kelamin.required'     => 'Jenis kelamin wajib dipilih.',
            'tanggal_lahir.required'     => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before'       => 'Tanggal lahir harus sebelum hari ini.',
            'agama.required'             => 'Agama wajib diisi.',
            'pekerjaan.required'         => 'Pekerjaan wajib diisi.',
            'status_perkawinan.required' => 'Status perkawinan wajib dipilih.',
            'status.required'            => 'Status wajib dipilih.',
        ]);

        Warga::create($request->only([
            'kartu_keluarga_id', 'nik', 'nama', 'jenis_kelamin',
            'tanggal_lahir', 'agama', 'pekerjaan', 'status_perkawinan', 'status'
        ]));

        return redirect()->route('admin.warga.index')
            ->with('success', 'Data warga berhasil ditambahkan.');
    }

    // =============================
    // Detail warga
    // =============================
    public function show(Warga $warga)
    {
        $warga->load(['kartuKeluarga', 'surat', 'pengajuan']);
        return view('admin.warga.show', compact('warga'));
    }

    // =============================
    // Form edit warga
    // =============================
    public function edit(Warga $warga)
    {
        $kartuKeluarga = KartuKeluarga::orderBy('kepala_keluarga')->get();
        return view('admin.warga.edit', compact('warga', 'kartuKeluarga'));
    }

    // =============================
    // Update warga
    // =============================
    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'kartu_keluarga_id' => 'required|exists:kartu_keluarga,id',
            'nik'               => 'required|string|size:16|unique:warga,nik,' . $warga->id,
            'nama'              => 'required|string|max:100',
            'jenis_kelamin'     => 'required|in:L,P',
            'tanggal_lahir'     => 'required|date|before:today',
            'agama'             => 'required|string|max:20',
            'pekerjaan'         => 'required|string|max:50',
            'status_perkawinan' => 'required|string|max:30',
            'status'            => 'required|in:aktif,pindah,meninggal',
        ], [
            'kartu_keluarga_id.required' => 'Kartu Keluarga wajib dipilih.',
            'nik.required'               => 'NIK wajib diisi.',
            'nik.size'                   => 'NIK harus 16 digit.',
            'nik.unique'                 => 'NIK sudah terdaftar.',
            'nama.required'              => 'Nama wajib diisi.',
            'jenis_kelamin.required'     => 'Jenis kelamin wajib dipilih.',
            'tanggal_lahir.required'     => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before'       => 'Tanggal lahir harus sebelum hari ini.',
            'agama.required'             => 'Agama wajib diisi.',
            'pekerjaan.required'         => 'Pekerjaan wajib diisi.',
            'status_perkawinan.required' => 'Status perkawinan wajib dipilih.',
            'status.required'            => 'Status wajib dipilih.',
        ]);

        $warga->update($request->only([
            'kartu_keluarga_id', 'nik', 'nama', 'jenis_kelamin',
            'tanggal_lahir', 'agama', 'pekerjaan', 'status_perkawinan', 'status'
        ]));

        return redirect()->route('admin.warga.index')
            ->with('success', 'Data warga berhasil diperbarui.');
    }

    // =============================
    // Hapus warga
    // =============================
    public function destroy(Warga $warga)
    {
        // Cek apakah warga memiliki akun user
        if ($warga->user()->exists()) {
            return back()->with('error', 'Warga tidak dapat dihapus karena memiliki akun pengguna.');
        }

        $warga->delete();

        return redirect()->route('admin.warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }
}
