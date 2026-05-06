@extends('layouts.app')

@section('title', 'Detail Kegiatan — Admin RT 08')
@section('page-title', 'Detail Kegiatan RT')
@section('page-subtitle', 'Informasi lengkap kegiatan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">Detail Kegiatan</h2>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.kegiatan.edit', $kegiatan) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-amber-700 bg-amber-50 rounded-xl hover:bg-amber-100 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form method="POST" action="{{ route('admin.kegiatan.destroy', $kegiatan) }}"
                      onsubmit="return confirm('Hapus kegiatan ini?')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-red-700 bg-red-50 rounded-xl hover:bg-red-100 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
                <a href="{{ route('admin.kegiatan.index') }}"
                   class="px-3 py-2 text-sm text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors">
                    ← Kembali
                </a>
            </div>
        </div>

        <div class="px-6 py-6 space-y-5 text-sm">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-teal-100 flex flex-col items-center justify-center shrink-0">
                    <span class="text-teal-700 font-bold text-lg leading-none">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d') }}</span>
                    <span class="text-teal-600 text-xs font-medium">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('M') }}</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-slate-800">{{ $kegiatan->nama_kegiatan }}</h1>
                    @php $isMendatang = \Carbon\Carbon::parse($kegiatan->tanggal)->isFuture(); @endphp
                    <span class="inline-block mt-1 text-xs px-2.5 py-0.5 rounded-full font-medium {{ $isMendatang ? 'bg-teal-100 text-teal-700' : 'bg-slate-100 text-slate-500' }}">
                        {{ $isMendatang ? 'Mendatang' : 'Sudah Selesai' }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Tanggal</p>
                    <p class="mt-1 text-slate-700 font-medium">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Lokasi</p>
                    <p class="mt-1 text-slate-700 font-medium">{{ $kegiatan->lokasi }}</p>
                </div>
                @if($kegiatan->user)
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Dibuat oleh</p>
                    <p class="mt-1 text-slate-700">{{ $kegiatan->user->name }}</p>
                </div>
                @endif
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Dibuat pada</p>
                    <p class="mt-1 text-slate-700">{{ $kegiatan->created_at->translatedFormat('d F Y') }}</p>
                </div>
            </div>

            @if($kegiatan->deskripsi)
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-2">Deskripsi</p>
                <div class="bg-slate-50 rounded-xl p-4 text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $kegiatan->deskripsi }}</div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
