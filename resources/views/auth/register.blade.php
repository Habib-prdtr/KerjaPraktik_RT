@extends('layouts.guest')

@section('title', 'Daftar Akun Warga')

@section('content')

    {{-- Header Card --}}
    <div class="text-center mb-7">
        <h2 class="text-2xl font-bold text-slate-800">Daftar Akun</h2>
        <p class="text-slate-500 text-sm mt-1">Buat akun untuk mengakses layanan RT</p>
    </div>

    {{-- Info Box --}}
    <div class="bg-blue-50 border border-blue-200 rounded-xl px-4 py-3 mb-6 text-xs text-blue-700 flex items-start gap-2">
        <svg class="w-4 h-4 mt-0.5 shrink-0 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
        </svg>
        <span>Pastikan data NIK Anda sudah terdaftar di RT 08 RW 02. Pilih nama Anda dari daftar warga yang tersedia.</span>
    </div>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-5">
            <div class="flex items-start gap-2">
                <svg class="w-4 h-4 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <ul class="space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Form Register --}}
    <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
        @csrf

        {{-- Pilih Data Warga --}}
        <div>
            <label for="warga_id" class="block text-sm font-medium text-slate-700 mb-1.5">
                Nama Warga <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 pointer-events-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </span>
                <select id="warga_id"
                        name="warga_id"
                        required
                        class="w-full pl-10 pr-4 py-2.5 border rounded-xl text-sm appearance-none
                               {{ $errors->has('warga_id') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                               transition-all duration-200 text-slate-800">
                    <option value="">-- Pilih Nama Warga --</option>
                    @foreach($wargaList as $warga)
                        <option value="{{ $warga->id }}" {{ old('warga_id') == $warga->id ? 'selected' : '' }}>
                            {{ $warga->nama }} — NIK: {{ $warga->nik }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if($wargaList->isEmpty())
                <p class="text-xs text-amber-600 mt-1">Semua warga sudah memiliki akun. Hubungi admin RT.</p>
            @endif
        </div>

        {{-- Nama Tampilan --}}
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">
                Nama Tampilan <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </span>
                <input id="name"
                       type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       placeholder="Nama lengkap Anda"
                       class="w-full pl-10 pr-4 py-2.5 border rounded-xl text-sm
                              {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}
                              focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                              transition-all duration-200 text-slate-800 placeholder-slate-400">
            </div>
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">
                Alamat Email <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </span>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       placeholder="contoh@email.com"
                       class="w-full pl-10 pr-4 py-2.5 border rounded-xl text-sm
                              {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}
                              focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                              transition-all duration-200 text-slate-800 placeholder-slate-400">
            </div>
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">
                Password <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </span>
                <input id="password"
                       type="password"
                       name="password"
                       required
                       placeholder="Minimal 6 karakter"
                       class="w-full pl-10 pr-4 py-2.5 border rounded-xl text-sm
                              {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}
                              focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                              transition-all duration-200 text-slate-800 placeholder-slate-400">
            </div>
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">
                Konfirmasi Password <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </span>
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       required
                       placeholder="Ulangi password Anda"
                       class="w-full pl-10 pr-4 py-2.5 border rounded-xl text-sm
                              border-slate-200 bg-slate-50
                              focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                              transition-all duration-200 text-slate-800 placeholder-slate-400">
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4
                       rounded-xl transition-all duration-200 shadow-lg shadow-blue-500/30
                       hover:shadow-blue-500/50 hover:-translate-y-0.5 active:translate-y-0 text-sm mt-2">
            Buat Akun Saya
        </button>
    </form>

    {{-- Divider --}}
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-slate-200"></div>
        </div>
        <div class="relative flex justify-center text-xs">
            <span class="bg-white px-3 text-slate-400">Sudah punya akun?</span>
        </div>
    </div>

    {{-- Link Login --}}
    <a href="{{ route('login') }}"
       class="w-full flex items-center justify-center gap-2 border border-slate-200 text-slate-600
              hover:border-blue-400 hover:text-blue-600 font-medium py-2.5 px-4 rounded-xl
              transition-all duration-200 text-sm hover:bg-blue-50">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
        </svg>
        Masuk ke Akun Saya
    </a>

@endsection
