@extends('layouts.warga')

@section('title', 'Kegiatan RT')
@section('page-subtitle', 'Agenda RT')

@push('styles')
<style>
    .glass-card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .glass-card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -10px rgba(16, 185, 129, 0.2);
    }
</style>
@endpush

@section('content')
<div class="space-y-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- ====== HERO SECTION ====== --}}
    <div class="relative rounded-[2rem] overflow-hidden shadow-2xl shadow-teal-500/20">
        <!-- Hero Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-teal-500 via-emerald-500 to-green-500 z-0"></div>
        
        <!-- Decorative Orbs -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-emerald-300/30 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4 pointer-events-none"></div>
        
        <div class="relative z-10 px-8 py-10 md:px-12 md:py-14 flex items-center gap-5">
            <div class="w-16 h-16 rounded-[1.25rem] bg-white/20 backdrop-blur-md border border-white/50 flex items-center justify-center shadow-lg shrink-0">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <h1 class="text-white text-2xl md:text-4xl font-black mb-1 drop-shadow-sm">Agenda Kegiatan</h1>
                <p class="text-teal-50 text-sm md:text-base font-medium">Jadwal kegiatan dan acara kebersamaan warga RT 08 RW 02</p>
            </div>
        </div>
    </div>

    @if($kegiatan->isEmpty())
    <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] border border-white shadow-sm p-12 text-center max-w-2xl mx-auto mt-8">
        <div class="w-24 h-24 bg-gradient-to-br from-teal-100 to-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
            <svg class="w-12 h-12 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <p class="text-xl font-black text-slate-800 mb-2">Belum Ada Kegiatan</p>
        <p class="text-slate-500 font-medium mb-8 max-w-sm mx-auto">Saat ini belum ada jadwal kegiatan atau acara RT yang akan datang.</p>
    </div>
    @else
    
    {{-- Grid Layout for Desktop --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-4">
        @foreach($kegiatan as $item)
        @php
            $isPast  = \Carbon\Carbon::parse($item->tanggal)->isPast();
            $isToday = \Carbon\Carbon::parse($item->tanggal)->isToday();
            
            $cardBg = 'bg-white/80 backdrop-blur-xl';
            $textColor = 'text-slate-800';
            $descColor = 'text-slate-500';
            $dateBg = $isPast ? 'bg-slate-100' : 'bg-gradient-to-br from-teal-100 to-emerald-100';
            $dateMonth = $isPast ? 'text-slate-400' : 'text-teal-600';
            $dateDay = $isPast ? 'text-slate-500' : 'text-teal-700';
        @endphp
        
        <a href="{{ route('warga.kegiatan.show', $item) }}" class="glass-card-hover {{ $cardBg }} rounded-[1.5rem] border {{ $isToday ? 'border-teal-400/60 shadow-lg shadow-teal-500/10 ring-2 ring-teal-50' : 'border-white shadow-sm' }} flex flex-col group overflow-hidden relative">
            
            @if($isToday)
            <div class="absolute -right-10 -top-10 w-32 h-32 bg-teal-100/50 rounded-full blur-2xl z-0 pointer-events-none"></div>
            @endif
            
            <div class="absolute top-0 left-0 w-1 h-full {{ $isToday ? 'bg-teal-500' : 'bg-slate-200' }} group-hover:bg-gradient-to-b group-hover:from-teal-500 group-hover:to-emerald-500 transition-all duration-300 z-10 pointer-events-none"></div>

            @if($item->foto)
            <div class="h-56 w-full overflow-hidden relative shrink-0 z-0">
                <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama_kegiatan }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>
            @endif
            
            <div class="p-5 flex-1 flex flex-col relative z-10 pl-6">
                <div class="flex items-start gap-4 mb-5">
                    {{-- Calendar Badge --}}
                    <div class="w-14 h-14 rounded-[1.25rem] {{ $dateBg }} border border-slate-100 flex flex-col items-center justify-center shrink-0 shadow-sm transition-transform group-hover:scale-105">
                        <p class="font-black text-lg leading-none {{ $dateDay }}">{{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</p>
                        <p class="{{ $dateMonth }} text-[10px] font-bold uppercase tracking-widest leading-none mt-1">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('M') }}</p>
                    </div>
                    
                    <div class="flex-1 min-w-0 pt-1">
                        <div class="flex items-center gap-2 flex-wrap mb-1.5">
                            @if($isToday)
                            <span class="text-[10px] font-black bg-white text-teal-600 px-2.5 py-1 rounded-md animate-pulse tracking-widest shadow-sm">HARI INI</span>
                            @elseif($isPast)
                            <span class="text-[10px] font-bold bg-slate-100 text-slate-500 px-2.5 py-1 rounded-md uppercase tracking-wider border border-slate-200">Selesai</span>
                            @else
                            <span class="text-[10px] font-black bg-teal-50 text-teal-600 px-2.5 py-1 rounded-md uppercase tracking-wider border border-teal-100">Mendatang</span>
                            @endif
                        </div>
                        <h3 class="text-lg font-black {{ $textColor }} leading-snug transition-colors line-clamp-2">{{ $item->nama_kegiatan }}</h3>
                    </div>
                </div>
                
                <div class="space-y-3 mb-6 flex-1">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-teal-50 flex items-center justify-center shrink-0 mt-0.5">
                            <span class="text-xs">📍</span>
                        </div>
                        <p class="text-sm font-medium {{ $descColor }} leading-relaxed line-clamp-2 pt-0.5">{{ $item->lokasi }}</p>
                    </div>
                    @if($item->waktu)
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-teal-50 flex items-center justify-center shrink-0 mt-0.5">
                            <span class="text-xs">🕐</span>
                        </div>
                        <p class="text-sm font-medium {{ $descColor }} leading-relaxed pt-0.5">{{ $item->waktu }}</p>
                    </div>
                    @endif
                </div>
                
                <div class="mt-auto pt-4 border-t border-slate-100 flex justify-end">
                    <span class="text-xs font-black text-teal-600 flex items-center gap-1 opacity-0 group-hover:opacity-100 -translate-x-3 group-hover:translate-x-0 transition-all uppercase tracking-widest bg-teal-50 px-3 py-1.5 rounded-lg">
                        Detail <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    
    <div class="mt-8 flex justify-center">
        {{ $kegiatan->links() }}
    </div>
    @endif
</div>
@endsection
