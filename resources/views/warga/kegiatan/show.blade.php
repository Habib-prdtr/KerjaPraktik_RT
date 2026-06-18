@extends('layouts.warga')
@section('title', $kegiatan->nama_kegiatan . ' — Portal Warga RT 08')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 space-y-6 pb-8">

    @php
        $isPast  = \Carbon\Carbon::parse($kegiatan->tanggal)->isPast();
        $isToday = \Carbon\Carbon::parse($kegiatan->tanggal)->isToday();
    @endphp

    {{-- Back Header --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('warga.kegiatan.index') }}"
           class="w-11 h-11 rounded-2xl bg-white border border-slate-200 hover:border-emerald-300 hover:bg-emerald-50 flex items-center justify-center transition-all shadow-sm group">
            <svg class="w-5 h-5 text-slate-600 group-hover:text-emerald-600 group-hover:-translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 leading-tight">Detail Kegiatan Warga</h1>
            <p class="text-xs text-slate-500 font-bold mt-0.5">Informasi lengkap agenda dan kegiatan sosial RT 08</p>
        </div>
    </div>

    {{-- Hero Header Banner --}}
    <div class="hero-warga rounded-[2.5rem] shadow-xl shadow-emerald-900/10 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-teal-400/25 rounded-full -translate-y-1/3 translate-x-1/4 blur-3xl pointer-events-none"></div>
        <div class="relative z-10 px-7 py-10 md:px-10 md:py-12">
            @if($isToday)
            <div class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-400/30 rounded-2xl px-4 py-2 mb-4 animate-pulse">
                <span class="text-base"><svg class="w-5 h-5 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"/></svg></span>
                <span class="text-[10px] font-black text-emerald-100 uppercase tracking-widest">Hari Ini!</span>
            </div>
            @elseif($isPast)
            <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 rounded-2xl px-4 py-2 mb-4">
                <span class="text-[10px] font-extrabold text-white/60 uppercase tracking-widest">Kegiatan Selesai</span>
            </div>
            @else
            <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 rounded-2xl px-4 py-2 mb-4">
                <span class="text-base"><svg class="w-4 h-4 inline-block text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></span>
                <span class="text-[10px] font-extrabold text-white/90 uppercase tracking-widest">Akan Datang</span>
            </div>
            @endif
            <h1 class="text-white text-xl md:text-3xl font-extrabold leading-tight drop-shadow-sm">{{ $kegiatan->nama_kegiatan }}</h1>
        </div>
    </div>

    {{-- Photo --}}
    @if($kegiatan->foto)
    <div class="card-premium p-2 overflow-hidden bg-white border border-slate-100 shadow-sm group">
        <div class="relative overflow-hidden rounded-[1.25rem] bg-slate-100">
            <img src="{{ Storage::url($kegiatan->foto) }}" alt="Foto Kegiatan"
                 class="w-full h-auto max-h-80 object-cover group-hover:scale-[1.01] transition-transform duration-700">
            <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm border border-slate-200 px-3 py-1.5 rounded-xl shadow-sm opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                <p class="flex items-center gap-1 text-[10px] font-black text-slate-700 uppercase tracking-widest"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> Dokumentasi</p>
            </div>
        </div>
    </div>
    @endif

    {{-- Info Cards --}}
    <div class="grid grid-cols-2 gap-4">
        <div class="card-premium p-5 text-center bg-white border border-slate-100 shadow-sm">
            <div class="text-3xl mb-2"><svg class="w-4 h-4 inline-block text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1">TANGGAL</p>
            <p class="text-sm font-extrabold text-slate-800">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d M Y') }}</p>
        </div>
        <div class="card-premium p-5 text-center bg-white border border-slate-100 shadow-sm">
            <div class="text-3xl mb-2"><svg class="w-3.5 h-3.5 inline-block text-slate-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1">LOKASI</p>
            <p class="text-sm font-extrabold text-slate-800 leading-tight line-clamp-2">{{ $kegiatan->lokasi }}</p>
        </div>
        @if($kegiatan->waktu)
        <div class="card-premium p-5 col-span-2 flex items-center gap-5 bg-white border border-slate-100 shadow-sm">
            <div class="shrink-0"><svg class="w-9 h-9 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            <div class="flex-1">
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-0.5">WAKTU PELAKSANAAN</p>
                <p class="text-base font-extrabold text-slate-800">{{ $kegiatan->waktu }} WIB</p>
            </div>
            @if($isToday)
            <span class="relative flex h-3 w-3 shrink-0">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
            </span>
            @endif
        </div>
        @endif
    </div>

    {{-- Deskripsi Rincian --}}
    @if($kegiatan->deskripsi)
    <div class="card-premium p-6 bg-white border border-slate-100 shadow-sm">
        <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-100">
            <span class="text-lg"><svg class="w-3.5 h-3.5 inline-block text-slate-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg></span>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Rincian Kegiatan</p>
        </div>
        <div class="text-slate-700 text-sm md:text-base font-bold leading-relaxed whitespace-pre-wrap">
            {!! nl2br(e($kegiatan->deskripsi)) !!}
        </div>
    </div>
    @endif

    {{-- CTA Banner --}}
    @if(!$isPast)
    <div class="bg-gradient-to-br from-emerald-50 to-teal-50/50 border border-emerald-100 rounded-3xl p-6 flex items-start gap-4 shadow-sm">
        <div class="w-12 h-12 rounded-2xl bg-white border border-emerald-100 flex items-center justify-center shrink-0 shadow-sm text-2xl"><svg class="w-6 h-6 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
        <div>
            <p class="text-base font-extrabold text-emerald-950 mb-0.5">Mari Hadir & Berpartisipasi!</p>
            <p class="text-xs text-emerald-800 font-bold leading-relaxed">Kehadiran Bapak/Ibu sekalian sangat berharga demi kerukunan, kelancaran, dan kebersamaan seluruh warga RT 08 RW 02.</p>
        </div>
    </div>
    @else
    <div class="bg-slate-50 border border-slate-200 border-dashed rounded-3xl p-6 flex items-center gap-4">
        <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center shrink-0 shadow-sm"><svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
        <div>
            <p class="text-sm font-extrabold text-slate-700">Kegiatan Telah Selesai</p>
            <p class="text-xs font-bold text-slate-500 mt-0.5">Terima kasih banyak atas partisipasi, tenaga, dan waktu yang diluangkan oleh seluruh warga RT!</p>
        </div>
    </div>
    @endif

    {{-- Back to List Button --}}
    <a href="{{ route('warga.kegiatan.index') }}"
       class="w-full flex items-center justify-center gap-2 bg-white border-2 border-slate-200 text-slate-700 hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700 font-bold py-4 px-6 rounded-2xl transition-all text-sm group shadow-sm">
        <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Agenda Kegiatan
    </a>
</div>
@endsection

