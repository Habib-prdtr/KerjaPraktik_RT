@extends('layouts.warga')

@section('title', 'Beranda Warga — Portal Resmi RT 08 RW 02')

@section('content')
<div class="space-y-6 pb-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- ====== HERO SECTION (WELCOME BANNER) ====== --}}
    <div class="hero-warga rounded-[2.5rem] shadow-xl shadow-emerald-900/10 relative overflow-hidden">
        <!-- Festive Floating Balloons, Confetti & Sparkles Background -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden select-none z-0">
            <!-- Styles for festive elements -->
            <style>
                @keyframes float-balloon {
                    0% { transform: translateY(120%) translateX(0) rotate(0deg); opacity: 0; }
                    10% { opacity: 0.35; }
                    90% { opacity: 0.35; }
                    100% { transform: translateY(-120%) translateX(20px) rotate(15deg); opacity: 0; }
                }
                @keyframes confetti-fall {
                    0% { transform: translateY(-10px) rotate(0deg); opacity: 0.8; }
                    100% { transform: translateY(320px) rotate(720deg); opacity: 0; }
                }
                .asri-balloon {
                    position: absolute;
                    border-radius: 50%;
                    animation: float-balloon linear infinite;
                }
                .confetti-particle {
                    position: absolute;
                    top: -10px;
                    width: 7px;
                    height: 7px;
                    border-radius: 1.5px;
                    animation: confetti-fall 4s linear infinite;
                }
            </style>
            
            <!-- Confetti Rain (20 colorful elements) -->
            <div class="confetti-particle bg-red-400" style="left: 5%; animation-duration: 3.5s; animation-delay: 0s;"></div>
            <div class="confetti-particle bg-amber-400" style="left: 15%; animation-duration: 4.5s; animation-delay: 1.5s;"></div>
            <div class="confetti-particle bg-teal-300" style="left: 25%; animation-duration: 3.8s; animation-delay: 0.5s;"></div>
            <div class="confetti-particle bg-indigo-400" style="left: 35%; animation-duration: 4.2s; animation-delay: 2.5s;"></div>
            <div class="confetti-particle bg-rose-400" style="left: 45%; animation-duration: 3.6s; animation-delay: 1s;"></div>
            <div class="confetti-particle bg-emerald-400" style="left: 55%; animation-duration: 4s; animation-delay: 3s;"></div>
            <div class="confetti-particle bg-yellow-300" style="left: 65%; animation-duration: 4.4s; animation-delay: 0.2s;"></div>
            <div class="confetti-particle bg-sky-400" style="left: 75%; animation-duration: 3.7s; animation-delay: 1.8s;"></div>
            <div class="confetti-particle bg-purple-400" style="left: 85%; animation-duration: 4.1s; animation-delay: 0.8s;"></div>
            <div class="confetti-particle bg-pink-400" style="left: 95%; animation-duration: 4.3s; animation-delay: 2.2s;"></div>
            <div class="confetti-particle bg-emerald-300" style="left: 10%; animation-duration: 3.9s; animation-delay: 2.8s;"></div>
            <div class="confetti-particle bg-amber-300" style="left: 30%; animation-duration: 4.6s; animation-delay: 0.7s;"></div>
            <div class="confetti-particle bg-teal-400" style="left: 50%; animation-duration: 3.5s; animation-delay: 2.1s;"></div>
            <div class="confetti-particle bg-rose-300" style="left: 70%; animation-duration: 4.2s; animation-delay: 1.2s;"></div>
            <div class="confetti-particle bg-indigo-300" style="left: 90%; animation-duration: 3.8s; animation-delay: 0.3s;"></div>

            <!-- Balloon 1 (Red) -->
            <div class="asri-balloon w-8 h-10 bg-red-400 bottom-0 left-[12%]" style="animation-duration: 9s; animation-delay: 0s;">
                <div class="absolute bottom-[-3px] left-[13px] w-1.5 h-1.5 bg-red-500 rotate-45"></div>
                <div class="absolute bottom-[-15px] left-[14px] w-[1px] h-4 bg-white/40"></div>
            </div>
            <!-- Balloon 2 (Gold) -->
            <div class="asri-balloon w-10 h-12 bg-amber-400 bottom-0 left-[42%]" style="animation-duration: 11s; animation-delay: 2.5s;">
                <div class="absolute bottom-[-3px] left-[17px] w-1.5 h-1.5 bg-amber-500 rotate-45"></div>
                <div class="absolute bottom-[-18px] left-[18px] w-[1px] h-5 bg-white/40"></div>
            </div>
            <!-- Balloon 3 (Teal) -->
            <div class="asri-balloon w-9 h-11 bg-teal-300 bottom-0 left-[72%]" style="animation-duration: 10s; animation-delay: 1.2s;">
                <div class="absolute bottom-[-3px] left-[15px] w-1.5 h-1.5 bg-teal-400 rotate-45"></div>
                <div class="absolute bottom-[-16px] left-[16px] w-[1px] h-4.5 bg-white/40"></div>
            </div>
            <!-- Twinkling Sparkles Background -->
            <div class="absolute top-[20%] left-[28%] w-3 h-3 bg-amber-200 rounded-full animate-ping" style="animation-duration: 3.5s;"></div>
            <div class="absolute top-[50%] left-[62%] w-2 h-2 bg-white rounded-full animate-ping" style="animation-duration: 4.5s;"></div>
        </div>

        <div class="relative z-10 px-6 py-10 md:px-12 md:py-14">
            <!-- Warm decorative glow orbs -->
            <div class="absolute top-0 right-0 w-80 h-80 bg-teal-400/20 rounded-full blur-3xl -translate-y-1/3 translate-x-1/4 pointer-events-none"></div>
            <div class="absolute bottom-0 left-10 w-48 h-48 bg-emerald-400/20 rounded-full blur-3xl translate-y-1/3 pointer-events-none"></div>

            <!-- Si Asri Mascot & Chat Bubble -->
            <div id="asri-mascot-container" class="absolute right-4 top-4 lg:right-72 lg:top-auto lg:bottom-0 w-24 h-24 lg:w-44 lg:h-44 pointer-events-auto cursor-pointer z-20 group/asri">
                <!-- Speech Bubble -->
                <div class="absolute -top-12 left-1/2 -translate-x-1/2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-[10px] lg:text-xs font-black px-4 py-2 rounded-full shadow-2xl border border-white/20 opacity-0 scale-75 pointer-events-none transition-all duration-300 group-hover/asri:opacity-100 group-hover/asri:scale-100 group-hover/asri:-top-16 select-none whitespace-nowrap z-30">
                    Halo, Tetangga! 👋
                    <div class="absolute bottom-[-4px] left-1/2 -translate-x-1/2 w-2 h-2 bg-teal-500 border-r border-b border-white/20 rotate-45"></div>
                </div>
                <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-lg">
                    <!-- Styles for Si Asri -->
                    <style>
                        @keyframes asri-bob {
                            0%, 100% { transform: translateY(0); }
                            50% { transform: translateY(-8px); }
                        }
                        @keyframes asri-jump {
                            0%, 100% { transform: translateY(0) scale(1); }
                            30% { transform: translateY(-20px) scale(0.95); }
                            50% { transform: translateY(0) scale(1.05); }
                            70% { transform: translateY(-6px) scale(0.98); }
                        }
                        @keyframes asri-wave {
                            0%, 100% { transform: rotate(0deg); }
                            50% { transform: rotate(-15deg); }
                        }
                        @keyframes asri-wave-fast {
                            0%, 100% { transform: rotate(0deg); }
                            50% { transform: rotate(-35deg); }
                        }
                        @keyframes asri-eye-blink {
                            0%, 90%, 100% { transform: scaleY(1); }
                            95% { transform: scaleY(0.1); }
                        }
                        @keyframes bird-wing-flap-fast {
                            0%, 100% { transform: rotate(0deg); }
                            50% { transform: rotate(-25deg); }
                        }
                        @keyframes bird-fly-up {
                            0% { transform: translate(0, 0) scale(1); opacity: 1; }
                            100% { transform: translate(-30px, -45px) scale(0.8); opacity: 0; }
                        }
                        @keyframes sparkle-burst {
                            0% { opacity: 0; transform: scale(0.5); }
                            50% { opacity: 1; transform: scale(1.1); }
                            100% { opacity: 0; transform: scale(0.5); }
                        }

                        .asri-bob-anim { animation: asri-bob 4s ease-in-out infinite; }
                        .asri-arm-anim { animation: asri-wave 2.5s ease-in-out infinite; transform-origin: 60px 120px; }
                        .asri-eye-anim { animation: asri-eye-blink 5s infinite; transform-origin: 100px 78px; }
                        .asri-bird-wing-anim { transform-origin: 96px 28px; }

                        /* Hover interactive jumping & fast waving */
                        #asri-mascot-container:hover .asri-bob-anim {
                            animation: asri-jump 0.9s ease-in-out infinite;
                        }
                        #asri-mascot-container:hover .asri-arm-anim {
                            animation: asri-wave-fast 0.6s ease-in-out infinite;
                        }
                        #asri-mascot-container:hover .asri-bird-anim {
                            animation: bird-fly-up 0.8s forwards ease-out;
                        }
                        #asri-mascot-container:hover .asri-bird-wing-anim {
                            animation: bird-wing-flap-fast 0.2s infinite;
                        }
                        #asri-mascot-container:hover .asri-sparkles {
                            animation: sparkle-burst 1.2s ease-in-out infinite;
                            transform-origin: 100px 100px;
                        }
                    </style>

                    <!-- MAGIC SPARKLES BURST (Lower z-index) -->
                    <g class="asri-sparkles" opacity="0">
                        <path d="M50 70 L52 75 L57 77 L52 79 L50 84 L48 79 L43 77 L48 75 Z" fill="#fbbf24" />
                        <path d="M150 70 L152 75 L157 77 L152 79 L150 84 L148 79 L143 77 L148 75 Z" fill="#fbbf24" />
                        <path d="M60 40 L62 43 L66 45 L62 47 L60 50 L58 47 L54 45 L58 43 Z" fill="#fbbf24" />
                        <path d="M140 40 L142 43 L146 45 L142 47 L140 50 L138 47 L134 45 L138 43 Z" fill="#fbbf24" />
                    </g>

                    <g class="asri-bob-anim">
                        <!-- BODY / SHIRT (Batik style) -->
                        <path d="M60 135C60 115 70 105 100 105C130 105 140 115 140 135V180H60V135Z" fill="#047857" />
                        <!-- Batik patterns -->
                        <circle cx="80" cy="125" r="3" fill="#a7f3d0" opacity="0.8"/>
                        <circle cx="120" cy="125" r="3" fill="#a7f3d0" opacity="0.8"/>
                        <circle cx="100" cy="140" r="4.5" fill="#fbbf24" opacity="0.9"/>
                        <circle cx="80" cy="155" r="3" fill="#a7f3d0" opacity="0.8"/>
                        <circle cx="120" cy="155" r="3" fill="#a7f3d0" opacity="0.8"/>
                        <path d="M96 155 L104 155 M100 151 L100 159" stroke="#a7f3d0" stroke-width="1.5"/>

                        <!-- COLLAR -->
                        <path d="M85 105L100 120L115 105" stroke="#fef08a" stroke-width="3" stroke-linecap="round"/>

                        <!-- LEFT HAND (Resting/holding side) -->
                        <path d="M140 120C150 130 155 140 150 150C148 154 143 153 140 150L135 135" stroke="#047857" stroke-width="14" stroke-linecap="round"/>
                        <circle cx="150" cy="152" r="7" fill="#fbcfe8" />

                        <!-- RIGHT ARM & HAND (Waving) -->
                        <g class="asri-arm-anim">
                            <path d="M60 120C45 110 32 90 38 75" stroke="#047857" stroke-width="14" stroke-linecap="round"/>
                            <circle cx="36" cy="70" r="9" fill="#fbcfe8" />
                            <path d="M30 63C29 59 31 56 34 57" stroke="#fbcfe8" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M36 61C35 57 37 54 40 55" stroke="#fbcfe8" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M42 63C42 59 44 56 47 58" stroke="#fbcfe8" stroke-width="2.5" stroke-linecap="round"/>
                        </g>

                        <!-- HEAD (Skin) -->
                        <circle cx="100" cy="78" r="36" fill="#fbcfe8" />

                        <!-- EARS -->
                        <circle cx="63" cy="80" r="7" fill="#fbcfe8" />
                        <circle cx="137" cy="80" r="7" fill="#fbcfe8" />

                        <!-- HAIR (Under Peci) -->
                        <path d="M68 63C75 53 125 53 132 63C132 63 120 50 100 50C80 50 68 63 68 63Z" fill="#1e293b" />

                        <!-- PECI (Indonesian cap) -->
                        <path d="M66 58 C66 42 75 39 100 39 C125 39 134 42 134 58 Z" fill="#0f172a" />
                        <!-- Golden Peci accent -->
                        <path d="M66 56 L134 56" stroke="#fbbf24" stroke-width="1.5"/>
                        <path d="M100 39 L100 46" stroke="#fbbf24" stroke-width="1.5" stroke-linecap="round"/>

                        <!-- CUTE BLUEBIRD ON PECI -->
                        <g class="asri-bird-anim">
                            <circle cx="100" cy="28" r="8" fill="#38bdf8" />
                            <circle cx="103" cy="26" r="1.5" fill="#1e293b" />
                            <polygon points="107,26 112,28 107,30" fill="#f59e0b" />
                            <!-- Wing -->
                            <path d="M96 28 C92 25 90 28 92 32 Z" fill="#0284c7" class="asri-bird-wing-anim" />
                            <!-- Legs -->
                            <path d="M98 34 Q94 37 96 40" stroke="#f59e0b" stroke-width="1" stroke-linecap="round" />
                            <path d="M102 34 Q98 37 100 40" stroke="#f59e0b" stroke-width="1" stroke-linecap="round" />
                        </g>

                        <!-- EYES -->
                        <g class="asri-eye-anim">
                            <circle cx="87" cy="78" r="5.5" fill="#0f172a" />
                            <circle cx="85" cy="76" r="1.8" fill="white" />
                            <circle cx="113" cy="78" r="5.5" fill="#0f172a" />
                            <circle cx="111" cy="76" r="1.8" fill="white" />
                        </g>

                        <!-- CHEEKS (Blush) -->
                        <circle cx="78" cy="86" r="5" fill="#f472b6" opacity="0.5" />
                        <circle cx="122" cy="86" r="5" fill="#f472b6" opacity="0.5" />

                        <!-- SMILE -->
                        <path d="M92 88C92 93 108 93 108 88" stroke="#be185d" stroke-width="2.5" stroke-linecap="round" fill="none" />
                    </g>
                </svg>
            </div>

            <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
                <!-- Greeting -->
                <div class="flex items-center gap-5">
                    <div class="relative shrink-0">
                        <div class="w-20 h-20 md:w-24 md:h-24 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shadow-xl">
                            <span class="text-white text-4xl md:text-5xl font-black">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                        @if($warga)
                        <div class="absolute -bottom-1.5 -right-1.5 w-6 h-6 bg-emerald-400 border-2 border-white rounded-full flex items-center justify-center shadow-md">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        @endif
                    </div>
                    <div>
                        @php
                            $hour = (int)date('H');
                            $greeting = $hour < 11 ? 'Selamat Pagi' : ($hour < 15 ? 'Selamat Siang' : ($hour < 19 ? 'Selamat Sore' : 'Selamat Malam'));
                            $greetEmoji = match(true) {
                                $hour < 11 => '<svg class="w-4 h-4 inline-block text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>',
                                $hour < 15 => '<svg class="w-4 h-4 inline-block text-sky-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 15h1m15 0h1m-1-4a7 7 0 10-14 0m14 0c0 1.93-1.57 3.5-3.5 3.5H6.5C4.57 18.5 3 16.93 3 15s1.57-3.5 3.5-3.5h.1C7.16 8.54 9.38 6.5 12 6.5c2.62 0 4.84 2.04 5.4 4.5h.1c1.93 0 3.5 1.57 3.5 3.5z"/></svg>',
                                $hour < 19 => '<svg class="w-4 h-4 inline-block text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>',
                                default => '<svg class="w-4 h-4 inline-block text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>',
                            };
                        @endphp
                        <p class="text-emerald-200 text-xs font-black uppercase tracking-widest mb-1 flex items-center gap-1.5">{{ $greeting }} {!! $greetEmoji !!} Bapak/Ibu</p>
                        <h1 class="text-white text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight mb-3">
                            {{ Auth::user()->name }}
                        </h1>
                        <div class="flex items-center gap-2 flex-wrap">
                            @if($warga)
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-400/25 border border-emerald-400/30 text-emerald-100 text-xs font-bold shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Data Warga Terverifikasi
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-amber-400/25 border border-amber-400/30 text-amber-200 text-xs font-bold shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Belum Terverifikasi RT
                            </span>
                            @endif
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-white/10 border border-white/15 text-white/80 text-xs font-semibold">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                Lingkungan RT 08 / RW 02
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Info panel & Date -->
                <div class="bg-white/10 backdrop-blur-xl border border-white/15 rounded-2xl p-5 w-full lg:w-auto lg:min-w-[240px] text-white">
                    <p class="text-emerald-200 text-[10px] font-black uppercase tracking-widest mb-0.5">Hari & Tanggal</p>
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="font-extrabold text-xl leading-tight">{{ now()->translatedFormat('l, d F Y') }}</p>
                    </div>
                    @if($warga)
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-white/10 rounded-xl p-3 text-center border border-white/5">
                            <p class="font-black text-2xl leading-none text-emerald-200">{{ $suratSaya->count() }}</p>
                            <p class="text-white/70 text-[9px] font-bold uppercase tracking-wider mt-1.5">Surat Saya</p>
                        </div>
                        <div class="bg-white/10 rounded-xl p-3 text-center border border-white/5">
                            <p class="font-black text-2xl leading-none text-amber-300">{{ $pengaduanSaya->count() }}</p>
                            <p class="text-white/70 text-[9px] font-bold uppercase tracking-wider mt-1.5">Laporan Saya</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(!$warga)
    {{-- Alert belum terverifikasi - Cozy Warm Amber Box --}}
    <div class="bg-amber-50 border border-amber-200 rounded-3xl p-6 flex items-start gap-4 shadow-sm">
        <div class="w-12 h-12 rounded-2xl bg-amber-100 border border-amber-200 flex items-center justify-center shrink-0 text-amber-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <div>
            <h3 class="font-extrabold text-amber-950 text-base mb-1">Akun Warga Belum Aktif Sepenuhnya</h3>
            <p class="text-sm font-medium text-amber-800 leading-relaxed">
                Untuk dapat menggunakan layanan online seperti **pengajuan surat pengantar** dan **pengiriman aduan warga**, akun Anda perlu dihubungkan dengan data kependudukan resmi RT. Silakan hubungi Pak RT/Pengurus RT untuk proses verifikasi data Kartu Keluarga Anda. Terima kasih atas pengertiannya!
            </p>
        </div>
    </div>
    @endif

    {{-- ====== QUICK ACTIONS (BENTO LAYANAN DESA) ====== --}}
    <div class="card-premium p-6 md:p-8 bg-white">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xs font-black text-emerald-700 uppercase tracking-widest mb-0.5">Layanan Warga RT</h2>
                <h3 class="text-lg font-extrabold text-slate-800">Mau mengurus apa hari ini?</h3>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $services = [
                    [
                        'href' => route('warga.surat.create'),
                        'label' => 'Buat Surat Pengantar',
                        'subtext' => 'Urus administrasi cepat secara online',
                        'emoji' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
                        'light' => 'bg-emerald-50 text-emerald-700 border-emerald-100 group-hover:bg-emerald-600 group-hover:text-white',
                        'hover_bg' => 'hover:border-emerald-200 hover:shadow-emerald-500/5'
                    ],
                    [
                        'href' => route('warga.pengaduan.create'),
                        'label' => 'Lapor Masalah / Usulan',
                        'subtext' => 'Laporkan kerusakan jalan, lampu mati, dll',
                        'emoji' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>',
                        'light' => 'bg-amber-50 text-amber-700 border-amber-100 group-hover:bg-amber-500 group-hover:text-white',
                        'hover_bg' => 'hover:border-amber-200 hover:shadow-amber-500/5'
                    ],
                    [
                        'href' => route('warga.pengumuman.index'),
                        'label' => 'Mading Pengumuman',
                        'subtext' => 'Baca berita & pengumuman terbaru RT',
                        'emoji' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>',
                        'light' => 'bg-teal-50 text-teal-700 border-teal-100 group-hover:bg-teal-600 group-hover:text-white',
                        'hover_bg' => 'hover:border-teal-200 hover:shadow-teal-500/5'
                    ],
                    [
                        'href' => route('warga.kegiatan.index'),
                        'label' => 'Agenda Kegiatan RT',
                        'subtext' => 'Jadwal kerja bakti, posyandu, & rapat',
                        'emoji' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
                        'light' => 'bg-rose-50 text-rose-700 border-rose-100 group-hover:bg-rose-600 group-hover:text-white',
                        'hover_bg' => 'hover:border-rose-200 hover:shadow-rose-500/5'
                    ],
                ];
            @endphp
            @foreach($services as $svc)
            <a href="{{ $svc['href'] }}" data-bento-index="{{ $loop->index }}"
               class="bento-card bento-hover bg-slate-50/50 hover:bg-white rounded-2xl p-5 border border-slate-100 flex flex-col gap-4 group cursor-pointer shadow-sm hover:shadow-xl transition-all duration-300 {{ $svc['hover_bg'] }} relative">
                <div class="w-14 h-14 rounded-2xl {{ $svc['light'] }} border flex items-center justify-center transition-all duration-300 shadow-sm shrink-0">
                    {!! $svc['emoji'] !!}
                </div>
                <div>
                    <span class="block text-[15px] font-extrabold text-slate-800 group-hover:text-emerald-700 transition-colors leading-snug mb-1">{{ $svc['label'] }}</span>
                    <span class="block text-xs text-slate-500 font-medium leading-relaxed">{{ $svc['subtext'] }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    {{-- ====== MAIN GRID (LETTER STATUS & ANNOUNCEMENT) ====== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        @if($warga)
        {{-- ====== LIST SURAT SAYA ====== --}}
        <div class="card-premium p-6 flex flex-col bg-white">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-md shadow-emerald-500/25">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-base font-extrabold text-slate-800 leading-none">Surat Pengantar Saya</h2>
                        <p class="text-[11px] text-slate-400 font-bold mt-1">Status pembuatan surat aktif</p>
                    </div>
                </div>
                <a href="{{ route('warga.surat.index') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-800 transition-colors flex items-center gap-1">
                    Lihat Semua <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="flex-1 flex flex-col gap-3">
                @if($suratSaya->isEmpty())
                <div class="flex-1 rounded-2xl border border-dashed border-slate-200 flex flex-col items-center justify-center p-8 text-center bg-slate-50/50">
                    <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    <p class="text-sm font-bold text-slate-600 mb-2">Bapak/Ibu belum pernah mengajukan surat</p>
                    <a href="{{ route('warga.surat.create') }}" class="text-xs font-black text-emerald-600 hover:text-emerald-800">Ajukan Surat Pertama →</a>
                </div>
                @else
                    @foreach($suratSaya->take(3) as $surat)
                    @php
                        $statusCls = match($surat->status) {
                            'diajukan' => 'pill-pending',
                            'diproses' => 'pill-diproses',
                            'selesai'  => 'pill-selesai',
                            'ditolak'  => 'pill-ditolak',
                            default    => 'pill-pending',
                        };
                        $statusLabel = match($surat->status) {
                            'diajukan' => 'Menunggu RT',
                            'diproses' => 'Sedang Dibuat',
                            'selesai'  => 'Siap Diambil',
                            'ditolak'  => 'Perlu Perbaikan',
                            default    => 'Diajukan',
                        };
                        $friendlyHint = match($surat->status) {
                            'diajukan' => '<svg class="w-4 h-4 inline-block -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Sedang menunggu antrean pemeriksaan Pak RT.',
                            'diproses' => '<svg class="w-4 h-4 inline-block -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg> Sedang dalam pengetikan/penandatanganan berkas.',
                            'selesai'  => '<svg class="w-4 h-4 inline-block -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Surat siap! Ambil fisik di rumah RT atau unduh detail.',
                            'ditolak'  => '<svg class="w-4 h-4 inline-block -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Ada data yang salah. Silakan periksa detail surat.',
                            default    => '',
                        };
                    @endphp
                    <a href="{{ route('warga.surat.show', $surat) }}"
                       class="block p-4 rounded-2xl border border-slate-100 hover:border-emerald-200 hover:bg-emerald-50/20 transition-all group">
                        <div class="flex items-center gap-3 justify-between">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0 text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-extrabold text-slate-800 truncate group-hover:text-emerald-700 transition-colors leading-tight">{{ $surat->jenis_surat }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold mt-1">Diajukan: {{ $surat->created_at->translatedFormat('d M Y') }}</p>
                                </div>
                            </div>
                            <span class="{{ $statusCls }} text-[9px] font-black px-2.5 py-1 rounded-lg uppercase tracking-wider shrink-0">{{ $statusLabel }}</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium mt-2.5 pt-2 border-t border-dashed border-slate-100 leading-normal flex items-start gap-1.5">{!! $friendlyHint !!}</p>
                    </a>
                    @endforeach
                @endif
            </div>
        </div>
        @endif

        {{-- ====== PAPAN MADING PENGUMUMAN ====== --}}
        <div class="card-premium p-6 flex flex-col bg-white">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-500 to-emerald-600 flex items-center justify-center shadow-md shadow-teal-500/25">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-base font-extrabold text-slate-800 leading-none">Mading Pengumuman RT</h2>
                        <p class="text-[11px] text-slate-400 font-bold mt-1">Kabar & edaran resmi pengurus RT</p>
                    </div>
                </div>
                <a href="{{ route('warga.pengumuman.index') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-800 transition-colors flex items-center gap-1">
                    Lihat Semua <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="flex-1 flex flex-col gap-3">
                @if($pengumumanTerbaru->isEmpty())
                <div class="flex-1 rounded-2xl border border-dashed border-slate-200 flex flex-col items-center justify-center p-8 text-center bg-slate-50/50">
                    <svg class="w-12 h-12 text-slate-300 mb-3 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    <p class="text-sm font-bold text-slate-600">Saat ini belum ada pengumuman baru</p>
                </div>
                @else
                    <div class="flex flex-col gap-3">
                        @foreach($pengumumanTerbaru->take(3) as $umum)
                        <a href="{{ route('warga.pengumuman.show', $umum) }}"
                           class="group block rounded-2xl bg-slate-50 border border-slate-100 hover:bg-emerald-50/20 hover:border-emerald-200 transition-all overflow-hidden">
                            @if($umum->foto)
                                <div class="h-36 overflow-hidden relative">
                                    <img src="{{ Str::startsWith($umum->foto, 'http') ? $umum->foto : Storage::url($umum->foto) }}"
                                         alt="{{ $umum->judul }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                            @endif
                            <div class="p-4">
                                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">{{ \Carbon\Carbon::parse($umum->tanggal)->translatedFormat('d M Y') }}</p>
                                <p class="text-sm font-extrabold text-slate-800 leading-tight line-clamp-1 group-hover:text-emerald-700 transition-colors">{{ $umum->judul }}</p>
                                <p class="text-xs text-slate-500 mt-1.5 leading-relaxed line-clamp-2">{{ Str::limit(strip_tags($umum->isi), 90) }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ====== UPCOMING AGENDA (KEGIATAN MENDATANG) ====== --}}
    @if($kegiatanMendatang->isNotEmpty())
    <div class="card-premium p-6 md:p-8 bg-white">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-500 to-orange-500 flex items-center justify-center shadow-md shadow-rose-500/25">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h2 class="text-base font-extrabold text-slate-800">Kegiatan Warga Terdekat</h2>
                    <p class="text-xs text-slate-400 font-bold">Jangan lupa catat tanggalnya dan ikut serta ya!</p>
                </div>
            </div>
            <a href="{{ route('warga.kegiatan.index') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-800 transition-colors flex items-center gap-1">
                Lihat Semua <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach($kegiatanMendatang as $k)
            <a href="{{ route('warga.kegiatan.show', $k) }}"
               class="group relative overflow-hidden rounded-3xl bg-white border border-slate-100 hover:-translate-y-2 hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-300 flex flex-col justify-between">
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-rose-50 border border-rose-100 rounded-xl px-3 py-1.5 flex items-center gap-2">
                            <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-[10px] font-black text-rose-700 uppercase tracking-widest">{{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d M Y') }}</span>
                        </div>
                    </div>
                    <h3 class="text-slate-800 font-extrabold text-base leading-snug line-clamp-2 mb-4 group-hover:text-emerald-700 transition-colors">{{ $k->nama_kegiatan }}</h3>
                </div>
                <div class="px-6 py-4 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-1.5 text-slate-500 text-xs font-semibold min-w-0">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="truncate">{{ $k->lokasi }}</span>
                    </div>
                    <span class="text-emerald-600 font-extrabold text-xs shrink-0 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-all">
                        Ikut <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ====== ESCAPING HIDE-AND-SEEK CAT MASCOT HTML ====== --}}
    <div id="escaping-cat" class="absolute z-20 pointer-events-none cursor-pointer select-none transition-all duration-300 ease-out transform translate-y-8 opacity-0 scale-75" style="width: 60px; height: 60px; top: 0; left: 50%; margin-left: -30px; display: none;">
        <!-- Speech Bubble above Cat -->
        <div id="cat-bubble" class="absolute -top-10 left-1/2 -translate-x-1/2 bg-amber-500 text-white text-[9px] font-black px-2 py-1 rounded-md shadow-md opacity-0 scale-75 transition-all duration-200 pointer-events-none whitespace-nowrap z-30">
            Tangkap aku! 🐾
            <div class="absolute bottom-[-3px] left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-amber-500 rotate-45"></div>
        </div>
        
        <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-md">
            <style>
                @keyframes cat-ears {
                    0%, 100% { transform: rotate(0deg); }
                    50% { transform: rotate(-5deg); }
                }
                .cat-left-ear { animation: cat-ears 3s infinite; transform-origin: 20px 20px; }
                .cat-right-ear { animation: cat-ears 3s infinite alternate; transform-origin: 80px 20px; }
            </style>
            <!-- Cat Ears -->
            <path d="M15 35 L5 10 L35 22 Z" fill="#f97316" stroke="#ea580c" stroke-width="2" class="cat-left-ear" />
            <path d="M10 20 L8 12 L20 18 Z" fill="#fecdd3" class="cat-left-ear" />

            <path d="M85 35 L95 10 L65 22 Z" fill="#f97316" stroke="#ea580c" stroke-width="2" class="cat-right-ear" />
            <path d="M90 20 L92 12 L80 18 Z" fill="#fecdd3" class="cat-right-ear" />

            <!-- Cat Head -->
            <circle cx="50" cy="50" r="32" fill="#f97316" stroke="#ea580c" stroke-width="2" />
            
            <!-- Cat Eyes (Large expressive eyes) -->
            <circle cx="36" cy="46" r="6" fill="#1e293b" />
            <circle cx="34" cy="43" r="2" fill="#ffffff" />
            
            <circle cx="64" cy="46" r="6" fill="#1e293b" />
            <circle cx="62" cy="43" r="2" fill="#ffffff" />
            
            <!-- Cat Cheeks -->
            <circle cx="28" cy="54" r="3" fill="#f43f5e" opacity="0.4" />
            <circle cx="72" cy="54" r="3" fill="#f43f5e" opacity="0.4" />
            
            <!-- Nose & Mouth -->
            <polygon points="50,53 47,50 53,50" fill="#f43f5e" />
            <path d="M46 56 C48 58 50 58 50 56 C50 58 52 58 54 56" stroke="#ea580c" stroke-width="2" stroke-linecap="round" fill="none" />
            
            <!-- Whiskers -->
            <path d="M20 50 H6 M22 55 H8 M20 60 H10" stroke="#fed7aa" stroke-width="1.5" stroke-linecap="round" />
            <path d="M80 50 H94 M78 55 H92 M80 60 H90" stroke="#fed7aa" stroke-width="1.5" stroke-linecap="round" />

            <!-- Cute Paws -->
            <circle cx="30" cy="80" r="10" fill="#fed7aa" stroke="#ea580c" stroke-width="2" />
            <circle cx="70" cy="80" r="10" fill="#fed7aa" stroke="#ea580c" stroke-width="2" />
            <path d="M27 75 V85 M30 75 V85 M33 75 V85" stroke="#ea580c" stroke-width="1.5" />
            <path d="M67 75 V85 M70 75 V85 M73 75 V85" stroke="#ea580c" stroke-width="1.5" />
        </svg>
    </div>

    {{-- ====== SMOKE POOF CONTAINER ====== --}}
    <div id="smoke-poof" class="absolute z-30 pointer-events-none" style="width: 70px; height: 70px; top: -35px; left: 50%; margin-left: -35px; display: none;">
        <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
            <style>
                @keyframes smoke-expand {
                    0% { transform: scale(0.3); opacity: 0; }
                    30% { transform: scale(1.1); opacity: 0.95; }
                    80% { opacity: 0.8; }
                    100% { transform: scale(1.4); opacity: 0; }
                }
                .smoke-cloud-anim { animation: smoke-expand 0.4s ease-out forwards; transform-origin: center; }
            </style>
            <g class="smoke-cloud-anim">
                <circle cx="50" cy="50" r="24" fill="#f1f5f9" opacity="0.9" />
                <circle cx="35" cy="40" r="16" fill="#f1f5f9" opacity="0.95" />
                <circle cx="65" cy="45" r="16" fill="#f1f5f9" opacity="0.95" />
                <circle cx="45" cy="62" r="14" fill="#cbd5e1" opacity="0.8" />
                <circle cx="58" cy="58" r="14" fill="#cbd5e1" opacity="0.8" />
            </g>
        </svg>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cat = document.getElementById('escaping-cat');
        const bubble = document.getElementById('cat-bubble');
        const cards = document.querySelectorAll('.bento-card');
        const smoke = document.getElementById('smoke-poof');
        
        if (!cat || cards.length === 0 || !smoke) return;
        
        let currentCardIndex = -1;
        let isMoving = false;
        let catchesCount = 0;
        
        const catPhrases = [
            "MEOW! Kaget! 🙀",
            "Nggak kena! Wuuush! 💨",
            "Coba lagi! Hahaha 🐾",
            "Ups! Licin banget! 🧼",
            "Jangan pencet aku! 😿",
            "Tangkap aku kalau bisa! 🐈"
        ];
        
        function spawnPawPrints(card) {
            if (!card) return;
            // Spawn 3 paws with walking delay
            for (let i = 0; i < 3; i++) {
                setTimeout(() => {
                    const paw = document.createElement('div');
                    paw.className = 'absolute pointer-events-none z-10 transition-opacity duration-700';
                    paw.style.width = '18px';
                    paw.style.height = '18px';
                    
                    // Walking trail coordinates
                    const x = 25 + (i * 20) + (Math.random() * 8);
                    const y = 35 + (Math.random() * 20);
                    paw.style.left = `${x}%`;
                    paw.style.top = `${y}%`;
                    
                    const rot = -20 + Math.random() * 40;
                    
                    paw.innerHTML = `
                        <svg viewBox="0 0 30 30" fill="#f97316" style="transform: rotate(${rot}deg);" opacity="0.4" class="w-full h-full">
                            <ellipse cx="15" cy="18" rx="6" ry="4" />
                            <circle cx="9" cy="11" r="2" />
                            <circle cx="13" cy="8" r="2" />
                            <circle cx="17" cy="8" r="2" />
                            <circle cx="21" cy="11" r="2" />
                        </svg>
                    `;
                    card.appendChild(paw);
                    
                    // Fade out
                    setTimeout(() => {
                        paw.style.opacity = '0';
                        setTimeout(() => paw.remove(), 700);
                    }, 500);
                }, i * 140);
            }
        }
        
        function moveCat() {
            if (isMoving) return;
            isMoving = true;
            
            const oldCard = cards[currentCardIndex];
            if (oldCard) {
                // Show smoke poof
                oldCard.appendChild(smoke);
                smoke.style.display = 'block';
                const smokeSvg = smoke.querySelector('g');
                smokeSvg.style.animation = 'none';
                smoke.offsetHeight; // trigger reflow
                smokeSvg.style.animation = 'smoke-expand 0.4s ease-out forwards';
                
                // Spawn footprints walking trail
                spawnPawPrints(oldCard);
                
                setTimeout(() => {
                    smoke.style.display = 'none';
                }, 400);
            }
            
            // Hide cat
            cat.classList.add('translate-y-8', 'opacity-0', 'scale-75', 'pointer-events-none');
            cat.classList.remove('-translate-y-9', 'opacity-100', 'scale-100', 'pointer-events-auto');
            bubble.classList.remove('opacity-100', 'scale-100');
            
            setTimeout(() => {
                // Select new card
                let newIndex;
                do {
                    newIndex = Math.floor(Math.random() * cards.length);
                } while (newIndex === currentCardIndex && cards.length > 1);
                
                currentCardIndex = newIndex;
                const targetCard = cards[currentCardIndex];
                
                // Append cat to target
                targetCard.appendChild(cat);
                cat.style.display = 'block';
                
                setTimeout(() => {
                    cat.classList.remove('translate-y-8', 'opacity-0', 'scale-75', 'pointer-events-none');
                    cat.classList.add('-translate-y-9', 'opacity-100', 'scale-100', 'pointer-events-auto');
                    
                    if (catchesCount > 0) {
                        const randomPhrase = catPhrases[Math.floor(Math.random() * catPhrases.length)];
                        bubble.innerText = randomPhrase;
                    }
                    
                    setTimeout(() => {
                        bubble.classList.add('opacity-100', 'scale-100');
                    }, 200);
                    
                    isMoving = false;
                }, 100);
            }, 300);
        }
        
        // Escape when cursor enters cat body
        cat.addEventListener('mouseenter', function() {
            catchesCount++;
            moveCat();
        });
        
        // Initial spawn delay
        setTimeout(moveCat, 1500);
    });
</script>
@endpush
@endsection
