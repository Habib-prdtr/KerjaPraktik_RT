@extends('layouts.guest')

@section('title', 'Masuk — Portal Warga RT 08')

@section('content')

<div class="mb-6">
    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mb-2 flex items-center gap-2">Selamat Datang, Tetangga! <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg></h2>
    <p class="text-slate-500 font-semibold text-xs sm:text-sm">Silakan masuk menggunakan akun Bapak/Ibu untuk mengakses seluruh layanan digital RT 08.</p>
</div>

@if($errors->any())
<div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 mb-6 flex items-start gap-3 alert-enter">
    <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center shrink-0 mt-0.5"><svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg></div>
    <div class="flex-1">
        <p class="text-xs font-black text-amber-800 mb-1">Ada sedikit kendala:</p>
        <ul class="list-disc pl-4 space-y-1">
            @foreach($errors->all() as $error)
                <li class="text-xs font-bold text-amber-700">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<form method="POST" action="{{ route('login.post') }}" class="space-y-4" id="login-form">
    @csrf

    {{-- Email --}}
    <div class="group">
        <label for="email" class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Alamat Email Bapak/Ibu</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-slate-400 group-focus-within:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   placeholder="Contoh: nama.lengkap@email.com"
                   class="premium-input w-full pl-12 pr-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-2xl text-slate-850 text-sm font-semibold placeholder-slate-400 focus:bg-white focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all">
        </div>
    </div>

    {{-- Password --}}
    <div class="group">
        <label for="password" class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Kata Sandi (Password)</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-slate-400 group-focus-within:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <input id="password" type="password" name="password" required placeholder="Masukkan kata sandi Anda"
                   class="premium-input w-full pl-12 pr-12 py-3 bg-slate-50 border-2 border-slate-200 rounded-2xl text-slate-850 text-sm font-semibold placeholder-slate-400 focus:bg-white focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all">
            <button type="button" id="toggle-pw" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-emerald-600 transition-colors">
                <svg id="eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Remember me --}}
    <div class="flex items-center justify-between">
        <label class="flex items-center gap-2.5 cursor-pointer group">
            <div class="relative">
                <input type="checkbox" name="remember" id="remember"
                       class="peer w-5 h-5 appearance-none bg-slate-100 border-2 border-slate-300 rounded-lg checked:bg-emerald-600 checked:border-emerald-600 transition-all cursor-pointer">
                <svg class="w-3 h-3 text-white absolute top-1 left-1 opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <span class="text-sm font-semibold text-slate-650">Ingat saya di HP/Komputer ini</span>
        </label>
    </div>

    {{-- CTA Button --}}
    <button type="submit" id="login-btn"
            class="btn-shimmer w-full bg-gradient-to-r from-emerald-600 via-emerald-700 to-teal-700 text-white font-extrabold py-3.5 px-6 rounded-2xl text-sm shadow-lg shadow-emerald-600/30 hover:shadow-emerald-600/55 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 flex items-center justify-center gap-2 group mt-2">
        <span>Masuk ke Beranda Warga</span>
        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
        </svg>
    </button>
</form>

<div class="relative my-6">
    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
    <div class="relative flex justify-center"><span class="bg-white px-4 text-slate-400 font-extrabold uppercase tracking-widest text-[10px]">Belum Punya Akun?</span></div>
</div>

<a href="{{ route('register') }}"
   class="w-full flex items-center justify-center gap-2 bg-white border-2 border-slate-200 text-slate-700 hover:border-emerald-500 hover:bg-emerald-50 hover:text-emerald-800 font-extrabold py-3 px-6 rounded-2xl transition-all text-sm group shadow-sm">
    <svg class="w-5 h-5 text-slate-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
    </svg>
    Daftar Akun Warga Baru
</a>

@endsection

@push('scripts')
<script>
    const pw = document.getElementById('password');
    const btn = document.getElementById('toggle-pw');
    const eye = document.getElementById('eye-open');
    btn.addEventListener('click', () => {
        const isText = pw.type === 'text';
        pw.type = isText ? 'password' : 'text';
        eye.innerHTML = isText
            ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`
            : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
    });

    // Loading state on submit
    document.getElementById('login-form').addEventListener('submit', () => {
        const b = document.getElementById('login-btn');
        b.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg><span>Memverifikasi Masuk...</span>';
        b.disabled = true;
    });
</script>
@endpush
