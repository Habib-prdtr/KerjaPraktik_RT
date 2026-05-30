@extends('layouts.warga')
@section('title', 'Daftar Surat Pengantar — Portal Warga RT 08')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- ====== HERO BANNER ====== --}}
    <div class="hero-warga rounded-[2.5rem] shadow-xl shadow-emerald-900/10">
        <div class="relative z-10 px-7 py-10 md:px-12 md:py-14">
            <div class="absolute top-0 right-0 w-80 h-80 bg-teal-400/25 rounded-full blur-3xl -translate-y-1/3 translate-x-1/4 pointer-events-none"></div>
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shadow-xl text-3xl">
                        <svg class="w-6 h-6 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h1 class="text-white text-2xl md:text-4xl font-extrabold mb-2">Daftar Surat Pengantar Saya</h1>
                        <p class="text-emerald-100 text-sm font-medium leading-relaxed">Kelola dan pantau pengajuan surat pengantar RT secara mudah dan online</p>
                    </div>
                </div>
                <a href="{{ route('warga.surat.create') }}"
                   class="group inline-flex items-center gap-2.5 bg-white text-emerald-800 hover:bg-emerald-50 font-black px-6 py-4 rounded-2xl shadow-lg hover:shadow-xl transition-all w-full lg:w-auto justify-center hover:-translate-y-0.5">
                    <span><svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg></span>
                    Buat Pengajuan Surat Baru
                </a>
            </div>
        </div>
    </div>

    {{-- ====== PANDUAN PENGURUSAN SURAT ====== --}}
    <div class="card-premium p-6 bg-white border border-emerald-100/50">
        <h2 class="text-[11px] font-black text-emerald-700 uppercase tracking-widest mb-1.5">Panduan Pengurusan</h2>
        <h3 class="text-base font-extrabold text-slate-800 mb-4">3 Langkah Mudah Mengurus Surat Pengantar RT</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex gap-3">
                <div class="w-8 h-8 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center text-xs font-black text-emerald-700 shrink-0">1</div>
                <div>
                    <h4 class="font-extrabold text-slate-800 text-sm mb-1">Ajukan Formulir Online</h4>
                    <p class="text-xs text-slate-500 leading-normal">Klik tombol "Buat Pengajuan Surat", isi jenis surat dan keperluan dengan jelas dan jujur.</p>
                </div>
            </div>
            <div class="flex gap-3">
                <div class="w-8 h-8 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center text-xs font-black text-emerald-700 shrink-0">2</div>
                <div>
                    <h4 class="font-extrabold text-slate-800 text-sm mb-1">Pemeriksaan Pak RT</h4>
                    <p class="text-xs text-slate-500 leading-normal">Pak RT akan memeriksa pengajuan secara online. Status surat dapat dipantau langsung di halaman ini.</p>
                </div>
            </div>
            <div class="flex gap-3">
                <div class="w-8 h-8 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center text-xs font-black text-emerald-700 shrink-0">3</div>
                <div>
                    <h4 class="font-extrabold text-slate-800 text-sm mb-1">Pengambilan Fisik Surat</h4>
                    <p class="text-xs text-slate-500 leading-normal">Jika status **"Siap Diambil"**, silakan datang ke rumah Pak RT untuk tanda tangan basah dan stempel resmi.</p>
                </div>
            </div>
        </div>
    </div>

    @if($suratSaya->isEmpty())
    {{-- ====== EMPTY STATE ====== --}}
    <div class="card-premium p-16 text-center bg-white">
        <div class="w-24 h-24 mx-auto mb-6 rounded-3xl bg-slate-50 border border-slate-100 flex items-center justify-center text-5xl shadow-sm">
            <svg class="w-16 h-16 inline-block text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
        </div>
        <h3 class="text-xl font-extrabold text-slate-800 mb-2">Bapak/Ibu Belum Memiliki Pengajuan</h3>
        <p class="text-slate-500 font-medium mb-8 max-w-sm mx-auto text-sm leading-relaxed">
            Saat ini belum ada riwayat surat pengantar yang diajukan. Silakan klik tombol di bawah untuk membuat surat pengantar pertama.
        </p>
        <a href="{{ route('warga.surat.create') }}"
           class="inline-flex items-center gap-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-extrabold px-8 py-4 rounded-2xl shadow-lg shadow-emerald-500/25 hover:-translate-y-0.5 transition-all">
            <svg class="w-6 h-6 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg> Ajukan Surat Pertama Anda
        </a>
    </div>
    @else

    {{-- ====== GRID SURAT CARDS ====== --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($suratSaya as $surat)
        @php
            $statusData = match($surat->status) {
                'diajukan' => [
                    'cls' => 'pill-pending',
                    'bar' => 'from-slate-400 to-slate-500',
                    'label' => 'Menunggu RT',
                    'icon' => '<svg class="w-3.5 h-3.5 inline-block mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    'hint' => 'Menunggu antrean berkas diperiksa Pak RT.'
                ],
                'diproses' => [
                    'cls' => 'pill-diproses',
                    'bar' => 'from-amber-400 to-amber-500',
                    'label' => 'Sedang Dibuat',
                    'icon' => '<svg class="w-3.5 h-3.5 inline-block mr-1 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>',
                    'hint' => 'Surat sedang diketik/ditandatangani Pengurus RT.'
                ],
                'selesai'  => [
                    'cls' => 'pill-selesai',
                    'bar' => 'from-emerald-400 to-teal-500',
                    'label' => 'Siap Diambil',
                    'icon' => '<svg class="w-3.5 h-3.5 inline-block mr-1 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    'hint' => 'Siap! Ambil fisik di rumah RT / unduh detail.'
                ],
                'ditolak'  => [
                    'cls' => 'pill-ditolak',
                    'bar' => 'from-rose-400 to-red-500',
                    'label' => 'Perlu Perbaikan',
                    'icon' => '<svg class="w-3.5 h-3.5 inline-block mr-1 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    'hint' => 'Pengajuan ditolak. Periksa alasan di tombol Detail.'
                ],
                default    => [
                    'cls' => 'pill-pending',
                    'bar' => 'from-slate-400 to-slate-500',
                    'label' => 'Diajukan',
                    'icon' => '<svg class="w-4 h-4 inline-block text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>',
                    'hint' => 'Terkirim ke pengurus RT.'
                ],
            };
        @endphp
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-emerald-500/5 hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col">
            {{-- Colored top bar --}}
            <div class="h-1.5 bg-gradient-to-r {{ $statusData['bar'] }}"></div>

            <div class="p-6 flex flex-col flex-1">
                <div class="flex items-start justify-between gap-3 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0 text-2xl">
                        <svg class="w-6 h-6 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <span class="{{ $statusData['cls'] }} text-[9px] font-black px-2.5 py-1 rounded-lg uppercase tracking-wider">
                        {!! $statusData['icon'] !!} {{ $statusData['label'] }}
                    </span>
                </div>

                <h3 class="text-[15px] font-extrabold text-slate-800 mb-1.5 leading-snug">{{ $surat->jenis_surat }}</h3>
                <p class="text-[10px] font-mono text-slate-400 bg-slate-50 border border-slate-100 inline-block px-2.5 py-0.5 rounded-md mb-3 align-middle w-max">
                    <svg class="w-3.5 h-3.5 inline-block text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg> {{ $surat->nomor_surat ?? 'Nomor belum terbit' }}
                </p>
                
                <div class="bg-slate-50/50 rounded-xl p-3 border border-slate-100 flex-1 flex flex-col justify-between mb-4">
                    <p class="text-xs text-slate-500 font-semibold leading-relaxed mb-3 line-clamp-2">
                        <svg class="w-3.5 h-3.5 inline-block text-slate-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg> Keperluan: <span class="font-normal text-slate-600">{{ $surat->keperluan ?? '-' }}</span>
                    </p>
                    <p class="text-[11px] text-slate-500 font-bold leading-normal border-t border-slate-100 pt-2">
                        {{ $statusData['hint'] }}
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                    <div>
                        <p class="text-[9px] text-slate-400 font-black uppercase tracking-wider leading-none">Tanggal Pengajuan</p>
                        <p class="text-xs font-bold text-slate-600 mt-1">{{ $surat->created_at->translatedFormat('d M Y') }}</p>
                    </div>
                    <a href="{{ route('warga.surat.show', $surat) }}"
                       class="inline-flex items-center gap-1.5 bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white text-xs font-extrabold px-4 py-2.5 rounded-xl transition-all shadow-sm">
                        Detail Surat
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- pagination --}}
    <div class="flex justify-center mt-6">
        {{ $suratSaya->links() }}
    </div>
    @endif
</div>
@endsection

