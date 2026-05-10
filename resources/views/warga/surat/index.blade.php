@extends('layouts.warga')

@section('title', 'Surat Saya')
@section('page-subtitle', 'Layanan Surat')

@push('styles')
<style>
    .glass-card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .glass-card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -10px rgba(245, 158, 11, 0.2);
    }
</style>
@endpush

@section('content')
<div class="space-y-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- ====== HERO SECTION ====== --}}
    <div class="relative rounded-[2rem] overflow-hidden shadow-2xl shadow-orange-500/20">
        <!-- Hero Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-amber-400 via-orange-500 to-red-500 z-0"></div>
        
        <!-- Decorative Orbs -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-amber-200/30 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4 pointer-events-none"></div>
        
        <div class="relative z-10 px-8 py-10 md:px-12 md:py-14 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 rounded-[1.25rem] bg-white/20 backdrop-blur-md border border-white/50 flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <h1 class="text-white text-2xl md:text-4xl font-black mb-1 drop-shadow-sm">Surat Saya</h1>
                    <p class="text-amber-50 text-sm md:text-base font-medium">Ajukan dan pantau status surat pengantar dari RT</p>
                </div>
            </div>
            <a href="{{ route('warga.surat.create') }}" class="group inline-flex items-center justify-center gap-2 bg-white/20 hover:bg-white text-white hover:text-orange-600 border border-white/50 hover:border-white px-6 py-3 rounded-xl font-bold shadow-lg backdrop-blur-sm transition-all w-full md:w-auto hover:scale-105">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Buat Surat Baru
            </a>
        </div>
    </div>

    @if($suratSaya->isEmpty())
    <div class="bg-white/60 backdrop-blur-xl rounded-[2rem] border border-white shadow-sm p-12 text-center max-w-2xl mx-auto mt-8">
        <div class="w-24 h-24 bg-gradient-to-br from-amber-100 to-orange-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
            <svg class="w-12 h-12 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <p class="text-xl font-black text-slate-800 mb-2">Belum Ada Pengajuan Surat</p>
        <p class="text-slate-500 font-medium mb-8 max-w-sm mx-auto">Anda belum pernah mengajukan surat pengantar. Klik tombol di atas jika Anda ingin membuat surat.</p>
        <a href="{{ route('warga.surat.create') }}" class="inline-block bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold px-8 py-3 rounded-xl shadow-lg shadow-orange-500/30 hover:scale-105 transition-transform">Ajukan Surat Pertama</a>
    </div>
    @else
    
    {{-- Grid Layout for Desktop --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-4">
        @foreach($suratSaya as $surat)
        @php
            $c = match($surat->status) {
                'diajukan' => ['bg'=>'bg-slate-50/50','border'=>'border-slate-200','pill'=>'bg-slate-200/50 text-slate-700','icon'=>'text-slate-500'],
                'diproses' => ['bg'=>'bg-blue-50/50','border'=>'border-blue-200','pill'=>'bg-blue-100 text-blue-700 shadow-sm shadow-blue-500/20','icon'=>'text-blue-500'],
                'selesai'  => ['bg'=>'bg-green-50/50','border'=>'border-green-200','pill'=>'bg-green-100 text-green-700 shadow-sm shadow-green-500/20','icon'=>'text-green-500'],
                'ditolak'  => ['bg'=>'bg-red-50/50','border'=>'border-red-200','pill'=>'bg-red-100 text-red-700 shadow-sm shadow-red-500/20','icon'=>'text-red-500'],
                default    => ['bg'=>'bg-slate-50/50','border'=>'border-slate-200','pill'=>'bg-slate-200/50 text-slate-700','icon'=>'text-slate-500'],
            };
        @endphp
        <div class="glass-card-hover bg-white/80 backdrop-blur-xl rounded-[1.5rem] border border-white shadow-sm overflow-hidden flex flex-col group relative">
            <!-- decorative corner blur -->
            <div class="absolute -top-10 -right-10 w-32 h-32 {{ str_replace('text-', 'bg-', $c['icon']) }} opacity-10 blur-2xl rounded-full pointer-events-none"></div>

            <div class="p-6 flex flex-col flex-1 relative z-10">
                <div class="flex items-start justify-between gap-3 mb-4">
                    <div class="w-12 h-12 rounded-[1rem] {{ $c['bg'] }} border {{ $c['border'] }} flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 {{ $c['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <span class="text-[10px] font-black px-3 py-1.5 rounded-lg {{ $c['pill'] }} uppercase tracking-widest">{{ $surat->status }}</span>
                </div>
                
                <h3 class="text-lg font-black text-slate-800 leading-tight group-hover:text-amber-600 transition-colors mb-2">{{ $surat->jenis_surat }}</h3>
                
                <div class="space-y-2 mb-6 flex-1">
                    <p class="text-xs font-bold text-slate-400 font-mono bg-slate-100/50 inline-block px-2 py-1 rounded-md">{{ $surat->nomor_surat }}</p>
                    <p class="text-sm font-medium text-slate-600 line-clamp-2">{{ $surat->keperluan ?? 'Tidak ada keterangan keperluan.' }}</p>
                </div>
                
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">{{ $surat->created_at->translatedFormat('d M Y') }}</span>
                    <a href="{{ route('warga.surat.show', $surat) }}" class="inline-flex items-center justify-center gap-1.5 text-xs font-bold bg-amber-50 hover:bg-amber-500 text-amber-700 hover:text-white px-4 py-2.5 rounded-xl transition-all">
                        Lihat Detail
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-8 flex justify-center">
        {{ $suratSaya->links() }}
    </div>
    @endif
</div>
@endsection
