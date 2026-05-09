@extends('layouts.warga')

@section('title', 'Pengaduan Saya')
@section('page-subtitle', 'Pengaduan Warga')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-br from-red-500 to-rose-600 p-6 md:p-10 relative overflow-hidden rounded-3xl shadow-lg shadow-red-500/20">
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-white text-2xl md:text-3xl font-black mb-1">Pengaduan Saya 📢</h1>
                <p class="text-red-100 text-sm md:text-base">Sampaikan keluhan atau laporan terkait lingkungan RT</p>
            </div>
            <a href="{{ route('warga.pengaduan.create') }}" class="inline-flex items-center justify-center gap-2 bg-white text-red-600 px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all w-full md:w-auto">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Buat Pengaduan
            </a>
        </div>
    </div>

    @if($pengaduanSaya->isEmpty())
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-12 text-center max-w-2xl mx-auto mt-8">
        <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-5">
            <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <p class="text-lg font-bold text-slate-800 mb-2">Belum Ada Pengaduan</p>
        <p class="text-slate-500 mb-6 max-w-sm mx-auto">Lingkungan aman terkendali! Jika ada keluhan atau laporan, Anda bisa membuat pengaduan baru di sini.</p>
    </div>
    @else
    
    {{-- Grid Layout for Desktop --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($pengaduanSaya as $aduan)
        @php
            $c = match($aduan->status) {
                'dikirim'  => ['pill'=>'bg-amber-100 text-amber-700','bar'=>'bg-amber-400','icon'=>'bg-amber-50 text-amber-500'],
                'diproses' => ['pill'=>'bg-blue-100 text-blue-700','bar'=>'bg-blue-500','icon'=>'bg-blue-50 text-blue-500'],
                'selesai'  => ['pill'=>'bg-green-100 text-green-700','bar'=>'bg-green-500','icon'=>'bg-green-50 text-green-500'],
                default    => ['pill'=>'bg-slate-100 text-slate-600','bar'=>'bg-slate-300','icon'=>'bg-slate-50 text-slate-500'],
            };
        @endphp
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col group">
            <div class="h-1.5 {{ $c['bar'] }} w-full"></div>
            <div class="p-5 flex flex-col flex-1">
                <div class="flex items-start justify-between gap-3 mb-3">
                    <h3 class="text-base font-bold text-slate-800 leading-tight group-hover:text-red-600 transition-colors line-clamp-2">{{ $aduan->judul }}</h3>
                </div>
                
                <p class="text-sm text-slate-500 line-clamp-3 mb-4 flex-1">{{ $aduan->isi }}</p>
                
                @if($aduan->tanggapan_admin)
                <div class="bg-green-50 border border-green-100 rounded-xl p-3 mb-4">
                    <p class="text-[11px] font-bold text-green-700 uppercase tracking-wider mb-1">💬 Tanggapan RT</p>
                    <p class="text-xs text-green-800 line-clamp-2">{{ $aduan->tanggapan_admin }}</p>
                </div>
                @endif
                
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                    <div class="flex flex-col">
                        <span class="text-[10px] text-slate-400 font-medium uppercase tracking-wider mb-0.5">Status</span>
                        <span class="text-xs font-bold px-2 py-0.5 rounded-md {{ $c['pill'] }} capitalize max-w-max">{{ $aduan->status }}</span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if($aduan->status === 'dikirim')
                        <form method="POST" action="{{ route('warga.pengaduan.destroy', $aduan) }}" onsubmit="return confirm('Hapus pengaduan ini?')">
                            @csrf @method('DELETE')
                            <button class="w-9 h-9 flex items-center justify-center rounded-xl bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-600 transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('warga.pengaduan.show', $aduan) }}" class="inline-flex items-center justify-center gap-1.5 text-xs font-bold bg-slate-50 hover:bg-red-50 text-slate-600 hover:text-red-600 px-4 py-2 rounded-xl transition-colors h-9">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-6 flex justify-center">
        {{ $pengaduanSaya->links() }}
    </div>
    @endif
</div>
@endsection
