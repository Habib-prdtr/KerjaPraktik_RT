@extends('layouts.guest')

@section('title', 'Daftar Akun — Portal Warga RT 08')

@section('content')

<div class="mb-3 sm:mb-4">
    <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mb-0.5 sm:mb-1">Buat Akun Warga Baru ✍️</h2>
    <p class="text-slate-500 font-semibold text-[10px] sm:text-xs">Daftar untuk mengakses layanan administrasi RT 08 secara online</p>
</div>

{{-- Info banner --}}
<div class="hidden sm:flex bg-emerald-50 border border-emerald-200 rounded-2xl p-3.5 mb-4 items-start gap-2.5">
    <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center shrink-0 mt-0.5 text-xs">💡</div>
    <p class="text-xs font-semibold text-emerald-800 leading-relaxed">
        <strong>Perhatian:</strong> Pastikan NIK Anda terdaftar di RT 08. Silakan cari dan pilih nama lengkap Anda pada daftar pilihan di bawah ini.
    </p>
</div>

@if($errors->any())
<div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 mb-4 flex items-start gap-3 alert-enter">
    <div class="w-7 h-7 rounded-full bg-amber-100 flex items-center justify-center shrink-0 mt-0.5 text-lg">⚠️</div>
    <div class="flex-1">
        <p class="text-xs font-black text-amber-800 mb-1">Ada sedikit kendala saat mendaftar:</p>
        <ul class="list-disc pl-4 space-y-1">
            @foreach($errors->all() as $error)
                <li class="text-xs font-bold text-amber-700">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<form method="POST" action="{{ route('register.post') }}" class="space-y-3" id="register-form">
    @csrf

    {{-- Pilih Warga --}}
    <div class="group">
        <label for="warga_id" class="block text-[11px] sm:text-xs font-bold text-slate-700 mb-1">
            Pilih Nama Warga Anda <span class="text-red-500">*</span>
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-slate-400 group-focus-within:text-emerald-605 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <select id="warga_id" name="warga_id" required
                    class="premium-input w-full pl-10 pr-9 py-2.5 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-800 text-xs font-semibold appearance-none focus:bg-white focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all cursor-pointer">
                <option value="" disabled selected>— Klik di sini untuk mencari nama Anda —</option>
                @foreach($wargaList as $warga)
                    <option value="{{ $warga->id }}" {{ old('warga_id') == $warga->id ? 'selected' : '' }}>
                        {{ $warga->nama }} — NIK: {{ $warga->nik }}
                    </option>
                @endforeach
            </select>
            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </div>
        @if($wargaList->isEmpty())
            <p class="text-xs font-bold text-amber-600 mt-1.5 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                Semua warga sudah memiliki akun. Hubungi pengurus RT jika Anda belum terdaftar.
            </p>
        @endif
    </div>

    {{-- Nama Tampilan --}}
    <div class="group">
        <label for="name" class="block text-[11px] sm:text-xs font-bold text-slate-700 mb-1">
            Nama Tampilan di Aplikasi <span class="text-red-500">*</span>
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-slate-400 group-focus-within:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required
                   placeholder="Contoh: Pak Budi / Ibu Lilik"
                   class="premium-input w-full pl-10 pr-4 py-2.5 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-850 text-xs font-semibold placeholder-slate-400 focus:bg-white focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all">
        </div>
    </div>

    {{-- Email --}}
    <div class="group">
        <label for="email" class="block text-[11px] sm:text-xs font-bold text-slate-700 mb-1">
            Alamat Email Bapak/Ibu <span class="text-red-500">*</span>
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-slate-400 group-focus-within:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   placeholder="Contoh: nama.anda@email.com"
                   class="premium-input w-full pl-10 pr-4 py-2.5 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-850 text-xs font-semibold placeholder-slate-400 focus:bg-white focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all">
        </div>
    </div>

    {{-- Password --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div class="group">
            <label for="password" class="block text-[11px] sm:text-xs font-bold text-slate-700 mb-1">
                Kata Sandi <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input id="password" type="password" name="password" required placeholder="Min. 6 karakter"
                       class="premium-input w-full pl-10 pr-3 py-2.5 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-850 text-xs font-semibold placeholder-slate-400 focus:bg-white focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all">
            </div>
        </div>
        <div class="group">
            <label for="password_confirmation" class="block text-[11px] sm:text-xs font-bold text-slate-700 mb-1">
                Ulangi Sandi <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Ketik ulang sandi"
                       class="premium-input w-full pl-10 pr-3 py-2.5 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-850 text-xs font-semibold placeholder-slate-400 focus:bg-white focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all">
            </div>
        </div>
    </div>

    {{-- Submit --}}
    <button type="submit" id="register-btn"
            class="btn-shimmer w-full bg-gradient-to-r from-emerald-600 via-emerald-700 to-teal-700 text-white font-extrabold py-3 px-5 rounded-xl text-xs shadow-lg shadow-emerald-600/30 hover:shadow-emerald-600/50 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 group mt-2">
        <span>Daftar Akun Warga Baru ✍️</span>
        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
        </svg>
    </button>
</form>

<div class="relative my-4">
    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
    <div class="relative flex justify-center"><span class="bg-white px-4 text-slate-400 font-extrabold uppercase tracking-widest text-[9px]">Sudah Punya Akun?</span></div>
</div>

<a href="{{ route('login') }}"
   class="w-full flex items-center justify-center gap-2 bg-white border-2 border-slate-200 text-slate-700 hover:border-emerald-500 hover:bg-emerald-50 hover:text-emerald-800 font-extrabold py-2.5 px-6 rounded-xl transition-all text-sm group shadow-sm">
    <svg class="w-4 h-4 text-slate-400 group-hover:text-emerald-600 group-hover:-translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
    </svg>
    Kembali ke Halaman Masuk
</a>

@endsection

@section('scripts')
<script>
    document.getElementById('register-form').addEventListener('submit', () => {
        const b = document.getElementById('register-btn');
        b.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg><span>Membuat akun...</span>';
        b.disabled = true;
    });
</script>
@endsection
