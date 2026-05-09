@extends('layouts.warga')

@section('title', $kegiatan->nama_kegiatan)
@section('page-subtitle', 'Detail Kegiatan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="bg-white border-b border-slate-100 px-4 py-4 flex items-center gap-3">
        <a href="{{ route('warga.kegiatan.index') }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-base font-bold text-slate-800 truncate">Detail Kegiatan</h1>
    </div>

    @php
        $isPast  = \Carbon\Carbon::parse($kegiatan->tanggal)->isPast();
        $isToday = \Carbon\Carbon::parse($kegiatan->tanggal)->isToday();
        $gradient = $isPast ? 'from-slate-600 to-slate-700' : ($isToday ? 'from-teal-400 to-emerald-500' : 'from-teal-500 to-emerald-600');
    @endphp

    {{-- Hero --}}
    <div class="bg-gradient-to-br {{ $gradient }} px-5 pt-6 pb-12 relative overflow-hidden rounded-3xl">
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full -translate-y-1/3 translate-x-1/3"></div>
        <div class="relative z-10">
            @if($isToday)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-white text-teal-700 mb-3 animate-pulse">🎉 Kegiatan Hari Ini!</span>
            @elseif($isPast)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/20 text-white mb-3">Sudah Berlalu</span>
            @else
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/20 text-white mb-3">📅 Akan Datang</span>
            @endif
            <h1 class="text-white text-2xl font-black leading-tight">{{ $kegiatan->nama_kegiatan }}</h1>
        </div>
    </div>

    <div class="px-4 -mt-6 pb-8 space-y-4">
        {{-- Info Cards --}}
        <div class="grid grid-cols-2 gap-3">
            <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/60 border border-slate-100 p-4 text-center">
                <span class="text-2xl block mb-1">📅</span>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Tanggal</p>
                <p class="text-sm font-black text-slate-800 mt-1">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d M Y') }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/60 border border-slate-100 p-4 text-center">
                <span class="text-2xl block mb-1">📍</span>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Lokasi</p>
                <p class="text-sm font-black text-slate-800 mt-1 leading-tight">{{ $kegiatan->lokasi }}</p>
            </div>
            @if($kegiatan->waktu)
            <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/60 border border-slate-100 p-4 text-center col-span-2">
                <span class="text-2xl block mb-1">🕐</span>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Waktu Pelaksanaan</p>
                <p class="text-sm font-black text-slate-800 mt-1">{{ $kegiatan->waktu }}</p>
            </div>
            @endif
        </div>

        {{-- Deskripsi --}}
        @if($kegiatan->deskripsi)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Deskripsi Kegiatan</p>
            <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $kegiatan->deskripsi }}</p>
        </div>
        @endif

        {{-- Banner --}}
        @if(!$isPast)
        <div class="bg-gradient-to-br from-teal-50 to-emerald-50 border border-teal-200 rounded-2xl p-4 flex items-center gap-3">
            <span class="text-3xl">🤝</span>
            <div>
                <p class="text-sm font-bold text-teal-800">Yuk, ikut berpartisipasi!</p>
                <p class="text-xs text-teal-700 mt-0.5">Seluruh warga RT 08 RW 02 diharapkan hadir dan berpartisipasi aktif.</p>
            </div>
        </div>
        @else
        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 flex items-center gap-3">
            <span class="text-3xl">📸</span>
            <p class="text-sm text-slate-600 font-medium">Kegiatan ini sudah berlangsung. Terima kasih atas partisipasi warga!</p>
        </div>
        @endif
    </div>
</div>
@endsection
