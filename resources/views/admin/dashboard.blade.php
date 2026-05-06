@extends('layouts.app')

@section('title', 'Dashboard Admin — RT 08 RW 02')
@section('page-title', 'Dashboard Admin')
@section('page-subtitle', 'Ringkasan data dan aktivitas terkini')

@section('content')
<div class="space-y-6">

    {{-- ===== STAT CARDS ===== --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Warga Aktif --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-800">{{ $stats['total_warga'] }}</p>
                <p class="text-xs text-slate-500 mt-0.5">Warga Aktif</p>
            </div>
        </div>

        {{-- Kartu Keluarga --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-800">{{ $stats['total_kk'] }}</p>
                <p class="text-xs text-slate-500 mt-0.5">Kartu Keluarga</p>
            </div>
        </div>

        {{-- Surat Diajukan --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-800">{{ $stats['surat_diajukan'] }}</p>
                <p class="text-xs text-slate-500 mt-0.5">Surat Diajukan</p>
            </div>
        </div>

        {{-- Pengaduan Masuk --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-800">{{ $stats['pengaduan_masuk'] }}</p>
                <p class="text-xs text-slate-500 mt-0.5">Pengaduan Masuk</p>
            </div>
        </div>
    </div>

    {{-- ===== STAT SEKUNDER ===== --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-blue-600 rounded-2xl p-4 text-white text-center">
            <p class="text-3xl font-bold">{{ $stats['surat_diproses'] }}</p>
            <p class="text-blue-200 text-xs mt-1">Surat Diproses</p>
        </div>
        <div class="bg-green-500 rounded-2xl p-4 text-white text-center">
            <p class="text-3xl font-bold">{{ $stats['surat_selesai'] }}</p>
            <p class="text-green-100 text-xs mt-1">Surat Selesai</p>
        </div>
        <div class="bg-orange-500 rounded-2xl p-4 text-white text-center">
            <p class="text-3xl font-bold">{{ $stats['pengaduan_diproses'] }}</p>
            <p class="text-orange-100 text-xs mt-1">Pengaduan Diproses</p>
        </div>
        <div class="bg-purple-600 rounded-2xl p-4 text-white text-center">
            <p class="text-3xl font-bold">{{ $stats['total_pengumuman'] }}</p>
            <p class="text-purple-200 text-xs mt-1">Total Pengumuman</p>
        </div>
        <div class="bg-teal-500 rounded-2xl p-4 text-white text-center">
            <p class="text-3xl font-bold">{{ $stats['total_kegiatan'] }}</p>
            <p class="text-teal-100 text-xs mt-1">Total Kegiatan</p>
        </div>
    </div>

    {{-- ===== TABEL & LIST BAWAH ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Surat Terbaru --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <h2 class="font-semibold text-slate-800 text-sm">Surat Terbaru</h2>
                <a href="{{ route('admin.surat.index') }}" class="text-xs text-blue-600 hover:underline">Lihat semua →</a>
            </div>
            <div class="divide-y divide-slate-50">
                @forelse($suratTerbaru as $surat)
                <div class="flex items-center gap-3 px-5 py-3">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $surat->jenis_surat }}</p>
                        <p class="text-xs text-slate-400">{{ $surat->warga->nama ?? '-' }} · {{ $surat->nomor_surat }}</p>
                    </div>
                    @php
                        $statusColor = match($surat->status) {
                            'diajukan'  => 'bg-slate-100 text-slate-600',
                            'diproses'  => 'bg-blue-100 text-blue-700',
                            'selesai'   => 'bg-green-100 text-green-700',
                            'ditolak'   => 'bg-red-100 text-red-700',
                            default     => 'bg-slate-100 text-slate-600',
                        };
                    @endphp
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $statusColor }} capitalize shrink-0">
                        {{ $surat->status }}
                    </span>
                </div>
                @empty
                <div class="px-5 py-6 text-center text-sm text-slate-400">Belum ada surat.</div>
                @endforelse
            </div>
        </div>

        {{-- Pengaduan Terbaru --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <h2 class="font-semibold text-slate-800 text-sm">Pengaduan Terbaru</h2>
                <a href="{{ route('admin.pengaduan.index') }}" class="text-xs text-blue-600 hover:underline">Lihat semua →</a>
            </div>
            <div class="divide-y divide-slate-50">
                @forelse($pengaduanTerbaru as $aduan)
                <div class="flex items-center gap-3 px-5 py-3">
                    <div class="w-9 h-9 rounded-xl bg-red-50 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $aduan->judul }}</p>
                        <p class="text-xs text-slate-400">{{ $aduan->warga->nama ?? '-' }} · {{ $aduan->created_at->diffForHumans() }}</p>
                    </div>
                    @php
                        $adColor = match($aduan->status) {
                            'dikirim'  => 'bg-amber-100 text-amber-700',
                            'diproses' => 'bg-blue-100 text-blue-700',
                            'selesai'  => 'bg-green-100 text-green-700',
                            default    => 'bg-slate-100 text-slate-600',
                        };
                    @endphp
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $adColor }} capitalize shrink-0">
                        {{ $aduan->status }}
                    </span>
                </div>
                @empty
                <div class="px-5 py-6 text-center text-sm text-slate-400">Belum ada pengaduan.</div>
                @endforelse
            </div>
        </div>

        {{-- Kegiatan Mendatang --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <h2 class="font-semibold text-slate-800 text-sm">Kegiatan Mendatang</h2>
                <a href="{{ route('admin.kegiatan.index') }}" class="text-xs text-blue-600 hover:underline">Lihat semua →</a>
            </div>
            <div class="divide-y divide-slate-50">
                @forelse($kegiatanMendatang as $kegiatan)
                <div class="flex items-center gap-3 px-5 py-3">
                    <div class="w-9 h-9 rounded-xl bg-teal-50 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $kegiatan->nama_kegiatan }}</p>
                        <p class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }} · {{ $kegiatan->lokasi }}</p>
                    </div>
                </div>
                @empty
                <div class="px-5 py-6 text-center text-sm text-slate-400">Tidak ada kegiatan mendatang.</div>
                @endforelse
            </div>
        </div>

        {{-- Pengumuman Terbaru --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <h2 class="font-semibold text-slate-800 text-sm">Pengumuman Terbaru</h2>
                <a href="{{ route('admin.pengumuman.index') }}" class="text-xs text-blue-600 hover:underline">Lihat semua →</a>
            </div>
            <div class="divide-y divide-slate-50">
                @forelse($pengumumanTerbaru as $umum)
                <div class="flex items-start gap-3 px-5 py-3">
                    <div class="w-9 h-9 rounded-xl bg-purple-50 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $umum->judul }}</p>
                        <p class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($umum->tanggal)->translatedFormat('d F Y') }}</p>
                    </div>
                </div>
                @empty
                <div class="px-5 py-6 text-center text-sm text-slate-400">Belum ada pengumuman.</div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
