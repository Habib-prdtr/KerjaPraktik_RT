@extends('layouts.warga')

@section('title', 'Ajukan Surat Baru')
@section('page-subtitle', 'Pengajuan Surat')

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
        <a href="{{ route('warga.surat.index') }}" class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200 hover:bg-slate-100 flex items-center justify-center transition-all shadow-sm hover:shadow group shrink-0 relative z-10">
            <svg class="w-6 h-6 text-slate-600 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div class="relative z-10">
            <h1 class="text-xl lg:text-2xl font-black text-slate-900">Ajukan Surat Baru</h1>
            <p class="text-sm font-medium text-slate-500 mt-1">Lengkapi formulir untuk mengajukan surat pengantar</p>
        </div>
    </div>

    <div class="bento-card p-6 lg:p-8 relative overflow-hidden">

        @if($errors->any())
        <div class="bg-red-50/80 border border-red-200 text-red-700 px-4 py-3 rounded-2xl text-sm mb-6 shadow-sm relative z-10">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 mt-0.5 shrink-0 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                <ul class="space-y-1 font-medium">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('warga.surat.store') }}" class="space-y-6 relative z-10">
            @csrf

            {{-- Jenis Surat --}}
            <div class="group space-y-2">
                <label for="jenis_surat" class="block text-sm font-bold text-slate-700 transition-colors group-focus-within:text-blue-600">Jenis Surat <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select id="jenis_surat" name="jenis_surat" required
                        class="w-full px-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 text-sm font-semibold focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 transition-all duration-300 shadow-sm hover:border-slate-300 appearance-none">
                        <option value="" class="font-medium text-slate-500">-- Pilih Jenis Surat --</option>
                        <option value="Surat Keterangan Domisili" {{ old('jenis_surat')=='Surat Keterangan Domisili'?'selected':'' }}>Surat Keterangan Domisili</option>
                        <option value="Surat Keterangan Tidak Mampu" {{ old('jenis_surat')=='Surat Keterangan Tidak Mampu'?'selected':'' }}>Surat Keterangan Tidak Mampu</option>
                        <option value="Surat Pengantar KTP" {{ old('jenis_surat')=='Surat Pengantar KTP'?'selected':'' }}>Surat Pengantar KTP</option>
                        <option value="Surat Keterangan Usaha" {{ old('jenis_surat')=='Surat Keterangan Usaha'?'selected':'' }}>Surat Keterangan Usaha</option>
                        <option value="Surat Keterangan Kelahiran" {{ old('jenis_surat')=='Surat Keterangan Kelahiran'?'selected':'' }}>Surat Keterangan Kelahiran</option>
                        <option value="Surat Keterangan Kematian" {{ old('jenis_surat')=='Surat Keterangan Kematian'?'selected':'' }}>Surat Keterangan Kematian</option>
                        <option value="Surat Pengantar SKCK" {{ old('jenis_surat')=='Surat Pengantar SKCK'?'selected':'' }}>Surat Pengantar SKCK</option>
                        <option value="Lainnya" {{ old('jenis_surat')=='Lainnya'?'selected':'' }}>Lainnya</option>
                    </select>
                    <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>

            {{-- Keperluan --}}
            <div class="group space-y-2">
                <label for="keperluan" class="block text-sm font-bold text-slate-700 transition-colors group-focus-within:text-blue-600">Keperluan / Tujuan <span class="text-red-500">*</span></label>
                <textarea id="keperluan" name="keperluan" rows="4" required
                    placeholder="Jelaskan keperluan pengajuan surat ini secara singkat dan jelas..."
                    class="w-full px-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 text-sm font-semibold focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 transition-all duration-300 shadow-sm hover:border-slate-300 placeholder-slate-400 resize-none">{{ old('keperluan') }}</textarea>
            </div>

            {{-- Info --}}
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex items-start gap-4 shadow-sm">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-blue-900 text-sm mb-0.5">Informasi Proses</h4>
                    <p class="text-xs text-blue-800 font-medium leading-relaxed">Pengajuan surat akan diverifikasi oleh Admin RT. Notifikasi status dapat Anda pantau di halaman utama Surat Saya.</p>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <button type="submit" class="w-full sm:w-2/3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-extrabold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:-translate-y-0.5 active:translate-y-0 text-base flex items-center justify-center gap-2 group">
                    Kirim Pengajuan
                    <svg class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </button>
                <a href="{{ route('warga.surat.index') }}" class="w-full sm:w-1/3 flex items-center justify-center bg-white border-2 border-slate-200 text-slate-700 hover:border-blue-400 hover:bg-blue-50 hover:text-blue-700 font-extrabold py-3 px-6 rounded-xl transition-all duration-300 text-sm group shadow-sm hover:shadow-md">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
