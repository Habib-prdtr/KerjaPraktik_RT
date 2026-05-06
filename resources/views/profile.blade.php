@extends('layouts.app')

@section('title', 'Profil Saya — RT 08 RW 02')
@section('page-title', 'Profil Saya')
@section('page-subtitle', 'Kelola informasi akun Anda')

@section('content')
<div class="max-w-3xl mx-auto space-y-5">

    {{-- Info Akun --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Informasi Akun</h2>
        </div>

        <div class="px-6 py-5">
            <div class="flex items-center gap-5 mb-6">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shrink-0">
                    <span class="text-white text-2xl font-bold">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-800">{{ $user->name }}</h3>
                    <p class="text-slate-500 text-sm mt-0.5">{{ $user->email }}</p>
                    @php $roleColor = $user->role === 'admin' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600'; @endphp
                    <span class="inline-block mt-1 text-xs px-2.5 py-0.5 rounded-full font-medium capitalize {{ $roleColor }}">{{ $user->role }}</span>
                </div>
            </div>

            @if($user->warga)
            <div class="bg-slate-50 rounded-xl p-4 grid grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">NIK</p>
                    <p class="mt-1 font-mono text-slate-700">{{ $user->warga->nik }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Nama Warga</p>
                    <p class="mt-1 font-medium text-slate-800">{{ $user->warga->nama }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Status</p>
                    @php
                        $sc = match($user->warga->status) {
                            'aktif'     => 'bg-green-100 text-green-700',
                            'pindah'    => 'bg-amber-100 text-amber-700',
                            'meninggal' => 'bg-slate-100 text-slate-500',
                            default     => 'bg-slate-100 text-slate-500',
                        };
                    @endphp
                    <span class="inline-block mt-1 text-xs px-2 py-0.5 rounded-full font-medium capitalize {{ $sc }}">{{ $user->warga->status }}</span>
                </div>
                @if($user->warga->kartuKeluarga)
                <div class="col-span-2 lg:col-span-3">
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Kartu Keluarga</p>
                    <p class="mt-1 text-slate-700">{{ $user->warga->kartuKeluarga->kepala_keluarga }} — No. {{ $user->warga->kartuKeluarga->no_kk }}</p>
                </div>
                @endif
            </div>
            @else
            <div class="bg-amber-50 border border-amber-100 rounded-xl px-4 py-3 text-sm text-amber-700">
                Akun Anda belum terhubung ke data warga. Hubungi admin untuk menghubungkannya.
            </div>
            @endif
        </div>
    </div>

    {{-- Form Update Profil --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Perbarui Profil</h2>
            <p class="text-xs text-slate-400 mt-0.5">Kosongkan kolom password jika tidak ingin menggantinya</p>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" class="px-6 py-6 space-y-5">
            @csrf
            @method('PATCH')

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
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Ganti Password (Opsional)</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password Baru</label>
                        <input type="password" id="password" name="password"
                               placeholder="Min. 6 karakter"
                               class="w-full px-4 py-2.5 text-sm rounded-xl border @error('password') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               placeholder="Ulangi password baru"
                               class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
