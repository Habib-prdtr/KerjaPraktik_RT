@extends('layouts.warga')

@section('title', 'Detail Pengaduan')
@section('page-subtitle', 'Status Pengaduan')

@push('styles')
<style>
    .bento-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        border-radius: 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="max-w-3xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">
    <div class="bento-card p-6 flex items-center gap-4 relative overflow-hidden">
        <a href="{{ route('warga.pengaduan.index') }}" class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200 hover:bg-slate-100 flex items-center justify-center transition-all shadow-sm hover:shadow group shrink-0 relative z-10">
            <svg class="w-6 h-6 text-slate-600 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div class="relative z-10">
            <h1 class="text-xl lg:text-2xl font-black text-slate-900">Detail Pengaduan</h1>
            <p class="text-sm font-medium text-slate-500 mt-0.5">Pantau status laporan dan tanggapan RT</p>
        </div>
    </div>

    @php
        $sc = match($pengaduan->status) {
            'dikirim'  => ['icon'=>'M12 19l9 2-9-18-9 18 9-2zm0 0v-8','bg'=>'from-slate-700 to-slate-900','color'=>'text-slate-400','label'=>'Terkirim','desc'=>'Laporan Anda sudah diterima dan menunggu respons RT.'],
            'diproses' => ['icon'=>'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15','bg'=>'from-blue-600 to-indigo-800','color'=>'text-blue-400','label'=>'Sedang Diproses','desc'=>'RT sedang menindaklanjuti pengaduan Anda saat ini.'],
            'selesai'  => ['icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z','bg'=>'from-emerald-600 to-teal-800','color'=>'text-emerald-400','label'=>'Selesai Ditangani','desc'=>'Masalah pada pengaduan Anda sudah berhasil diselesaikan.'],
            default    => ['icon'=>'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z','bg'=>'from-slate-600 to-slate-800','color'=>'text-slate-400','label'=>$pengaduan->status,'desc'=>''],
        };
    @endphp

    {{-- Status Hero --}}
    <div class="bg-gradient-to-br {{ $sc['bg'] }} px-6 py-10 relative overflow-hidden rounded-[2rem] shadow-xl shadow-slate-900/20">
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        <div class="relative z-10 text-center">
            <div class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mx-auto mb-5 border border-white/20 shadow-inner">
                <svg class="w-10 h-10 {{ $sc['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sc['icon'] }}"/></svg>
            </div>
            <p class="text-white text-2xl font-black tracking-tight drop-shadow-sm">{{ $sc['label'] }}</p>
            <p class="text-white/70 text-sm font-medium mt-2 max-w-sm mx-auto leading-relaxed">{{ $sc['desc'] }}</p>
        </div>
    </div>

    <div class="space-y-6 pb-6">
        {{-- Isi Pengaduan --}}
        <div class="bento-card overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <p class="text-xs font-black text-slate-500 uppercase tracking-widest">Informasi Pengaduan</p>
            </div>
            <div class="p-6 lg:p-8 bg-white">
                <h2 class="text-xl font-black text-slate-900 mb-4">{{ $pengaduan->judul }}</h2>
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-5">
                    <p class="text-sm text-slate-700 font-medium leading-relaxed whitespace-pre-wrap">{{ $pengaduan->isi }}</p>
                </div>
                @if($pengaduan->foto)
                <div class="mt-5">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Foto Lampiran</p>
                    <a href="{{ Storage::url($pengaduan->foto) }}" target="_blank" class="block overflow-hidden rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto Pengaduan" class="w-full h-auto max-h-96 object-contain bg-slate-100">
                    </a>
                </div>
                @endif
                <div class="mt-5 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Waktu Laporan</p>
                        <p class="text-xs font-bold text-slate-700">{{ $pengaduan->created_at->translatedFormat('l, d F Y - H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tanggapan RT --}}
        @if($pengaduan->tanggapan_admin)
        <div class="bg-blue-50 border border-blue-100 rounded-[1.5rem] p-6 shadow-sm relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center shrink-0 border border-blue-200">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black text-blue-700 uppercase tracking-widest">Tanggapan Resmi</p>
                        <p class="text-sm font-bold text-blue-900">Dari Pengurus RT</p>
                    </div>
                </div>
                <div class="bg-white border border-blue-100 rounded-xl p-5">
                    <p class="text-sm font-semibold text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $pengaduan->tanggapan_admin }}</p>
                </div>
            </div>
        </div>
        @else
        <div class="bento-card p-8 text-center border-dashed border-2 border-slate-200 shadow-none">
            <div class="w-16 h-16 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-base font-black text-slate-800 mb-1">Belum Ada Tanggapan</h3>
            <p class="text-sm font-medium text-slate-500 max-w-sm mx-auto">Pengurus RT akan segera meninjau dan menindaklanjuti laporan yang Anda kirimkan.</p>
        </div>
        @endif

        {{-- Hapus --}}
        @if($pengaduan->status === 'dikirim')
        <div class="pt-2">
            <form method="POST" action="{{ route('warga.pengaduan.destroy', $pengaduan) }}" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan dan menghapus laporan ini secara permanen?')">
                @csrf @method('DELETE')
                <button type="submit" class="w-full bg-white border-2 border-red-200 text-red-600 hover:bg-red-50 hover:border-red-300 font-bold py-4 rounded-xl transition-all text-sm flex items-center justify-center gap-2 group shadow-sm">
                    <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Batalkan & Hapus Laporan
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
