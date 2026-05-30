<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Warga RT 08</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-pattern {
            background-color: #064e3b;
            background-image: radial-gradient(#10b981 1px, transparent 1px), radial-gradient(#10b981 1px, transparent 1px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
            background-attachment: fixed;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="antialiased bg-slate-50 min-h-screen flex flex-col selection:bg-emerald-500 selection:text-white">

    {{-- ====== NAVBAR ====== --}}
    <nav class="fixed top-0 inset-x-0 z-50 bg-white/80 backdrop-blur-lg border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                {{-- Logo --}}
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white shadow-lg shadow-emerald-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-extrabold text-slate-800 tracking-tight leading-none">RT 08 RW 02</h1>
                        <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest mt-1">Portal Digital</p>
                    </div>
                </div>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-extrabold text-slate-600 hover:text-emerald-600 transition-colors mr-2">Beranda Saya</a>
                        <a href="{{ route('profile.edit') }}" class="w-10 h-10 rounded-full bg-slate-100 hover:bg-emerald-100 border border-slate-200 hover:border-emerald-300 flex items-center justify-center text-slate-600 hover:text-emerald-700 transition-all shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-emerald-600 transition-colors px-4 py-2 rounded-xl hover:bg-slate-100">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-sm font-extrabold px-6 py-2.5 rounded-xl shadow-lg shadow-emerald-600/20 hover:shadow-emerald-600/40 hover:-translate-y-0.5 transition-all">Daftar Akun</a>
                        @endif
                    @endauth
                </div>
                
                {{-- Mobile Menu Button (simplified) --}}
                <div class="md:hidden flex items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-emerald-100 text-emerald-800 px-4 py-2 rounded-xl text-xs font-bold">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-md shadow-emerald-500/30">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- ====== HERO SECTION ====== --}}
    <main class="flex-1 flex items-center relative overflow-hidden pt-20">
        {{-- Background Elements --}}
        <div class="absolute inset-0 hero-pattern opacity-10"></div>
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-teal-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-emerald-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float" style="animation-delay: 2s;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-16 lg:py-24">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 font-bold text-xs mb-8 shadow-sm">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    Selamat Datang di Portal Warga
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-tight mb-6">
                    Pelayanan RT <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">Lebih Cepat</span>, Mudah & Transparan
                </h1>
                
                <p class="text-lg text-slate-600 font-medium mb-10 leading-relaxed px-4">
                    Kelola surat pengantar, laporkan masalah lingkungan, dan ikuti info kegiatan desa secara online langsung dari *smartphone* Anda.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-extrabold px-8 py-4 rounded-2xl shadow-xl shadow-emerald-600/30 hover:shadow-emerald-600/50 hover:-translate-y-1 transition-all text-sm group">
                            Masuk ke Dashboard Warga
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    @else
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-extrabold px-8 py-4 rounded-2xl shadow-xl shadow-emerald-600/30 hover:shadow-emerald-600/50 hover:-translate-y-1 transition-all text-sm group">
                            Daftar Akun Sekarang
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        @endif
                        <a href="{{ route('login') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-white text-slate-700 border-2 border-slate-200 hover:border-emerald-300 hover:text-emerald-700 hover:bg-emerald-50 font-extrabold px-8 py-4 rounded-2xl shadow-sm hover:shadow-md transition-all text-sm group">
                            Sudah Punya Akun? Masuk
                        </a>
                    @endauth
                </div>
            </div>
            
            {{-- Features Grid --}}
            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <div class="bg-white/60 backdrop-blur-md rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-800 mb-2">Surat Online</h3>
                    <p class="text-sm text-slate-500 font-medium">Buat pengajuan surat pengantar langsung dari rumah, tanpa perlu bolak-balik ke rumah RT.</p>
                </div>
                <div class="bg-white/60 backdrop-blur-md rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 rounded-2xl bg-teal-100 text-teal-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-800 mb-2">Lapor Masalah</h3>
                    <p class="text-sm text-slate-500 font-medium">Temukan infrastruktur rusak atau masalah lingkungan? Segera lapor, lengkap dengan fotonya.</p>
                </div>
                <div class="bg-white/60 backdrop-blur-md rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-800 mb-2">Mading & Agenda</h3>
                    <p class="text-sm text-slate-500 font-medium">Tak perlu takut ketinggalan informasi. Semua pengumuman dan jadwal kegiatan desa ada di sini.</p>
                </div>
            </div>
        </div>
    </main>
    
    {{-- Footer --}}
    <footer class="bg-white border-t border-slate-200 py-8 relative z-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-xs font-bold text-slate-400">&copy; {{ date('Y') }} Pengurus RT 08 RW 02. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
