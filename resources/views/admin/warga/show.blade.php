@extends('layouts.app')

@section('title', 'Detail Warga — Admin RT 08')
@section('page-title', 'Detail Warga')
@section('page-subtitle', 'Profil lengkap dan riwayat warga')

@section('content')
<div class="space-y-5 max-w-4xl mx-auto">

    {{-- Info Warga --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">Profil Warga</h2>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.warga.edit', $warga) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-amber-700 bg-amber-50 rounded-xl hover:bg-amber-100 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('admin.warga.index') }}"
                   class="px-3 py-2 text-sm text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors">
                    ← Kembali
                </a>
            </div>
        </div>

        <div class="px-6 py-5">
            <div class="flex items-center gap-5 mb-6">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shrink-0">
                    <span class="text-white text-2xl font-bold">{{ strtoupper(substr($warga->nama, 0, 1)) }}</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-800">{{ $warga->nama }}</h3>
                    <p class="font-mono text-sm text-slate-400 mt-0.5">NIK: {{ $warga->nik }}</p>
                    @php
                        $sc = match($warga->status) {
                            'aktif'     => 'bg-green-100 text-green-700',
                            'pindah'    => 'bg-amber-100 text-amber-700',
                            'meninggal' => 'bg-slate-100 text-slate-500',
                            default     => 'bg-slate-100 text-slate-500',
                        };
                    @endphp
                    <span class="inline-block mt-1 text-xs px-2.5 py-0.5 rounded-full font-medium capitalize {{ $sc }}">{{ $warga->status }}</span>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-4 text-sm">
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Jenis Kelamin</p>
                    <p class="mt-1 text-slate-700 font-medium">{{ $warga->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Tanggal Lahir</p>
                    <p class="mt-1 text-slate-700 font-medium">{{ \Carbon\Carbon::parse($warga->tanggal_lahir)->translatedFormat('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Agama</p>
                    <p class="mt-1 text-slate-700 font-medium">{{ $warga->agama }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Pekerjaan</p>
                    <p class="mt-1 text-slate-700 font-medium">{{ $warga->pekerjaan }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Status Perkawinan</p>
                    <p class="mt-1 text-slate-700 font-medium">{{ $warga->status_perkawinan }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Kartu Keluarga</p>
                    @if($warga->kartuKeluarga)
                    <a href="{{ route('admin.kartu-keluarga.show', $warga->kartuKeluarga) }}"
                       class="mt-1 block text-blue-600 hover:underline font-medium">
                        {{ $warga->kartuKeluarga->kepala_keluarga }}
                    </a>
                    @else
                    <p class="mt-1 text-slate-300">Tidak ada</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        {{-- Riwayat Surat --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-slate-800 text-sm">Riwayat Surat</h3>
            </div>
            <div class="divide-y divide-slate-50">
                @forelse($warga->surat->take(5) as $surat)
                <div class="flex items-center gap-3 px-5 py-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $surat->jenis_surat }}</p>
                        <p class="text-xs text-slate-400 font-mono">{{ $surat->nomor_surat }}</p>
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
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $statusColor }} capitalize shrink-0">{{ $surat->status }}</span>
                </div>
                @empty
                <div class="px-5 py-5 text-center text-sm text-slate-400">Belum ada pengajuan surat.</div>
                @endforelse
            </div>
        </div>

        {{-- Riwayat Pengaduan --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-slate-800 text-sm">Riwayat Pengaduan</h3>
            </div>
            <div class="divide-y divide-slate-50">
                @forelse($warga->pengajuan->take(5) as $aduan)
                <div class="flex items-center gap-3 px-5 py-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $aduan->judul }}</p>
                        <p class="text-xs text-slate-400">{{ $aduan->created_at->diffForHumans() }}</p>
                    </div>
                    @php
                        $adColor = match($aduan->status) {
                            'dikirim'  => 'bg-amber-100 text-amber-700',
                            'diproses' => 'bg-blue-100 text-blue-700',
                            'selesai'  => 'bg-green-100 text-green-700',
                            default    => 'bg-slate-100 text-slate-600',
                        };
                    @endphp
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $adColor }} capitalize shrink-0">{{ $aduan->status }}</span>
                </div>
                @empty
                <div class="px-5 py-5 text-center text-sm text-slate-400">Belum ada pengaduan.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
