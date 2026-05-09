@extends('layouts.warga')

@section('title', 'Beranda — Portal Warga RT 08 RW 02')
@section('page-subtitle', 'Selamat datang')

@push('styles')
<style>
    @keyframes moveGradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .animate-gradient {
        background-size: 200% 200%;
        animation: moveGradient 8s ease infinite;
    }
</style>
@endpush

@section('content')
<div class="space-y-8 pb-10">

    {{-- ====== BRIGHT ANIMATED HERO SECTION ====== --}}
    <div class="bg-gradient-to-r from-sky-400 via-indigo-400 to-purple-400 animate-gradient px-6 py-10 md:px-10 md:py-12 overflow-hidden rounded-[1.5rem] shadow-lg shadow-indigo-500/20 relative">
        {{-- Abstract Orbs --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/20 rounded-full -translate-y-1/2 translate-x-1/3 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/20 rounded-full translate-y-1/3 -translate-x-1/4 blur-3xl pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            
            {{-- Profile Section --}}
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-white/20 backdrop-blur-sm border border-white/40 flex items-center justify-center shadow-sm">
                    <span class="text-white text-xl md:text-2xl font-black">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <div>
                    <p class="text-white/90 text-xs md:text-sm font-bold tracking-wide uppercase mb-0.5">Selamat Datang 👋</p>
                    <p class="text-white text-xl md:text-3xl font-black tracking-tight drop-shadow-sm">{{ Auth::user()->name }}</p>
                </div>
            </div>
            
            {{-- Date Badge --}}
            <div class="bg-white/20 backdrop-blur-md border border-white/30 rounded-2xl px-5 py-3 shadow-sm md:text-right">
                <p class="text-white/90 text-[10px] md:text-xs font-bold uppercase tracking-widest mb-0.5">{{ now()->translatedFormat('l, d F Y') }}</p>
                <p class="text-white font-black text-sm drop-shadow-sm">RT 08 / RW 02 — Ds. Penambangan</p>
            </div>
        </div>
    </div>

    {{-- ====== LAYANAN MENU (SEPARATED, NOT OVERLAPPING) ====== --}}
    <div class="max-w-5xl mx-auto px-2">
        <div class="bg-white rounded-[1.5rem] shadow-sm border border-slate-100 p-6 md:p-8">
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-5 text-center">Layanan Cepat Warga</p>
            
            <div class="grid grid-cols-4 gap-2 md:gap-6 justify-items-center">
                <a href="{{ route('warga.surat.create') }}" class="flex flex-col items-center gap-3 group w-full">
                    <div class="w-12 h-12 md:w-16 md:h-16 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center transition-all duration-300 shadow-sm group-hover:shadow-orange-500/30 group-hover:-translate-y-1">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <span class="text-[10px] md:text-xs font-bold text-slate-600 group-hover:text-orange-600 text-center leading-tight transition-colors">Surat</span>
                </a>
                
                <a href="{{ route('warga.pengaduan.create') }}" class="flex flex-col items-center gap-3 group w-full">
                    <div class="w-12 h-12 md:w-16 md:h-16 rounded-2xl bg-gradient-to-br from-rose-400 to-red-600 flex items-center justify-center transition-all duration-300 shadow-sm group-hover:shadow-red-500/30 group-hover:-translate-y-1">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <span class="text-[10px] md:text-xs font-bold text-slate-600 group-hover:text-red-600 text-center leading-tight transition-colors">Pengaduan</span>
                </a>
                
                <a href="{{ route('warga.pengumuman.index') }}" class="flex flex-col items-center gap-3 group w-full">
                    <div class="w-12 h-12 md:w-16 md:h-16 rounded-2xl bg-gradient-to-br from-purple-400 to-indigo-500 flex items-center justify-center transition-all duration-300 shadow-sm group-hover:shadow-purple-500/30 group-hover:-translate-y-1">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    </div>
                    <span class="text-[10px] md:text-xs font-bold text-slate-600 group-hover:text-indigo-600 text-center leading-tight transition-colors">Pengumuman</span>
                </a>
                
                <a href="{{ route('warga.kegiatan.index') }}" class="flex flex-col items-center gap-3 group w-full">
                    <div class="w-12 h-12 md:w-16 md:h-16 rounded-2xl bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center transition-all duration-300 shadow-sm group-hover:shadow-teal-500/30 group-hover:-translate-y-1">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-[10px] md:text-xs font-bold text-slate-600 group-hover:text-teal-600 text-center leading-tight transition-colors">Kegiatan</span>
                </a>
            </div>
        </div>
    </div>

    @if(!$warga)
    {{-- ====== ACCOUNT NOT LINKED ====== --}}
    <div class="bg-amber-50 border border-amber-200 rounded-[1.5rem] p-5 flex items-start md:items-center gap-4 max-w-5xl mx-auto">
        <span class="text-2xl shrink-0">⚠️</span>
        <div>
            <p class="font-bold text-amber-900 text-sm md:text-base mb-0.5">Akun Belum Terhubung dengan Data Warga</p>
            <p class="text-xs md:text-sm text-amber-800">Untuk menggunakan layanan pengajuan surat dan pengaduan, akun Anda harus diverifikasi oleh Admin RT.</p>
        </div>
    </div>
    @endif

    {{-- ====== MAIN CONTENT GRID ====== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 max-w-7xl mx-auto">
        
        @if($warga)
        {{-- ====== STATUS SURAT SAYA ====== --}}
        <div class="bg-white rounded-[1.5rem] shadow-sm border border-slate-100 p-6 flex flex-col hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Status Surat</h2>
                </div>
                <a href="{{ route('warga.surat.index') }}" class="text-xs text-blue-600 font-bold hover:underline">Lihat Semua &rarr;</a>
            </div>
            
            <div class="flex-1 flex flex-col gap-3">
                @if($suratSaya->isEmpty())
                <div class="flex-1 rounded-2xl border border-dashed border-slate-200 flex flex-col items-center justify-center p-6 text-center bg-slate-50">
                    <p class="text-sm font-medium text-slate-500 mb-3">Belum ada pengajuan surat</p>
                    <a href="{{ route('warga.surat.create') }}" class="inline-flex items-center gap-1.5 text-xs bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                        Buat Pengajuan
                    </a>
                </div>
                @else
                    @foreach($suratSaya->take(3) as $surat)
                    @php
                        $color = match($surat->status) {
                            'diajukan' => ['pill'=>'bg-slate-100 text-slate-600','icon'=>'bg-slate-50 text-slate-500'],
                            'diproses' => ['pill'=>'bg-blue-100 text-blue-700','icon'=>'bg-blue-50 text-blue-500'],
                            'selesai'  => ['pill'=>'bg-green-100 text-green-700','icon'=>'bg-green-50 text-green-500'],
                            'ditolak'  => ['pill'=>'bg-red-100 text-red-700','icon'=>'bg-red-50 text-red-400'],
                            default    => ['pill'=>'bg-slate-100 text-slate-600','icon'=>'bg-slate-50 text-slate-500'],
                        };
                    @endphp
                    <a href="{{ route('warga.surat.show', $surat) }}" class="flex items-center gap-3 bg-white border border-slate-100 p-3 rounded-xl hover:border-blue-200 hover:bg-blue-50/30 transition-colors group">
                        <div class="w-10 h-10 rounded-lg {{ $color['icon'] }} flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-800 truncate group-hover:text-blue-700 transition-colors">{{ $surat->jenis_surat }}</p>
                            <p class="text-xs font-medium text-slate-400">{{ $surat->created_at->translatedFormat('d M Y') }}</p>
                        </div>
                        <span class="text-[10px] font-bold px-2 py-1 rounded-md {{ $color['pill'] }} uppercase tracking-wider">{{ $surat->status }}</span>
                    </a>
                    @endforeach
                @endif
            </div>
        </div>
        @endif

        {{-- ====== PENGUMUMAN TERBARU ====== --}}
        <div class="bg-white rounded-[1.5rem] shadow-sm border border-slate-100 p-6 flex flex-col hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Pengumuman RT</h2>
                </div>
                <a href="{{ route('warga.pengumuman.index') }}" class="text-xs text-purple-600 font-bold hover:underline">Lihat Semua &rarr;</a>
            </div>

            <div class="flex-1 flex flex-col gap-3">
                @if($pengumumanTerbaru->isEmpty())
                <div class="flex-1 rounded-2xl border border-dashed border-slate-200 flex flex-col items-center justify-center p-6 text-center bg-slate-50">
                    <p class="text-sm font-medium text-slate-500">Belum ada pengumuman</p>
                </div>
                @else
                    @foreach($pengumumanTerbaru->take(3) as $umum)
                    <a href="{{ route('warga.pengumuman.show', $umum) }}" class="flex items-start gap-3 bg-white border border-slate-100 p-3 rounded-xl hover:border-purple-200 hover:bg-purple-50/30 transition-colors group">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-800 group-hover:text-purple-700 transition-colors line-clamp-1">{{ $umum->judul }}</p>
                            <p class="text-xs font-medium text-slate-400 mt-0.5">{{ \Carbon\Carbon::parse($umum->tanggal)->translatedFormat('d M Y') }}</p>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-purple-500 transition-colors shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    @endforeach
                @endif
            </div>
        </div>

    </div>

    {{-- ====== KEGIATAN MENDATANG ====== --}}
    @if($kegiatanMendatang->isNotEmpty())
    <div class="bg-white rounded-[1.5rem] shadow-sm border border-slate-100 p-6 max-w-7xl mx-auto mt-6">
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h2 class="text-lg font-bold text-slate-800">Kegiatan Mendatang</h2>
            </div>
            <a href="{{ route('warga.kegiatan.index') }}" class="text-xs text-teal-600 font-bold hover:underline">Lihat Semua &rarr;</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($kegiatanMendatang as $k)
            <a href="{{ route('warga.kegiatan.show', $k) }}" class="bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl p-4 text-white hover:shadow-md hover:-translate-y-0.5 transition-all">
                <p class="text-white/80 text-[10px] font-bold tracking-wider uppercase mb-1">{{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d M Y') }}</p>
                <p class="font-bold text-sm leading-snug line-clamp-2 mb-2">{{ $k->nama_kegiatan }}</p>
                <div class="flex items-center gap-1.5 text-teal-50 text-[11px]">
                    <span class="truncate">📍 {{ $k->lokasi }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
