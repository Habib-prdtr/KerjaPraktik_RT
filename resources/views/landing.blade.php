<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Warga RT 08 - Modern & Terintegrasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #064e3b 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .blob {
            position: absolute;
            filter: blur(80px);
            z-index: 0;
            opacity: 0.6;
            animation: blob-bounce 10s infinite alternate;
        }
        @keyframes blob-bounce {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased overflow-x-hidden selection:bg-emerald-500 selection:text-white">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 backdrop-blur-md bg-white/70 border-b border-slate-200/50" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3 cursor-pointer" onclick="window.scrollTo(0,0)">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-extrabold text-xl tracking-tight text-slate-900 block leading-none">RT 08</span>
                        <span class="text-[10px] font-black uppercase tracking-widest text-emerald-600 block mt-0.5">Desa Penambangan</span>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#mading" class="text-sm font-bold text-slate-600 hover:text-emerald-600 transition-colors">Mading Warga</a>
                    <a href="#tentang" class="text-sm font-bold text-slate-600 hover:text-emerald-600 transition-colors">Tentang</a>
                    <div class="h-6 w-px bg-slate-300"></div>
                    @auth
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-700 hover:text-emerald-600 transition-colors">Ke Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-700 hover:text-emerald-600 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-slate-900 hover:bg-emerald-600 text-white text-sm font-bold py-2.5 px-5 rounded-full transition-all duration-300 shadow-md hover:shadow-emerald-500/25 hover:-translate-y-0.5">Daftar</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-slate-600 hover:text-emerald-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-slate-100 px-4 py-4 space-y-3 shadow-xl">
            <a href="#mading" class="block text-base font-bold text-slate-700 hover:text-emerald-600">Mading Warga</a>
            <a href="#tentang" class="block text-base font-bold text-slate-700 hover:text-emerald-600">Tentang</a>
            <hr class="border-slate-100">
            @auth
                <a href="{{ route('login') }}" class="block text-base font-bold text-slate-700 hover:text-emerald-600">Ke Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="block text-base font-bold text-slate-700 hover:text-emerald-600">Masuk</a>
                <a href="{{ route('register') }}" class="block text-base font-bold text-emerald-600">Daftar Akun Baru</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden min-h-[90vh] flex items-center">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 z-0 bg-[#0f172a]">
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 32px 32px;"></div>
        </div>
        
        <!-- Blobs -->
        <div class="blob bg-emerald-500/30 w-96 h-96 rounded-full top-0 left-0 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="blob bg-teal-500/20 w-[30rem] h-[30rem] rounded-full bottom-0 right-0 translate-x-1/3 translate-y-1/3 animation-delay-2000"></div>
        <div class="blob bg-indigo-500/20 w-80 h-80 rounded-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 animation-delay-4000"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-300 text-xs font-bold mb-6 backdrop-blur-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Portal Digital Terintegrasi
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-extrabold text-white tracking-tight mb-6 leading-[1.1]">
                        Membangun <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Rukun Tetangga</span> Yang Lebih Baik.
                    </h1>
                    <p class="text-lg text-slate-300 mb-10 max-w-2xl mx-auto lg:mx-0 font-medium leading-relaxed">
                        Platform layanan mandiri untuk warga RT 08 RW 02 Desa Penambangan. Dapatkan informasi terbaru, ajukan surat, dan sampaikan aspirasi dengan mudah dan cepat.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        @auth
                            <a href="{{ route('login') }}" class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-extrabold px-8 py-4 rounded-full transition-all duration-300 shadow-[0_0_40px_-10px_rgba(16,185,129,0.5)] hover:shadow-[0_0_60px_-15px_rgba(16,185,129,0.7)] hover:-translate-y-1 flex items-center justify-center gap-2">
                                Ke Dashboard Warga
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-extrabold px-8 py-4 rounded-full transition-all duration-300 shadow-[0_0_40px_-10px_rgba(16,185,129,0.5)] hover:shadow-[0_0_60px_-15px_rgba(16,185,129,0.7)] hover:-translate-y-1 flex items-center justify-center gap-2">
                                Mulai Sekarang
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                            <a href="#mading" class="w-full sm:w-auto bg-white/10 hover:bg-white/20 text-white border border-white/20 font-bold px-8 py-4 rounded-full transition-all duration-300 backdrop-blur-md flex items-center justify-center">
                                Lihat Pengumuman
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Visual/Image Content -->
                <div class="hidden lg:block relative perspective-1000">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-white/10 transform rotate-y-[-10deg] rotate-x-[5deg] hover:rotate-y-0 hover:rotate-x-0 transition-transform duration-700 ease-out">
                        <img src="https://images.unsplash.com/photo-1576615278693-f8e095e275f1?q=80&w=1200&auto=format&fit=crop" alt="Dashboard Preview" class="w-full h-auto object-cover opacity-90 hover:opacity-100 transition-opacity">
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-900/50 to-transparent mix-blend-overlay"></div>
                    </div>
                    
                    <!-- Floating Badge -->
                    <div class="absolute -bottom-6 -left-6 glass-card p-4 rounded-2xl shadow-xl animate-bounce-slow">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800">Layanan Digital</p>
                                <p class="text-[10px] font-semibold text-slate-500">Akses 24 Jam</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Wave -->
        <div class="absolute bottom-0 w-full leading-none z-10">
            <svg class="block w-full h-12 lg:h-24" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,133.22,200.83,130,242.87,128.16,283.43,115.53,321.39,56.44Z" class="fill-slate-50"></path>
            </svg>
        </div>
    </section>

    <!-- Mading Pengumuman Section -->
    <section id="mading" class="py-24 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-sm font-black tracking-widest text-emerald-600 uppercase mb-3">Papan Informasi Warga</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Mading Pengumuman Terkini</h3>
                <p class="mt-4 text-slate-500 max-w-2xl mx-auto font-medium">Informasi dan berita terbaru seputar kegiatan dan kebijakan di lingkungan RT 08 RW 02.</p>
            </div>

            @if($pengumuman->isEmpty())
                <div class="bg-white rounded-3xl p-12 text-center border border-slate-100 shadow-sm">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <h4 class="text-lg font-bold text-slate-700">Belum Ada Pengumuman</h4>
                    <p class="text-sm text-slate-500 mt-2">Belum ada informasi terbaru yang dibagikan oleh pengurus RT.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($pengumuman as $item)
                        <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(16,185,129,0.1)] transition-all duration-300 group hover:-translate-y-1 flex flex-col h-full">
                            <div class="p-8 flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-4">
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase tracking-wider rounded-lg border border-emerald-100">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                                <h4 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-emerald-600 transition-colors line-clamp-2">
                                    {{ $item->judul }}
                                </h4>
                                <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3 flex-1">
                                    {{ Str::limit(strip_tags($item->isi), 120) }}
                                </p>
                                <div class="mt-auto pt-5 border-t border-slate-100 flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                        <span class="text-xs font-bold text-slate-600">{{ $item->user->name ?? 'Pengurus RT' }}</span>
                                    </div>
                                    @auth
                                        <a href="{{ route('warga.pengumuman.show', $item->id) }}" class="text-emerald-600 hover:text-emerald-700 text-sm font-bold flex items-center gap-1 group/link">
                                            Baca <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="text-slate-400 hover:text-emerald-600 text-sm font-bold flex items-center gap-1 group/link transition-colors" title="Login untuk membaca lengkap">
                                            Login untuk baca <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @if($pengumuman->count() >= 3)
                <div class="mt-12 text-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-700 hover:text-emerald-600 hover:border-emerald-200 font-bold py-3 px-6 rounded-full transition-all text-sm shadow-sm hover:shadow-md">
                        Lihat Semua Pengumuman
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                @endif
            @endif
        </div>
    </section>

    <!-- Features Overview -->
    <section id="tentang" class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-sm font-black tracking-widest text-emerald-600 uppercase mb-3">Layanan Kami</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mb-6">Urus Keperluan RT Dari Genggaman Anda</h3>
                    <p class="text-slate-500 font-medium mb-10 leading-relaxed">
                        Kami mendigitalkan pelayanan administratif RT untuk memudahkan setiap warga. Tidak perlu lagi repot antre atau mencari waktu luang pengurus.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900 mb-1">Pengajuan Surat Online</h4>
                                <p class="text-sm text-slate-500">Ajukan Surat Pengantar RT untuk berbagai keperluan administratif (KTP, Domisili, dll) langsung dari HP.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900 mb-1">Pengaduan Warga</h4>
                                <p class="text-sm text-slate-500">Sampaikan keluhan, aspirasi, atau masalah di lingkungan RT. Status penyelesaian dapat dipantau.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900 mb-1">Kegiatan Warga</h4>
                                <p class="text-sm text-slate-500">Dapatkan informasi jadwal kerja bakti, posyandu, atau pertemuan rutin RT agar tidak tertinggal.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-emerald-100 to-teal-50 rounded-[3rem] transform rotate-3 scale-105 -z-10"></div>
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1000&auto=format&fit=crop" alt="Features App" class="rounded-[3rem] shadow-xl border-8 border-white object-cover h-[500px] w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center mb-6">
                <div class="w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center border border-slate-700">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
            </div>
            <h4 class="text-white font-extrabold text-xl mb-2">Portal Warga RT 08 / RW 02</h4>
            <p class="text-sm text-slate-500 mb-8">Desa Penambangan • Melayani Dengan Sepenuh Hati</p>
            <div class="h-px w-full max-w-sm mx-auto bg-slate-800 mb-8"></div>
            <p class="text-xs font-semibold">
                &copy; {{ date('Y') }} Sistem Informasi RT 08. Hak Cipta Dilindungi.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 20) {
                nav.classList.add('shadow-sm', 'bg-white/90');
                nav.classList.remove('bg-white/70');
            } else {
                nav.classList.remove('shadow-sm', 'bg-white/90');
                nav.classList.add('bg-white/70');
            }
        });

        // Mobile Menu Toggle
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
