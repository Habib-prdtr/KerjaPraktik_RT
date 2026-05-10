@extends('layouts.warga')

@section('title', 'Ajukan Surat Baru')
@section('page-subtitle', 'Pengajuan Surat')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">
    {{-- Header --}}
    <div class="glass-panel rounded-[2rem] p-6 lg:p-8 flex items-center gap-4 relative overflow-hidden">
        <div class="absolute -right-10 -top-10 w-32 h-32 bg-amber-100 rounded-full blur-3xl opacity-60"></div>
        <a href="{{ route('warga.surat.index') }}" class="w-12 h-12 rounded-[1rem] bg-white border border-slate-200 hover:bg-slate-50 flex items-center justify-center transition-all shadow-sm hover:shadow group shrink-0 relative z-10">
            <svg class="w-6 h-6 text-slate-600 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div class="relative z-10">
            <h1 class="text-xl lg:text-2xl font-black text-slate-800">Ajukan Surat Baru</h1>
            <p class="text-sm font-medium text-slate-500 mt-1">Lengkapi formulir untuk mengajukan surat pengantar</p>
        </div>
    </div>

    <div class="glass-panel rounded-[2rem] p-6 lg:p-8 relative overflow-hidden">
        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-orange-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>

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

        <form method="POST" action="{{ route('warga.surat.store') }}" class="space-y-6 relative z-10">
            @csrf

            {{-- Jenis Surat --}}
            <div class="space-y-2">
                <label for="jenis_surat" class="block text-sm font-black text-slate-700 uppercase tracking-widest">Jenis Surat <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select id="jenis_surat" name="jenis_surat" required
                        class="w-full px-5 py-4 bg-white border border-slate-200 rounded-[1.25rem] text-slate-800 text-base font-bold focus:outline-none focus:ring-4 focus:ring-amber-500/20 focus:border-amber-400 transition-all appearance-none shadow-sm hover:border-amber-300">
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
                    <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>

            {{-- Keperluan --}}
            <div class="space-y-2">
                <label for="keperluan" class="block text-sm font-black text-slate-700 uppercase tracking-widest">Keperluan / Tujuan <span class="text-red-500">*</span></label>
                <textarea id="keperluan" name="keperluan" rows="5" required
                    placeholder="Jelaskan keperluan pengajuan surat ini secara singkat dan jelas..."
                    class="w-full px-5 py-4 bg-white border border-slate-200 rounded-[1.25rem] text-slate-800 text-base font-medium focus:outline-none focus:ring-4 focus:ring-amber-500/20 focus:border-amber-400 transition-all resize-none shadow-sm hover:border-amber-300 placeholder-slate-400/70">{{ old('keperluan') }}</textarea>
            </div>

            {{-- Info --}}
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200/60 rounded-2xl p-5 flex items-start gap-4 shadow-sm">
                <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-amber-900 mb-0.5">Informasi Proses</h4>
                    <p class="text-sm text-amber-800 font-medium leading-relaxed">Pengajuan surat akan diverifikasi oleh Admin RT. Notifikasi status dapat Anda pantau di halaman utama Surat Saya.</p>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <button type="submit" class="w-full sm:w-2/3 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-bold py-4 rounded-[1.25rem] transition-all shadow-lg shadow-orange-500/30 hover:-translate-y-1 text-base flex items-center justify-center gap-2 group">
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1 group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Pengajuan
                </button>
                <a href="{{ route('warga.surat.index') }}" class="w-full sm:w-1/3 flex items-center justify-center bg-white border-2 border-slate-200 hover:bg-slate-50 hover:border-slate-300 text-slate-700 font-bold py-4 rounded-[1.25rem] transition-all text-base shadow-sm hover:shadow">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
