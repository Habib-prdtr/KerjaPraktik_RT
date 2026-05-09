@extends('layouts.warga')

@section('title', 'Buat Pengaduan')
@section('page-subtitle', 'Form Pengaduan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="bg-white border-b border-slate-100 px-4 py-4 flex items-center gap-3">
        <a href="{{ route('warga.pengaduan.index') }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-base font-bold text-slate-800">Buat Pengaduan</h1>
            <p class="text-xs text-slate-400">Sampaikan keluhan Anda ke RT</p>
        </div>
    </div>

    <div class="px-4 py-5 space-y-4">
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-2xl p-4 text-sm text-red-700">
            <ul class="space-y-1">@foreach($errors->all() as $e)<li>• {{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form method="POST" action="{{ route('warga.pengaduan.store') }}" class="space-y-4">
            @csrf

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 space-y-2">
                <label for="judul" class="block text-sm font-bold text-slate-700">Judul Pengaduan <span class="text-red-500">*</span></label>
                <input id="judul" type="text" name="judul" value="{{ old('judul') }}" required
                    placeholder="Contoh: Lampu jalan RT mati 3 hari"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm font-medium focus:outline-none focus:ring-4 focus:ring-red-500/15 focus:border-red-400 transition-all placeholder-slate-400">
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 space-y-2">
                <label for="isi" class="block text-sm font-bold text-slate-700">Detail Pengaduan <span class="text-red-500">*</span></label>
                <textarea id="isi" name="isi" rows="6" required
                    placeholder="Jelaskan masalah secara detail. Sertakan lokasi, waktu, dan info pendukung..."
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-4 focus:ring-red-500/15 focus:border-red-400 transition-all resize-none placeholder-slate-400">{{ old('isi') }}</textarea>
            </div>

            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-start gap-3">
                <span class="text-xl shrink-0">⚠️</span>
                <p class="text-xs text-amber-800 font-medium leading-relaxed">Harap sertakan informasi yang akurat. Pengaduan palsu atau tidak relevan tidak akan diproses.</p>
            </div>

            <div class="space-y-2.5 pt-2">
                <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-600 hover:to-rose-600 text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-red-500/25 hover:-translate-y-0.5 text-sm flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Pengaduan
                </button>
                <a href="{{ route('warga.pengaduan.index') }}" class="block w-full text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-4 rounded-2xl transition-colors text-sm">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
