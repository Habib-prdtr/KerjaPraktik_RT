@extends(Auth::user()->role === 'admin' ? 'layouts.app' : 'layouts.warga')

@section('title', 'Profil Saya — Portal Warga RT 08')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 space-y-5 pb-8">

    {{-- ====== Profile Hero Card ====== --}}
    <div class="card-premium overflow-hidden">
        {{-- Gradient header --}}
        <div class="h-32 bg-gradient-to-br from-teal-800 via-emerald-800 to-green-700 relative overflow-hidden">
            <div class="absolute inset-0" style="background-image: linear-gradient(rgba(255,255,255,0.06) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.06) 1px, transparent 1px); background-size: 20px 20px;"></div>
            <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -translate-y-1/3 translate-x-1/4 blur-2xl pointer-events-none"></div>
        </div>

        <div class="px-7 pb-7 -mt-12 relative">
            {{-- Avatar --}}
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-xl shadow-emerald-500/20 border-4 border-white mb-4">
                <span class="text-white text-2xl font-black">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-black text-slate-900">{{ $user->name }}</h2>
                    <p class="text-slate-500 font-medium text-sm mt-0.5">{{ $user->email }}</p>
                    <div class="mt-2 flex items-center gap-2 flex-wrap">
                        @php
                            $roleColor = $user->role === 'admin'
                                ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md shadow-amber-500/25'
                                : 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-500/25';
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-black uppercase tracking-wider {{ $roleColor }}">
                            {!! $user->role === 'admin' ? '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg> Admin' : '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg> Warga' !!}
                        </span>
                        @if($user->warga)
                        <span class="inline-flex items-center gap-1 px-3.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Terverifikasi Aktif
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Warga data --}}
            @if($user->warga)
            <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                <div class="bg-emerald-50/50 border border-emerald-100 rounded-2xl p-4">
                    <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">NIK Anda</p>
                    <p class="font-mono text-sm font-bold text-slate-800">{{ $user->warga->nik }}</p>
                </div>
                <div class="bg-teal-50/50 border border-teal-100 rounded-2xl p-4">
                    <p class="text-[10px] font-black text-teal-600 uppercase tracking-widest mb-1">Nama Sesuai KTP</p>
                    <p class="text-sm font-bold text-slate-800 truncate">{{ $user->warga->nama }}</p>
                </div>
                <div class="bg-amber-50/40 border border-amber-100 rounded-2xl p-4">
                    <p class="text-[10px] font-black text-amber-600 uppercase tracking-widest mb-1">Status Kependudukan</p>
                    @php
                        $statusData = match($user->warga->status) {
                            'aktif'     => ['cls' => 'text-emerald-700 font-black', 'emoji' => '<svg class="w-4 h-4 inline-block -mt-0.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'],
                            'pindah'    => ['cls' => 'text-amber-700 font-black', 'emoji' => '<svg class="w-4 h-4 inline-block -mt-0.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>'],
                            'meninggal' => ['cls' => 'text-slate-500 font-black', 'emoji' => '<svg class="w-4 h-4 inline-block -mt-0.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>'],
                            default     => ['cls' => 'text-slate-600 font-black', 'emoji' => '<svg class="w-4 h-4 inline-block -mt-0.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'],
                        };
                    @endphp
                    <p class="text-sm {{ $statusData['cls'] }} capitalize flex items-center gap-1.5">{!! $statusData['emoji'] !!} {{ $user->warga->status }}</p>
                </div>
                @if($user->warga->kartuKeluarga)
                <div class="col-span-1 sm:col-span-2 lg:col-span-3 bg-slate-50 border border-slate-200/60 rounded-2xl p-4">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kepala Keluarga</p>
                    <p class="text-sm font-bold text-slate-800">{{ $user->warga->kartuKeluarga->kepala_keluarga }}</p>
                    <p class="text-xs font-mono text-slate-500 mt-0.5">No. Kartu Keluarga: {{ $user->warga->kartuKeluarga->no_kk }}</p>
                </div>
                @endif
            </div>
            @else
            <div class="mt-5 bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-start gap-3">
                <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center shrink-0"><svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg></div>
                <div>
                    <p class="text-sm font-black text-amber-900 mb-0.5">Akun Belum Terhubung</p>
                    <p class="text-xs text-amber-700 font-medium leading-relaxed">Akun Anda belum terhubung ke data warga fisik RT. Silakan hubungi pengurus RT untuk sinkronisasi data Anda.</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- ====== Form Update Profil ====== --}}
    <div class="card-premium overflow-hidden">
        <div class="px-7 py-5 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-emerald-50/10">
            <h3 class="font-black text-slate-800 text-lg flex items-center gap-2">Perbarui Profil Bapak/Ibu <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></h3>
            <p class="text-xs text-slate-450 font-semibold mt-0.5">Silakan perbarui data Anda jika diperlukan. Kosongkan sandi jika tidak ingin diganti.</p>
        </div>

        @if(session('success'))
        <div class="mx-7 mt-5 bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-center gap-3 alert-enter">
            <svg class="w-6 h-6 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-sm font-bold text-emerald-700">{{ session('success') }}</p>
        </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="px-7 py-6 space-y-5">
            @csrf @method('PATCH')

            {{-- Nama --}}
            <div class="group">
                <label for="name" class="block text-xs sm:text-sm font-bold text-slate-700 mb-2">
                    Nama Lengkap / Panggilan <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border-2 rounded-2xl text-slate-800 text-sm font-semibold focus:bg-white focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all
                                  @error('name') border-red-300 bg-red-50 @else border-slate-200 @enderror">
                </div>
                @error('name')<p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p>@enderror
                <p class="text-[10px] sm:text-xs text-slate-400 font-medium mt-1">Nama panggilan Anda yang akan tampil di aplikasi portal warga.</p>
            </div>

            {{-- Email --}}
            <div class="group">
                <label for="email" class="block text-xs sm:text-sm font-bold text-slate-700 mb-2">
                    Alamat Email Aktif <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border-2 rounded-2xl text-slate-800 text-sm font-semibold focus:bg-white focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all
                                  @error('email') border-red-300 bg-red-50 @else border-slate-200 @enderror">
                </div>
                @error('email')<p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p>@enderror
                <p class="text-[10px] sm:text-xs text-slate-400 font-medium mt-1">Digunakan untuk login dan menerima surat elektronik resmi dari RT.</p>
            </div>

            {{-- Password Section --}}
            <div class="border-2 border-dashed border-emerald-200 bg-emerald-50/10 rounded-2xl p-5 space-y-4">
                <p class="text-xs font-black text-emerald-800 uppercase tracking-widest flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-emerald-650" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Ganti Kata Sandi (Password) — Opsional
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="group">
                        <label for="password" class="block text-xs sm:text-sm font-bold text-slate-700 mb-2">Kata Sandi Baru</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4.5 h-4.5 text-slate-400" style="width:1.1rem;height:1.1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input type="password" id="password" name="password" placeholder="Min. 6 karakter"
                                   class="w-full pl-10 pr-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-2xl text-slate-800 text-sm font-semibold focus:bg-white focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all @error('password') border-red-300 bg-red-50 @enderror">
                        </div>
                        @error('password')<p class="mt-1 text-xs font-semibold text-red-650">{{ $message }}</p>@enderror
                    </div>
                    <div class="group">
                        <label for="password_confirmation" class="block text-xs sm:text-sm font-bold text-slate-700 mb-2">Konfirmasi Sandi Baru</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4.5 h-4.5 text-slate-400" style="width:1.1rem;height:1.1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi sandi baru"
                                   class="w-full pl-10 pr-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-2xl text-slate-800 text-sm font-semibold focus:bg-white focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-gradient-to-r from-emerald-600 via-emerald-700 to-teal-700 text-white font-extrabold py-4 px-6 rounded-2xl shadow-lg shadow-emerald-600/20 hover:shadow-emerald-600/35 hover:-translate-y-0.5 transition-all text-sm flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>

    {{-- Logout --}}
    <div class="card-premium p-5">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="font-black text-slate-850 text-sm">Keluar dari Akun (Logout)</p>
                <p class="text-xs text-slate-500 font-semibold mt-0.5">Keluar dari HP/Komputer ini secara aman.</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                @csrf
                <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-red-50 hover:bg-red-600 border-2 border-red-200 hover:border-red-600 text-red-600 hover:text-white font-bold py-2.5 px-5 rounded-2xl transition-all text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar Sesi Akun
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
