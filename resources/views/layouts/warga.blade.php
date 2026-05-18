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
        
        /* Premium Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Premium Utility Classes */
        .premium-shadow { box-shadow: 0 4px 40px -8px rgba(0, 0, 0, 0.05), 0 1px 3px -1px rgba(0, 0, 0, 0.03); }
        .bento-hover { transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
        .bento-hover:hover { transform: translateY(-4px) scale(1.01); box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.08); z-index: 10; }
        .text-gradient { background: linear-gradient(135deg, #1e293b 0%, #334155 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
    @stack('styles')
</head>
<body class="bg-[#FAFAFA] antialiased text-slate-800 flex flex-col min-h-screen relative overflow-x-hidden">

    {{-- ====== PREMIUM FLOATING NAVBAR ====== --}}
    <div class="fixed top-0 inset-x-0 z-50 pt-4 px-4 sm:px-6 pointer-events-none">
        <nav class="max-w-6xl mx-auto bg-white/80 backdrop-blur-xl border border-slate-200/60 rounded-2xl md:rounded-full shadow-[0_8px_30px_rgb(0,0,0,0.04)] pointer-events-auto transition-all duration-300">
            <div class="px-4 sm:px-6 h-16 flex items-center justify-between">
                
                {{-- Brand --}}
                <div class="flex items-center gap-3 shrink-0">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-md shadow-blue-500/20">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <a href="{{ route('warga.dashboard') }}" class="text-base font-extrabold text-slate-900 tracking-tight hidden sm:block">RT 08<span class="text-blue-600">.</span></a>
                </div>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('warga.dashboard') }}" class="px-4 py-2 rounded-full text-[13px] font-bold transition-all duration-300 {{ request()->routeIs('warga.dashboard') ? 'bg-slate-900 text-white shadow-md' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100' }}">Beranda</a>
                    <a href="{{ route('warga.surat.index') }}" class="px-4 py-2 rounded-full text-[13px] font-bold transition-all duration-300 {{ request()->routeIs('warga.surat.*') ? 'bg-slate-900 text-white shadow-md' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100' }}">Surat</a>
                    <a href="{{ route('warga.pengaduan.index') }}" class="px-4 py-2 rounded-full text-[13px] font-bold transition-all duration-300 {{ request()->routeIs('warga.pengaduan.*') ? 'bg-slate-900 text-white shadow-md' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100' }}">Pengaduan</a>
                    <a href="{{ route('warga.pengumuman.index') }}" class="px-4 py-2 rounded-full text-[13px] font-bold transition-all duration-300 {{ request()->routeIs('warga.pengumuman.*') ? 'bg-slate-900 text-white shadow-md' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100' }}">Pengumuman</a>
                    <a href="{{ route('warga.kegiatan.index') }}" class="px-4 py-2 rounded-full text-[13px] font-bold transition-all duration-300 {{ request()->routeIs('warga.kegiatan.*') ? 'bg-slate-900 text-white shadow-md' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100' }}">Kegiatan</a>
                </div>

                {{-- User Profile --}}
                <div class="flex items-center gap-2">
                    <a href="{{ route('profile') }}" class="flex items-center gap-2.5 px-1.5 py-1.5 pr-4 rounded-full hover:bg-slate-100 border border-transparent hover:border-slate-200 transition-all duration-300 group">
                        <div class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center border border-blue-200 text-blue-700 text-xs font-black group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="text-[13px] font-bold text-slate-600 group-hover:text-slate-900">{{ explode(' ', Auth::user()->name)[0] }}</span>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                        @csrf
                        <button type="submit" class="w-9 h-9 flex items-center justify-center rounded-full text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all" title="Keluar">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>

                    <button id="mobile-menu-btn" class="md:hidden w-9 h-9 flex items-center justify-center rounded-full text-slate-600 bg-slate-100 hover:bg-slate-200 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
            
            {{-- Mobile Menu Dropdown --}}
            <div id="mobile-menu" class="hidden md:hidden border-t border-slate-100/50 p-2">
                <div class="bg-slate-50/50 rounded-2xl p-2 space-y-1">
                    <a href="{{ route('warga.dashboard') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('warga.dashboard') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-600' }}">Beranda</a>
                    <a href="{{ route('warga.surat.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('warga.surat.*') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-600' }}">Surat</a>
                    <a href="{{ route('warga.pengaduan.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('warga.pengaduan.*') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-600' }}">Pengaduan</a>
                    <a href="{{ route('warga.pengumuman.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('warga.pengumuman.*') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-600' }}">Pengumuman</a>
                    <a href="{{ route('warga.kegiatan.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('warga.kegiatan.*') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-600' }}">Kegiatan</a>
                    <form method="POST" action="{{ route('logout') }}" class="pt-1">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2.5 rounded-xl text-sm font-bold text-red-600 hover:bg-red-50 flex items-center gap-2">
                            Keluar Akun
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </div>

    {{-- Push content down so it's not hidden under floating nav --}}
    <div class="h-24 md:h-28"></div>

    {{-- ====== ALERTS ====== --}}
    @if(session('success') || session('error'))
    <div class="max-w-4xl mx-auto px-4 sm:px-6 w-full mb-6 z-40 relative">
        @if(session('success'))
        <div id="warga-alert" class="flex items-center gap-3 bg-slate-900 text-white px-5 py-4 rounded-2xl text-sm shadow-xl shadow-slate-900/10 animate-[slideDown_0.3s_ease-out]">
            <div class="w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center shrink-0 text-green-400">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            </div>
            <span class="flex-1 font-bold">{{ session('success') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div id="warga-alert" class="flex items-center gap-3 bg-red-50 border border-red-100 text-red-800 px-5 py-4 rounded-2xl text-sm shadow-xl shadow-red-500/10 animate-[slideDown_0.3s_ease-out]">
            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            </div>
            <span class="flex-1 font-bold">{{ session('error') }}</span>
        </div>
        @endif
    </div>
    @endif

    {{-- ====== MAIN CONTENT ====== --}}
    <main class="flex-1 w-full mx-auto pb-12 relative z-10">
        @yield('content')
    </main>

    {{-- ====== PREMIUM FOOTER ====== --}}
    <footer class="mt-auto py-8 relative z-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="border-t border-slate-200/60 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-md bg-slate-900 flex items-center justify-center">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <span class="text-sm font-bold text-slate-700">Portal Warga RT 08.</span>
                </div>
                <p class="text-[11px] font-semibold text-slate-400">© {{ date('Y') }} Sistem Informasi Lingkungan Pintar.</p>
            </div>
        </div>
    </footer>

    <style>
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
    </style>

    <script>
        setTimeout(() => {
            const el = document.getElementById('warga-alert');
            if (el) { el.style.opacity = '0'; el.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)'; el.style.transform = 'translateY(-10px) scale(0.95)'; setTimeout(() => el.remove(), 500); }
        }, 4000);

        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        if(btn && menu) {
            btn.addEventListener('click', () => {
                if (menu.classList.contains('hidden')) {
                    menu.classList.remove('hidden');
                    setTimeout(() => { menu.classList.add('opacity-100'); menu.classList.remove('opacity-0'); }, 10);
                } else {
                    menu.classList.add('hidden');
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
