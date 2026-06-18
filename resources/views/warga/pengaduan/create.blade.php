@extends('layouts.warga')
@section('title', 'Buat Laporan Baru — Portal Warga RT 08')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 space-y-5">

    {{-- ====== BACK HEADER ====== --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('warga.pengaduan.index') }}"
           class="w-11 h-11 rounded-2xl bg-white border border-slate-200 hover:border-emerald-300 hover:bg-emerald-50 flex items-center justify-center transition-all shadow-sm group">
            <svg class="w-5 h-5 text-slate-600 group-hover:text-emerald-600 group-hover:-translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 leading-tight">Laporkan Masalah / Usulan</h1>
            <p class="text-xs text-slate-500 font-bold mt-0.5">Sampaikan laporan atau usul perbaikan lingkungan RT</p>
        </div>
    </div>

    {{-- ====== FORM CARD ====== --}}
    <div class="card-premium p-6 md:p-8 bg-white border border-slate-100">

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-6 flex items-start gap-3">
            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center shrink-0 text-red-600 font-bold"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg></div>
            <ul class="space-y-1">
                @foreach($errors->all() as $e)
                <li class="text-xs font-bold text-red-700">{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('warga.pengaduan.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Judul --}}
            <div class="group">
                <label for="judul" class="block text-sm font-extrabold text-slate-700 mb-1.5">
                    Judul Laporan Bapak/Ibu <span class="text-red-500">*</span>
                </label>
                <p class="text-xs text-slate-400 font-semibold mb-2">Tuliskan masalah singkat yang dialami</p>
                <input id="judul" type="text" name="judul" value="{{ old('judul') }}" required
                       placeholder="Contoh: Saluran air tersumbat sampah di dekat pos ronda"
                       class="w-full px-4 py-3.5 bg-slate-50 border-2 border-slate-200 rounded-2xl text-slate-800 text-sm font-bold focus:bg-white focus:outline-none focus:border-emerald-600 transition-all placeholder-slate-400">
            </div>

            {{-- Isi --}}
            <div class="group">
                <label for="isi" class="block text-sm font-extrabold text-slate-700 mb-1.5">
                    Detail Kejadian / Usulan Lengkap <span class="text-red-500">*</span>
                </label>
                <p class="text-xs text-slate-400 font-semibold mb-2">Jelaskan lokasi kejadian dan kendala secara detail agar Pak RT mudah memahaminya</p>
                <textarea id="isi" name="isi" rows="5" required
                          placeholder="Contoh: Sejak hujan lebat kemarin sore, saluran air di depan rumah No. 12 tersumbat sampah plastik sehingga air meluap ke jalan. Mohon kiranya bisa diadakan kerja bakti pembersihan."
                          class="w-full px-4 py-3.5 bg-slate-50 border-2 border-slate-200 rounded-2xl text-slate-800 text-sm font-bold focus:bg-white focus:outline-none focus:border-emerald-600 transition-all resize-none placeholder-slate-400">{{ old('isi') }}</textarea>
            </div>

            {{-- Foto --}}
            <div class="group">
                <label for="foto" class="block text-sm font-extrabold text-slate-700 mb-1.5">
                    Unggah Foto Bukti Kejadian <span class="text-slate-400 font-bold">(Opsional)</span>
                </label>
                <p class="text-xs text-slate-400 font-semibold mb-3">Melampirkan foto akan sangat membantu Pengurus RT memahami kondisi lapangan</p>
                <label for="foto" class="flex flex-col items-center justify-center w-full py-8 px-4 bg-slate-50 border-2 border-dashed border-slate-300 rounded-3xl cursor-pointer hover:border-emerald-500 hover:bg-emerald-50/20 transition-all group">
                    <div class="mb-2 group-hover:scale-110 transition-transform"><svg class="w-10 h-10 inline-block text-slate-400 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                    <p class="text-sm font-extrabold text-slate-600 mb-1">Ambil Foto / Pilih Berkas Foto</p>
                    <p class="text-xs text-slate-400 font-bold">Maksimal ukuran file: 10MB (Format: Gambar)</p>
                    <input id="foto" type="file" name="foto" accept="image/*" class="hidden">
                </label>
                <p id="file-name" class="text-xs text-emerald-600 font-extrabold mt-2.5 hidden bg-emerald-50 border border-emerald-100 rounded-xl px-3 py-1.5 w-max"></p>
                <div id="image-preview-container" class="mt-4 hidden">
                    <img id="image-preview" src="" alt="Preview Foto" class="w-full max-w-sm rounded-2xl border-2 border-slate-200 object-cover shadow-sm">
                </div>
            </div>

            {{-- Warning banner --}}
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-start gap-3.5">
                <div class="w-9 h-9 rounded-xl bg-amber-100 border border-amber-200 flex items-center justify-center shrink-0 shadow-sm"><svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg></div>
                <div>
                    <p class="text-sm font-extrabold text-amber-950 mb-0.5">Catatan Penting</p>
                    <p class="text-xs text-amber-800 font-semibold leading-relaxed">
                        Mohon sampaikan aduan secara santun dan sesuai fakta lapangan. Pak RT dan jajaran pengurus akan segera merespons demi kerukunan warga bersama.
                    </p>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-extrabold py-4 px-6 rounded-2xl shadow-lg shadow-emerald-500/25 hover:-translate-y-0.5 transition-all text-sm flex items-center justify-center gap-2 group">
                    <svg class="w-5 h-5 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Laporan / Usulan
                </button>
                <a href="{{ route('warga.pengaduan.index') }}"
                   class="sm:w-auto flex items-center justify-center bg-white border-2 border-slate-200 text-slate-700 hover:border-red-300 hover:text-red-600 font-bold py-4 px-6 rounded-2xl transition-all text-sm">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const fotoInput = document.getElementById('foto');
    const fileName = document.getElementById('file-name');
    const previewContainer = document.getElementById('image-preview-container');
    const imagePreview = document.getElementById('image-preview');

    fotoInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            fileName.innerHTML = '<svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Berhasil Memilih: ' + file.name;
            fileName.classList.remove('hidden');
            
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            fileName.classList.add('hidden');
            previewContainer.classList.add('hidden');
            imagePreview.src = '';
        }
    });
</script>
@endpush
