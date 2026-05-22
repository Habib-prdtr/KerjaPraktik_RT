@extends('layouts.warga')
@section('title', 'Buat Surat Baru — Portal Warga RT 08')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 space-y-5">

    {{-- ====== BACK HEADER ====== --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('warga.surat.index') }}"
           class="w-11 h-11 rounded-2xl bg-white border border-slate-200 hover:border-emerald-300 hover:bg-emerald-50 flex items-center justify-center transition-all shadow-sm group">
            <svg class="w-5 h-5 text-slate-600 group-hover:text-emerald-600 group-hover:-translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 leading-tight">Buat Surat Pengantar Baru</h1>
            <p class="text-xs text-slate-500 font-bold mt-0.5">Silakan isi formulir di bawah ini dengan lengkap</p>
        </div>
    </div>

    {{-- ====== FORM CARD ====== --}}
    <div class="card-premium p-6 md:p-8 bg-white border border-slate-100">

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-6 flex items-start gap-3">
            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center shrink-0 text-red-600 font-bold">⚠️</div>
            <ul class="space-y-1">
                @foreach($errors->all() as $e)
                <li class="text-xs font-bold text-red-700">{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('warga.surat.store') }}" class="space-y-6">
            @csrf

            {{-- Jenis Surat --}}
            <div class="group">
                <label for="jenis_surat" class="block text-sm font-extrabold text-slate-700 mb-2">
                    Pilih Jenis Surat <span class="text-red-500">*</span>
                </label>
                <p class="text-xs text-slate-400 font-semibold mb-2">Silakan pilih surat keterangan yang Bapak/Ibu perlukan</p>
                <div class="relative">
                    <select id="jenis_surat" name="jenis_surat" required
                            class="w-full px-4 py-3.5 bg-slate-50 border-2 border-slate-200 rounded-2xl text-slate-800 text-sm font-bold appearance-none focus:bg-white focus:outline-none focus:border-emerald-600 transition-all cursor-pointer">
                        <option value="">— Silakan Klik untuk Memilih Jenis Surat —</option>
                        @foreach([
                            'Surat Keterangan Domisili',
                            'Surat Keterangan Tidak Mampu',
                            'Surat Pengantar KTP',
                            'Surat Keterangan Usaha',
                            'Surat Keterangan Kelahiran',
                            'Surat Keterangan Kematian',
                            'Surat Pengantar SKCK',
                            'Lainnya',
                        ] as $jenis)
                        <option value="{{ $jenis }}" {{ old('jenis_surat') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>

            {{-- Keperluan --}}
            <div class="group">
                <label for="keperluan" class="block text-sm font-extrabold text-slate-700 mb-1.5">
                    Keperluan / Tujuan Pembuatan Surat <span class="text-red-500">*</span>
                </label>
                <p class="text-xs text-slate-400 font-semibold mb-2">Tuliskan tujuan surat ini digunakan agar mempermudah Pak RT menulis isi surat pengantar</p>
                <textarea id="keperluan" name="keperluan" rows="4" required
                          placeholder="Contoh pengisian: Untuk mengajukan beasiswa sekolah anak, atau syarat melamar pekerjaan baru."
                          class="w-full px-4 py-3.5 bg-slate-50 border-2 border-slate-200 rounded-2xl text-slate-800 text-sm font-bold focus:bg-white focus:outline-none focus:border-emerald-600 transition-all resize-none placeholder-slate-400">{{ old('keperluan') }}</textarea>
            </div>

            {{-- Info banner --}}
            <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-4 flex items-start gap-3.5">
                <div class="w-9 h-9 rounded-xl bg-emerald-100 border border-emerald-200 flex items-center justify-center shrink-0 text-xl shadow-sm">ℹ️</div>
                <div>
                    <p class="text-sm font-extrabold text-emerald-950 mb-0.5">Informasi Pemrosesan</p>
                    <p class="text-xs text-emerald-800 font-semibold leading-relaxed">
                        Setelah menekan tombol kirim, data Bapak/Ibu akan langsung terkirim ke handphone pengurus RT. Mohon pantau status pengajuan secara berkala.
                    </p>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-extrabold py-4 px-6 rounded-2xl shadow-lg shadow-emerald-500/25 hover:-translate-y-0.5 transition-all text-sm flex items-center justify-center gap-2 group">
                    <svg class="w-5 h-5 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Pengajuan Surat
                </button>
                <a href="{{ route('warga.surat.index') }}"
                   class="sm:w-auto flex items-center justify-center bg-white border-2 border-slate-200 text-slate-700 hover:border-red-300 hover:text-red-600 font-bold py-4 px-6 rounded-2xl transition-all text-sm">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
