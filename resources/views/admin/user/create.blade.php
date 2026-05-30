@extends('layouts.app')

@section('title', 'Tambah Pengguna — Admin RT 08')
@section('page-title', 'Tambah Pengguna')
@section('page-subtitle', 'Buat akun pengguna baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Data Akun Pengguna</h2>
        </div>

        <form method="POST" action="{{ route('admin.user.store') }}" class="px-6 py-6 space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       placeholder="Nama pengguna"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('name') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       placeholder="email@contoh.com"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('email') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" placeholder="Min. 6 karakter"
                           class="w-full px-4 py-2.5 text-sm rounded-xl border @error('password') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    @error('password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password <span class="text-red-500">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password"
                           class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-slate-700 mb-1.5">Role <span class="text-red-500">*</span></label>
                <select id="role" name="role"
                        class="w-full sm:w-48 px-4 py-2.5 text-sm rounded-xl border @error('role') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                    <option value="warga" {{ old('role') === 'warga' ? 'selected' : '' }}>Warga</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="warga_id" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Hubungkan ke Warga
                    <span class="text-slate-400 text-xs">(opsional, untuk role warga)</span>
                </label>
                <select id="warga_id" name="warga_id"
                        class="w-full px-4 py-2.5 text-sm rounded-xl border @error('warga_id') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                    <option value="">-- Tidak Terhubung --</option>
                    @foreach($wargaList as $w)
                    <option value="{{ $w->id }}" {{ old('warga_id') == $w->id ? 'selected' : '' }}>
                        {{ $w->nama }} ({{ $w->nik }})
                    </option>
                    @endforeach
                </select>
                <p class="mt-1 text-xs text-slate-400">Hanya warga aktif yang belum memiliki akun yang dapat dipilih.</p>
                @error('warga_id')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-xl hover:bg-emerald-700 transition-colors shadow-sm">
                    Buat Akun
                </button>
                <a href="{{ route('admin.user.index') }}"
                   class="px-6 py-2.5 text-sm text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
