@extends('layouts.guest')

@section('title', 'Daftar Akun Warga')

@section('content')

    <div class="mb-6 text-center lg:text-left">
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Daftar Akun</h2>
        <p class="text-slate-500 font-medium text-base">Buat akun untuk mengakses layanan RT</p>
    </div>

    {{-- Info Box --}}
    <div class="bg-blue-50/80 backdrop-blur border border-blue-200 rounded-xl px-4 py-3 mb-6 flex items-start gap-2 shadow-sm">
        <div class="bg-blue-100 rounded-full p-1.5 shrink-0">
            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
        </div>
        <p class="text-[13px] font-semibold text-blue-800 leading-relaxed">
            Pastikan NIK Anda terdaftar di RT 08. Pilih nama Anda di bawah.
        </p>
    </div>

    @if($errors->any())
        <div class="bg-red-50/80 backdrop-blur border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6 shadow-sm">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 mt-0.5 shrink-0 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <ul class="space-y-1 font-medium">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
        @csrf

        {{-- Pilih Data Warga --}}
        <div class="group">
            <label for="warga_id" class="block text-sm font-bold text-slate-700 mb-2 transition-colors group-focus-within:text-blue-600">
                Nama Warga <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <select id="warga_id" name="warga_id" required
                        class="w-full pl-11 pr-10 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 text-sm font-semibold appearance-none
                               focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 transition-all duration-300 shadow-sm hover:border-slate-300 cursor-pointer">
                    <option value="" disabled selected>-- Pilih Nama Warga --</option>
                    @foreach($wargaList as $warga)
                        <option value="{{ $warga->id }}" {{ old('warga_id') == $warga->id ? 'selected' : '' }}>
                            {{ $warga->nama }} — NIK: {{ $warga->nik }}
                        </option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
            @if($wargaList->isEmpty())
                <p class="text-sm font-semibold text-amber-600 mt-2 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    Semua warga sudah memiliki akun. Hubungi admin.
                </p>
            @endif
        </div>

        {{-- Nama Tampilan --}}
        <div class="group">
            <label for="name" class="block text-sm font-bold text-slate-700 mb-2 transition-colors group-focus-within:text-blue-600">
                Nama Tampilan <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="Nama lengkap Anda"
                       class="w-full pl-11 pr-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 text-sm font-semibold placeholder-slate-400
                              focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 transition-all duration-300 shadow-sm hover:border-slate-300">
            </div>
        </div>

        {{-- Email --}}
        <div class="group">
            <label for="email" class="block text-sm font-bold text-slate-700 mb-2 transition-colors group-focus-within:text-blue-600">
                Alamat Email <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="contoh@email.com"
                       class="w-full pl-11 pr-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 text-sm font-semibold placeholder-slate-400
                              focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 transition-all duration-300 shadow-sm hover:border-slate-300">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Password --}}
            <div class="group">
                <label for="password" class="block text-sm font-bold text-slate-700 mb-2 transition-colors group-focus-within:text-blue-600">
                    Password <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input id="password" type="password" name="password" required placeholder="Min 6 char"
                           class="w-full pl-11 pr-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 text-sm font-semibold placeholder-slate-400
                                  focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 transition-all duration-300 shadow-sm hover:border-slate-300">
                </div>
            </div>

            {{-- Konfirmasi Password --}}
            <div class="group">
                <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2 transition-colors group-focus-within:text-blue-600">
                    Ulangi Password <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Ulangi password"
                           class="w-full pl-11 pr-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 text-sm font-semibold placeholder-slate-400
                                  focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 transition-all duration-300 shadow-sm hover:border-slate-300">
                </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-extrabold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:-translate-y-0.5 active:translate-y-0 text-base mt-4 flex justify-center items-center gap-2 group">
            <span>Buat Akun Saya</span>
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </form>

    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center"><div class="w-full border-t-2 border-slate-100"></div></div>
        <div class="relative flex justify-center text-sm"><span class="bg-white px-4 text-slate-400 font-bold uppercase tracking-wider text-[11px]">Atau</span></div>
    </div>

    <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-2 bg-white border-2 border-slate-200 text-slate-700 hover:border-blue-400 hover:bg-blue-50 hover:text-blue-700 font-extrabold py-3 px-6 rounded-xl transition-all duration-300 text-sm group shadow-sm hover:shadow-md">
        <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform text-slate-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
        Kembali ke Login
    </a>

@endsection
