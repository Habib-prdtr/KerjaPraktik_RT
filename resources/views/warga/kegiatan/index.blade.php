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
            $day     = \Carbon\Carbon::parse($item->tanggal)->format('d');
            $month   = \Carbon\Carbon::parse($item->tanggal)->translatedFormat('M');
        @endphp
        <a href="{{ route('warga.kegiatan.show', $item) }}"
           class="bg-white rounded-3xl border shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group flex flex-col relative
                  {{ $isToday ? 'border-emerald-300 ring-2 ring-emerald-100/50 shadow-emerald-500/10' : 'border-slate-100 hover:border-emerald-200 hover:-translate-y-1.5 hover:shadow-emerald-500/5' }}
                  {{ $isPast ? 'opacity-80' : '' }}">

            {{-- Photo or gradient header --}}
            @if($item->foto)
            <div class="h-44 overflow-hidden bg-slate-100 relative shrink-0">
                <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama_kegiatan }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                @if($isToday)
                <div class="absolute top-3 left-3 flex items-center gap-1.5 bg-emerald-600 text-white text-[10px] font-black px-3 py-1.5 rounded-full shadow-md animate-pulse">
                    🔴 HARI INI
                </div>
                @elseif($isPast)
                <div class="absolute top-3 left-3 bg-slate-700/80 backdrop-blur-sm text-white text-[10px] font-bold px-3 py-1.5 rounded-full">
                    Selesai
                </div>
                @else
                <div class="absolute top-3 left-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-[10px] font-black px-3 py-1.5 rounded-full shadow-md">
                    Mendatang
                </div>
                @endif
            </div>
            @else
            {{-- No photo: colored gradient banner --}}
            <div class="h-20 relative overflow-hidden {{ $isPast ? 'bg-gradient-to-r from-slate-500 to-slate-600' : ($isToday ? 'bg-gradient-to-r from-emerald-500 to-teal-600' : 'bg-gradient-to-r from-emerald-600 to-teal-700') }}">
                <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(255,255,255,0.15) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.15) 1px, transparent 1px); background-size: 20px 20px;"></div>
                @if($isToday)
                <div class="absolute top-3 left-3 bg-white/20 backdrop-blur-sm text-white text-[10px] font-black px-3 py-1.5 rounded-full animate-pulse">🔴 HARI INI</div>
                @elseif($isPast)
                <div class="absolute top-3 left-3 bg-white/20 backdrop-blur-sm text-white text-[10px] font-bold px-3 py-1.5 rounded-full">Selesai</div>
                @else
                <div class="absolute top-3 left-3 bg-white/20 backdrop-blur-sm text-white text-[10px] font-black px-3 py-1.5 rounded-full">Mendatang</div>
                @endif
            </div>
            @endif

            <div class="p-5 flex-1 flex flex-col">
                {{-- Calendar badge --}}
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-14 h-14 rounded-2xl shrink-0 flex flex-col items-center justify-center shadow-sm border
                                {{ $isPast ? 'bg-slate-50 border-slate-200' : ($isToday ? 'bg-emerald-50 border-emerald-200' : 'bg-teal-50 border-teal-100/50') }} -mt-9 ring-4 ring-white">
                        <p class="font-extrabold text-xl leading-none {{ $isPast ? 'text-slate-600' : ($isToday ? 'text-emerald-700' : 'text-teal-700') }}">{{ $day }}</p>
                        <p class="text-[9px] font-black uppercase tracking-wider leading-none mt-0.5 {{ $isPast ? 'text-slate-400' : ($isToday ? 'text-emerald-500' : 'text-teal-500') }}">{{ $month }}</p>
                    </div>
                    <div class="flex-1 min-w-0 pt-1">
                        <h3 class="text-[15px] font-extrabold text-slate-800 group-hover:text-emerald-700 transition-colors leading-snug line-clamp-2">{{ $item->nama_kegiatan }}</h3>
                    </div>
                </div>

                <div class="space-y-2 flex-1">
                    <div class="flex items-start gap-2 text-xs text-slate-500 font-bold">
                        <span class="text-sm shrink-0">📍</span>
                        <span class="line-clamp-1">{{ $item->lokasi }}</span>
                    </div>
                    @if($item->waktu)
                    <div class="flex items-center gap-2 text-xs text-slate-500 font-bold">
                        <span class="text-sm shrink-0">🕐</span>
                        <span>{{ $item->waktu }}</span>
                    </div>
                    @endif
                </div>

                <div class="mt-4 pt-4 border-t border-slate-100 flex justify-end">
                    <span class="text-[10px] font-black text-emerald-700 flex items-center gap-1 opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all bg-emerald-50 px-3 py-1.5 rounded-xl">
                        Lihat Detail <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                    </span>
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
