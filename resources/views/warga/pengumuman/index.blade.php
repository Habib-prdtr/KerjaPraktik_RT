@extends('layouts.warga')

@section('title', 'Pengumuman RT')
@section('page-subtitle', 'Informasi Warga')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-br from-purple-600 to-indigo-700 p-6 md:p-10 relative overflow-hidden rounded-3xl shadow-lg shadow-purple-900/20">
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl"></div>
        <div class="absolute bottom-0 left-10 w-32 h-32 bg-purple-500/30 rounded-full translate-y-1/2 blur-xl"></div>
        
        <div class="relative z-10">
            <h1 class="text-white text-2xl md:text-3xl font-black mb-1">Pengumuman RT 📢</h1>
            <p class="text-purple-100 text-sm md:text-base">Informasi terbaru dan terpenting untuk warga RT 08 RW 02</p>
        </div>
    </div>

    @if($pengumuman->isEmpty())
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-12 text-center max-w-2xl mx-auto mt-8">
        <div class="w-20 h-20 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-5">
            <svg class="w-10 h-10 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
        </div>
        <p class="text-lg font-bold text-slate-800 mb-2">Belum Ada Pengumuman</p>
        <p class="text-slate-500 mb-6 max-w-sm mx-auto">Saat ini belum ada informasi terbaru dari pengurus RT.</p>
    </div>
    @else
    
    {{-- Grid Layout for Desktop --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($pengumuman as $umum)
        @php
            $isNew = $umum->tanggal >= now()->subDays(3)->toDateString();
        @endphp
        <a href="{{ route('warga.pengumuman.show', $umum) }}" class="flex flex-col bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:border-purple-200 hover:-translate-y-1 transition-all duration-300 group overflow-hidden">
            <div class="p-5 flex-1 flex flex-col">
                <div class="flex items-start justify-between gap-3 mb-3">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400 group-hover:text-purple-500 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ \Carbon\Carbon::parse($umum->tanggal)->translatedFormat('d M Y') }}
                    </span>
                    @if($isNew)
                    <span class="px-2 py-0.5 rounded-md bg-purple-100 text-purple-700 text-[10px] font-black tracking-widest uppercase shrink-0 animate-pulse">BARU</span>
                    @endif
                </div>
                
                <h3 class="text-lg font-black text-slate-800 leading-snug mb-2 group-hover:text-purple-700 transition-colors line-clamp-2">{{ $umum->judul }}</h3>
                <p class="text-sm text-slate-500 leading-relaxed line-clamp-3 mb-4">{{ strip_tags($umum->isi) }}</p>
                
                <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs font-medium text-slate-400 flex items-center gap-1.5">
                        <div class="w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center text-[8px] font-bold text-slate-600">RT</div>
                        {{ $umum->user->name ?? 'Admin' }}
                    </span>
                    <span class="text-xs font-bold text-purple-600 flex items-center gap-1 opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all">
                        Baca <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </span>
                </div>
            </div>
            <div class="h-1 w-full bg-slate-100 group-hover:bg-gradient-to-r group-hover:from-purple-500 group-hover:to-indigo-500 transition-all duration-500"></div>
        </a>
        @endforeach
    </div>
    
    <div class="mt-6 flex justify-center">
        {{ $pengumuman->links() }}
    </div>
    @endif
</div>
@endsection
