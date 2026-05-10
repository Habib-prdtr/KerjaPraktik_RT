@extends('layouts.warga')

@section('title', 'Buat Pengaduan')
@section('page-subtitle', 'Form Pengaduan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">
    {{-- Header --}}
    <div class="glass-panel rounded-[2rem] p-6 lg:p-8 flex items-center gap-4 relative overflow-hidden">
        <div class="absolute -right-10 -top-10 w-32 h-32 bg-red-100 rounded-full blur-3xl opacity-60 pointer-events-none"></div>
        <a href="{{ route('warga.pengaduan.index') }}" class="w-12 h-12 rounded-[1rem] bg-white border border-slate-200 hover:bg-slate-50 flex items-center justify-center transition-all shadow-sm hover:shadow group shrink-0 relative z-10">
            <svg class="w-6 h-6 text-slate-600 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div class="relative z-10">
            <h1 class="text-xl lg:text-2xl font-black text-slate-800">Buat Pengaduan Baru</h1>
            <p class="text-sm font-medium text-slate-500 mt-1">Sampaikan keluhan dan laporan untuk lingkungan RT</p>
        </div>
    </div>

    <div class="glass-panel rounded-[2rem] p-6 lg:p-8 relative overflow-hidden">
        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-rose-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>

        @if($errors->any())
        <div class="bg-red-50/80 backdrop-blur-sm border border-red-200 rounded-2xl p-5 text-sm text-red-700 mb-6 relative z-10">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                <span class="font-bold">Terdapat Kesalahan</span>
            </div>
            <ul class="space-y-1.5 pl-7 list-disc">
                @foreach($errors->all() as $e)
                    <li class="font-medium">{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('warga.pengaduan.store') }}" enctype="multipart/form-data" class="space-y-6 relative z-10">
            @csrf

            <div class="space-y-2">
                <label for="judul" class="block text-sm font-black text-slate-700 uppercase tracking-widest">Judul Laporan <span class="text-red-500">*</span></label>
                <input id="judul" type="text" name="judul" value="{{ old('judul') }}" required
                    placeholder="Contoh: Lampu jalan depan RT mati 3 hari"
                    class="w-full px-5 py-4 bg-white border border-slate-200 rounded-[1.25rem] text-slate-800 text-base font-bold focus:outline-none focus:ring-4 focus:ring-red-500/20 focus:border-red-400 transition-all placeholder-slate-400/70 shadow-sm hover:border-red-300">
            </div>

            <div class="space-y-2">
                <label for="isi" class="block text-sm font-black text-slate-700 uppercase tracking-widest">Detail Masalah <span class="text-red-500">*</span></label>
                <textarea id="isi" name="isi" rows="6" required
                    placeholder="Jelaskan masalah secara mendetail. Sertakan lokasi kejadian, waktu pengamatan, atau pihak yang terlibat..."
                    class="w-full px-5 py-4 bg-white border border-slate-200 rounded-[1.25rem] text-slate-800 text-base font-medium focus:outline-none focus:ring-4 focus:ring-red-500/20 focus:border-red-400 transition-all resize-none placeholder-slate-400/70 shadow-sm hover:border-red-300">{{ old('isi') }}</textarea>
            </div>

            <div class="space-y-2">
                <label for="foto" class="block text-sm font-black text-slate-700 uppercase tracking-widest">Foto Lampiran (Opsional)</label>
                <div class="relative">
                    <input id="foto" type="file" name="foto" accept="image/*"
                        class="w-full px-5 py-3.5 bg-white border border-slate-200 rounded-[1.25rem] text-slate-800 text-base font-medium focus:outline-none focus:ring-4 focus:ring-red-500/20 focus:border-red-400 transition-all shadow-sm hover:border-red-300 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-red-50 file:text-red-600 hover:file:bg-red-100">
                    <p class="text-xs font-medium text-slate-400 mt-2 ml-2">Format gambar: JPG, PNG, WEBP (Maks: 10MB).</p>
                </div>
            </div>

            <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200/60 rounded-2xl p-5 flex items-start gap-4 shadow-sm">
                <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-amber-900 mb-0.5">Perhatian Khusus</h4>
                    <p class="text-sm text-amber-800 font-medium leading-relaxed">Harap gunakan kalimat yang jelas dan tidak mengandung unsur provokatif. Pengaduan palsu dapat ditindaklanjuti secara administratif.</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <button type="submit" class="w-full sm:w-2/3 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white font-bold py-4 rounded-[1.25rem] transition-all shadow-lg shadow-rose-500/30 hover:-translate-y-1 text-base flex items-center justify-center gap-2 group">
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1 group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Laporan
                </button>
                <a href="{{ route('warga.pengaduan.index') }}" class="w-full sm:w-1/3 flex items-center justify-center bg-white border-2 border-slate-200 hover:bg-slate-50 hover:border-slate-300 text-slate-700 font-bold py-4 rounded-[1.25rem] transition-all text-base shadow-sm hover:shadow">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
