<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login') — Portal Warga RT 08</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Animated lush nature gradient background */
        .bg-asri {
            position: fixed;
            inset: 0;
            z-index: 0;
            background: #FAF9F5;
            overflow: hidden;
            pointer-events: none;
        }
        .bg-asri::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle 500px at 10% 20%, rgba(16,185,129,0.08) 0%, transparent 80%),
                radial-gradient(circle 400px at 90% 80%, rgba(20,184,166,0.08) 0%, transparent 80%),
                radial-gradient(circle 600px at 50% 50%, rgba(245,158,11,0.05) 0%, transparent 80%);
            animation: asri-glow 15s ease-in-out infinite alternate;
        }
        @keyframes asri-glow {
            0%   { opacity: 0.8; transform: scale(1); }
            50%  { opacity: 1; transform: scale(1.03); }
            100% { opacity: 0.8; transform: scale(1); }
        }

        /* Floating leaf-like green particles */
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            animation: float-particle linear infinite;
            opacity: 0.12;
        }
        @keyframes float-particle {
            0%   { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10%  { opacity: 0.12; }
            90%  { opacity: 0.12; }
            100% { transform: translateY(-10vh) rotate(360deg); opacity: 0; }
        }

        /* Grid overlay */
        .grid-overlay {
            background-image: linear-gradient(rgba(16,185,129,0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(16,185,129,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Premium forms */
        .glass-form {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
        }

        /* Premium input focus */
        .premium-input {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .premium-input:focus {
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.12), 0 1px 3px rgba(0,0,0,0.05);
        }

        /* Shimmer on CTA button */
        .btn-shimmer {
            position: relative;
            overflow: hidden;
        }
        .btn-shimmer::after {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shimmer 2.5s ease-in-out infinite;
        }
        @keyframes shimmer {
            0%   { left: -100%; }
            100% { left: 200%; }
        }

        .animate-float-slow {
            animation: float-slow 8s ease-in-out infinite;
        }
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33%  { transform: translateY(-10px) rotate(0.5deg); }
            66%  { transform: translateY(-5px) rotate(-0.5deg); }
        }

        /* Scroll custom */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(16,185,129,0.3); border-radius: 10px; }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-start sm:justify-center items-center p-3 py-6 sm:p-4 sm:py-10 relative overflow-x-hidden overflow-y-auto">

    <!-- Beautiful Animated Background (Lush Nature) -->
    <div class="bg-asri">
        <!-- Grid overlay -->
        <div class="absolute inset-0 grid-overlay"></div>

        <!-- Floating particles (Green leaves look) -->
        <div class="particle w-2.5 h-2.5 bg-emerald-300 left-[10%]" style="animation-duration:15s; animation-delay:0s;"></div>
        <div class="particle w-3.5 h-3.5 bg-teal-300 left-[25%]" style="animation-duration:18s; animation-delay:3s;"></div>
        <div class="particle w-2 h-2 bg-emerald-200 left-[60%]" style="animation-duration:12s; animation-delay:6s;"></div>
        <div class="particle w-3 h-3 bg-teal-200 left-[80%]" style="animation-duration:20s; animation-delay:1s;"></div>
        <div class="particle w-2.5 h-2.5 bg-emerald-400 left-[45%]" style="animation-duration:14s; animation-delay:8s;"></div>
        <div class="particle w-1.5 h-1.5 bg-amber-200 left-[70%]" style="animation-duration:16s; animation-delay:4s;"></div>
    </div>

    <!-- Main Container -->
    <div class="w-full max-w-5xl z-10 relative">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-0 rounded-2xl sm:rounded-[2.5rem] overflow-hidden shadow-xl shadow-emerald-900/10 border border-slate-200/50">

            {{-- LEFT PANEL: Branding (Only visible on desktop) --}}
            <div class="lg:col-span-2 hidden lg:flex relative flex-col justify-between p-10 overflow-hidden min-h-[600px]">
                <!-- Background image and lush emerald gradient overlay -->
                <div class="absolute inset-0">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=1200&auto=format&fit=crop"
                         class="w-full h-full object-cover" alt="Desa Asri">
                    <div class="absolute inset-0 bg-gradient-to-b from-emerald-900/80 via-emerald-800/70 to-teal-900/90"></div>
                    <div class="absolute inset-0 bg-[linear-gradient(135deg,rgba(16,185,129,0.35),rgba(20,184,166,0.35))]"></div>
                </div>

                <!-- Top branding -->
                <div class="relative z-10 animate-float-slow">
                    <div class="flex items-center gap-3 mb-10">
                        <div class="w-12 h-12 rounded-2xl bg-white/15 backdrop-blur-xl border border-white/25 flex items-center justify-center shadow-xl">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        </div>
                        <div>
                            <p class="text-emerald-100 text-xs font-black uppercase tracking-wider">Portal Warga</p>
                            <p class="text-white font-extrabold text-lg leading-tight">RT 08 / RW 02</p>
                        </div>
                    </div>

                    <h1 class="text-4xl font-extrabold text-white leading-tight mb-4 drop-shadow-sm">
                        Rukun, Asri<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 to-teal-100">
                            & Digital
                        </span>
                    </h1>
                    <p class="text-emerald-50 text-xs font-bold leading-relaxed">
                        Sistem informasi pelayanan warga RT 08 RW 02 Desa Penambangan yang ramah, transparan, cepat, dan modern.
                    </p>
                </div>

                <!-- Stats and features block -->
                <div class="relative z-10 space-y-4">
                    <div class="flex items-center gap-3 bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-4">
                        <div class="grid grid-cols-3 gap-2 w-full">
                            <div class="text-center">
                                <p class="text-white font-extrabold text-lg leading-none">100+</p>
                                <p class="text-emerald-100 text-[9px] font-black uppercase tracking-wider mt-1">Warga</p>
                            </div>
                            <div class="text-center border-x border-white/10">
                                <p class="text-white font-extrabold text-lg leading-none">24/7</p>
                                <p class="text-emerald-100 text-[9px] font-black uppercase tracking-wider mt-1">Online</p>
                            </div>
                            <div class="text-center">
                                <p class="text-white font-extrabold text-lg leading-none">4+</p>
                                <p class="text-emerald-100 text-[9px] font-black uppercase tracking-wider mt-1">Layanan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature bullets -->
                    <div class="space-y-2">
                        @foreach(['Pengajuan Surat Online', 'Pengaduan & Aspirasi', 'Informasi & Mading RT'] as $feat)
                        <div class="flex items-center gap-2.5 text-emerald-50 text-xs font-bold">
                            <div class="w-5 h-5 rounded-full bg-white/15 border border-white/25 flex items-center justify-center shrink-0">
                                <svg class="w-3 h-3 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            {{ $feat }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- RIGHT PANEL: Forms (Responsive for both Web and Mobile) --}}
            <div class="lg:col-span-3 glass-form px-5 py-8 sm:p-10 lg:p-12 flex flex-col justify-center min-h-0 lg:min-h-[600px]">

                <!-- Mobile branding (Visible on mobile only) -->
                <div class="lg:hidden mb-8 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-600 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-500/20 shrink-0">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <div>
                        <p class="text-[9px] text-emerald-700 font-black uppercase tracking-wider">Portal Warga</p>
                        <p class="font-extrabold text-slate-850">RT 08 / RW 02</p>
                    </div>
                </div>

                <div class="w-full max-w-md mx-auto">
                    @yield('content')
                </div>

                <p class="text-center text-slate-400 text-[10px] font-bold mt-10">
                    © {{ date('Y') }} Sistem Informasi RT 08 RW 02 • Ds. Penambangan
                </p>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
