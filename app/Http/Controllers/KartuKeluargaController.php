<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'nik'            => 'required|string|size:16|unique:warga,nik',
            'jenis_kelamin'  => 'required|in:L,P',
            'tanggal_lahir'  => 'required|date|before:today',
            'agama'          => 'required|string|max:20',
            'pekerjaan'      => 'required|string|max:50',
            'status_perkawinan' => 'required|string|max:30',
            'status'         => 'required|in:aktif,pindah,meninggal',
        ], [
            'no_kk.required'          => 'No. KK wajib diisi.',
            'no_kk.size'              => 'No. KK harus 16 digit.',
            'no_kk.unique'            => 'No. KK sudah terdaftar.',
            'kepala_keluarga.required'=> 'Nama kepala keluarga wajib diisi.',
            'alamat.required'         => 'Alamat wajib diisi.',
            'rt.required'             => 'RT wajib diisi.',
            'rw.required'             => 'RW wajib diisi.',
            'nik.required'            => 'NIK wajib diisi.',
            'nik.size'                => 'NIK harus 16 digit.',
            'nik.unique'              => 'NIK sudah terdaftar.',
            'jenis_kelamin.required'  => 'Jenis kelamin wajib dipilih.',
            'tanggal_lahir.required'  => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before'    => 'Tanggal lahir harus sebelum hari ini.',
            'agama.required'          => 'Agama wajib diisi.',
            'pekerjaan.required'      => 'Pekerjaan wajib diisi.',
            'status_perkawinan.required' => 'Status perkawinan wajib dipilih.',
            'status.required'         => 'Status wajib dipilih.',
        ]);

        DB::transaction(function () use ($request) {
            $kk = KartuKeluarga::create($request->only([
                'no_kk', 'kepala_keluarga', 'alamat', 'rt', 'rw'
            ]));

            Warga::create([
                'kartu_keluarga_id' => $kk->id,
                'nik'               => $request->nik,
                'nama'              => $request->kepala_keluarga,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'agama'             => $request->agama,
                'pekerjaan'         => $request->pekerjaan,
                'status_perkawinan' => $request->status_perkawinan,
                'status'            => $request->status,
            ]);
        });

        return redirect()->route('admin.kartu-keluarga.index')
            ->with('success', 'Data Kartu Keluarga dan Kepala Keluarga berhasil ditambahkan.');
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

        return redirect()->route('admin.kartu-keluarga.index')
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

        return redirect()->route('admin.kartu-keluarga.index')
            ->with('success', 'Data Kartu Keluarga berhasil dihapus.');
    }
}
