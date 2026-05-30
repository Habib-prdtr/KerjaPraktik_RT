@extends('layouts.warga')
@section('title', 'Agenda Kegiatan — Portal Warga RT 08')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- ====== HERO BANNER ====== --}}
    <div class="hero-warga rounded-[2.5rem] shadow-xl shadow-emerald-900/10">
        <div class="relative z-10 px-7 py-10 md:px-12 md:py-14">
            <div class="absolute top-0 right-0 w-80 h-80 bg-teal-400/25 rounded-full blur-3xl -translate-y-1/3 translate-x-1/4 pointer-events-none"></div>
            <div class="relative z-10 flex items-center gap-5">
                <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shadow-xl text-3xl">
                    🤝
                </div>
                <div>
                    <h1 class="text-white text-2xl md:text-4xl font-extrabold mb-1.5">Agenda & Kegiatan Desa</h1>
                    <p class="text-emerald-100 text-sm font-medium leading-relaxed">Jadwal gotong royong, rapat RT, posyandu, dan acara kebersamaan warga RT 08 RW 02</p>
                </div>
            </div>
        </div>
    </div>

    @if($kegiatan->isEmpty())
    {{-- ====== EMPTY STATE ====== --}}
    <div class="card-premium p-16 text-center bg-white border border-slate-100 shadow-sm">
        <div class="w-24 h-24 mx-auto mb-6 rounded-3xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-5xl shadow-sm">🗓️</div>
        <h3 class="text-xl font-extrabold text-slate-800 mb-2">Belum Ada Agenda Kegiatan</h3>
        <p class="text-slate-500 font-medium max-w-sm mx-auto text-sm leading-relaxed">Saat ini belum ada jadwal kegiatan atau acara RT yang terdaftar. Cek berkala ya!</p>
    </div>
    @else

    {{-- ====== GRID AGENDA CARDS ====== --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($kegiatan as $item)
        @php
            $isPast  = \Carbon\Carbon::parse($item->tanggal)->isPast();
            $isToday = \Carbon\Carbon::parse($item->tanggal)->isToday();
            $dateStr = \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y');
        @endphp
        <a href="{{ route('warga.kegiatan.show', $item) }}"
           class="group relative bg-white rounded-2xl shadow-sm border border-slate-200 hover:shadow-2xl hover:border-emerald-300 transition-all duration-300 hover:-translate-y-2 flex flex-col overflow-hidden
                  {{ $isPast ? 'opacity-80' : '' }}">
            
            {{-- Bagian Gambar / Header Banner --}}
            @if($item->foto)
                <div class="relative w-full h-48 bg-slate-100 overflow-hidden">
                    <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama_kegiatan }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-slate-900/0 to-transparent"></div>
                    
                    {{-- Badges --}}
                    <div class="absolute top-4 right-4">
                        @if($isToday)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-500 text-white shadow-lg shadow-rose-500/30 animate-pulse">
                                <span class="w-1.5 h-1.5 rounded-full bg-white"></span> HARI INI
                            </span>
                        @elseif($isPast)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-800/80 backdrop-blur-md text-slate-200 border border-slate-700/50">
                                Selesai
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/90 backdrop-blur-md text-white border border-emerald-400/50 shadow-lg shadow-emerald-500/20">
                                Mendatang
                            </span>
                        @endif
                    </div>
                </div>
            @else
                <div class="relative w-full h-36 overflow-hidden {{ $isPast ? 'bg-slate-700' : 'bg-gradient-to-br from-emerald-600 to-teal-800' }}">
                    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 16px 16px;"></div>
                    <div class="absolute top-4 right-4">
                        @if($isToday)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-500 text-white shadow-lg shadow-rose-500/30 animate-pulse">
                                <span class="w-1.5 h-1.5 rounded-full bg-white"></span> HARI INI
                            </span>
                        @elseif($isPast)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/20 backdrop-blur-md text-white border border-white/20">
                                Selesai
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/20 backdrop-blur-md text-white border border-white/30 shadow-lg shadow-black/10">
                                Mendatang
                            </span>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Bagian Konten --}}
            <div class="p-5 flex-1 flex flex-col relative bg-white">
                {{-- Decorative Line --}}
                <div class="absolute top-0 left-5 right-5 h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent"></div>

                {{-- Tanggal & Waktu --}}
                <div class="flex items-center gap-3 mb-3 text-sm">
                    <div class="flex items-center gap-1.5 font-semibold {{ $isToday ? 'text-rose-600' : 'text-emerald-600' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>{{ $dateStr }}</span>
                    </div>
                    @if($item->waktu)
                    <div class="w-1 h-1 rounded-full bg-slate-300"></div>
                    <div class="flex items-center gap-1.5 text-slate-500 font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ $item->waktu }}</span>
                    </div>
                    @endif
                </div>

                {{-- Judul Kegiatan --}}
                <h3 class="text-lg font-bold text-slate-900 mb-3 line-clamp-2 leading-snug group-hover:text-emerald-700 transition-colors">
                    {{ $item->nama_kegiatan }}
                </h3>

                {{-- Lokasi --}}
                <div class="mt-auto flex items-start gap-2 text-slate-600 text-sm">
                    <svg class="w-4 h-4 mt-0.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="line-clamp-1 leading-relaxed">{{ $item->lokasi }}</span>
                </div>

                {{-- Hover Indicator --}}
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span class="text-xs font-bold text-emerald-600">Baca Selengkapnya</span>
                    <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="flex justify-center mt-6">
        {{ $kegiatan->links() }}
    </div>
    @endif
</div>
@endsection
