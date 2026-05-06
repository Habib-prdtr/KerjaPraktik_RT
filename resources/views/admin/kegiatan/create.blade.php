@extends('layouts.app')

@section('title', 'Tambah Kegiatan — Admin RT 08')
@section('page-title', 'Tambah Kegiatan RT')
@section('page-subtitle', 'Buat agenda kegiatan baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Data Kegiatan RT</h2>
        </div>

        <form method="POST" action="{{ route('admin.kegiatan.store') }}" class="px-6 py-6 space-y-5">
            @csrf

            <div>
                <label for="nama_kegiatan" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Nama Kegiatan <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}"
                       placeholder="Contoh: Gotong Royong Bulanan"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('nama_kegiatan') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nama_kegiatan')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}"
                           class="w-full px-4 py-2.5 text-sm rounded-xl border @error('tanggal') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('tanggal')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Lokasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                           placeholder="Contoh: Balai RW 02"
                           class="w-full px-4 py-2.5 text-sm rounded-xl border @error('lokasi') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('lokasi')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Deskripsi <span class="text-slate-400 text-xs">(opsional)</span>
                </label>
                <textarea id="deskripsi" name="deskripsi" rows="5"
                          placeholder="Keterangan tambahan tentang kegiatan ini…"
                          class="w-full px-4 py-3 text-sm rounded-xl border @error('deskripsi') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                    Simpan Kegiatan
                </button>
                <a href="{{ route('admin.kegiatan.index') }}"
                   class="px-6 py-2.5 text-sm text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
