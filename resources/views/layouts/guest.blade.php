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
            background: linear-gradient(135deg, #e8f5e9 0%, #e0f2f1 50%, #fef8e7 100%);
            overflow: hidden;
            pointer-events: none;
        }
        .bg-asri::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle 600px at 15% 15%, rgba(16,185,129,0.12) 0%, transparent 80%),
                radial-gradient(circle 500px at 85% 85%, rgba(20,184,166,0.1) 0%, transparent 80%),
                radial-gradient(circle 700px at 50% 50%, rgba(245,158,11,0.08) 0%, transparent 80%);
            animation: asri-glow 20s ease-in-out infinite alternate;
        }
        @keyframes asri-glow {
            0%   { opacity: 0.8; transform: scale(1) translate(0, 0); }
            50%  { opacity: 1.0; transform: scale(1.05) translate(15px, -15px); }
            100% { opacity: 0.8; transform: scale(1) translate(0, 0); }
        }

        /* Glowing background blobs for depth */
        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.55;
            pointer-events: none;
            z-index: 1;
        }
        .bg-blob-1 {
            width: 750px;
            height: 750px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.48) 0%, rgba(20, 184, 166, 0.05) 80%);
            top: -200px;
            left: -200px;
            animation: float-blob-1 25s infinite alternate ease-in-out;
        }
        .bg-blob-2 {
            width: 650px;
            height: 650px;
            background: radial-gradient(circle, rgba(20, 184, 166, 0.45) 0%, rgba(16, 185, 129, 0.05) 80%);
            bottom: -150px;
            right: -150px;
            animation: float-blob-2 20s infinite alternate ease-in-out;
        }
        .bg-blob-3 {
            width: 580px;
            height: 580px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.32) 0%, rgba(251, 191, 36, 0.02) 80%);
            top: 30%;
            left: 25%;
            animation: float-blob-3 30s infinite alternate ease-in-out;
        }

        @keyframes float-blob-1 {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(80px, 40px) scale(1.12); }
            100% { transform: translate(0, 0) scale(1); }
        }
        @keyframes float-blob-2 {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-60px, -80px) scale(1.08); }
            100% { transform: translate(0, 0) scale(1); }
        }
        @keyframes float-blob-3 {
            0% { transform: translate(0, 0) scale(1) rotate(0deg); }
            50% { transform: translate(45px, -60px) scale(1.15) rotate(180deg); }
            100% { transform: translate(0, 0) scale(1) rotate(360deg); }
        }

        /* Glassmorphic organic shapes */
        .glass-organic {
            position: absolute;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 8px 32px 0 rgba(16, 185, 129, 0.08);
            pointer-events: none;
            z-index: 2;
        }
        .shape-1 {
            width: 220px;
            height: 260px;
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            top: 10%;
            left: -50px;
            animation: morph-shape-1 20s infinite alternate ease-in-out;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.18) 0%, rgba(52, 211, 153, 0.05) 100%);
            border: 1.5px solid rgba(16, 185, 129, 0.35);
        }
        .shape-2 {
            width: 260px;
            height: 220px;
            border-radius: 50% 50% 60% 40% / 40% 50% 60% 50%;
            bottom: 8%;
            right: -60px;
            animation: morph-shape-2 24s infinite alternate ease-in-out;
            background: linear-gradient(135deg, rgba(20, 184, 166, 0.18) 0%, rgba(45, 212, 191, 0.05) 100%);
            border: 1.5px solid rgba(20, 184, 166, 0.35);
        }
        .shape-3 {
            width: 200px;
            height: 200px;
            border-radius: 40% 60% 30% 70% / 50% 30% 70% 50%;
            top: 55%;
            left: 55%;
            animation: morph-shape-3 22s infinite alternate ease-in-out;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(251, 191, 36, 0.05) 100%);
            border: 1.5px solid rgba(245, 158, 11, 0.3);
        }

        @keyframes morph-shape-1 {
            0% {
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
                transform: translate(0, 0) rotate(0deg) scale(1);
            }
            50% {
                border-radius: 40% 60% 50% 50% / 50% 60% 40% 60%;
                transform: translate(40px, 20px) rotate(120deg) scale(1.1);
            }
            100% {
                border-radius: 50% 50% 60% 40% / 40% 50% 60% 50%;
                transform: translate(-10px, -20px) rotate(240deg) scale(0.95);
            }
        }
        @keyframes morph-shape-2 {
            0% {
                border-radius: 50% 50% 60% 40% / 40% 50% 60% 50%;
                transform: translate(0, 0) rotate(0deg) scale(1);
            }
            50% {
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
                transform: translate(-30px, 40px) rotate(-90deg) scale(1.08);
            }
            100% {
                border-radius: 40% 60% 50% 50% / 50% 60% 40% 60%;
                transform: translate(20px, -10px) rotate(-180deg) scale(0.95);
            }
        }
        @keyframes morph-shape-3 {
            0% {
                border-radius: 40% 60% 30% 70% / 50% 30% 70% 50%;
                transform: translate(0, 0) rotate(0deg) scale(1);
            }
            50% {
                border-radius: 60% 40% 50% 50% / 40% 60% 50% 50%;
                transform: translate(-20px, -30px) rotate(120deg) scale(1.1);
            }
            100% {
                border-radius: 50% 50% 40% 60% / 50% 40% 60% 50%;
                transform: translate(15px, 20px) rotate(240deg) scale(0.95);
            }
        }

        /* Floating leaf-like green particles */
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            animation: float-particle linear infinite;
            opacity: 0.18;
            box-shadow: 0 0 8px rgba(16, 185, 129, 0.2);
            z-index: 3;
        }
        @keyframes float-particle {
            0%   { transform: translateY(100vh) rotate(0deg) scale(0.8); opacity: 0; }
            10%  { opacity: 0.18; }
            90%  { opacity: 0.18; }
            100% { transform: translateY(-10vh) rotate(360deg) scale(1.2); opacity: 0; }
        }

        /* Grid overlay with radial mask for center focus */
        .grid-overlay {
            background-image: linear-gradient(rgba(16,185,129,0.035) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(16,185,129,0.035) 1px, transparent 1px);
            background-size: 50px 50px;
            mask-image: radial-gradient(circle at center, black 30%, transparent 80%);
            -webkit-mask-image: radial-gradient(circle at center, black 30%, transparent 80%);
            z-index: 0;
        }

        /* Premium forms with glassmorphism and soft gradient tint */
        .glass-form {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.92) 0%, rgba(240, 253, 246, 0.86) 100%);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
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

        <!-- Glowing blobs for background richness -->
        <div class="bg-blob bg-blob-1"></div>
        <div class="bg-blob bg-blob-2"></div>
        <div class="bg-blob bg-blob-3"></div>

        <!-- Glassmorphic floating organic elements -->
        <div class="glass-organic shape-1"></div>
        <div class="glass-organic shape-2"></div>
        <div class="glass-organic shape-3"></div>

        <!-- Floating particles (Green leaves look) -->
        <div class="particle w-2.5 h-2.5 bg-emerald-300 left-[8%]" style="animation-duration:15s; animation-delay:0s;"></div>
        <div class="particle w-3.5 h-3.5 bg-teal-300 left-[22%]" style="animation-duration:18s; animation-delay:3s;"></div>
        <div class="particle w-2 h-2 bg-emerald-200 left-[58%]" style="animation-duration:12s; animation-delay:6s;"></div>
        <div class="particle w-3 h-3 bg-teal-200 left-[82%]" style="animation-duration:20s; animation-delay:1s;"></div>
        <div class="particle w-2.5 h-2.5 bg-emerald-400 left-[43%]" style="animation-duration:14s; animation-delay:8s;"></div>
        <div class="particle w-2.5 h-2.5 bg-amber-300 left-[68%]" style="animation-duration:16s; animation-delay:4s;"></div>
        <div class="particle w-2 h-2 bg-emerald-300 left-[90%]" style="animation-duration:17s; animation-delay:2s;"></div>
        <div class="particle w-3 h-3 bg-teal-300 left-[35%]" style="animation-duration:19s; animation-delay:7s;"></div>

        <!-- Cute Floating Background Clouds & Balloons (Festive upgrade) -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
            <style>
                @keyframes bg-cloud-move {
                    0% { transform: translateX(-150px) translateY(0); }
                    100% { transform: translateX(110vw) translateY(10px); }
                }
                @keyframes bg-balloon-float {
                    0% { transform: translateY(110vh) translateX(0) scale(0.65); opacity: 0; }
                    12% { opacity: 0.35; }
                    88% { opacity: 0.35; }
                    100% { transform: translateY(-15vh) translateX(40px) scale(0.85); opacity: 0; }
                }
                .bg-floating-cloud {
                    position: absolute;
                    opacity: 0.6;
                    animation: bg-cloud-move linear infinite;
                }
                .bg-floating-balloon {
                    position: absolute;
                    animation: bg-balloon-float linear infinite;
                }
            </style>
            
            <!-- Drifting Clouds -->
            <div class="bg-floating-cloud top-[12%]" style="animation-duration: 48s; animation-delay: 0s;">
                <svg width="110" height="70" viewBox="0 0 100 60" fill="#ffffff" opacity="0.8"><path d="M20 40 C20 30, 35 25, 45 35 C55 30, 70 35, 75 45 C85 45, 90 52, 85 60 L15 60 C5 60, 5 45, 20 40 Z"/></svg>
            </div>
            <div class="bg-floating-cloud top-[60%]" style="animation-duration: 56s; animation-delay: 18s;">
                <svg width="130" height="80" viewBox="0 0 120 70" fill="#ffffff" opacity="0.6"><path d="M25 45 C25 35, 40 30, 50 40 C62 35, 78 40, 85 50 C95 50, 100 58, 95 67 L20 67 C10 67, 10 52, 25 45 Z"/></svg>
            </div>

            <!-- Rising Balloons -->
            <div class="bg-floating-balloon left-[12%]" style="animation-duration: 26s; animation-delay: 1s;">
                <svg width="35" height="50" viewBox="0 0 30 45">
                    <ellipse cx="15" cy="18" rx="12" ry="15" fill="#f43f5e" />
                    <polygon points="15,33 12,36 18,36" fill="#f43f5e" />
                    <path d="M15 36 Q12 40 15 44" stroke="#94a3b8" stroke-width="1.2" fill="none" />
                </svg>
            </div>
            <div class="bg-floating-balloon left-[85%]" style="animation-duration: 29s; animation-delay: 9s;">
                <svg width="38" height="54" viewBox="0 0 30 45">
                    <ellipse cx="15" cy="18" rx="12" ry="15" fill="#fbbf24" />
                    <polygon points="15,33 12,36 18,36" fill="#fbbf24" />
                    <path d="M15 36 Q18 40 15 44" stroke="#94a3b8" stroke-width="1.2" fill="none" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="w-full max-w-md lg:max-w-5xl z-10 relative">
        <!-- Colorful ambient glow backing overlay -->
        <div class="absolute -inset-2 bg-gradient-to-r from-emerald-500/20 via-teal-500/20 to-amber-500/15 rounded-3xl sm:rounded-[2.7rem] blur-3xl opacity-80 pointer-events-none"></div>
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-0 rounded-2xl sm:rounded-[2.5rem] overflow-hidden shadow-xl shadow-emerald-900/10 border border-slate-200/50 relative">

            {{-- LEFT PANEL: Branding (Only visible on desktop) --}}
            <div class="lg:col-span-2 hidden lg:flex relative flex-col justify-between p-10 overflow-hidden min-h-[600px]">
                <!-- Background and lush emerald gradient overlay with cartoon portal SVG -->
                <div class="absolute inset-0 bg-gradient-to-b from-emerald-900 via-emerald-800 to-teal-950">
                    <!-- Glowing decorative blobs inside the panel -->
                    <div class="absolute top-1/4 left-1/4 w-72 h-72 rounded-full bg-emerald-500/25 blur-3xl"></div>
                    <div class="absolute bottom-1/4 right-1/4 w-72 h-72 rounded-full bg-teal-400/25 blur-3xl"></div>
                    
                    <!-- Portal Cartoon Illustration Background (Super Meriah Upgrade) -->
                    <div class="absolute inset-0 flex items-center justify-center opacity-85 lg:opacity-90 pointer-events-none select-none z-0">
                        <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full max-w-[340px] h-auto drop-shadow-[0_0_15px_rgba(16,185,129,0.3)]">
                            <style>
                                @keyframes portal-glow {
                                    0%, 100% { transform: scale(1); opacity: 0.9; filter: drop-shadow(0 0 5px #10b981); }
                                    50% { transform: scale(1.04); opacity: 1; filter: drop-shadow(0 0 15px #34d399); }
                                }
                                @keyframes floating-key {
                                    0%, 100% { transform: translateY(0) rotate(0deg); }
                                    50% { transform: translateY(-15px) rotate(8deg); }
                                }
                                @keyframes float-letter-1 {
                                    0% { transform: translate(0, 0) scale(0.5) rotate(0deg); opacity: 0; }
                                    15% { opacity: 1; }
                                    85% { opacity: 1; }
                                    100% { transform: translate(55px, -90px) scale(0.95) rotate(45deg); opacity: 0; }
                                }
                                @keyframes float-letter-2 {
                                    0% { transform: translate(0, 0) scale(0.5) rotate(0deg); opacity: 0; }
                                    15% { opacity: 1; }
                                    85% { opacity: 1; }
                                    100% { transform: translate(-45px, -100px) scale(0.9) rotate(-35deg); opacity: 0; }
                                }
                                @keyframes rotate-gear {
                                    0% { transform: rotate(0deg); }
                                    100% { transform: rotate(360deg); }
                                }
                                @keyframes rotate-gear-counter {
                                    0% { transform: rotate(360deg); }
                                    100% { transform: rotate(0deg); }
                                }
                                @keyframes star-blink-local {
                                    0%, 100% { transform: scale(0.8); opacity: 0.4; }
                                    50% { transform: scale(1.2); opacity: 1; }
                                }
                                @keyframes smoke-heart {
                                    0% { transform: translate(0, 0) scale(0.5); opacity: 0; }
                                    30% { opacity: 0.9; }
                                    100% { transform: translate(-10px, -45px) scale(1.2); opacity: 0; }
                                }
                                .portal-ring { animation: portal-glow 3.5s ease-in-out infinite; transform-origin: 200px 200px; }
                                .portal-key { animation: floating-key 2.5s ease-in-out infinite; transform-origin: 260px 170px; }
                                .portal-letter-1 { animation: float-letter-1 5s linear infinite; transform-origin: 180px 230px; }
                                .portal-letter-2 { animation: float-letter-2 4.5s linear infinite; animation-delay: 2.2s; transform-origin: 180px 230px; }
                                .portal-gear { animation: rotate-gear 20s linear infinite; transform-origin: 200px 200px; }
                                .portal-gear-inner { animation: rotate-gear-counter 12s linear infinite; transform-origin: 200px 200px; }
                                .portal-star { animation: star-blink-local 2s infinite ease-in-out; transform-origin: center; }
                                .portal-smoke { animation: smoke-heart 3s infinite linear; transform-origin: 167px 190px; }
                            </style>

                            <!-- STARS IN SKY -->
                            <path d="M50 80 L52 83 L55 84 L52 85 L50 88 L48 85 L45 84 L48 83 Z" fill="#fbbf24" class="portal-star" style="animation-delay: 0s;" />
                            <path d="M340 70 L342 73 L345 74 L342 75 L340 78 L338 75 L335 74 L338 73 Z" fill="#fbbf24" class="portal-star" style="animation-delay: 0.8s;" />
                            <path d="M90 120 L91 122 L93 123 L91 124 L90 126 L89 124 L87 123 L89 122 Z" fill="#38bdf8" class="portal-star" style="animation-delay: 0.4s;" />
                            <path d="M310 140 L311 142 L313 143 L311 144 L310 146 L309 144 L307 143 L309 142 Z" fill="#38bdf8" class="portal-star" style="animation-delay: 1.2s;" />

                            <!-- BACKGROUND GLOWING RINGS -->
                            <circle cx="200" cy="200" r="148" stroke="#10b981" stroke-width="2.5" stroke-dasharray="10 14" class="portal-gear" opacity="0.5" />
                            <circle cx="200" cy="200" r="132" stroke="#fbbf24" stroke-width="1.5" stroke-dasharray="6 8" class="portal-gear-inner" opacity="0.6" />
                            <circle cx="200" cy="200" r="120" fill="url(#portalGrad)" class="portal-ring" />
                            <circle cx="200" cy="200" r="120" stroke="#34d399" stroke-width="3" opacity="0.8" />

                            <!-- CHIMNEY SMOKE HEART -->
                            <path d="M166 185 C164 182, 161 182, 159 184 C157 186, 157 189, 159 191 L166 198 L173 191 C175 189, 175 186, 173 184 C171 182, 168 182, 166 185 Z" fill="#a7f3d0" class="portal-smoke" />
                            <path d="M166 185 C164 182, 161 182, 159 184 C157 186, 157 189, 159 191 L166 198 L173 191 C175 189, 175 186, 173 184 C171 182, 168 182, 166 185 Z" fill="#cbd5e1" class="portal-smoke" style="animation-delay: 1.5s;" />

                            <!-- CUTE NEIGHBORHOOD HOUSE -->
                            <path d="M110 260 C150 255 250 255 290 260 L290 270 L110 270 Z" fill="#047857" />
                            <rect x="140" y="190" width="80" height="70" rx="10" fill="#f8fafc" stroke="#10b981" stroke-width="2" />
                            <path d="M130 195 L180 145 C190 135 210 135 220 145 L270 195 Z" fill="#10b981" />
                            <!-- Chimney -->
                            <rect x="162" y="172" width="10" height="20" fill="#047857" />
                            <rect x="160" y="170" width="14" height="4" fill="#fbbf24" rx="1" />
                            
                            <circle cx="200" cy="140" r="8" fill="#fbbf24" />
                            <rect x="230" y="155" width="16" height="25" fill="#e2e8f0" />
                            <path d="M226 155 L246 155" stroke="#cbd5e1" stroke-width="3" />
                            <path d="M165 260 V215 C165 210 170 205 180 205 C190 205 195 210 195 215 V260 Z" fill="#0f766e" />
                            <circle cx="172" cy="235" r="3" fill="#fbbf24" />
                            <rect x="150" y="210" width="20" height="20" rx="4" fill="#fbbf24" opacity="0.9" />
                            <path d="M160 210 V230 M150 220 H170" stroke="#f59e0b" stroke-width="1.5" />

                            <!-- COZY TREES -->
                            <path d="M90 260C90 230 110 210 120 210C130 210 135 230 135 260Z" fill="#065f46" opacity="0.85" />
                            <path d="M285 260C285 235 298 220 305 220C312 220 315 235 315 260Z" fill="#065f46" opacity="0.85" />

                            <!-- FLOATING LETTERS -->
                            <g class="portal-letter-1">
                                <rect x="175" y="225" width="24" height="16" rx="3" fill="#ffffff" filter="url(#shadow-portal-small)" />
                                <path d="M175 225 L187 233 L199 225" stroke="#10b981" stroke-width="2" />
                            </g>
                            <g class="portal-letter-2">
                                <rect x="175" y="225" width="24" height="16" rx="3" fill="#e0f2fe" filter="url(#shadow-portal-small)" />
                                <path d="M175 225 L187 233 L199 225" stroke="#38bdf8" stroke-width="2" />
                            </g>

                            <!-- FLOATING SECURITY KEY (Vibrant yellow and orange) -->
                            <g class="portal-key">
                                <circle cx="260" cy="160" r="14" stroke="#fbbf24" stroke-width="5" fill="#fef08a" />
                                <circle cx="260" cy="160" r="5" fill="#d97706" />
                                <rect x="257" y="174" width="6" height="24" rx="2.5" fill="#fbbf24" />
                                <rect x="263" y="184" width="8" height="5" rx="1.5" fill="#fbbf24" />
                                <rect x="263" y="193" width="6" height="5" rx="1.5" fill="#fbbf24" />
                            </g>

                            <!-- GRADIENT & SHADOW DEFINITIONS -->
                            <defs>
                                <radialGradient id="portalGrad" cx="50%" cy="50%" r="50%">
                                    <stop offset="0%" stop-color="#10b981" stop-opacity="0.4"/>
                                    <stop offset="65%" stop-color="#115e59" stop-opacity="0.12"/>
                                    <stop offset="100%" stop-color="#115e59" stop-opacity="0"/>
                                </radialGradient>
                                <filter id="shadow-portal-small" x="-2" y="-1" width="28" height="20" filterUnits="userSpaceOnUse">
                                    <feDropShadow dx="0" dy="2" stdDeviation="2" flood-color="#047857" flood-opacity="0.1" />
                                </filter>
                            </defs>
                        </svg>
                    </div>
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
