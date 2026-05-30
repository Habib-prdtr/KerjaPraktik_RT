<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Informasi RT 08 RW 02')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Subtle mesh bg */
        .page-bg {
            background:
                radial-gradient(ellipse 70% 50% at 0% 0%, rgba(16,185,129,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 60% 60% at 100% 100%, rgba(20,184,166,0.05) 0%, transparent 60%),
                #f4f7f5;
        }
    </style>
    @stack('styles')
</head>
<body class="page-bg font-sans antialiased text-slate-800">

    <div class="flex h-screen overflow-hidden">

        {{-- ===================== SIDEBAR ===================== --}}
        <aside id="sidebar"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-emerald-900 to-emerald-800 shadow-2xl
                      transform -translate-x-full transition-transform duration-300 ease-in-out
                      lg:relative lg:translate-x-0 lg:flex lg:flex-col lg:shrink-0">

            {{-- Logo / Branding --}}
            <div class="flex items-center gap-3 px-6 py-5 border-b border-emerald-700/50">
                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold text-sm leading-tight">RT 08 / RW 02</p>
                    <p class="text-emerald-200 text-xs">Sistem Informasi Warga</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto px-4 py-5 space-y-1">

                @if(Auth::user()->role === 'admin')
                    {{-- ===== MENU ADMIN ===== --}}
                    <p class="px-3 pt-2 pb-1 text-emerald-300 text-xs font-semibold uppercase tracking-widest">Menu Utama</p>

                    <a href="{{ route('admin.dashboard') }}"
                       class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        Dashboard
                    </a>

                    <p class="px-3 pt-4 pb-1 text-emerald-300 text-xs font-semibold uppercase tracking-widest">Data Warga</p>

                    <a href="{{ route('admin.kartu-keluarga.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.kartu-keluarga.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2"/>
                        </svg>
                        Kartu Keluarga
                    </a>

                    <a href="{{ route('admin.warga.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.warga.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Data Warga
                    </a>

                    <p class="px-3 pt-4 pb-1 text-emerald-300 text-xs font-semibold uppercase tracking-widest">Layanan</p>

                    <a href="{{ route('admin.surat.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.surat.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Surat Menyurat
                    </a>

                    <a href="{{ route('admin.pengaduan.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        Pengaduan Warga
                    </a>

                    <p class="px-3 pt-4 pb-1 text-emerald-300 text-xs font-semibold uppercase tracking-widest">Informasi</p>

                    <a href="{{ route('admin.pengumuman.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        Pengumuman
                    </a>

                    <a href="{{ route('admin.kegiatan.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Kegiatan RT
                    </a>

                    <p class="px-3 pt-4 pb-1 text-emerald-300 text-xs font-semibold uppercase tracking-widest">Sistem</p>

                    <a href="{{ route('admin.user.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Kelola Pengguna
                    </a>

                @else
                    {{-- ===== MENU WARGA ===== --}}
                    <p class="px-3 pt-2 pb-1 text-emerald-300 text-xs font-semibold uppercase tracking-widest">Menu Utama</p>

                    <a href="{{ route('warga.dashboard') }}"
                       class="sidebar-link {{ request()->routeIs('warga.dashboard') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        Dashboard
                    </a>

                    <p class="px-3 pt-4 pb-1 text-emerald-300 text-xs font-semibold uppercase tracking-widest">Layanan</p>

                    <a href="{{ route('warga.surat.index') }}"
                       class="sidebar-link {{ request()->routeIs('warga.surat.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Pengajuan Surat
                    </a>

                    <a href="{{ route('warga.pengaduan.index') }}"
                       class="sidebar-link {{ request()->routeIs('warga.pengaduan.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        Pengaduan
                    </a>

                    <p class="px-3 pt-4 pb-1 text-emerald-300 text-xs font-semibold uppercase tracking-widest">Informasi</p>

                    <a href="{{ route('warga.pengumuman.index') }}"
                       class="sidebar-link {{ request()->routeIs('warga.pengumuman.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        Pengumuman
                    </a>

                    <a href="{{ route('warga.kegiatan.index') }}"
                       class="sidebar-link {{ request()->routeIs('warga.kegiatan.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Kegiatan RT
                    </a>
                @endif
            </nav>

            {{-- User Footer --}}
            <div class="px-4 py-4 border-t border-emerald-700/50">
                <a href="{{ route('profile') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-white/10 transition-colors duration-200 group">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-400 to-teal-300 flex items-center justify-center shrink-0">
                        <span class="text-white text-xs font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                        <p class="text-emerald-300 text-xs capitalize">{{ Auth::user()->role }}</p>
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-3 py-2 rounded-xl text-emerald-200 hover:text-white hover:bg-red-500/20 transition-all duration-200 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- Overlay mobile --}}
        <div id="sidebar-overlay"
             class="fixed inset-0 z-40 bg-black/50 hidden lg:hidden"
             onclick="toggleSidebar()">
        </div>

        {{-- ===================== MAIN CONTENT ===================== --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            {{-- TOPBAR / NAVBAR --}}
            <header class="bg-white border-b border-slate-200 px-4 lg:px-6 py-4 flex items-center justify-between shrink-0 shadow-sm">
                {{-- Hamburger + Page Title --}}
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()"
                            class="p-2 rounded-lg text-slate-500 hover:bg-slate-100 lg:hidden transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div>
                        <h1 class="text-base font-semibold text-slate-800">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-xs text-slate-400 hidden sm:block">@yield('page-subtitle', 'Sistem Informasi RT 08 RW 02')</p>
                    </div>
                </div>

                {{-- Right side --}}
                <div class="flex items-center gap-3">
                    {{-- Tanggal --}}
                    <span class="hidden md:block text-xs text-slate-500 bg-slate-100 px-3 py-1.5 rounded-lg">
                        {{ now()->translatedFormat('d F Y') }}
                    </span>

                    {{-- Avatar --}}
                    <a href="{{ route('profile') }}"
                       class="flex items-center gap-2 px-3 py-1.5 rounded-xl hover:bg-slate-100 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-600 to-teal-400 flex items-center justify-center">
                            <span class="text-white text-xs font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                        </div>
                        <span class="hidden sm:block text-sm font-medium text-slate-700">{{ Auth::user()->name }}</span>
                    </a>
                </div>
            </header>

            {{-- ALERT MESSAGES (TOAST) --}}
            @if(session('success') || session('error') || session('info'))
            <div class="fixed top-20 right-4 sm:right-6 z-[100] flex flex-col gap-3 pointer-events-none w-full max-w-sm px-4 sm:px-0">
                @if(session('success'))
                <div id="admin-toast-success" class="pointer-events-auto toast-enter bg-white border-l-4 border-emerald-500 rounded-xl p-4 shadow-2xl flex items-start gap-3 w-full">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-800">Berhasil!</p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.closest('.pointer-events-auto').style.display='none'" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                @endif

                @if(session('error'))
                <div id="admin-toast-error" class="pointer-events-auto toast-enter bg-white border-l-4 border-red-500 rounded-xl p-4 shadow-2xl flex items-start gap-3 w-full">
                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-800">Gagal!</p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.closest('.pointer-events-auto').style.display='none'" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                @endif

                @if(session('info'))
                <div id="admin-toast-info" class="pointer-events-auto toast-enter bg-white border-l-4 border-amber-500 rounded-xl p-4 shadow-2xl flex items-start gap-3 w-full">
                    <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-800">Informasi</p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ session('info') }}</p>
                    </div>
                    <button onclick="this.closest('.pointer-events-auto').style.display='none'" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                @endif
            </div>
            @endif

            {{-- PAGE CONTENT --}}
            <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- ===================== CUSTOM STYLES ===================== --}}
    <style>
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 0.75rem;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #bfdbfe;
            transition: all 0.15s ease;
            text-decoration: none;
        }
        .sidebar-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: #ffffff;
        }
        .sidebar-link.active {
            background-color: rgba(255,255,255,0.15);
            color: #ffffff;
            box-shadow: inset 3px 0 0 #60a5fa;
        }

        @keyframes slideInRight {
            from { opacity:0; transform: translateX(50px); }
            to { opacity:1; transform: translateX(0); }
        }
        .toast-enter { animation: slideInRight 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
    </style>

    {{-- (Global modal bawaan dihapus, diganti menggunakan SweetAlert2) --}}

    {{-- ===================== SCRIPTS ===================== --}}
    <script>
        function toggleSidebar() {
            const sidebar  = document.getElementById('sidebar');
            const overlay  = document.getElementById('sidebar-overlay');
            const isOpen   = !sidebar.classList.contains('-translate-x-full');

            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }
        }

        // Auto-close toast setelah 5 detik
        setTimeout(() => {
            const toasts = document.querySelectorAll('[id^="admin-toast"]');
            toasts.forEach(el => {
                el.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                el.style.opacity = '0';
                el.style.transform = 'translateX(20px)';
                setTimeout(() => el.remove(), 500);
            });
        }, 5000);

        // Global Confirm Modal Logic with SweetAlert2
        function confirmAction(event, message) {
            event.preventDefault();
            const form = event.target;
            
            Swal.fire({
                title: 'Konfirmasi',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-2xl',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
