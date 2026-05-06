@extends('layouts.app')

@section('title', 'Edit Kartu Keluarga — Admin RT 08')
@section('page-title', 'Edit Kartu Keluarga')
@section('page-subtitle', 'Perbarui data kartu keluarga')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-slate-800">Edit Data Kartu Keluarga</h2>
                <p class="text-xs text-slate-400 mt-0.5">No. KK: <span class="font-mono">{{ $kartuKeluarga->no_kk }}</span></p>
            </div>
            <a href="{{ route('admin.kartu-keluarga.show', $kartuKeluarga) }}"
               class="text-sm text-blue-600 hover:underline">← Detail</a>
        </div>

        <form method="POST" action="{{ route('admin.kartu-keluarga.update', $kartuKeluarga) }}" class="px-6 py-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- No. KK --}}
            <div>
                <label for="no_kk" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Nomor KK <span class="text-red-500">*</span>
                </label>
                <input type="text" id="no_kk" name="no_kk" value="{{ old('no_kk', $kartuKeluarga->no_kk) }}"
                       maxlength="16"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('no_kk') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('no_kk')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kepala Keluarga --}}
            <div>
                <label for="kepala_keluarga" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Nama Kepala Keluarga <span class="text-red-500">*</span>
                </label>
                <input type="text" id="kepala_keluarga" name="kepala_keluarga" value="{{ old('kepala_keluarga', $kartuKeluarga->kepala_keluarga) }}"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('kepala_keluarga') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('kepala_keluarga')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label for="alamat" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Alamat <span class="text-red-500">*</span>
                </label>
                <textarea id="alamat" name="alamat" rows="3"
                          class="w-full px-4 py-2.5 text-sm rounded-xl border @error('alamat') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('alamat', $kartuKeluarga->alamat) }}</textarea>
                @error('alamat')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- RT & RW --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="rt" class="block text-sm font-medium text-slate-700 mb-1.5">RT <span class="text-red-500">*</span></label>
                    <input type="text" id="rt" name="rt" value="{{ old('rt', $kartuKeluarga->rt) }}"
                           class="w-full px-4 py-2.5 text-sm rounded-xl border @error('rt') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('rt')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="rw" class="block text-sm font-medium text-slate-700 mb-1.5">RW <span class="text-red-500">*</span></label>
                    <input type="text" id="rw" name="rw" value="{{ old('rw', $kartuKeluarga->rw) }}"
                           class="w-full px-4 py-2.5 text-sm rounded-xl border @error('rw') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('rw')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                    Perbarui Data
                </button>
                <a href="{{ route('admin.kartu-keluarga.index') }}"
                   class="px-6 py-2.5 text-sm text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
