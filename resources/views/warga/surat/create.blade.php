@extends('layouts.warga')

@section('title', 'Ajukan Surat Baru')
@section('page-subtitle', 'Pengajuan Surat')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    {{-- Header --}}
    <div class="bg-white border-b border-slate-100 px-4 py-4 flex items-center gap-3">
        <a href="{{ route('warga.surat.index') }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-base font-bold text-slate-800">Ajukan Surat Baru</h1>
            <p class="text-xs text-slate-400">Isi formulir pengajuan surat</p>
        </div>
    </div>

    <div class="px-4 py-5 space-y-4">
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-2xl p-4 text-sm text-red-700">
            <ul class="space-y-1">@foreach($errors->all() as $e)<li class="flex items-start gap-2"><span class="text-red-400 mt-0.5">•</span>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form method="POST" action="{{ route('warga.surat.store') }}" class="space-y-4">
            @csrf

            {{-- Jenis Surat --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 space-y-2">
                <label for="jenis_surat" class="block text-sm font-bold text-slate-700">Jenis Surat <span class="text-red-500">*</span></label>
                <select id="jenis_surat" name="jenis_surat" required
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm font-medium focus:outline-none focus:ring-4 focus:ring-amber-500/15 focus:border-amber-400 transition-all appearance-none">
                    <option value="">-- Pilih Jenis Surat --</option>
                    <option value="Surat Keterangan Domisili" {{ old('jenis_surat')=='Surat Keterangan Domisili'?'selected':'' }}>Surat Keterangan Domisili</option>
                    <option value="Surat Keterangan Tidak Mampu" {{ old('jenis_surat')=='Surat Keterangan Tidak Mampu'?'selected':'' }}>Surat Keterangan Tidak Mampu</option>
                    <option value="Surat Pengantar KTP" {{ old('jenis_surat')=='Surat Pengantar KTP'?'selected':'' }}>Surat Pengantar KTP</option>
                    <option value="Surat Keterangan Usaha" {{ old('jenis_surat')=='Surat Keterangan Usaha'?'selected':'' }}>Surat Keterangan Usaha</option>
                    <option value="Surat Keterangan Kelahiran" {{ old('jenis_surat')=='Surat Keterangan Kelahiran'?'selected':'' }}>Surat Keterangan Kelahiran</option>
                    <option value="Surat Keterangan Kematian" {{ old('jenis_surat')=='Surat Keterangan Kematian'?'selected':'' }}>Surat Keterangan Kematian</option>
                    <option value="Surat Pengantar SKCK" {{ old('jenis_surat')=='Surat Pengantar SKCK'?'selected':'' }}>Surat Pengantar SKCK</option>
                    <option value="Lainnya" {{ old('jenis_surat')=='Lainnya'?'selected':'' }}>Lainnya</option>
                </select>
            </div>

            {{-- Keperluan --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 space-y-2">
                <label for="keperluan" class="block text-sm font-bold text-slate-700">Keperluan / Tujuan <span class="text-red-500">*</span></label>
                <textarea id="keperluan" name="keperluan" rows="5" required
                    placeholder="Jelaskan keperluan pengajuan surat ini..."
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-4 focus:ring-amber-500/15 focus:border-amber-400 transition-all resize-none placeholder-slate-400">{{ old('keperluan') }}</textarea>
            </div>

            {{-- Info --}}
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-start gap-3">
                <span class="text-xl">ℹ️</span>
                <p class="text-xs text-amber-800 font-medium leading-relaxed">Pengajuan surat akan diproses oleh Admin RT. Harap pantau status surat Anda secara berkala.</p>
            </div>

            {{-- Actions --}}
            <div class="space-y-2.5 pt-2">
                <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-amber-500/25 hover:-translate-y-0.5 text-sm flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Pengajuan
                </button>
                <a href="{{ route('warga.surat.index') }}" class="block w-full text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-4 rounded-2xl transition-colors text-sm">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
