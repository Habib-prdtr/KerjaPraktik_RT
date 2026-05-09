@extends('layouts.warga')

@section('title', $pengumuman->judul)
@section('page-subtitle', 'Pengumuman RT')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="bg-white border-b border-slate-100 px-4 py-4 flex items-center gap-3">
        <a href="{{ route('warga.pengumuman.index') }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-base font-bold text-slate-800 truncate">Pengumuman</h1>
    </div>

    <div class="bg-gradient-to-br from-purple-600 to-indigo-700 px-5 pt-6 pb-8 relative overflow-hidden rounded-3xl">
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/3 translate-x-1/3"></div>
        <div class="relative z-10">
            <span class="inline-flex items-center gap-1 text-xs font-bold text-purple-200 uppercase tracking-wider mb-3">📣 Pengumuman Resmi RT</span>
            <h1 class="text-white text-xl font-black leading-tight">{{ $pengumuman->judul }}</h1>
            <div class="flex items-center gap-4 mt-3 text-xs text-purple-200">
                <span>📅 {{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('d F Y') }}</span>
                <span>👤 {{ $pengumuman->user->name ?? 'Admin RT' }}</span>
            </div>
        </div>
    </div>

    <div class="px-4 py-5 pb-8">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <div class="prose prose-sm prose-slate max-w-none text-slate-700 leading-relaxed text-sm">
                {!! nl2br(e($pengumuman->isi)) !!}
            </div>
        </div>

        <div class="mt-4 bg-purple-50 border border-purple-100 rounded-2xl p-4 flex items-center gap-3">
            <span class="text-2xl">🏘️</span>
            <p class="text-xs text-purple-800 font-medium">Pengumuman ini dikeluarkan oleh pihak RT 08 RW 02. Harap diperhatikan dan disebarluaskan kepada warga sekitar.</p>
        </div>
    </div>
</div>
@endsection
