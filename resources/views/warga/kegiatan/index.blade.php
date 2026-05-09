@extends('layouts.warga')

@section('title', 'Kegiatan RT')
@section('page-subtitle', 'Agenda RT')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-br from-teal-500 to-emerald-600 p-6 md:p-10 relative overflow-hidden rounded-3xl shadow-lg shadow-teal-600/20">
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl"></div>
        <div class="absolute bottom-0 left-10 w-32 h-32 bg-teal-800/20 rounded-full translate-y-1/2 blur-xl"></div>
        <div class="relative z-10">
            <h1 class="text-white text-2xl md:text-3xl font-black mb-1">Agenda RT 📅</h1>
            <p class="text-teal-100 text-sm md:text-base">Jadwal kegiatan dan acara penting warga RT 08 RW 02</p>
        </div>
    </div>

    @if($kegiatan->isEmpty())
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-12 text-center max-w-2xl mx-auto mt-8">
        <div class="w-20 h-20 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-5">
            <svg class="w-10 h-10 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <p class="text-lg font-bold text-slate-800 mb-2">Belum Ada Kegiatan</p>
        <p class="text-slate-500 mb-6 max-w-sm mx-auto">Saat ini belum ada jadwal kegiatan atau acara RT yang akan datang.</p>
    </div>
    @else
    
    {{-- Grid Layout for Desktop --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($kegiatan as $item)
        @php
            $isPast  = \Carbon\Carbon::parse($item->tanggal)->isPast();
            $isToday = \Carbon\Carbon::parse($item->tanggal)->isToday();
            
            $cardBorder = $isToday ? 'border-teal-400 ring-2 ring-teal-400 ring-offset-2' : 'border-slate-100 hover:border-teal-200';
            $dateBg = $isToday ? 'from-teal-500 to-emerald-500 text-white' : ($isPast ? 'from-slate-100 to-slate-200 text-slate-500' : 'from-teal-100 to-emerald-100 text-teal-700');
            $dateMonth = $isToday ? 'text-teal-100' : ($isPast ? 'text-slate-400' : 'text-teal-600');
        @endphp
        
        <a href="{{ route('warga.kegiatan.show', $item) }}" class="flex flex-col bg-white rounded-2xl border {{ $cardBorder }} shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group overflow-hidden">
            @if($isToday)
            <div class="h-1.5 w-full bg-gradient-to-r from-teal-400 to-emerald-400"></div>
            @endif
            
            <div class="p-5 flex-1 flex flex-col">
                <div class="flex items-start gap-4 mb-4">
                    {{-- Calendar Icon/Badge --}}
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br {{ $dateBg }} flex flex-col items-center justify-center shrink-0 shadow-sm transition-transform group-hover:scale-105">
                        <p class="font-black text-xl leading-none">{{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</p>
                        <p class="{{ $dateMonth }} text-[10px] font-bold uppercase tracking-widest leading-none mt-1">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('M') }}</p>
                    </div>
                    
                    <div class="flex-1 min-w-0 pt-1">
                        <div class="flex items-center gap-2 flex-wrap mb-1">
                            @if($isToday)
                            <span class="text-[10px] font-black bg-teal-500 text-white px-2 py-0.5 rounded-full animate-pulse tracking-wide">HARI INI</span>
                            @elseif($isPast)
                            <span class="text-[10px] font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-md">Selesai</span>
                            @else
                            <span class="text-[10px] font-bold bg-teal-50 text-teal-600 px-2 py-0.5 rounded-md">Mendatang</span>
                            @endif
                        </div>
                        <h3 class="text-base font-black text-slate-800 leading-snug group-hover:text-teal-700 transition-colors line-clamp-2">{{ $item->nama_kegiatan }}</h3>
                    </div>
                </div>
                
                <div class="space-y-2 mb-4 flex-1">
                    <p class="text-sm text-slate-600 flex items-start gap-2">
                        <span class="text-teal-500 shrink-0">📍</span>
                        <span class="line-clamp-2">{{ $item->lokasi }}</span>
                    </p>
                    @if($item->waktu)
                    <p class="text-sm text-slate-600 flex items-center gap-2">
                        <span class="text-teal-500 shrink-0">🕐</span>
                        <span>{{ $item->waktu }}</span>
                    </p>
                    @endif
                </div>
                
                <div class="mt-auto pt-4 border-t border-slate-100 flex justify-end">
                    <span class="text-xs font-bold text-teal-600 flex items-center gap-1 opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all">
                        Lihat Detail <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    
    <div class="mt-6 flex justify-center">
        {{ $kegiatan->links() }}
    </div>
    @endif
</div>
@endsection
