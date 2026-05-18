@extends('layouts.warga')

@section('title', $kegiatan->nama_kegiatan)
@section('page-subtitle', 'Detail Kegiatan')

@push('styles')
<style>
    .bento-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        border-radius: 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="max-w-3xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">
    <div class="bento-card p-6 flex items-center gap-4 relative overflow-hidden">
        <a href="{{ route('warga.kegiatan.index') }}" class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200 hover:bg-slate-100 flex items-center justify-center transition-all shadow-sm hover:shadow group shrink-0 relative z-10">
            <svg class="w-6 h-6 text-slate-600 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div class="relative z-10">
            <h1 class="text-xl lg:text-2xl font-black text-slate-900">Detail Kegiatan</h1>
            <p class="text-sm font-medium text-slate-500 mt-0.5">Informasi lengkap agenda RT</p>
        </div>
    </div>

    @php
        $isPast  = \Carbon\Carbon::parse($kegiatan->tanggal)->isPast();
        $isToday = \Carbon\Carbon::parse($kegiatan->tanggal)->isToday();
        $bgClass = $isPast ? 'bg-slate-800' : 'bg-slate-900';
    @endphp

    {{-- Hero --}}
    <div class="{{ $bgClass }} px-6 lg:px-8 py-10 relative overflow-hidden rounded-[2rem] shadow-xl border border-slate-800">
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        <div class="absolute top-0 right-0 w-48 h-48 bg-blue-500/10 rounded-full -translate-y-1/3 translate-x-1/3 blur-xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-indigo-500/10 rounded-full translate-y-1/3 -translate-x-1/3 blur-xl pointer-events-none"></div>
        
        <div class="relative z-10 text-center md:text-left">
            @if($isToday)
            <div class="inline-flex items-center gap-2 bg-blue-600/20 border border-blue-500/30 px-3 py-1.5 rounded-lg mb-4 animate-pulse shadow-sm">
                <span class="text-base">🎉</span>
                <span class="text-[10px] font-black text-blue-400 uppercase tracking-widest">Hari Ini!</span>
            </div>
            @elseif($isPast)
            <div class="inline-flex items-center gap-2 bg-slate-700/50 border border-slate-600/50 px-3 py-1.5 rounded-lg mb-4">
                <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Selesai</span>
            </div>
            @else
            <div class="inline-flex items-center gap-2 bg-blue-500/10 border border-blue-500/20 px-3 py-1.5 rounded-lg mb-4">
                <span class="text-[10px] font-bold text-blue-300 uppercase tracking-widest">Akan Datang</span>
            </div>
            @endif
            
            <h1 class="text-white text-2xl lg:text-3xl font-black leading-tight drop-shadow-sm">{{ $kegiatan->nama_kegiatan }}</h1>
        </div>
    </div>

    <div class="space-y-6 pb-6">
        {{-- Foto Dokumentasi --}}
        @if($kegiatan->foto)
        <div class="bento-card p-2 shadow-sm overflow-hidden group">
            <div class="relative overflow-hidden rounded-xl bg-slate-100">
                <img src="{{ Storage::url($kegiatan->foto) }}" alt="Foto Kegiatan" class="w-full h-auto max-h-96 object-cover transform group-hover:scale-105 transition-transform duration-700">
                <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-lg border border-slate-200 shadow-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-2 group-hover:translate-y-0">
                    <p class="text-[10px] font-black text-slate-700 uppercase tracking-widest">Dokumentasi</p>
                </div>
            </div>
        </div>
        @endif

        {{-- Info Cards --}}
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-white border border-slate-200 rounded-2xl p-5 lg:p-6 text-center shadow-sm">
                <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="text-xl">📅</span>
                </div>
                <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest">Tanggal</p>
                <p class="text-sm font-black text-slate-900 mt-1">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d M Y') }}</p>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl p-5 lg:p-6 text-center shadow-sm">
                <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="text-xl">📍</span>
                </div>
                <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest">Lokasi</p>
                <p class="text-sm font-black text-slate-900 mt-1 leading-tight line-clamp-2">{{ $kegiatan->lokasi }}</p>
            </div>
            @if($kegiatan->waktu)
            <div class="bg-white border border-slate-200 rounded-2xl p-5 lg:p-6 flex items-center justify-between col-span-2 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center shrink-0">
                        <span class="text-xl">🕐</span>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest">Waktu Pelaksanaan</p>
                        <p class="text-base font-black text-slate-900 mt-0.5">{{ $kegiatan->waktu }}</p>
                    </div>
                </div>
                @if($isToday)
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-600"></span>
                </span>
                @endif
            </div>
            @endif
        </div>

        {{-- Deskripsi --}}
        @if($kegiatan->deskripsi)
        <div class="bento-card p-6 lg:p-8">
            <div class="flex items-center gap-2 mb-4 border-b border-slate-100 pb-3">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h7"/></svg>
                <h3 class="text-xs font-black text-slate-500 uppercase tracking-widest">Rincian Kegiatan</h3>
            </div>
            <div class="prose prose-slate max-w-none text-slate-700 font-medium leading-relaxed">
                {!! nl2br(e($kegiatan->deskripsi)) !!}
            </div>
        </div>
        @endif

        {{-- Banner --}}
        @if(!$isPast)
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 lg:p-6 flex items-start gap-5 shadow-sm relative overflow-hidden">
            <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center shrink-0 border border-blue-200 shadow-sm text-2xl relative z-10">
                🤝
            </div>
            <div class="relative z-10 pt-1">
                <p class="text-base font-black text-blue-900 mb-1">Mari Berpartisipasi!</p>
                <p class="text-sm text-blue-800 font-medium leading-relaxed">Seluruh warga RT 08 RW 02 diharapkan kehadirannya untuk berpartisipasi aktif dalam kegiatan ini.</p>
            </div>
        </div>
        @else
        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 lg:p-6 flex items-center gap-5 border-dashed">
            <div class="w-12 h-12 bg-white border border-slate-200 shadow-sm rounded-full flex items-center justify-center shrink-0 text-xl">
                📸
            </div>
            <div>
                <p class="text-sm font-black text-slate-800">Kegiatan Selesai</p>
                <p class="text-xs font-medium text-slate-500 mt-0.5">Kegiatan ini sudah berlangsung. Terima kasih atas partisipasi seluruh warga!</p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
