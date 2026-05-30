@extends('layouts.warga')

@section('title', 'Beranda Warga — Portal Resmi RT 08 RW 02')

@section('content')
<div class="space-y-6 pb-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- ====== HERO SECTION (WELCOME BANNER) ====== --}}
    <div class="hero-warga rounded-[2.5rem] shadow-xl shadow-emerald-900/10">
        <div class="relative z-10 px-6 py-10 md:px-12 md:py-14">
            <!-- Warm decorative glow orbs -->
            <div class="absolute top-0 right-0 w-80 h-80 bg-teal-400/20 rounded-full blur-3xl -translate-y-1/3 translate-x-1/4 pointer-events-none"></div>
            <div class="absolute bottom-0 left-10 w-48 h-48 bg-emerald-400/20 rounded-full blur-3xl translate-y-1/3 pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
                <!-- Greeting -->
                <div class="flex items-center gap-5">
                    <div class="relative shrink-0">
                        <div class="w-20 h-20 md:w-24 md:h-24 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shadow-xl">
                            <span class="text-white text-4xl md:text-5xl font-black">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                        @if($warga)
                        <div class="absolute -bottom-1.5 -right-1.5 w-6 h-6 bg-emerald-400 border-2 border-white rounded-full flex items-center justify-center shadow-md">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        @endif
                    </div>
                    <div>
                        @php
                            $hour = (int)date('H');
                            $greeting = $hour < 11 ? 'Selamat Pagi' : ($hour < 15 ? 'Selamat Siang' : ($hour < 19 ? 'Selamat Sore' : 'Selamat Malam'));
                            $greetEmoji = match(true) {
                                $hour < 11 => '<svg class="w-4 h-4 inline-block text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>',
                                $hour < 15 => '<svg class="w-4 h-4 inline-block text-sky-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 15h1m15 0h1m-1-4a7 7 0 10-14 0m14 0c0 1.93-1.57 3.5-3.5 3.5H6.5C4.57 18.5 3 16.93 3 15s1.57-3.5 3.5-3.5h.1C7.16 8.54 9.38 6.5 12 6.5c2.62 0 4.84 2.04 5.4 4.5h.1c1.93 0 3.5 1.57 3.5 3.5z"/></svg>',
                                $hour < 19 => '<svg class="w-4 h-4 inline-block text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>',
                                default => '<svg class="w-4 h-4 inline-block text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>',
                            };
                        @endphp
                        <p class="text-emerald-200 text-xs font-black uppercase tracking-widest mb-1 flex items-center gap-1.5">{{ $greeting }} {!! $greetEmoji !!} Bapak/Ibu</p>
                        <h1 class="text-white text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight mb-3">
                            {{ Auth::user()->name }}
                        </h1>
                        <div class="flex items-center gap-2 flex-wrap">
                            @if($warga)
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-400/25 border border-emerald-400/30 text-emerald-100 text-xs font-bold shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Data Warga Terverifikasi
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-amber-400/25 border border-amber-400/30 text-amber-200 text-xs font-bold shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Belum Terverifikasi RT
                            </span>
                            @endif
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-white/10 border border-white/15 text-white/80 text-xs font-semibold">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                Lingkungan RT 08 / RW 02
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Info panel & Date -->
                <div class="bg-white/10 backdrop-blur-xl border border-white/15 rounded-2xl p-5 w-full lg:w-auto lg:min-w-[240px] text-white">
                    <p class="text-emerald-200 text-[10px] font-black uppercase tracking-widest mb-0.5">Hari & Tanggal</p>
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="font-extrabold text-xl leading-tight">{{ now()->translatedFormat('l, d F Y') }}</p>
                    </div>
                    @if($warga)
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-white/10 rounded-xl p-3 text-center border border-white/5">
                            <p class="font-black text-2xl leading-none text-emerald-200">{{ $suratSaya->count() }}</p>
                            <p class="text-white/70 text-[9px] font-bold uppercase tracking-wider mt-1.5">Surat Saya</p>
                        </div>
                        <div class="bg-white/10 rounded-xl p-3 text-center border border-white/5">
                            <p class="font-black text-2xl leading-none text-amber-300">{{ $pengaduanSaya->count() }}</p>
                            <p class="text-white/70 text-[9px] font-bold uppercase tracking-wider mt-1.5">Laporan Saya</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(!$warga)
    {{-- Alert belum terverifikasi - Cozy Warm Amber Box --}}
    <div class="bg-amber-50 border border-amber-200 rounded-3xl p-6 flex items-start gap-4 shadow-sm">
        <div class="w-12 h-12 rounded-2xl bg-amber-100 border border-amber-200 flex items-center justify-center shrink-0 text-amber-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <div>
            <h3 class="font-extrabold text-amber-950 text-base mb-1">Akun Warga Belum Aktif Sepenuhnya</h3>
            <p class="text-sm font-medium text-amber-800 leading-relaxed">
                Untuk dapat menggunakan layanan online seperti **pengajuan surat pengantar** dan **pengiriman aduan warga**, akun Anda perlu dihubungkan dengan data kependudukan resmi RT. Silakan hubungi Pak RT/Pengurus RT untuk proses verifikasi data Kartu Keluarga Anda. Terima kasih atas pengertiannya!
            </p>
        </div>
    </div>
    @endif

    {{-- ====== QUICK ACTIONS (BENTO LAYANAN DESA) ====== --}}
    <div class="card-premium p-6 md:p-8 bg-white">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xs font-black text-emerald-700 uppercase tracking-widest mb-0.5">Layanan Warga RT</h2>
                <h3 class="text-lg font-extrabold text-slate-800">Mau mengurus apa hari ini?</h3>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $services = [
                    [
                        'href' => route('warga.surat.create'),
                        'label' => 'Buat Surat Pengantar',
                        'subtext' => 'Urus administrasi cepat secara online',
                        'emoji' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
                        'light' => 'bg-emerald-50 text-emerald-700 border-emerald-100 group-hover:bg-emerald-600 group-hover:text-white',
                        'hover_bg' => 'hover:border-emerald-200 hover:shadow-emerald-500/5'
                    ],
                    [
                        'href' => route('warga.pengaduan.create'),
                        'label' => 'Lapor Masalah / Usulan',
                        'subtext' => 'Laporkan kerusakan jalan, lampu mati, dll',
                        'emoji' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>',
                        'light' => 'bg-amber-50 text-amber-700 border-amber-100 group-hover:bg-amber-500 group-hover:text-white',
                        'hover_bg' => 'hover:border-amber-200 hover:shadow-amber-500/5'
                    ],
                    [
                        'href' => route('warga.pengumuman.index'),
                        'label' => 'Mading Pengumuman',
                        'subtext' => 'Baca berita & pengumuman terbaru RT',
                        'emoji' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>',
                        'light' => 'bg-teal-50 text-teal-700 border-teal-100 group-hover:bg-teal-600 group-hover:text-white',
                        'hover_bg' => 'hover:border-teal-200 hover:shadow-teal-500/5'
                    ],
                    [
                        'href' => route('warga.kegiatan.index'),
                        'label' => 'Agenda Kegiatan RT',
                        'subtext' => 'Jadwal kerja bakti, posyandu, & rapat',
                        'emoji' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
                        'light' => 'bg-rose-50 text-rose-700 border-rose-100 group-hover:bg-rose-600 group-hover:text-white',
                        'hover_bg' => 'hover:border-rose-200 hover:shadow-rose-500/5'
                    ],
                ];
            @endphp
            @foreach($services as $svc)
            <a href="{{ $svc['href'] }}"
               class="bento-hover bg-slate-50/50 hover:bg-white rounded-2xl p-5 border border-slate-100 flex flex-col gap-4 group cursor-pointer shadow-sm hover:shadow-xl transition-all duration-300 {{ $svc['hover_bg'] }}">
                <div class="w-14 h-14 rounded-2xl {{ $svc['light'] }} border flex items-center justify-center transition-all duration-300 shadow-sm shrink-0">
                    {!! $svc['emoji'] !!}
                </div>
                <div>
                    <span class="block text-[15px] font-extrabold text-slate-800 group-hover:text-emerald-700 transition-colors leading-snug mb-1">{{ $svc['label'] }}</span>
                    <span class="block text-xs text-slate-500 font-medium leading-relaxed">{{ $svc['subtext'] }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    {{-- ====== MAIN GRID (LETTER STATUS & ANNOUNCEMENT) ====== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        @if($warga)
        {{-- ====== LIST SURAT SAYA ====== --}}
        <div class="card-premium p-6 flex flex-col bg-white">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-md shadow-emerald-500/25">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-base font-extrabold text-slate-800 leading-none">Surat Pengantar Saya</h2>
                        <p class="text-[11px] text-slate-400 font-bold mt-1">Status pembuatan surat aktif</p>
                    </div>
                </div>
                <a href="{{ route('warga.surat.index') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-800 transition-colors flex items-center gap-1">
                    Lihat Semua <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="flex-1 flex flex-col gap-3">
                @if($suratSaya->isEmpty())
                <div class="flex-1 rounded-2xl border border-dashed border-slate-200 flex flex-col items-center justify-center p-8 text-center bg-slate-50/50">
                    <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    <p class="text-sm font-bold text-slate-600 mb-2">Bapak/Ibu belum pernah mengajukan surat</p>
                    <a href="{{ route('warga.surat.create') }}" class="text-xs font-black text-emerald-600 hover:text-emerald-800">Ajukan Surat Pertama →</a>
                </div>
                @else
                    @foreach($suratSaya->take(3) as $surat)
                    @php
                        $statusCls = match($surat->status) {
                            'diajukan' => 'pill-pending',
                            'diproses' => 'pill-diproses',
                            'selesai'  => 'pill-selesai',
                            'ditolak'  => 'pill-ditolak',
                            default    => 'pill-pending',
                        };
                        $statusLabel = match($surat->status) {
                            'diajukan' => 'Menunggu RT',
                            'diproses' => 'Sedang Dibuat',
                            'selesai'  => 'Siap Diambil',
                            'ditolak'  => 'Perlu Perbaikan',
                            default    => 'Diajukan',
                        };
                        $friendlyHint = match($surat->status) {
                            'diajukan' => '<svg class="w-4 h-4 inline-block -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Sedang menunggu antrean pemeriksaan Pak RT.',
                            'diproses' => '<svg class="w-4 h-4 inline-block -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg> Sedang dalam pengetikan/penandatanganan berkas.',
                            'selesai'  => '<svg class="w-4 h-4 inline-block -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Surat siap! Ambil fisik di rumah RT atau unduh detail.',
                            'ditolak'  => '<svg class="w-4 h-4 inline-block -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Ada data yang salah. Silakan periksa detail surat.',
                            default    => '',
                        };
                    @endphp
                    <a href="{{ route('warga.surat.show', $surat) }}"
                       class="block p-4 rounded-2xl border border-slate-100 hover:border-emerald-200 hover:bg-emerald-50/20 transition-all group">
                        <div class="flex items-center gap-3 justify-between">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0 text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-extrabold text-slate-800 truncate group-hover:text-emerald-700 transition-colors leading-tight">{{ $surat->jenis_surat }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold mt-1">Diajukan: {{ $surat->created_at->translatedFormat('d M Y') }}</p>
                                </div>
                            </div>
                            <span class="{{ $statusCls }} text-[9px] font-black px-2.5 py-1 rounded-lg uppercase tracking-wider shrink-0">{{ $statusLabel }}</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium mt-2.5 pt-2 border-t border-dashed border-slate-100 leading-normal flex items-start gap-1.5">{!! $friendlyHint !!}</p>
                    </a>
                    @endforeach
                @endif
            </div>
        </div>
        @endif

        {{-- ====== PAPAN MADING PENGUMUMAN ====== --}}
        <div class="card-premium p-6 flex flex-col bg-white">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-500 to-emerald-600 flex items-center justify-center shadow-md shadow-teal-500/25">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-base font-extrabold text-slate-800 leading-none">Mading Pengumuman RT</h2>
                        <p class="text-[11px] text-slate-400 font-bold mt-1">Kabar & edaran resmi pengurus RT</p>
                    </div>
                </div>
                <a href="{{ route('warga.pengumuman.index') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-800 transition-colors flex items-center gap-1">
                    Lihat Semua <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="flex-1 flex flex-col gap-3">
                @if($pengumumanTerbaru->isEmpty())
                <div class="flex-1 rounded-2xl border border-dashed border-slate-200 flex flex-col items-center justify-center p-8 text-center bg-slate-50/50">
                    <svg class="w-12 h-12 text-slate-300 mb-3 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    <p class="text-sm font-bold text-slate-600">Saat ini belum ada pengumuman baru</p>
                </div>
                @else
                    <div class="relative pl-4 border-l-2 border-emerald-100 space-y-4 py-1">
                        @foreach($pengumumanTerbaru->take(3) as $umum)
                        <div class="relative group">
                            <div class="absolute -left-[1.35rem] top-2 w-3.5 h-3.5 bg-white border-2 border-emerald-300 rounded-full group-hover:bg-emerald-600 group-hover:border-emerald-600 transition-all shadow-sm"></div>
                            <a href="{{ route('warga.pengumuman.show', $umum) }}"
                               class="block p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-emerald-50/20 hover:border-emerald-200 transition-all">
                                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">{{ \Carbon\Carbon::parse($umum->tanggal)->translatedFormat('d M Y') }}</p>
                                <p class="text-sm font-extrabold text-slate-800 leading-tight line-clamp-1 group-hover:text-emerald-700 transition-colors">{{ $umum->judul }}</p>
                                <p class="text-xs text-slate-500 mt-1.5 leading-relaxed line-clamp-2">{{ Str::limit(strip_tags($umum->isi), 90) }}</p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ====== UPCOMING AGENDA (KEGIATAN MENDATANG) ====== --}}
    @if($kegiatanMendatang->isNotEmpty())
    <div class="card-premium p-6 md:p-8 bg-white">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-500 to-orange-500 flex items-center justify-center shadow-md shadow-rose-500/25">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h2 class="text-base font-extrabold text-slate-800">Kegiatan Warga Terdekat</h2>
                    <p class="text-xs text-slate-400 font-bold">Jangan lupa catat tanggalnya dan ikut serta ya!</p>
                </div>
            </div>
            <a href="{{ route('warga.kegiatan.index') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-800 transition-colors flex items-center gap-1">
                Lihat Semua <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach($kegiatanMendatang as $k)
            <a href="{{ route('warga.kegiatan.show', $k) }}"
               class="group relative overflow-hidden rounded-3xl bg-white border border-slate-100 hover:-translate-y-2 hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-300 flex flex-col justify-between">
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-rose-50 border border-rose-100 rounded-xl px-3 py-1.5 flex items-center gap-2">
                            <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-[10px] font-black text-rose-700 uppercase tracking-widest">{{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d M Y') }}</span>
                        </div>
                    </div>
                    <h3 class="text-slate-800 font-extrabold text-base leading-snug line-clamp-2 mb-4 group-hover:text-emerald-700 transition-colors">{{ $k->nama_kegiatan }}</h3>
                </div>
                <div class="px-6 py-4 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-1.5 text-slate-500 text-xs font-semibold min-w-0">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="truncate">{{ $k->lokasi }}</span>
                    </div>
                    <span class="text-emerald-600 font-extrabold text-xs shrink-0 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-all">
                        Ikut <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
