@extends('layouts.warga')

@section('title', 'Detail Pengaduan')
@section('page-subtitle', 'Status Pengaduan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">
    <div class="glass-panel rounded-[2rem] p-6 flex items-center gap-4 relative overflow-hidden">
        <a href="{{ route('warga.pengaduan.index') }}" class="w-12 h-12 rounded-[1rem] bg-white border border-slate-200 hover:bg-slate-50 flex items-center justify-center transition-all shadow-sm hover:shadow group shrink-0 relative z-10">
            <svg class="w-6 h-6 text-slate-600 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div class="relative z-10">
            <h1 class="text-xl lg:text-2xl font-black text-slate-800">Detail Pengaduan</h1>
            <p class="text-sm font-medium text-slate-500 mt-0.5">Pantau status laporan dan tanggapan RT</p>
        </div>
    </div>

    @php
        $sc = match($pengaduan->status) {
            'dikirim'  => ['emoji'=>'📤','bg'=>'from-amber-400 to-orange-500','label'=>'Terkirim','desc'=>'Laporan Anda sudah diterima dan menunggu respons RT.'],
            'diproses' => ['emoji'=>'🔄','bg'=>'from-blue-500 to-indigo-600','label'=>'Sedang Diproses','desc'=>'RT sedang menindaklanjuti pengaduan Anda saat ini.'],
            'selesai'  => ['emoji'=>'✅','bg'=>'from-green-400 to-emerald-600','label'=>'Selesai Ditangani','desc'=>'Masalah pada pengaduan Anda sudah berhasil diselesaikan.'],
            default    => ['emoji'=>'📢','bg'=>'from-slate-500 to-slate-600','label'=>$pengaduan->status,'desc'=>''],
        };
    @endphp

    {{-- Status Hero --}}
    <div class="bg-gradient-to-br {{ $sc['bg'] }} px-6 pt-8 pb-12 relative overflow-hidden rounded-[2rem] shadow-xl shadow-slate-500/20">
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full -translate-y-1/3 translate-x-1/3 blur-xl"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-black/10 rounded-full translate-y-1/3 -translate-x-1/3 blur-xl"></div>
        <div class="relative z-10 text-center">
            <div class="w-24 h-24 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center mx-auto mb-4 border border-white/30 shadow-inner">
                <div class="text-5xl drop-shadow-md">{{ $sc['emoji'] }}</div>
            </div>
            <p class="text-white text-2xl font-black tracking-tight drop-shadow-sm">{{ $sc['label'] }}</p>
            <p class="text-white/80 text-sm font-medium mt-2 max-w-sm mx-auto leading-relaxed">{{ $sc['desc'] }}</p>
        </div>
    </div>

    <div class="-mt-8 relative z-20 space-y-6 pb-6">
        {{-- Isi Pengaduan --}}
        <div class="glass-panel rounded-[2rem] shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100/50 bg-white/50 backdrop-blur-md">
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Informasi Pengaduan</p>
            </div>
            <div class="p-6 lg:p-8 bg-white/80">
                <h2 class="text-xl font-black text-slate-800 mb-4">{{ $pengaduan->judul }}</h2>
                <div class="bg-slate-50/50 border border-slate-100 rounded-[1.25rem] p-5">
                    <p class="text-base text-slate-600 font-medium leading-relaxed whitespace-pre-wrap">{{ $pengaduan->isi }}</p>
                </div>
                @if($pengaduan->foto)
                <div class="mt-5">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Foto Lampiran</p>
                    <a href="{{ Storage::url($pengaduan->foto) }}" target="_blank" class="block overflow-hidden rounded-[1.25rem] border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto Pengaduan" class="w-full h-auto max-h-96 object-contain bg-slate-50">
                    </a>
                </div>
                @endif
                <div class="mt-5 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu Laporan</p>
                        <p class="text-xs font-bold text-slate-600">{{ $pengaduan->created_at->translatedFormat('l, d F Y - H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tanggapan RT --}}
        @if($pengaduan->tanggapan_admin)
        <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200/60 rounded-[2rem] p-6 shadow-sm relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-32 h-32 bg-emerald-100 rounded-full blur-2xl opacity-50"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-[1rem] bg-emerald-100 flex items-center justify-center text-xl shrink-0">
                        💬
                    </div>
                    <div>
                        <p class="text-xs font-black text-emerald-700 uppercase tracking-widest">Tanggapan Resmi</p>
                        <p class="text-sm font-bold text-emerald-900">Dari Pengurus RT</p>
                    </div>
                </div>
                <div class="bg-white/60 backdrop-blur-sm border border-emerald-100 rounded-[1.25rem] p-5">
                    <p class="text-sm font-semibold text-emerald-800 leading-relaxed whitespace-pre-wrap">{{ $pengaduan->tanggapan_admin }}</p>
                </div>
            </div>
        </div>
        @else
        <div class="glass-panel rounded-[2rem] p-8 text-center border-dashed border-2">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl">⏳</span>
            </div>
            <h3 class="text-base font-black text-slate-700 mb-1">Belum Ada Tanggapan</h3>
            <p class="text-sm font-medium text-slate-500 max-w-sm mx-auto">Pengurus RT akan segera meninjau dan menindaklanjuti laporan yang Anda kirimkan.</p>
        </div>
        @endif

        {{-- Hapus --}}
        @if($pengaduan->status === 'dikirim')
        <div class="pt-2">
            <form method="POST" action="{{ route('warga.pengaduan.destroy', $pengaduan) }}" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan dan menghapus laporan ini secara permanen?')">
                @csrf @method('DELETE')
                <button type="submit" class="w-full bg-white border-2 border-red-200 text-red-600 hover:bg-red-50 hover:border-red-300 font-bold py-4 rounded-[1.25rem] transition-all text-sm flex items-center justify-center gap-2 group shadow-sm">
                    <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Batalkan & Hapus Laporan
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
