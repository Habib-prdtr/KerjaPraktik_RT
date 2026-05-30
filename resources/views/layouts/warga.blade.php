<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal Warga RT 08 RW 02 - Desa Penambangan')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        *, body { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(16,185,129,0.25); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(16,185,129,0.45); }

        /* Background body: Warm Cream & Soft Greenish */
        body { background: #f4f7f5; }

        /* Subtle mesh bg */
        .page-bg {
            background:
                radial-gradient(ellipse 70% 50% at 0% 0%, rgba(16,185,129,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 60% 60% at 100% 100%, rgba(20,184,166,0.05) 0%, transparent 60%),
                #f4f7f5;
        }

        /* Floating navbar */
        .nav-glass {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(16,185,129,0.12);
            box-shadow: 0 4px 24px rgba(16,185,129,0.06), 0 1px 4px rgba(0,0,0,0.02);
        }

        /* Active nav indicator - Fresh Green Gradient */
        .nav-active {
            background: linear-gradient(135deg, #059669, #0f766e);
            color: white;
            box-shadow: 0 4px 14px rgba(16,185,129,0.3);
        }

        /* Card premium */
        .card-premium {
            background: white;
            border: 1px solid rgba(16,185,129,0.08);
            box-shadow: 0 4px 16px rgba(16,185,129,0.03), 0 1px 3px rgba(0,0,0,0.02);
            border-radius: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-premium:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(16,185,129,0.1), 0 4px 8px rgba(0,0,0,0.04);
            border-color: rgba(16,185,129,0.18);
        }

        /* Gradient text */
        .text-gradient-green {
            background: linear-gradient(135deg, #059669, #0f766e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Hero section - Lush Green Village Scenic morning gradient */
        .hero-warga {
            background: linear-gradient(135deg, #0f766e 0%, #115e59 45%, #166534 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-warga::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 30px 30px;
        }

        @keyframes slideInRight {
            from { opacity:0; transform: translateX(50px); }
            to { opacity:1; transform: translateX(0); }
        }
        .toast-enter { animation: slideInRight 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }

        /* Bottom mobile nav */
        .mobile-bottom-nav {
            background: rgba(255,255,255,0.96);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(16,185,129,0.1);
            box-shadow: 0 -4px 24px rgba(16,185,129,0.08);
        }

        /* Pulse badge */
        @keyframes pulse-badge {
            0%, 100% { box-shadow: 0 0 0 0 rgba(16,185,129,0.4); }
            50% { box-shadow: 0 0 0 6px rgba(16,185,129,0); }
        }
        .badge-pulse { animation: pulse-badge 2s infinite; }

        /* Bento hover */
        .bento-hover {
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .bento-hover:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 20px 40px rgba(16,185,129,0.08);
        }

        /* Status pills - Simplified and Friendly */
        .pill-pending  { background: #f0f4f8; color: #334155; border: 1px solid #cbd5e1; } /* Menunggu */
        .pill-diproses { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; } /* Sedang Dibuat */
        .pill-selesai  { background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; } /* Siap Diambil */
        .pill-ditolak  { background: #fff5f5; color: #b91c1c; border: 1px solid #fee2e2; } /* Perlu Diperbaiki */
        .pill-dikirim  { background: #faf5ff; color: #6b21a8; border: 1px solid #e9d5ff; }
    </style>
    @stack('styles')
</head>
<body class="page-bg antialiased text-slate-800 flex flex-col min-h-screen relative overflow-x-hidden">

    <!-- ====== FLOATING NAVBAR ====== -->
    <div class="fixed top-0 inset-x-0 z-50 pt-3 px-4 sm:px-6 pointer-events-none">
        <nav class="max-w-6xl mx-auto nav-glass rounded-2xl md:rounded-full pointer-events-auto transition-all duration-300">
            <div class="px-4 sm:px-5 h-16 flex items-center justify-between gap-4">

                <!-- Brand (Identity) -->
                <a href="{{ route('warga.dashboard') }}" class="flex items-center gap-2.5 shrink-0 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-600 to-teal-600 flex items-center justify-center shadow-md shadow-emerald-500/25 group-hover:shadow-emerald-500/40 transition-shadow">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-[9px] text-emerald-600 font-black uppercase tracking-widest leading-none mb-0.5">Desa Penambangan</p>
                        <p class="font-extrabold text-slate-900 text-sm leading-none">RT 08 RW 02<span class="text-emerald-500">.</span></p>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-1">
                    @php
                        $navLinks = [
                            ['route' => 'warga.dashboard', 'label' => 'Beranda', 'match' => 'warga.dashboard'],
                            ['route' => 'warga.surat.index', 'label' => 'Surat Pengantar', 'match' => 'warga.surat.*'],
                            ['route' => 'warga.pengaduan.index', 'label' => 'Lapor Masalah', 'match' => 'warga.pengaduan.*'],
                            ['route' => 'warga.pengumuman.index', 'label' => 'Mading RT', 'match' => 'warga.pengumuman.*'],
                            ['route' => 'warga.kegiatan.index', 'label' => 'Agenda RT', 'match' => 'warga.kegiatan.*'],
                        ];
                    @endphp
                    @foreach($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       class="px-4 py-2 rounded-full text-[13px] font-bold transition-all duration-300 {{ request()->routeIs($link['match']) ? 'nav-active' : 'text-slate-500 hover:text-emerald-700 hover:bg-emerald-50' }}">
                        {{ $link['label'] }}
                    </a>
                    @endforeach
                </div>

                <!-- Right section -->
                <div class="flex items-center gap-2">
                    <!-- Profile -->
                    <a href="{{ route('profile') }}"
                       class="flex items-center gap-2 px-2 py-1.5 pr-3.5 rounded-full hover:bg-emerald-50 border border-transparent hover:border-emerald-100 transition-all group">
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white text-xs font-black shadow-md shadow-emerald-500/25">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden sm:block text-[13px] font-bold text-slate-600 group-hover:text-emerald-900">
                            {{ explode(' ', Auth::user()->name)[0] }}
                        </span>
                    </a>

                    <!-- Logout (desktop) -->
                    <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                        @csrf
                        <button type="submit" title="Keluar"
                                class="w-9 h-9 rounded-full text-slate-400 hover:text-red-600 hover:bg-red-50 flex items-center justify-center transition-all">
                            <svg class="w-4.5 h-4.5" style="width:1.125rem;height:1.125rem" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>

                </div>
            </div>
        </nav>
    </div>

    <!-- Spacer for fixed nav -->
    <div class="h-24 md:h-28"></div>

    <!-- ====== TOAST ALERTS ====== -->
    @if(session('success') || session('error') || session('info'))
    <div class="fixed top-24 right-4 sm:right-6 z-[100] flex flex-col gap-3 pointer-events-none w-full max-w-sm px-4 sm:px-0">
        @if(session('success'))
        <div id="warga-toast" class="pointer-events-auto toast-enter bg-white border-l-4 border-emerald-500 rounded-xl p-4 shadow-2xl flex items-start gap-3 w-full">
            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0 mt-0.5">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-slate-800">Berhasil!</p>
                <p class="text-xs text-slate-500 mt-0.5">{{ session('success') }}</p>
            </div>
            <button onclick="this.closest('#warga-toast').style.display='none'" class="text-slate-400 hover:text-slate-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div id="warga-toast-error" class="pointer-events-auto toast-enter bg-white border-l-4 border-red-500 rounded-xl p-4 shadow-2xl flex items-start gap-3 w-full">
            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center shrink-0 mt-0.5">
                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-slate-800">Gagal!</p>
                <p class="text-xs text-slate-500 mt-0.5">{{ session('error') }}</p>
            </div>
            <button onclick="this.closest('#warga-toast-error').style.display='none'" class="text-slate-400 hover:text-slate-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        @endif

        @if(session('info'))
        <div id="warga-toast-info" class="pointer-events-auto toast-enter bg-white border-l-4 border-amber-500 rounded-xl p-4 shadow-2xl flex items-start gap-3 w-full">
            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center shrink-0 mt-0.5">
                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-slate-800">Informasi</p>
                <p class="text-xs text-slate-500 mt-0.5">{{ session('info') }}</p>
            </div>
            <button onclick="this.closest('#warga-toast-info').style.display='none'" class="text-slate-400 hover:text-slate-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        @endif
    </div>
    @endif

    <!-- ====== MAIN CONTENT ====== -->
    <main class="flex-1 w-full mx-auto pt-2 md:pt-4 pb-16 md:pb-10 relative z-10">
        @yield('content')
    </main>

    <!-- ====== FOOTER ====== -->
    <footer class="mt-auto pt-6 pb-4 relative z-10 hidden md:block">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="border-t border-emerald-100 pt-6 flex flex-col md:flex-row items-center justify-between gap-3">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-emerald-600 to-teal-600 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-slate-700">Portal Resmi Warga RT 08 RW 02</span>
                </div>
                <p class="text-xs font-semibold text-slate-400">© {{ date('Y') }} Rukun Tetangga 08 • Desa Penambangan • Ramah, Bersih, dan Asri</p>
            </div>
        </div>
    </footer>

    <!-- ====== MOBILE BOTTOM NAV ====== -->
    <div class="md:hidden fixed bottom-0 inset-x-0 z-50 mobile-bottom-nav">
        <div class="flex items-center justify-around px-2 py-2">
            @php
                $bottomNavLinks = [
                    ['route' => 'warga.dashboard', 'match' => 'warga.dashboard', 'label' => 'Beranda', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
                    ['route' => 'warga.surat.index', 'match' => 'warga.surat.*', 'label' => 'Surat', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>'],
                    ['route' => 'warga.pengaduan.index', 'match' => 'warga.pengaduan.*', 'label' => 'Lapor', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>'],
                    ['route' => 'warga.pengumuman.index', 'match' => 'warga.pengumuman.*', 'label' => 'Mading', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>'],
                    ['route' => 'warga.kegiatan.index', 'match' => 'warga.kegiatan.*', 'label' => 'Agenda', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>'],
                ];
            @endphp
            @foreach($bottomNavLinks as $nav)
            @php $isActive = request()->routeIs($nav['match']); @endphp
            <a href="{{ route($nav['route']) }}"
               class="flex flex-col items-center gap-0.5 py-1 px-3 min-w-0 rounded-xl transition-all {{ $isActive ? 'text-emerald-600 font-extrabold' : 'text-slate-400 hover:text-slate-700' }}">
                <div class="w-10 h-8 flex items-center justify-center relative">
                    @if($isActive)
                    <div class="absolute inset-0 rounded-xl bg-emerald-50 border border-emerald-100"></div>
                    @endif
                    <svg class="w-5 h-5 relative z-10 {{ $isActive ? 'text-emerald-600' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $nav['icon'] !!}</svg>
                </div>
                <span class="text-[10px] leading-none">{{ $nav['label'] }}</span>
            </a>
            @endforeach
        </div>
    </div>

    <script>
        // Auto dismiss toast
        setTimeout(() => {
            const toasts = document.querySelectorAll('[id^="warga-toast"]');
            toasts.forEach(el => {
                el.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                el.style.opacity = '0';
                el.style.transform = 'translateX(20px)';
                setTimeout(() => el.remove(), 500);
            });
        }, 5000);


    </script>
    @stack('scripts')
</body>
</html>
