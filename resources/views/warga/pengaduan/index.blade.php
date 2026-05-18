@extends('layouts.warga')

@section('title', 'Pengaduan Saya')
@section('page-subtitle', 'Pengaduan Warga')

@push('styles')
<style>
    .bento-card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .bento-card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.1);
        border-color: #cbd5e1;
    }
</style>
@endpush

@section('content')
<div class="space-y-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- ====== HERO SECTION ====== --}}
    <div class="relative rounded-[2rem] overflow-hidden bg-slate-900 border border-slate-800 shadow-xl shadow-slate-900/20">
        <!-- Hero Background -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        
        <!-- Decorative Orbs -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4 pointer-events-none"></div>
        
        <div class="relative z-10 px-8 py-10 md:px-12 md:py-14 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 rounded-2xl bg-slate-800 border border-slate-700 flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <h1 class="text-white text-2xl md:text-4xl font-black mb-1 drop-shadow-sm">Pengaduan Saya</h1>
                    <p class="text-slate-400 text-sm md:text-base font-medium">Sampaikan keluhan atau laporan terkait lingkungan RT</p>
                </div>
            </div>
            <a href="{{ route('warga.pengaduan.create') }}" class="group inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white border border-indigo-500 px-6 py-3 rounded-xl font-bold shadow-lg shadow-indigo-600/20 transition-all w-full md:w-auto hover:scale-105">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Buat Pengaduan
            </a>
        </div>
    </div>

    @if($pengaduanSaya->isEmpty())
    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-12 text-center max-w-2xl mx-auto mt-8">
        <div class="w-24 h-24 bg-indigo-50 border border-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <p class="text-xl font-black text-slate-800 mb-2">Belum Ada Pengaduan</p>
        <p class="text-slate-500 font-medium mb-8 max-w-sm mx-auto">Lingkungan aman terkendali! Jika ada keluhan atau laporan, Anda bisa membuat pengaduan baru di sini.</p>
        <a href="{{ route('warga.pengaduan.create') }}" class="inline-block bg-slate-900 text-white hover:bg-slate-800 font-bold px-8 py-3 rounded-xl shadow-md transition-all hover:-translate-y-0.5">Lapor Sekarang</a>
    </div>
    @else
    
    {{-- Grid Layout for Desktop --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-4">
        @foreach($pengaduanSaya as $aduan)
        @php
            $c = match($aduan->status) {
                'dikirim'  => ['bg'=>'bg-slate-50','border'=>'border-slate-200','pill'=>'bg-slate-100 text-slate-700','icon'=>'text-slate-600'],
                'diproses' => ['bg'=>'bg-blue-50/50','border'=>'border-blue-200','pill'=>'bg-blue-100 text-blue-700','icon'=>'text-blue-600'],
                'selesai'  => ['bg'=>'bg-green-50/50','border'=>'border-green-200','pill'=>'bg-green-100 text-green-700','icon'=>'text-green-600'],
                default    => ['bg'=>'bg-slate-50','border'=>'border-slate-200','pill'=>'bg-slate-100 text-slate-700','icon'=>'text-slate-600'],
            };
        @endphp
        <div class="bento-card-hover bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col group relative">
            <div class="p-6 flex flex-col flex-1 relative z-10">
                <div class="flex items-start justify-between gap-3 mb-4">
                    <div class="w-12 h-12 rounded-xl {{ $c['bg'] }} border {{ $c['border'] }} flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 {{ $c['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-md {{ $c['pill'] }} uppercase tracking-widest">{{ $aduan->status }}</span>
                </div>
                
                <h3 class="text-lg font-black text-slate-800 leading-tight group-hover:text-indigo-600 transition-colors mb-2 line-clamp-2">{{ $aduan->judul }}</h3>
                
                <p class="text-sm font-medium text-slate-500 line-clamp-3 mb-4 flex-1">{{ $aduan->isi }}</p>
                
                @if($aduan->tanggapan_admin)
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 mb-4 shadow-sm">
                    <div class="flex items-center gap-1.5 mb-1.5">
                        <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/></svg>
                        <p class="text-[10px] font-bold text-slate-600 uppercase tracking-wider">Tanggapan RT</p>
                    </div>
                    <p class="text-xs text-slate-700 font-medium line-clamp-2">{{ $aduan->tanggapan_admin }}</p>
                </div>
                @endif
                
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">{{ $aduan->created_at->translatedFormat('d M Y') }}</span>
                    
                    <div class="flex items-center gap-2">
                        @if($aduan->status === 'dikirim')
                        <form method="POST" action="{{ route('warga.pengaduan.destroy', $aduan) }}" onsubmit="return confirm('Hapus pengaduan ini?')">
                            @csrf @method('DELETE')
                            <button class="w-9 h-9 flex items-center justify-center rounded-xl bg-red-50 border border-red-100 hover:bg-red-500 hover:border-red-500 text-red-500 hover:text-white transition-all shadow-sm group" title="Hapus">
                                <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('warga.pengaduan.show', $aduan) }}" class="inline-flex items-center justify-center gap-1.5 text-xs font-bold bg-indigo-50 hover:bg-indigo-600 text-indigo-700 hover:text-white px-4 py-2.5 rounded-xl transition-all shadow-sm">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-8 flex justify-center">
        {{ $pengaduanSaya->links() }}
    </div>
    @endif
</div>
@endsection
