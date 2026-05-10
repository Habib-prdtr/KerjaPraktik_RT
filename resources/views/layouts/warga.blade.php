<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal Warga RT 08 RW 02')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body, * { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }
        
        /* Modern Background Blobs */
        .bg-blob {
            position: absolute;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.6;
            animation: float 10s ease-in-out infinite alternate;
        }
        .bg-blob-1 { top: -10%; left: -10%; width: 50vw; height: 50vw; max-width: 600px; max-height: 600px; background: radial-gradient(circle, rgba(59,130,246,0.3) 0%, rgba(147,197,253,0) 70%); }
        .bg-blob-2 { bottom: -10%; right: -10%; width: 60vw; height: 60vw; max-width: 700px; max-height: 700px; background: radial-gradient(circle, rgba(16,185,129,0.2) 0%, rgba(110,231,183,0) 70%); animation-delay: -5s; }
        
        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, 30px) scale(1.1); }
        }

        /* Glassmorphism Utilities */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        
        /* Hide scrollbar for clean look */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50/50 antialiased font-sans flex flex-col min-h-screen relative overflow-x-hidden">

    <!-- Decorative Background Elements -->
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>

    {{-- ====== TOP NAVBAR ====== --}}
    <nav class="glass sticky top-4 z-50 mx-4 sm:mx-6 lg:mx-8 rounded-2xl shadow-sm border border-white/80 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center h-16 lg:h-20">
                
                {{-- Logo & Brand --}}
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/30 transform hover:rotate-3 transition-transform">
                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <div>
                        <a href="{{ route('warga.dashboard') }}" class="text-base lg:text-lg font-extrabold text-slate-800 leading-none hover:text-blue-600 transition-colors tracking-tight">Portal RT 08</a>
                        <p class="text-[11px] lg:text-xs text-slate-500 font-medium leading-none mt-1">Layanan Warga Terpadu</p>
                    </div>
                </div>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center space-x-2">
                    <a href="{{ route('warga.dashboard') }}" class="relative px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 {{ request()->routeIs('warga.dashboard') ? 'text-blue-700 bg-blue-50 shadow-sm' : 'text-slate-500 hover:text-slate-800 hover:bg-white/60' }}">
                        Beranda
                    </a>
                    <a href="{{ route('warga.surat.index') }}" class="relative px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 {{ request()->routeIs('warga.surat.*') ? 'text-blue-700 bg-blue-50 shadow-sm' : 'text-slate-500 hover:text-slate-800 hover:bg-white/60' }}">
                        Surat
                    </a>
                    <a href="{{ route('warga.pengaduan.index') }}" class="relative px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 {{ request()->routeIs('warga.pengaduan.*') ? 'text-blue-700 bg-blue-50 shadow-sm' : 'text-slate-500 hover:text-slate-800 hover:bg-white/60' }}">
                        Pengaduan
                    </a>
                    <a href="{{ route('warga.pengumuman.index') }}" class="relative px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 {{ request()->routeIs('warga.pengumuman.*') ? 'text-blue-700 bg-blue-50 shadow-sm' : 'text-slate-500 hover:text-slate-800 hover:bg-white/60' }}">
                        Pengumuman
                    </a>
                    <a href="{{ route('warga.kegiatan.index') }}" class="relative px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 {{ request()->routeIs('warga.kegiatan.*') ? 'text-blue-700 bg-blue-50 shadow-sm' : 'text-slate-500 hover:text-slate-800 hover:bg-white/60' }}">
                        Kegiatan
                    </a>
                </div>

                {{-- User Profile & Logout --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('profile') }}" class="group flex items-center gap-3 bg-white/50 hover:bg-white/80 border border-slate-200/50 rounded-2xl p-1.5 pr-4 transition-all duration-300 shadow-sm hover:shadow">
                        <div class="w-8 h-8 lg:w-9 lg:h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center shadow-inner group-hover:scale-105 transition-transform">
                            <span class="text-white text-xs lg:text-sm font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                        <span class="hidden lg:block text-sm font-bold text-slate-700 group-hover:text-indigo-600 transition-colors">{{ explode(' ', Auth::user()->name)[0] }}</span>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                        @csrf
                        <button type="submit" class="p-2.5 text-slate-400 hover:text-red-600 bg-white/50 hover:bg-red-50 rounded-xl transition-all duration-300 shadow-sm hover:shadow" title="Keluar">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>

                    {{-- Hamburger Button (Mobile) --}}
                    <button id="mobile-menu-btn" class="md:hidden p-2.5 text-slate-500 bg-white/50 hover:bg-white/80 rounded-xl transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-white/50 bg-white/80 backdrop-blur-xl rounded-b-2xl overflow-hidden transition-all duration-300">
            <div class="px-4 py-4 space-y-1">
                <a href="{{ route('warga.dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('warga.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-white' }}">Beranda</a>
                <a href="{{ route('warga.surat.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('warga.surat.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-white' }}">Surat</a>
                <a href="{{ route('warga.pengaduan.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('warga.pengaduan.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-white' }}">Pengaduan</a>
                <a href="{{ route('warga.pengumuman.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('warga.pengumuman.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-white' }}">Pengumuman</a>
                <a href="{{ route('warga.kegiatan.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('warga.kegiatan.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-white' }}">Kegiatan</a>
                
                <hr class="my-2 border-slate-200/60">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 rounded-xl text-sm font-bold text-red-600 hover:bg-red-50 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- ====== ALERT MESSAGES ====== --}}
    @if(session('success') || session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 w-full relative z-40">
        @if(session('success'))
        <div id="warga-alert" class="flex items-center gap-3 bg-white border border-green-200 text-green-800 px-5 py-4 rounded-2xl text-sm shadow-xl shadow-green-500/10 animate-[slideDown_0.3s_ease-out]">
            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            </div>
            <span class="flex-1 font-bold">{{ session('success') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div id="warga-alert" class="flex items-center gap-3 bg-white border border-red-200 text-red-800 px-5 py-4 rounded-2xl text-sm shadow-xl shadow-red-500/10 animate-[slideDown_0.3s_ease-out]">
            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            </div>
            <span class="flex-1 font-bold">{{ session('error') }}</span>
        </div>
        @endif
    </div>
    @endif

    {{-- ====== MAIN CONTENT ====== --}}
    <main class="flex-1 w-full mx-auto py-8 lg:py-10 relative z-10">
        @yield('content')
    </main>

    {{-- ====== FOOTER ====== --}}
    <footer class="mt-auto pb-6 pt-10 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass rounded-3xl p-6 text-center shadow-sm">
                <p class="text-xs font-bold text-slate-500">© {{ date('Y') }} Portal Layanan Warga RT 08 / RW 02.</p>
                <p class="text-[10px] font-medium text-slate-400 mt-1">Dibuat dengan ❤️ untuk lingkungan yang lebih baik.</p>
            </div>
        </div>
    </footer>

    <style>
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <script>
        // Auto-close alert
        setTimeout(() => {
            const el = document.getElementById('warga-alert');
            if (el) {
                el.style.opacity = '0';
                el.style.transition = 'opacity 0.5s ease';
                setTimeout(() => el.remove(), 500);
            }
        }, 5000);

        // Mobile Menu Toggle
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        if(btn && menu) {
            btn.addEventListener('click', () => {
                if (menu.classList.contains('hidden')) {
                    menu.classList.remove('hidden');
                    // Add small delay for animation
                    setTimeout(() => {
                        menu.classList.add('opacity-100');
                        menu.classList.remove('opacity-0');
                    }, 10);
                } else {
                    menu.classList.add('hidden');
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
