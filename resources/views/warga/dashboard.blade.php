@extends('layouts.warga')

@section('title', 'Beranda — Portal Warga RT 08 RW 02')

@push('styles')
<style>
    /* Animated Gradient Background for Hero */
    .hero-gradient {
        background: linear-gradient(-45deg, #3b82f6, #6366f1, #8b5cf6, #06b6d4);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
    }
    
    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Glass Panels */
    .glass-panel {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
    }
    
    .glass-card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .glass-card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -10px rgba(99, 102, 241, 0.15);
        background: rgba(255, 255, 255, 0.95);
    }

    /* Floating Animation for Elements */
    .animate-float {
        animation: float-element 6s ease-in-out infinite;
    }
    @keyframes float-element {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
</style>
@endpush

@section('content')
<div class="space-y-8 pb-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- ====== HERO SECTION ====== --}}
    <div class="relative rounded-[2rem] overflow-hidden shadow-2xl shadow-indigo-500/20">
        <!-- Hero Background -->
        <div class="hero-gradient absolute inset-0 z-0"></div>
        
        <!-- Decorative Orbs -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-cyan-400/30 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4 pointer-events-none"></div>
        
        <div class="relative z-10 px-8 py-12 md:px-12 md:py-16 flex flex-col md:flex-row items-center justify-between gap-8">
            
            {{-- Profile Greeting --}}
            <div class="flex items-center gap-6 w-full md:w-auto">
                <div class="relative">
                    <div class="absolute inset-0 bg-white/30 rounded-full animate-ping opacity-75"></div>
                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-full bg-white/20 backdrop-blur-md border-2 border-white/50 flex items-center justify-center shadow-lg relative z-10">
                        <span class="text-white text-3xl md:text-5xl font-black drop-shadow-md">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                </div>
                <div>
                    @php
                        $hour = date('H');
                        $greeting = 'Selamat Pagi';
                        if ($hour >= 11 && $hour <= 14) $greeting = 'Selamat Siang';
                        elseif ($hour > 14 && $hour <= 18) $greeting = 'Selamat Sore';
                        elseif ($hour > 18) $greeting = 'Selamat Malam';
                    @endphp
                    <p class="text-white/90 text-sm md:text-base font-bold tracking-widest uppercase mb-1">{{ $greeting }} 👋</p>
                    <h1 class="text-white text-3xl md:text-4xl lg:text-5xl font-black tracking-tight drop-shadow-sm">{{ Auth::user()->name }}</h1>
                    @if($warga)
                        <p class="mt-2 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 border border-white/30 text-white text-xs font-semibold backdrop-blur-sm shadow-sm">
                            <svg class="w-3.5 h-3.5 text-green-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Warga Terverifikasi
                        </p>
                    @endif
                </div>
            </div>
            
            {{-- Quick Info Panel --}}
            <div class="bg-white/10 backdrop-blur-xl border border-white/30 rounded-2xl p-5 shadow-xl md:text-right w-full md:w-auto animate-float">
                <p class="text-white/80 text-[11px] md:text-xs font-bold uppercase tracking-widest mb-1">{{ now()->translatedFormat('l, d F Y') }}</p>
                <p class="text-white font-black text-base drop-shadow-sm mb-4">RT 08 / RW 02 — Ds. Penambangan</p>
                
                @if($warga)
                <div class="flex items-center md:justify-end gap-4 mt-2">
                    <div class="text-center bg-black/10 rounded-xl px-3 py-2 border border-white/10">
                        <p class="text-white text-xl font-black leading-none">{{ $suratSaya->count() }}</p>
                        <p class="text-white/70 text-[10px] font-bold uppercase mt-1">Surat</p>
                    </div>
                    <div class="text-center bg-black/10 rounded-xl px-3 py-2 border border-white/10">
                        <p class="text-white text-xl font-black leading-none">{{ $pengaduanSaya->count() }}</p>
                        <p class="text-white/70 text-[10px] font-bold uppercase mt-1">Aduan</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    @if(!$warga)
    {{-- ====== ACCOUNT NOT LINKED ====== --}}
    <div class="bg-gradient-to-r from-amber-100 to-orange-50 border border-amber-200 rounded-3xl p-6 flex items-start md:items-center gap-5 shadow-sm transform transition-all hover:scale-[1.01]">
        <div class="w-12 h-12 rounded-full bg-amber-200/50 flex items-center justify-center shrink-0">
            <span class="text-3xl drop-shadow-sm">⚠️</span>
        </div>
        <div>
            <h3 class="font-black text-amber-900 text-lg md:text-xl mb-1">Akun Belum Diverifikasi</h3>
            <p class="text-sm md:text-base font-medium text-amber-800">Untuk menggunakan layanan pengajuan surat dan pengaduan, akun Anda harus dihubungkan dengan data kependudukan oleh Admin RT. Silakan hubungi pengurus RT.</p>
        </div>
    </div>
    @endif

    {{-- ====== QUICK ACTIONS ====== --}}
    <div class="relative -mt-6 md:-mt-8 z-20 px-2">
        <div class="glass-panel rounded-[2rem] p-6 md:p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-sm font-black text-slate-400 uppercase tracking-widest">Layanan Cepat</h2>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                <!-- Action 1 -->
                <a href="{{ route('warga.surat.create') }}" class="glass-card-hover bg-gradient-to-br from-slate-50 to-white rounded-2xl p-5 border border-slate-100 flex flex-col items-center justify-center gap-4 group">
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-[1.25rem] bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <span class="text-sm font-black text-slate-700 group-hover:text-blue-600 text-center transition-colors">Buat Surat</span>
                </a>
                
                <!-- Action 2 -->
                <a href="{{ route('warga.pengaduan.create') }}" class="glass-card-hover bg-gradient-to-br from-slate-50 to-white rounded-2xl p-5 border border-slate-100 flex flex-col items-center justify-center gap-4 group">
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-[1.25rem] bg-gradient-to-br from-rose-500 to-red-600 flex items-center justify-center shadow-lg shadow-red-500/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <span class="text-sm font-black text-slate-700 group-hover:text-red-600 text-center transition-colors">Lapor Aduan</span>
                </a>
                
                <!-- Action 3 -->
                <a href="{{ route('warga.pengumuman.index') }}" class="glass-card-hover bg-gradient-to-br from-slate-50 to-white rounded-2xl p-5 border border-slate-100 flex flex-col items-center justify-center gap-4 group">
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-[1.25rem] bg-gradient-to-br from-purple-500 to-fuchsia-600 flex items-center justify-center shadow-lg shadow-purple-500/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    </div>
                    <span class="text-sm font-black text-slate-700 group-hover:text-purple-600 text-center transition-colors">Info RT</span>
                </a>
                
                <!-- Action 4 -->
                <a href="{{ route('warga.kegiatan.index') }}" class="glass-card-hover bg-gradient-to-br from-slate-50 to-white rounded-2xl p-5 border border-slate-100 flex flex-col items-center justify-center gap-4 group">
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-[1.25rem] bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center shadow-lg shadow-teal-500/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-sm font-black text-slate-700 group-hover:text-teal-600 text-center transition-colors">Kegiatan</span>
                </a>
            </div>
        </div>
    </div>

    {{-- ====== MAIN CONTENT GRID ====== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        @if($warga)
        {{-- ====== STATUS SURAT SAYA ====== --}}
        <div class="glass-panel rounded-[2rem] p-6 lg:p-8 flex flex-col relative overflow-hidden">
            <!-- Decorative accent -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-100 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

            <div class="flex items-center justify-between mb-6 relative z-10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-[1rem] bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center border border-blue-200">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h2 class="text-xl font-black text-slate-800">Status Surat</h2>
                </div>
                <a href="{{ route('warga.surat.index') }}" class="text-sm text-blue-600 font-bold hover:text-blue-800 hover:underline transition-colors">Semua &rarr;</a>
            </div>
            
            <div class="flex-1 flex flex-col gap-4 relative z-10">
                @if($suratSaya->isEmpty())
                <div class="flex-1 rounded-[1.5rem] border-2 border-dashed border-slate-200/60 flex flex-col items-center justify-center p-8 text-center bg-white/50">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-base font-bold text-slate-500 mb-2">Belum ada pengajuan</p>
                    <a href="{{ route('warga.surat.create') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800">Buat sekarang &rarr;</a>
                </div>
                @else
                    @foreach($suratSaya->take(3) as $surat)
                    @php
                        $color = match($surat->status) {
                            'diajukan' => ['bg'=>'bg-slate-50','border'=>'border-slate-200','text'=>'text-slate-700','pill'=>'bg-slate-200/50 text-slate-700'],
                            'diproses' => ['bg'=>'bg-blue-50/50','border'=>'border-blue-200','text'=>'text-blue-800','pill'=>'bg-blue-100 text-blue-700 shadow-sm shadow-blue-500/20'],
                            'selesai'  => ['bg'=>'bg-green-50/50','border'=>'border-green-200','text'=>'text-green-800','pill'=>'bg-green-100 text-green-700 shadow-sm shadow-green-500/20'],
                            'ditolak'  => ['bg'=>'bg-red-50/50','border'=>'border-red-200','text'=>'text-red-800','pill'=>'bg-red-100 text-red-700 shadow-sm shadow-red-500/20'],
                            default    => ['bg'=>'bg-slate-50','border'=>'border-slate-200','text'=>'text-slate-700','pill'=>'bg-slate-200/50 text-slate-700'],
                        };
                    @endphp
                    <a href="{{ route('warga.surat.show', $surat) }}" class="flex items-center gap-4 bg-white border {{ $color['border'] }} p-4 rounded-2xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-[1rem] {{ $color['bg'] }} border {{ $color['border'] }} flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 {{ $color['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-base font-bold text-slate-800 truncate group-hover:text-blue-600 transition-colors">{{ $surat->jenis_surat }}</p>
                            <p class="text-xs font-bold text-slate-400 mt-1">{{ $surat->created_at->translatedFormat('d M Y') }}</p>
                        </div>
                        <span class="text-[10px] font-black px-3 py-1.5 rounded-lg {{ $color['pill'] }} uppercase tracking-widest">{{ $surat->status }}</span>
                    </a>
                    @endforeach
                @endif
            </div>
        </div>
        @endif

        {{-- ====== PENGUMUMAN TERBARU ====== --}}
        <div class="glass-panel rounded-[2rem] p-6 lg:p-8 flex flex-col relative overflow-hidden">
            <!-- Decorative accent -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-purple-100 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

            <div class="flex items-center justify-between mb-6 relative z-10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-[1rem] bg-gradient-to-br from-purple-100 to-fuchsia-100 flex items-center justify-center border border-purple-200">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    </div>
                    <h2 class="text-xl font-black text-slate-800">Pengumuman RT</h2>
                </div>
                <a href="{{ route('warga.pengumuman.index') }}" class="text-sm text-purple-600 font-bold hover:text-purple-800 hover:underline transition-colors">Semua &rarr;</a>
            </div>

            <div class="flex-1 flex flex-col gap-4 relative z-10">
                @if($pengumumanTerbaru->isEmpty())
                <div class="flex-1 rounded-[1.5rem] border-2 border-dashed border-slate-200/60 flex flex-col items-center justify-center p-8 text-center bg-white/50">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    </div>
                    <p class="text-base font-bold text-slate-500">Belum ada pengumuman</p>
                </div>
                @else
                    <div class="relative border-l-2 border-purple-100 pl-4 py-2 space-y-6">
                        @foreach($pengumumanTerbaru->take(3) as $umum)
                        <div class="relative group">
                            <!-- Timeline Dot -->
                            <div class="absolute -left-[1.35rem] top-1.5 w-3 h-3 bg-purple-500 rounded-full ring-4 ring-white group-hover:scale-125 transition-transform duration-300"></div>
                            
                            <a href="{{ route('warga.pengumuman.show', $umum) }}" class="block bg-white border border-slate-100 p-4 rounded-2xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group-hover:border-purple-200">
                                <p class="text-[11px] font-black text-purple-600 mb-1 tracking-wider uppercase">{{ \Carbon\Carbon::parse($umum->tanggal)->translatedFormat('d M Y') }}</p>
                                <p class="text-base font-bold text-slate-800 line-clamp-1 group-hover:text-purple-700 transition-colors">{{ $umum->judul }}</p>
                                <p class="text-sm font-medium text-slate-500 mt-2 line-clamp-2">{{ Str::limit($umum->isi, 80) }}</p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{-- ====== KEGIATAN MENDATANG ====== --}}
    @if($kegiatanMendatang->isNotEmpty())
    <div class="glass-panel rounded-[2rem] p-6 lg:p-8 mt-8">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-[1rem] bg-gradient-to-br from-teal-100 to-emerald-100 flex items-center justify-center border border-teal-200">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h2 class="text-xl font-black text-slate-800">Kegiatan Mendatang</h2>
            </div>
            <a href="{{ route('warga.kegiatan.index') }}" class="text-sm text-teal-600 font-bold hover:text-teal-800 hover:underline transition-colors">Lihat Semua &rarr;</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($kegiatanMendatang as $k)
            <a href="{{ route('warga.kegiatan.show', $k) }}" class="relative overflow-hidden rounded-2xl group block hover:-translate-y-2 transition-all duration-300 hover:shadow-xl hover:shadow-teal-500/20">
                <!-- Background decoration -->
                <div class="absolute inset-0 bg-gradient-to-br from-teal-500 to-emerald-600 z-0"></div>
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl z-0 group-hover:scale-150 transition-transform duration-700"></div>
                
                <div class="relative z-10 p-6 h-full flex flex-col justify-between">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-lg border border-white/20 mb-4">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-white text-[10px] font-black tracking-widest uppercase">{{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d M Y') }}</span>
                        </div>
                        <p class="font-black text-lg text-white leading-tight line-clamp-2 mb-4">{{ $k->nama_kegiatan }}</p>
                    </div>
                    
                    <div class="flex items-center gap-2 text-teal-50 bg-black/10 rounded-xl p-3 border border-white/10">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-xs font-bold truncate">{{ $k->lokasi }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
