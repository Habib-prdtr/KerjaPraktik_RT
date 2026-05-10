<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengaduanController extends Controller
{
    const STATUS_LIST = ['dikirim', 'diproses', 'selesai'];

    // =============================
    // [ADMIN] Daftar semua pengaduan
    // =============================
    public function index(Request $request)
    {
        $query = Pengajuan::with('warga');

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhereHas('warga', fn($w) => $w->where('nama', 'like', "%{$keyword}%"));
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengaduan  = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
        $statusList = self::STATUS_LIST;

        return view('admin.pengaduan.index', compact('pengaduan', 'statusList'));
    }

    // =============================
    // [ADMIN] Detail pengaduan & beri tanggapan
    // =============================
    public function show(Pengajuan $pengaduan)
    {
        $pengaduan->load('warga');
        $statusList = self::STATUS_LIST;
        return view('admin.pengaduan.show', compact('pengaduan', 'statusList'));
    }

    // =============================
    // [ADMIN] Tanggapi pengaduan
    // =============================
    public function tanggapi(Request $request, Pengajuan $pengaduan)
    {
        $request->validate([
            'status'          => 'required|in:' . implode(',', self::STATUS_LIST),
            'tanggapan_admin' => 'required|string|max:1000',
        ], [
            'status.required'          => 'Status wajib dipilih.',
            'tanggapan_admin.required' => 'Tanggapan wajib diisi.',
            'tanggapan_admin.max'      => 'Tanggapan maksimal 1000 karakter.',
        ]);

        $pengaduan->update([
            'status'          => $request->status,
            'tanggapan_admin' => $request->tanggapan_admin,
        ]);

        return back()->with('success', 'Tanggapan berhasil dikirim.');
    }

    // =============================
    // [WARGA] Daftar pengaduan milik warga
    // =============================
    public function myPengaduan(Request $request)
    {
        $warga = Auth::user()->warga;

        if (!$warga) {
            return view('warga.pengaduan.index', ['pengaduanSaya' => collect()]);
        }

        $query = Pengajuan::where('warga_id', $warga->id);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengaduanSaya  = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
        $statusList = self::STATUS_LIST;

        return view('warga.pengaduan.index', compact('pengaduanSaya', 'statusList'));
    }

    // =============================
    // [WARGA] Form buat pengaduan
    // =============================
    public function create()
    {
        $warga = Auth::user()->warga;

        if (!$warga) {
            return redirect()->route('warga.dashboard')
                ->with('error', 'Data warga tidak ditemukan. Hubungi admin.');
        }

        return view('warga.pengaduan.create');
    }

    // =============================
    // [WARGA] Simpan pengaduan baru
    // =============================
    public function store(Request $request)
    {
        $warga = Auth::user()->warga;

        if (!$warga) {
            return redirect()->route('warga.dashboard')
                ->with('error', 'Data warga tidak ditemukan.');
        }

        $request->validate([
            'judul' => 'required|string|max:150',
            'isi'   => 'required|string|max:2000',
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ], [
            'judul.required' => 'Judul pengaduan wajib diisi.',
            'judul.max'      => 'Judul maksimal 150 karakter.',
            'isi.required'   => 'Isi pengaduan wajib diisi.',
            'foto.image'     => 'File harus berupa gambar.',
            'foto.mimes'     => 'Format gambar: JPG, PNG, atau WEBP.',
            'foto.max'       => 'Ukuran gambar maksimal 10MB.',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fileName = 'pengaduan_' . $warga->id . '_' . time() . '.' . $request->file('foto')->extension();
            $fotoPath = $request->file('foto')->storeAs('pengaduan', $fileName, 'public');
        }

        Pengajuan::create([
            'warga_id' => $warga->id,
            'judul'    => $request->judul,
            'isi'      => $request->isi,
            'foto'     => $fotoPath,
            'status'   => 'dikirim',
        ]);

        return redirect()->route('warga.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim. Kami akan segera menindaklanjuti.');
    }

    // =============================
    // [WARGA] Detail pengaduan milik warga
    // =============================
    public function showMyPengaduan(Pengajuan $pengaduan)
    {
        $warga = Auth::user()->warga;
        if (!$warga || $pengaduan->warga_id !== $warga->id) {
            abort(403, 'Akses ditolak.');
        }

        return view('warga.pengaduan.show', compact('pengaduan'));
    }

    // =============================
    // [WARGA] Hapus pengaduan (hanya yg belum diproses)
    // =============================
    public function destroy(Pengajuan $pengaduan)
    {
        $warga = Auth::user()->warga;
        if (!$warga || $pengaduan->warga_id !== $warga->id) {
            abort(403, 'Akses ditolak.');
        }

        if ($pengaduan->status !== 'dikirim') {
            return back()->with('error', 'Pengaduan yang sudah diproses tidak dapat dihapus.');
        }

        // Hapus foto jika ada
        if ($pengaduan->foto && Storage::disk('public')->exists($pengaduan->foto)) {
            Storage::disk('public')->delete($pengaduan->foto);
        }

        $pengaduan->delete();

        return redirect()->route('warga.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
