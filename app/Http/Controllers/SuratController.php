<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SuratController extends Controller
{
    // Status surat yang valid
    const STATUS_LIST = ['diajukan', 'diproses', 'selesai', 'ditolak'];

    // Jenis surat yang tersedia
    const JENIS_SURAT = [
        'Surat Keterangan Domisili',
        'Surat Keterangan Tidak Mampu',
        'Surat Keterangan Usaha',
        'Surat Pengantar KTP',
        'Surat Pengantar KK',
        'Surat Keterangan Kelahiran',
        'Surat Keterangan Kematian',
        'Surat Keterangan Pindah',
        'Surat Keterangan Belum Menikah',
        'Surat Keterangan Lainnya',
    ];

    // =============================
    // [ADMIN] Daftar semua surat
    // =============================
    public function index(Request $request)
    {
        $query = Surat::with('warga');

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('nomor_surat', 'like', "%{$keyword}%")
                  ->orWhere('jenis_surat', 'like', "%{$keyword}%")
                  ->orWhereHas('warga', fn($w) => $w->where('nama', 'like', "%{$keyword}%"));
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $surat = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
        $statusList = self::STATUS_LIST;

        return view('admin.surat.index', compact('surat', 'statusList'));
    }

    // =============================
    // [ADMIN] Detail surat
    // =============================
    public function show(Surat $surat)
    {
        $surat->load('warga.kartuKeluarga');
        return view('admin.surat.show', compact('surat'));
    }

    // =============================
    // [ADMIN] Update status surat & upload PDF
    // =============================
    public function updateStatus(Request $request, Surat $surat)
    {
        if ($surat->status === 'selesai') {
            return redirect()->route('admin.surat.index')
                ->with('error', 'Status surat yang sudah selesai tidak dapat diubah lagi.');
        }

        // Batasi status baru yang diperbolehkan berdasarkan status saat ini
        $allowedStatuses = [];
        if ($surat->status === 'diajukan') {
            $allowedStatuses = ['diproses', 'ditolak'];
        } elseif ($surat->status === 'diproses') {
            $allowedStatuses = ['selesai'];
        }

        // Jika status saat ini sudah ditolak atau tidak ada transisi yang diperbolehkan
        if (empty($allowedStatuses)) {
            return redirect()->route('admin.surat.index')
                ->with('error', 'Status surat ini tidak dapat diubah lagi.');
        }

        $request->validate([
            'status'   => 'required|in:' . implode(',', $allowedStatuses),
            'file_pdf' => 'nullable|file|mimes:pdf|max:2048',
        ], [
            'status.required' => 'Status wajib dipilih.',
            'status.in'       => 'Pilihan status tidak valid untuk tahap proses ini.',
            'file_pdf.mimes'  => 'File harus berformat PDF.',
            'file_pdf.max'    => 'Ukuran file maksimal 2MB.',
        ]);

        $data = ['status' => $request->status];

        // Upload file PDF jika ada
        if ($request->hasFile('file_pdf')) {
            // Hapus file lama jika ada
            if ($surat->file_pdf && Storage::disk('public')->exists($surat->file_pdf)) {
                Storage::disk('public')->delete($surat->file_pdf);
            }

            $fileName = 'surat_' . Str::slug($surat->nomor_surat) . '_' . time() . '.pdf';
            $path     = $request->file('file_pdf')->storeAs('surat', $fileName, 'public');
            $data['file_pdf'] = $path;
        }

        $surat->update($data);

        return redirect()->route('admin.surat.index')->with('success', 'Status surat berhasil diperbarui.');
    }

    // =============================
    // [WARGA] Daftar surat milik warga yang login
    // =============================
    public function mySurat(Request $request)
    {
        $warga = Auth::user()->warga;

        if (!$warga) {
            return view('warga.surat.index', ['suratSaya' => collect(), 'jenisSurat' => self::JENIS_SURAT]);
        }

        $query = Surat::where('warga_id', $warga->id);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $suratSaya  = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
        $statusList = self::STATUS_LIST;
        $jenisSurat = self::JENIS_SURAT;

        return view('warga.surat.index', compact('suratSaya', 'statusList', 'jenisSurat'));
    }

    // =============================
    // [WARGA] Form pengajuan surat baru
    // =============================
    public function create()
    {
        $warga = Auth::user()->warga;

        if (!$warga) {
            return redirect()->route('warga.dashboard')
                ->with('error', 'Data warga tidak ditemukan. Hubungi admin.');
        }

        $jenisSurat = self::JENIS_SURAT;
        return view('warga.surat.create', compact('jenisSurat', 'warga'));
    }

    // =============================
    // [WARGA] Simpan pengajuan surat
    // =============================
    public function store(Request $request)
    {
        $warga = Auth::user()->warga;

        if (!$warga) {
            return redirect()->route('warga.dashboard')
                ->with('error', 'Data warga tidak ditemukan.');
        }

        $request->validate([
            'jenis_surat' => 'required|string|max:100',
            'keperluan'   => 'required|string|max:500',
        ], [
            'jenis_surat.required' => 'Jenis surat wajib dipilih.',
            'keperluan.required'   => 'Keperluan wajib diisi.',
            'keperluan.max'        => 'Keperluan maksimal 500 karakter.',
        ]);

        // Generate nomor surat otomatis
        $nomorSurat = $this->generateNomorSurat();

        Surat::create([
            'warga_id'    => $warga->id,
            'jenis_surat' => $request->jenis_surat,
            'nomor_surat' => $nomorSurat,
            'keperluan'   => $request->keperluan,
            'status'      => 'diajukan',
        ]);

        return redirect()->route('warga.surat.index')
            ->with('success', 'Pengajuan surat berhasil dikirim. Nomor surat: ' . $nomorSurat);
    }

    // =============================
    // [WARGA] Detail surat milik warga
    // =============================
    public function showMySurat(Surat $surat)
    {
        // Pastikan hanya warga pemilik yang bisa lihat
        $warga = Auth::user()->warga;
        if (!$warga || $surat->warga_id !== $warga->id) {
            abort(403, 'Akses ditolak.');
        }

        return view('warga.surat.show', compact('surat'));
    }
    // =============================
    // [WARGA] Hapus/Batalkan surat
    // =============================
    public function destroy(Surat $surat)
    {
        $warga = Auth::user()->warga;
        if (!$warga || $surat->warga_id !== $warga->id) {
            abort(403, 'Akses ditolak.');
        }

        if ($surat->status !== 'diajukan') {
            return redirect()->route('warga.surat.show', $surat)
                ->with('error', 'Hanya surat dengan status "diajukan" yang dapat dibatalkan.');
        }

        if ($surat->file_pdf && Storage::disk('public')->exists($surat->file_pdf)) {
            Storage::disk('public')->delete($surat->file_pdf);
        }

        $surat->delete();

        return redirect()->route('warga.surat.index')
            ->with('success', 'Pengajuan surat berhasil dibatalkan dan dihapus.');
    }
    // =============================
    // Helper: generate nomor surat
    // =============================
    private function generateNomorSurat(): string
    {
        $bulan    = now()->format('m');
        $tahun    = now()->format('Y');
        $urutan   = Surat::whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->count() + 1;
        $sequence = str_pad($urutan, 3, '0', STR_PAD_LEFT);

        return "RT-{$sequence}/{$bulan}/{$tahun}";
    }
}
