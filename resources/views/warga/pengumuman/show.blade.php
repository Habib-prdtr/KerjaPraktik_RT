@extends('layouts.warga')
@section('title', $pengumuman->judul . ' — Portal Warga RT 08')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 space-y-6 pb-8">

    {{-- Back Header --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('warga.pengumuman.index') }}"
           class="w-11 h-11 rounded-2xl bg-white border border-slate-200 hover:border-emerald-300 hover:bg-emerald-50 flex items-center justify-center transition-all shadow-sm group">
            <svg class="w-5 h-5 text-slate-600 group-hover:text-emerald-600 group-hover:-translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 leading-tight">Detail Pengumuman</h1>
            <p class="text-xs text-slate-500 font-bold mt-0.5">Informasi resmi dari Pengurus RT 08</p>
        </div>
    </div>

    {{-- Hero Header Banner --}}
    <div class="hero-warga rounded-[2.5rem] shadow-xl shadow-emerald-900/10 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-teal-400/25 rounded-full -translate-y-1/3 translate-x-1/4 blur-3xl pointer-events-none"></div>
        <div class="relative z-10 px-7 py-10 md:px-10 md:py-12">
            <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 rounded-2xl px-3.5 py-2 mb-5">
                <span class="text-base">📢</span>
                <span class="text-[10px] font-black text-white/90 uppercase tracking-widest">Pengumuman RT</span>
            </div>
            <h1 class="text-white text-xl md:text-3xl font-extrabold leading-tight mb-5 drop-shadow-sm">{{ $pengumuman->judul }}</h1>
            <div class="flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2 bg-white/10 border border-white/15 rounded-xl px-3.5 py-2">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-white/90 text-xs font-bold">{{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 border border-white/15 rounded-xl px-3.5 py-2">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span class="text-white/90 text-xs font-bold">{{ $pengumuman->user->name ?? 'Admin RT' }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="card-premium p-6 md:p-8 bg-white border border-slate-100 shadow-sm">
        <div class="text-slate-700 text-sm md:text-base font-bold leading-relaxed whitespace-pre-wrap">
            {!! nl2br(e($pengumuman->isi)) !!}
        </div>
    </div>

    {{-- Footer Info --}}
    <div class="bg-gradient-to-br from-emerald-50 to-teal-50/50 border border-emerald-100 rounded-3xl p-6 flex items-start gap-4">
        <div class="w-12 h-12 rounded-2xl bg-white border border-emerald-100 flex items-center justify-center shrink-0 shadow-sm text-2xl">🏘️</div>
        <div>
            <h4 class="font-extrabold text-emerald-950 mb-0.5">Informasi Resmi Lingkungan</h4>
            <p class="text-xs text-emerald-800 font-bold leading-relaxed">Pengumuman ini dikeluarkan secara sah oleh Pengurus RT 08 RW 02. Harap dicermati dan disebarluaskan kepada tetangga/warga lain yang membutuhkan.</p>
        </div>
    </div>

    {{-- Action Buttons (WhatsApp & Back) --}}
    <div class="flex flex-col sm:flex-row gap-3 pt-2">
        <a href="https://api.whatsapp.com/send?text={{ urlencode("*PENGUMUMAN RT 08*\n\n*Tema:* " . $pengumuman->judul . "\n*Tanggal:* " . \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('d M Y') . "\n\n" . substr(strip_tags($pengumuman->isi), 0, 160) . "...\n\n_Selengkapnya silakan login ke Portal Warga RT 08_") }}"
           target="_blank"
           class="flex-1 bg-[#25D366] hover:bg-[#20ba5a] text-white font-extrabold py-4 px-6 rounded-2xl shadow-lg shadow-green-500/20 hover:-translate-y-0.5 transition-all text-sm flex items-center justify-center gap-2 group">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.517 2.266 2.27 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.968C16.57 1.97 14.1 .946 11.477.946c-5.438 0-9.863 4.374-9.868 9.8.001 1.77.462 3.5 1.335 5.013l-.99 3.615 3.693-.97z"/></svg>
            Bagikan ke WhatsApp Warga
        </a>
        <a href="{{ route('warga.pengumuman.index') }}"
           class="sm:w-auto flex items-center justify-center bg-white border-2 border-slate-200 text-slate-700 hover:border-emerald-300 hover:text-emerald-700 font-bold py-4 px-6 rounded-2xl transition-all text-sm">
            Kembali
        </a>
    </div>
</div>
@endsection
