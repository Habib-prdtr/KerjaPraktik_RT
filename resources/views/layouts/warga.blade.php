<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal Warga RT 08 RW 02')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        body, * { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="bg-slate-50 antialiased font-sans flex flex-col min-h-screen">

    {{-- ====== TOP NAVBAR ====== --}}
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                {{-- Logo & Brand --}}
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <div>
                        <a href="{{ route('warga.dashboard') }}" class="text-sm font-bold text-slate-800 leading-none hover:text-blue-600 transition-colors">RT 08 / RW 02</a>
                        <p class="text-[10px] text-slate-400 leading-none mt-1">Portal Layanan Warga</p>
                    </div>
                </div>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center space-x-1 lg:space-x-4">
                    <a href="{{ route('warga.dashboard') }}" class="px-3 py-2 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('warga.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">Beranda</a>
                    <a href="{{ route('warga.surat.index') }}" class="px-3 py-2 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('warga.surat.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">Surat</a>
                    <a href="{{ route('warga.pengaduan.index') }}" class="px-3 py-2 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('warga.pengaduan.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">Pengaduan</a>
                    <a href="{{ route('warga.pengumuman.index') }}" class="px-3 py-2 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('warga.pengumuman.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">Pengumuman</a>
                    <a href="{{ route('warga.kegiatan.index') }}" class="px-3 py-2 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('warga.kegiatan.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">Kegiatan</a>
                </div>

                {{-- User Profile & Logout (Desktop & Mobile combined) --}}
                <div class="flex items-center gap-2 lg:gap-4">
                    <a href="{{ route('profile') }}" class="flex items-center gap-2 hover:bg-slate-50 rounded-xl px-2 py-1.5 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center shadow-sm">
                            <span class="text-white text-xs font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                        </div>
                        <span class="hidden lg:block text-sm font-semibold text-slate-700">{{ Auth::user()->name }}</span>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                        @csrf
                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-colors" title="Keluar">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>

                    {{-- Hamburger Button (Mobile) --}}
                    <button id="mobile-menu-btn" class="md:hidden p-2 text-slate-500 hover:bg-slate-100 rounded-xl transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-100 bg-white">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="{{ route('warga.dashboard') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('warga.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50' }}">Beranda</a>
                <a href="{{ route('warga.surat.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('warga.surat.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50' }}">Surat</a>
                <a href="{{ route('warga.pengaduan.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('warga.pengaduan.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50' }}">Pengaduan</a>
                <a href="{{ route('warga.pengumuman.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('warga.pengumuman.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50' }}">Pengumuman</a>
                <a href="{{ route('warga.kegiatan.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('warga.kegiatan.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50' }}">Kegiatan</a>
                
                <hr class="my-2 border-slate-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2.5 rounded-xl text-sm font-semibold text-red-600 hover:bg-red-50">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- ====== ALERT MESSAGES ====== --}}
    @if(session('success') || session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        @if(session('success'))
        <div id="warga-alert" class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-2xl text-sm shadow-sm">
            <svg class="w-5 h-5 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span class="flex-1 font-medium">{{ session('success') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div id="warga-alert" class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-2xl text-sm shadow-sm">
            <svg class="w-5 h-5 text-red-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            <span class="flex-1 font-medium">{{ session('error') }}</span>
        </div>
        @endif
    </div>
    @endif

    {{-- ====== MAIN CONTENT ====== --}}
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    {{-- ====== FOOTER ====== --}}
    <footer class="bg-white border-t border-slate-200 py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-xs font-semibold text-slate-500">© {{ date('Y') }} Portal Layanan Warga RT 08 / RW 02.</p>
        </div>
    </footer>

    <script>
        // Auto-close alert
        setTimeout(() => {
            const el = document.getElementById('warga-alert');
            if (el) el.remove();
        }, 5000);

        // Mobile Menu Toggle
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        if(btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
