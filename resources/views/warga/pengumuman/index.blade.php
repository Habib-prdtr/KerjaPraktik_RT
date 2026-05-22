@extends('layouts.warga')
@section('title', 'Papan Mading RT — Portal Warga RT 08')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- ====== HERO BANNER ====== --}}
    <div class="hero-warga rounded-[2.5rem] shadow-xl shadow-emerald-900/10">
        <div class="relative z-10 px-7 py-10 md:px-12 md:py-14">
            <div class="absolute top-0 right-0 w-80 h-80 bg-teal-400/25 rounded-full blur-3xl -translate-y-1/3 translate-x-1/4 pointer-events-none"></div>
            <div class="relative z-10 flex items-center gap-5">
                <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shadow-xl text-3xl">
                    📢
                </div>
                <div>
                    <h1 class="text-white text-2xl md:text-4xl font-extrabold mb-1.5">Papan Mading RT 08</h1>
                    <p class="text-emerald-100 text-sm font-medium leading-relaxed">Informasi terbaru, pengumuman resmi, dan kabar penting untuk seluruh warga RT 08 RW 02</p>
                </div>
            </div>
        </div>
    </div>

    @if($pengumuman->isEmpty())
    {{-- ====== EMPTY STATE ====== --}}
    <div class="card-premium p-16 text-center bg-white border border-slate-100 shadow-sm">
        <div class="w-24 h-24 mx-auto mb-6 rounded-3xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-5xl shadow-sm">📭</div>
        <h3 class="text-xl font-extrabold text-slate-800 mb-2">Belum Ada Pengumuman</h3>
        <p class="text-slate-500 font-medium max-w-sm mx-auto text-sm leading-relaxed">Saat ini belum ada informasi terbaru dari pengurus RT. Silakan cek berkala ya!</p>
    </div>
    @else

    {{-- ====== MADING CARDS ====== --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($pengumuman as $umum)
        @php $isNew = $umum->tanggal >= now()->subDays(3)->toDateString(); @endphp
        <a href="{{ route('warga.pengumuman.show', $umum) }}"
           class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-emerald-500/5 hover:-translate-y-1.5 transition-all duration-300 overflow-hidden group flex flex-col relative">
            {{-- Left accent bar --}}
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-emerald-500 to-teal-600 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

            <div class="p-6 flex flex-col flex-1 pl-7">
                <div class="flex items-start justify-between gap-3 mb-4">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-100/50 px-3 py-1 rounded-xl">
                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ \Carbon\Carbon::parse($umum->tanggal)->translatedFormat('d M Y') }}
                    </span>
                    @if($isNew)
                    <span class="px-2.5 py-1 rounded-xl bg-gradient-to-r from-amber-500 to-orange-500 text-white text-[9px] font-black tracking-wider uppercase shrink-0 shadow-md shadow-amber-500/25">
                        BARU
                    </span>
                    @endif
                </div>

                <h3 class="text-[15px] font-extrabold text-slate-800 mb-2.5 line-clamp-2 group-hover:text-emerald-700 transition-colors leading-snug">{{ $umum->judul }}</h3>
                <p class="text-xs text-slate-500 font-medium line-clamp-3 mb-5 flex-1 leading-relaxed">{{ strip_tags($umum->isi) }}</p>

                <div class="flex items-center justify-between pt-4 border-t border-slate-100 mt-auto">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-emerald-50 to-teal-50 border border-emerald-100 flex items-center justify-center text-[10px] font-black text-emerald-700">RT</div>
                        <span class="text-xs font-bold text-slate-600">{{ $umum->user->name ?? 'Admin RT' }}</span>
                    </div>
                    <span class="text-xs font-extrabold text-emerald-600 flex items-center gap-1 opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all">
                        Baca Selengkapnya <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- pagination --}}
    <div class="flex justify-center mt-6">
        {{ $pengumuman->links() }}
    </div>
    @endif
</div>
@endsection
