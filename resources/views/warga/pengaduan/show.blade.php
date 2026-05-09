@extends('layouts.warga')

@section('title', 'Detail Pengaduan')
@section('page-subtitle', 'Status Pengaduan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="bg-white border-b border-slate-100 px-4 py-4 flex items-center gap-3">
        <a href="{{ route('warga.pengaduan.index') }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-base font-bold text-slate-800">Detail Pengaduan</h1>
    </div>

    @php
        $sc = match($pengaduan->status) {
            'dikirim'  => ['emoji'=>'📤','bg'=>'from-amber-500 to-orange-500','label'=>'Dikirim','desc'=>'Pengaduan Anda sudah diterima dan menunggu respons.'],
            'diproses' => ['emoji'=>'🔄','bg'=>'from-blue-500 to-indigo-600','label'=>'Sedang Diproses','desc'=>'RT sedang menindaklanjuti pengaduan Anda.'],
            'selesai'  => ['emoji'=>'✅','bg'=>'from-green-500 to-emerald-600','label'=>'Selesai Ditangani','desc'=>'Pengaduan Anda sudah berhasil ditangani oleh RT.'],
            default    => ['emoji'=>'📢','bg'=>'from-slate-500 to-slate-600','label'=>$pengaduan->status,'desc'=>''],
        };
    @endphp

    {{-- Status Hero --}}
    <div class="bg-gradient-to-br {{ $sc['bg'] }} px-4 pt-6 pb-10 relative overflow-hidden rounded-3xl">
        <div class="absolute top-0 right-0 w-36 h-36 bg-white/10 rounded-full -translate-y-1/3 translate-x-1/3"></div>
        <div class="relative z-10 text-center">
            <div class="text-5xl mb-3">{{ $sc['emoji'] }}</div>
            <p class="text-white text-xl font-black">{{ $sc['label'] }}</p>
            <p class="text-white/75 text-xs mt-2">{{ $sc['desc'] }}</p>
        </div>
    </div>

    <div class="px-4 -mt-5 space-y-4 pb-6">
        {{-- Isi Pengaduan --}}
        <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/60 border border-slate-100 overflow-hidden">
            <div class="px-5 py-3 border-b border-slate-100 bg-slate-50">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Isi Pengaduan</p>
            </div>
            <div class="p-5">
                <h2 class="text-base font-black text-slate-800 mb-3">{{ $pengaduan->judul }}</h2>
                <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-wrap">{{ $pengaduan->isi }}</p>
                <p class="text-xs text-slate-400 mt-4 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Dikirim {{ $pengaduan->created_at->translatedFormat('d F Y, H:i') }}
                </p>
            </div>
        </div>

        {{-- Tanggapan RT --}}
        @if($pengaduan->tanggapan)
        <div class="bg-green-50 border border-green-200 rounded-2xl overflow-hidden">
            <div class="px-5 py-3 border-b border-green-200 bg-green-100 flex items-center gap-2">
                <span class="text-lg">💬</span>
                <p class="text-xs font-bold text-green-800 uppercase tracking-wider">Tanggapan dari RT</p>
            </div>
            <div class="p-5">
                <p class="text-sm text-green-800 leading-relaxed whitespace-pre-wrap">{{ $pengaduan->tanggapan }}</p>
            </div>
        </div>
        @else
        <div class="bg-slate-50 border border-slate-200 border-dashed rounded-2xl p-6 text-center">
            <p class="text-2xl mb-2">⏳</p>
            <p class="text-sm font-semibold text-slate-600">Belum ada tanggapan</p>
            <p class="text-xs text-slate-400 mt-1">Pihak RT akan segera menindaklanjuti pengaduan Anda.</p>
        </div>
        @endif

        {{-- Hapus --}}
        @if($pengaduan->status === 'dikirim')
        <form method="POST" action="{{ route('warga.pengaduan.destroy', $pengaduan) }}" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="w-full border-2 border-red-200 text-red-500 hover:bg-red-50 font-semibold py-3 rounded-2xl transition-colors text-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Hapus Pengaduan
            </button>
        </form>
        @endif
    </div>
</div>
@endsection
