@extends('layouts.warga')

@section('title', 'Buat Pengaduan')
@section('page-subtitle', 'Form Pengaduan')

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
    {{-- Header --}}
    <div class="bento-card p-6 lg:p-8 flex items-center gap-4 relative overflow-hidden">
        <a href="{{ route('warga.pengaduan.index') }}" class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200 hover:bg-slate-100 flex items-center justify-center transition-all shadow-sm hover:shadow group shrink-0 relative z-10">
            <svg class="w-6 h-6 text-slate-600 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div class="relative z-10">
            <h1 class="text-xl lg:text-2xl font-black text-slate-900">Buat Pengaduan Baru</h1>
            <p class="text-sm font-medium text-slate-500 mt-1">Sampaikan keluhan dan laporan untuk lingkungan RT</p>
        </div>
    </div>

    <div class="bento-card p-6 lg:p-8 relative overflow-hidden">

        @if($errors->any())
        <div class="bg-red-50/80 border border-red-200 text-red-700 px-4 py-3 rounded-2xl text-sm mb-6 shadow-sm relative z-10">
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

            <div class="group space-y-2">
                <label for="judul" class="block text-sm font-bold text-slate-700 transition-colors group-focus-within:text-blue-600">Judul Laporan <span class="text-red-500">*</span></label>
                <input id="judul" type="text" name="judul" value="{{ old('judul') }}" required
                    placeholder="Contoh: Lampu jalan depan RT mati 3 hari"
                    class="w-full px-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 text-sm font-semibold focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 transition-all duration-300 shadow-sm hover:border-slate-300 placeholder-slate-400">
            </div>

            <div class="group space-y-2">
                <label for="isi" class="block text-sm font-bold text-slate-700 transition-colors group-focus-within:text-blue-600">Detail Masalah <span class="text-red-500">*</span></label>
                <textarea id="isi" name="isi" rows="5" required
                    placeholder="Jelaskan masalah secara mendetail. Sertakan lokasi kejadian, waktu pengamatan, atau pihak yang terlibat..."
                    class="w-full px-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 text-sm font-semibold focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 transition-all duration-300 shadow-sm hover:border-slate-300 resize-none placeholder-slate-400">{{ old('isi') }}</textarea>
            </div>

            <div class="group space-y-2">
                <label for="foto" class="block text-sm font-bold text-slate-700 transition-colors group-focus-within:text-blue-600">Foto Lampiran (Opsional)</label>
                <div class="relative">
                    <input id="foto" type="file" name="foto" accept="image/*"
                        class="w-full px-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 text-sm font-semibold focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 transition-all shadow-sm hover:border-slate-300 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
                    <p class="text-xs font-medium text-slate-400 mt-2 ml-1">Format gambar: JPG, PNG, WEBP (Maks: 10MB).</p>
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex items-start gap-4 shadow-sm">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-blue-900 text-sm mb-0.5">Perhatian Khusus</h4>
                    <p class="text-xs text-blue-800 font-medium leading-relaxed">Harap gunakan kalimat yang jelas dan tidak mengandung unsur provokatif. Pengaduan palsu dapat ditindaklanjuti secara administratif.</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <button type="submit" class="w-full sm:w-2/3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-extrabold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:-translate-y-0.5 active:translate-y-0 text-base flex items-center justify-center gap-2 group">
                    <svg class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Laporan
                </button>
                <a href="{{ route('warga.pengaduan.index') }}" class="w-full sm:w-1/3 flex items-center justify-center bg-white border-2 border-slate-200 text-slate-700 hover:border-blue-400 hover:bg-blue-50 hover:text-blue-700 font-extrabold py-3 px-6 rounded-xl transition-all duration-300 text-sm group shadow-sm hover:shadow-md">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
