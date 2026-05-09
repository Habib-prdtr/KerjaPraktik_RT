@extends('layouts.warga')

@section('title', 'Surat Saya')
@section('page-subtitle', 'Layanan Surat')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-br from-amber-500 to-orange-600 p-6 md:p-10 relative overflow-hidden rounded-3xl shadow-lg shadow-orange-500/20">
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-white text-2xl md:text-3xl font-black mb-1">Surat Saya 📄</h1>
                <p class="text-amber-100 text-sm md:text-base">Ajukan dan pantau status surat pengantar dari RT</p>
            </div>
            <a href="{{ route('warga.surat.create') }}" class="inline-flex items-center justify-center gap-2 bg-white text-orange-600 px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all w-full md:w-auto">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Buat Surat Baru
            </a>
        </div>
    </div>

    @if($suratSaya->isEmpty())
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-12 text-center max-w-2xl mx-auto mt-8">
        <div class="w-20 h-20 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-5">
            <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <p class="text-lg font-bold text-slate-800 mb-2">Belum Ada Pengajuan Surat</p>
        <p class="text-slate-500 mb-6 max-w-sm mx-auto">Anda belum pernah mengajukan surat pengantar. Klik tombol di atas jika Anda ingin membuat surat.</p>
    </div>
    @else
    
    {{-- Grid Layout for Desktop --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($suratSaya as $surat)
        @php
            $c = match($surat->status) {
                'diajukan' => ['pill'=>'bg-slate-100 text-slate-600','bar'=>'bg-slate-300'],
                'diproses' => ['pill'=>'bg-blue-100 text-blue-700','bar'=>'bg-blue-500'],
                'selesai'  => ['pill'=>'bg-green-100 text-green-700','bar'=>'bg-green-500'],
                'ditolak'  => ['pill'=>'bg-red-100 text-red-700','bar'=>'bg-red-500'],
                default    => ['pill'=>'bg-slate-100 text-slate-600','bar'=>'bg-slate-300'],
            };
        @endphp
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col group">
            <div class="h-1.5 {{ $c['bar'] }} w-full"></div>
            <div class="p-5 flex flex-col flex-1">
                <div class="flex items-start justify-between gap-3 mb-3">
                    <h3 class="text-base font-bold text-slate-800 leading-tight group-hover:text-blue-600 transition-colors">{{ $surat->jenis_surat }}</h3>
                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-full {{ $c['pill'] }} capitalize shrink-0">{{ $surat->status }}</span>
                </div>
                <div class="space-y-1.5 mb-4 flex-1">
                    <p class="text-xs text-slate-500 font-mono">{{ $surat->nomor_surat }}</p>
                    <p class="text-sm text-slate-600 line-clamp-2">{{ $surat->keperluan ?? 'Tidak ada keterangan keperluan.' }}</p>
                </div>
                
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                    <span class="text-xs font-medium text-slate-400">{{ $surat->created_at->translatedFormat('d M Y') }}</span>
                    <a href="{{ route('warga.surat.show', $surat) }}" class="inline-flex items-center justify-center gap-1.5 text-xs font-bold bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 px-4 py-2 rounded-xl transition-colors">
                        Detail
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-6 flex justify-center">
        {{ $suratSaya->links() }}
    </div>
    @endif
</div>
@endsection
