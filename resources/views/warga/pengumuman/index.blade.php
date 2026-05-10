@extends('layouts.warga')

@section('title', 'Pengumuman RT')
@section('page-subtitle', 'Informasi Warga')

@push('styles')
<style>
    .glass-card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .glass-card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -10px rgba(168, 85, 247, 0.2);
    }
</style>
@endpush

@section('content')
<div class="space-y-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- ====== HERO SECTION ====== --}}
    <div class="relative rounded-[2rem] overflow-hidden shadow-2xl shadow-purple-500/20">
        <!-- Hero Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-purple-500 via-fuchsia-500 to-pink-500 z-0"></div>
        
        <!-- Decorative Orbs -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-fuchsia-300/30 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4 pointer-events-none"></div>
        
        <div class="relative z-10 px-8 py-10 md:px-12 md:py-14 flex items-center gap-5">
            <div class="w-16 h-16 rounded-[1.25rem] bg-white/20 backdrop-blur-md border border-white/50 flex items-center justify-center shadow-lg shrink-0">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
            </div>
            <div>
                <h1 class="text-white text-2xl md:text-4xl font-black mb-1 drop-shadow-sm">Pengumuman RT</h1>
                <p class="text-fuchsia-50 text-sm md:text-base font-medium">Informasi terbaru dan terpenting untuk warga RT 08 RW 02</p>
            </div>
        </div>
    </div>

    @if($pengumuman->isEmpty())
    <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] border border-white shadow-sm p-12 text-center max-w-2xl mx-auto mt-8">
        <div class="w-24 h-24 bg-gradient-to-br from-purple-100 to-fuchsia-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
            <svg class="w-12 h-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
        </div>
        <p class="text-xl font-black text-slate-800 mb-2">Belum Ada Pengumuman</p>
        <p class="text-slate-500 font-medium mb-8 max-w-sm mx-auto">Saat ini belum ada informasi terbaru dari pengurus RT.</p>
    </div>
    @else
    
    {{-- Grid Layout for Desktop --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-4">
        @foreach($pengumuman as $umum)
        @php
            $isNew = $umum->tanggal >= now()->subDays(3)->toDateString();
        @endphp
        <a href="{{ route('warga.pengumuman.show', $umum) }}" class="glass-card-hover bg-white/80 backdrop-blur-xl rounded-[1.5rem] border border-white shadow-sm flex flex-col group overflow-hidden relative">
            <div class="absolute top-0 left-0 w-1 h-full bg-slate-200 group-hover:bg-gradient-to-b group-hover:from-purple-500 group-hover:to-fuchsia-500 transition-all duration-300"></div>
            
            <div class="p-6 flex-1 flex flex-col pl-7">
                <div class="flex items-start justify-between gap-3 mb-4">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400 group-hover:text-purple-500 transition-colors bg-slate-50 px-2.5 py-1 rounded-md">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ \Carbon\Carbon::parse($umum->tanggal)->translatedFormat('d M Y') }}
                    </span>
                    @if($isNew)
                    <span class="px-2.5 py-1 rounded-md bg-gradient-to-r from-purple-500 to-fuchsia-500 text-white text-[10px] font-black tracking-widest uppercase shrink-0 shadow-sm shadow-purple-500/30 animate-pulse">BARU</span>
                    @endif
                </div>
                
                <h3 class="text-lg font-black text-slate-800 leading-snug mb-3 group-hover:text-purple-600 transition-colors line-clamp-2">{{ $umum->judul }}</h3>
                <p class="text-sm font-medium text-slate-500 leading-relaxed line-clamp-3 mb-6">{{ strip_tags($umum->isi) }}</p>
                
                <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-400 flex items-center gap-2">
                        <div class="w-6 h-6 rounded-[0.5rem] bg-gradient-to-br from-purple-100 to-fuchsia-100 border border-purple-200 flex items-center justify-center text-[10px] font-black text-purple-700 shadow-sm">RT</div>
                        {{ $umum->user->name ?? 'Admin' }}
                    </span>
                    <span class="text-xs font-black text-purple-600 flex items-center gap-1 opacity-0 group-hover:opacity-100 -translate-x-3 group-hover:translate-x-0 transition-all uppercase tracking-widest bg-purple-50 px-3 py-1.5 rounded-lg">
                        Baca <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    
    <div class="mt-8 flex justify-center">
        {{ $pengumuman->links() }}
    </div>
    @endif
</div>
@endsection
