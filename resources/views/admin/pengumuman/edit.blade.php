@extends('layouts.app')

@section('title', 'Edit Pengumuman — Admin RT 08')
@section('page-title', 'Edit Pengumuman')
@section('page-subtitle', 'Perbarui konten pengumuman')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">Edit Pengumuman</h2>
            <a href="{{ route('admin.pengumuman.show', $pengumuman) }}" class="text-sm text-emerald-600 hover:underline">← Detail</a>
        </div>

        <form method="POST" action="{{ route('admin.pengumuman.update', $pengumuman) }}" class="px-6 py-6 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="judul" class="block text-sm font-medium text-slate-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $pengumuman->judul) }}"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('judul') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @error('judul')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="tanggal" class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal <span class="text-red-500">*</span></label>
                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $pengumuman->tanggal) }}"
                       class="w-full sm:w-48 px-4 py-2.5 text-sm rounded-xl border @error('tanggal') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @error('tanggal')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="isi" class="block text-sm font-medium text-slate-700 mb-1.5">Isi Pengumuman <span class="text-red-500">*</span></label>
                <textarea id="isi" name="isi" rows="8"
                          class="w-full px-4 py-3 text-sm rounded-xl border @error('isi') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500 resize-none leading-relaxed">{{ old('isi', $pengumuman->isi) }}</textarea>
                @error('isi')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-xl hover:bg-emerald-700 transition-colors shadow-sm">
                    Perbarui
                </button>
                <a href="{{ route('admin.pengumuman.index') }}"
                   class="px-6 py-2.5 text-sm text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
