@extends('layouts.app')

@section('title', 'Edit Pengguna — Admin RT 08')
@section('page-title', 'Edit Pengguna')
@section('page-subtitle', 'Perbarui data akun pengguna')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-slate-800">Edit: {{ $user->name }}</h2>
                <p class="text-xs text-slate-400 mt-0.5">{{ $user->email }}</p>
            </div>
            <a href="{{ route('admin.user.show', $user) }}" class="text-sm text-blue-600 hover:underline">← Detail</a>
        </div>

        <form method="POST" action="{{ route('admin.user.update', $user) }}" class="px-6 py-6 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('name') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border @error('email') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="border border-dashed border-slate-200 rounded-xl p-4 space-y-4">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Reset Password (Opsional)</p>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password Baru</label>
                        <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ganti"
                               class="w-full px-4 py-2.5 text-sm rounded-xl border @error('password') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru"
                               class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-slate-700 mb-1.5">Role <span class="text-red-500">*</span></label>
                <select id="role" name="role"
                        class="w-full sm:w-48 px-4 py-2.5 text-sm rounded-xl border @error('role') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="warga" {{ old('role', $user->role) === 'warga' ? 'selected' : '' }}>Warga</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="warga_id" class="block text-sm font-medium text-slate-700 mb-1.5">Terhubung ke Warga</label>
                <select id="warga_id" name="warga_id"
                        class="w-full px-4 py-2.5 text-sm rounded-xl border @error('warga_id') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="">-- Tidak Terhubung --</option>
                    @foreach($wargaList as $w)
                    <option value="{{ $w->id }}" {{ old('warga_id', $user->warga_id) == $w->id ? 'selected' : '' }}>
                        {{ $w->nama }} ({{ $w->nik }})
                    </option>
                    @endforeach
                </select>
                @error('warga_id')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                    Perbarui Akun
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
