@extends('layouts.app')

@section('title', 'Tambah Warga — Admin RT 08')
@section('page-title', 'Tambah Data Warga')
@section('page-subtitle', 'Daftarkan warga baru ke sistem')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Data Pribadi Warga</h2>
            <p class="text-xs text-slate-400 mt-0.5">Pastikan NIK 16 digit sesuai KTP</p>
        </div>

        <form method="POST" action="{{ route('admin.warga.store') }}" class="px-6 py-6 space-y-5">
            @csrf

            {{-- KK --}}
            <div>
                <label for="kartu_keluarga_id" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Kartu Keluarga <span class="text-red-500">*</span>
                </label>
                <select id="kartu_keluarga_id" name="kartu_keluarga_id"
                        class="w-full px-4 py-2.5 text-sm rounded-xl border @error('kartu_keluarga_id') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="">-- Pilih Kartu Keluarga --</option>
                    @foreach($kartuKeluarga as $kk)
                    <option value="{{ $kk->id }}" {{ old('kartu_keluarga_id') == $kk->id ? 'selected' : '' }}>
                        {{ $kk->kepala_keluarga }} ({{ $kk->no_kk }})
                    </option>
                    @endforeach
                </select>
                @error('kartu_keluarga_id')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- NIK --}}
            <div>
                <label for="nik" class="block text-sm font-medium text-slate-700 mb-1.5">NIK <span class="text-red-500">*</span></label>
                <input type="text" id="nik" name="nik" value="{{ old('nik') }}"
                       maxlength="16" placeholder="16 digit NIK"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('nik') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nik')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            {{-- Nama --}}
            <div>
                <label for="nama" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                       placeholder="Nama lengkap sesuai KTP"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('nama') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nama')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            {{-- JK & Tanggal Lahir --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-slate-700 mb-1.5">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select id="jenis_kelamin" name="jenis_kelamin"
                            class="w-full px-4 py-2.5 text-sm rounded-xl border @error('jenis_kelamin') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                           class="w-full px-4 py-2.5 text-sm rounded-xl border @error('tanggal_lahir') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('tanggal_lahir')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Agama & Status Perkawinan --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="agama" class="block text-sm font-medium text-slate-700 mb-1.5">Agama <span class="text-red-500">*</span></label>
                    <select id="agama" name="agama"
                            class="w-full px-4 py-2.5 text-sm rounded-xl border @error('agama') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">-- Pilih --</option>
                        @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agm)
                        <option value="{{ $agm }}" {{ old('agama') === $agm ? 'selected' : '' }}>{{ $agm }}</option>
                        @endforeach
                    </select>
                    @error('agama')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="status_perkawinan" class="block text-sm font-medium text-slate-700 mb-1.5">Status Perkawinan <span class="text-red-500">*</span></label>
                    <select id="status_perkawinan" name="status_perkawinan"
                            class="w-full px-4 py-2.5 text-sm rounded-xl border @error('status_perkawinan') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">-- Pilih --</option>
                        @foreach(['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'] as $sp)
                        <option value="{{ $sp }}" {{ old('status_perkawinan') === $sp ? 'selected' : '' }}>{{ $sp }}</option>
                        @endforeach
                    </select>
                    @error('status_perkawinan')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Pekerjaan --}}
            <div>
                <label for="pekerjaan" class="block text-sm font-medium text-slate-700 mb-1.5">Pekerjaan <span class="text-red-500">*</span></label>
                <input type="text" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}"
                       placeholder="Contoh: Guru, Wiraswasta, Pelajar"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('pekerjaan') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('pekerjaan')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            {{-- Status Warga --}}
            <div>
                <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">Status <span class="text-red-500">*</span></label>
                <select id="status" name="status"
                        class="w-full px-4 py-2.5 text-sm rounded-xl border @error('status') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="aktif" {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="pindah" {{ old('status') === 'pindah' ? 'selected' : '' }}>Pindah</option>
                    <option value="meninggal" {{ old('status') === 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                </select>
                @error('status')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                    Simpan Data
                </button>
                <a href="{{ route('admin.warga.index') }}"
                   class="px-6 py-2.5 text-sm text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
