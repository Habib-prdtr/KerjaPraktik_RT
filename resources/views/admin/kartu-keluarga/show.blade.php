@extends('layouts.app')

@section('title', 'Detail KK — Admin RT 08')
@section('page-title', 'Detail Kartu Keluarga')
@section('page-subtitle', 'Informasi lengkap kartu keluarga dan anggota')

@section('content')
<div class="space-y-5 max-w-4xl mx-auto">

    {{-- Card Info KK --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-slate-800">Informasi Kartu Keluarga</h2>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.kartu-keluarga.edit', $kartuKeluarga) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-amber-700 bg-amber-50 rounded-xl hover:bg-amber-100 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('admin.kartu-keluarga.index') }}"
                   class="px-3 py-2 text-sm text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors">
                    ← Kembali
                </a>
            </div>
        </div>

        <div class="px-6 py-5 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Nomor KK</p>
                <p class="mt-1 font-mono font-semibold text-slate-800 text-lg">{{ $kartuKeluarga->no_kk }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Kepala Keluarga</p>
                <p class="mt-1 font-semibold text-slate-800 text-lg">{{ $kartuKeluarga->kepala_keluarga }}</p>
            </div>
            <div class="sm:col-span-2">
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Alamat</p>
                <p class="mt-1 text-slate-700">{{ $kartuKeluarga->alamat }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">RT / RW</p>
                <p class="mt-1 text-slate-700 font-medium">RT {{ $kartuKeluarga->rt }} / RW {{ $kartuKeluarga->rw }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Didaftarkan</p>
                <p class="mt-1 text-slate-700">{{ $kartuKeluarga->created_at->translatedFormat('d F Y') }}</p>
            </div>
        </div>
    </div>

    {{-- Daftar Anggota --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">
                Anggota Keluarga
                <span class="ml-2 text-xs bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full font-medium">{{ $kartuKeluarga->warga->count() }} orang</span>
            </h2>
            <a href="{{ route('admin.warga.create') }}"
               class="inline-flex items-center gap-1.5 text-sm text-emerald-600 hover:underline">
                + Tambah Warga
            </a>
        </div>

        @if($kartuKeluarga->warga->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-emerald-600 to-teal-600 border-b-0">
                        <th class="text-left px-5 py-3 text-xs font-semibold text-white/90 uppercase tracking-wider">NIK</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-white/90 uppercase tracking-wider">Nama</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-white/90 uppercase tracking-wider">JK</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-white/90 uppercase tracking-wider">Pekerjaan</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-white/90 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($kartuKeluarga->warga as $w)
                    <tr class="hover:bg-emerald-50/60 transition-colors border-b border-slate-50">
                        <td class="px-5 py-3 font-mono text-xs text-slate-600">{{ $w->nik }}</td>
                        <td class="px-5 py-3 font-medium text-slate-800">{{ $w->nama }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $w->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $w->pekerjaan }}</td>
                        <td class="px-5 py-3">
                            @php
                                $sc = match($w->status) {
                                    'aktif'     => 'bg-green-100 text-green-700',
                                    'pindah'    => 'bg-amber-100 text-amber-700',
                                    'meninggal' => 'bg-slate-100 text-slate-500',
                                    default     => 'bg-slate-100 text-slate-500',
                                };
                            @endphp
                            <span class="text-xs px-2 py-0.5 rounded-full font-medium capitalize {{ $sc }}">{{ $w->status }}</span>
                        </td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('admin.warga.show', $w) }}" class="text-xs text-emerald-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="px-6 py-8 text-center text-slate-400 text-sm">
            Belum ada anggota keluarga terdaftar.
        </div>
        @endif
    </div>

</div>
@endsection
