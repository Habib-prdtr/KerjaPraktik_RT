@extends('layouts.app')

@section('title', 'Tambah Kartu Keluarga — Admin RT 08')
@section('page-title', 'Tambah Kartu Keluarga')
@section('page-subtitle', 'Daftarkan kartu keluarga baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Data Kartu Keluarga</h2>
            <p class="text-xs text-slate-400 mt-0.5">Isi semua kolom yang wajib diisi</p>
        </div>

        <form method="POST" action="{{ route('admin.kartu-keluarga.store') }}" class="px-6 py-6 space-y-5">
            @csrf

            {{-- No. KK --}}
            <div>
                <label for="no_kk" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Nomor KK <span class="text-red-500">*</span>
                </label>
                <input type="text" id="no_kk" name="no_kk" value="{{ old('no_kk') }}"
                       maxlength="16" placeholder="16 digit nomor kartu keluarga"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('no_kk') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @error('no_kk')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kepala Keluarga --}}
            <div>
                <label for="kepala_keluarga" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Nama Kepala Keluarga <span class="text-red-500">*</span>
                </label>
                <input type="text" id="kepala_keluarga" name="kepala_keluarga" value="{{ old('kepala_keluarga') }}"
                       placeholder="Nama lengkap kepala keluarga"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('kepala_keluarga') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @error('kepala_keluarga')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label for="alamat" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Alamat <span class="text-red-500">*</span>
                </label>
                <textarea id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap"
                          class="w-full px-4 py-2.5 text-sm rounded-xl border @error('alamat') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500 resize-none">{{ old('alamat') }}</textarea>
                @error('alamat')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <hr class="border-slate-100 my-6">

            <div class="bg-slate-50 -mx-6 px-6 py-4 border-y border-slate-100">
                <h3 class="font-semibold text-slate-800 text-sm">Data Kepala Keluarga (Sebagai Warga)</h3>
                <p class="text-xs text-slate-400 mt-0.5">Kepala keluarga akan otomatis terdaftar sebagai warga pertama di KK ini</p>
            </div>

            {{-- NIK --}}
            <div>
                <label for="nik" class="block text-sm font-medium text-slate-700 mb-1.5">NIK <span class="text-red-500">*</span></label>
                <input type="text" id="nik" name="nik" value="{{ old('nik') }}"
                       maxlength="16" placeholder="16 digit NIK kepala keluarga"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('nik') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @error('nik')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            {{-- JK & Tanggal Lahir --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-slate-700 mb-1.5">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select id="jenis_kelamin" name="jenis_kelamin"
                            class="w-full px-4 py-2.5 text-sm rounded-xl border @error('jenis_kelamin') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                           class="w-full px-4 py-2.5 text-sm rounded-xl border @error('tanggal_lahir') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    @error('tanggal_lahir')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Agama & Status Perkawinan --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="agama" class="block text-sm font-medium text-slate-700 mb-1.5">Agama <span class="text-red-500">*</span></label>
                    <select id="agama" name="agama"
                            class="w-full px-4 py-2.5 text-sm rounded-xl border @error('agama') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
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
                            class="w-full px-4 py-2.5 text-sm rounded-xl border @error('status_perkawinan') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
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
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('pekerjaan') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @error('pekerjaan')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            {{-- Status Warga --}}
            <div>
                <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">Status Warga <span class="text-red-500">*</span></label>
                <select id="status" name="status"
                        class="w-full px-4 py-2.5 text-sm rounded-xl border @error('status') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                    <option value="aktif" {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="pindah" {{ old('status') === 'pindah' ? 'selected' : '' }}>Pindah</option>
                    <option value="meninggal" {{ old('status') === 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                </select>
                @error('status')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            {{-- RT & RW (Otomatis Set RT 08 RW 02) --}}
            <input type="hidden" name="rt" value="08">
            <input type="hidden" name="rw" value="02">

            {{-- Actions --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-xl hover:bg-emerald-700 transition-colors shadow-sm">
                    Simpan Data
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
