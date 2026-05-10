@extends('layouts.warga')

@section('title', $pengumuman->judul)
@section('page-subtitle', 'Pengumuman RT')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">
    <div class="glass-panel rounded-[2rem] p-6 flex items-center gap-4 relative overflow-hidden">
        <a href="{{ route('warga.pengumuman.index') }}" class="w-12 h-12 rounded-[1rem] bg-white border border-slate-200 hover:bg-slate-50 flex items-center justify-center transition-all shadow-sm hover:shadow group shrink-0 relative z-10">
            <svg class="w-6 h-6 text-slate-600 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div class="relative z-10">
            <h1 class="text-xl lg:text-2xl font-black text-slate-800">Detail Pengumuman</h1>
            <p class="text-sm font-medium text-slate-500 mt-0.5">Informasi resmi dari pengurus RT</p>
        </div>
    </div>

    <div class="bg-gradient-to-br from-purple-500 via-fuchsia-600 to-pink-600 px-6 lg:px-8 pt-8 pb-10 relative overflow-hidden rounded-[2rem] shadow-xl shadow-purple-500/20">
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full -translate-y-1/3 translate-x-1/3 blur-xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-black/10 rounded-full translate-y-1/3 -translate-x-1/3 blur-xl pointer-events-none"></div>
        
        <div class="relative z-10">
            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm border border-white/30 rounded-lg px-3 py-1.5 mb-4 shadow-sm">
                <span class="text-lg leading-none">📣</span>
                <span class="text-[10px] font-black text-white uppercase tracking-widest">Pengumuman Warga</span>
            </div>
            
            <h1 class="text-white text-2xl lg:text-3xl font-black leading-tight drop-shadow-sm mb-4">{{ $pengumuman->judul }}</h1>
            
            <div class="flex flex-wrap items-center gap-4 text-xs font-bold text-purple-50">
                <div class="flex items-center gap-1.5 bg-black/10 px-3 py-1.5 rounded-lg border border-white/10 backdrop-blur-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('l, d F Y') }}
                </div>
                <div class="flex items-center gap-1.5 bg-black/10 px-3 py-1.5 rounded-lg border border-white/10 backdrop-blur-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    {{ $pengumuman->user->name ?? 'Admin RT' }}
                </div>
            </div>
        </div>
    </div>

    <div class="-mt-8 relative z-20 space-y-6 pb-6">
        <div class="glass-panel rounded-[2rem] p-6 lg:p-8 shadow-lg">
            <div class="prose prose-slate max-w-none prose-p:text-slate-600 prose-p:leading-relaxed prose-headings:text-slate-800 prose-headings:font-black prose-a:text-purple-600">
                {!! nl2br(e($pengumuman->isi)) !!}
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-50 to-fuchsia-50 border border-purple-200/60 rounded-[1.5rem] p-5 flex items-start gap-4 shadow-sm relative overflow-hidden">
            <div class="absolute -right-5 -top-5 w-20 h-20 bg-purple-100 rounded-full blur-xl opacity-50 pointer-events-none"></div>
            <div class="w-12 h-12 rounded-[1rem] bg-gradient-to-br from-purple-100 to-fuchsia-100 flex items-center justify-center shrink-0 border border-purple-200 shadow-inner text-2xl relative z-10">
                🏘️
            </div>
            <div class="relative z-10">
                <h4 class="font-bold text-purple-900 mb-0.5">Informasi Resmi Lingkungan</h4>
                <p class="text-sm text-purple-800 font-medium leading-relaxed">Pengumuman ini dikeluarkan oleh pengurus RT 08 RW 02. Harap dicermati dan disebarluaskan kepada warga sekitar yang membutuhkan informasi ini.</p>
            </div>
        </div>
    </div>
</div>
@endsection
