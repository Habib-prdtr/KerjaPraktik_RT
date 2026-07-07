<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Warga RT 08 - Modern & Terintegrasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

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
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased overflow-x-hidden selection:bg-emerald-500 selection:text-white">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 backdrop-blur-md bg-white/70 border-b border-slate-200/50"
        id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3 cursor-pointer" onclick="window.scrollTo(0,0)">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <div>
                        <span class="font-extrabold text-xl tracking-tight text-slate-900 block leading-none">RT
                            08</span>
                        <span
                            class="text-[10px] font-black uppercase tracking-widest text-emerald-600 block mt-0.5">Desa
                            Penambangan</span>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#mading"
                        class="text-sm font-bold text-slate-600 hover:text-emerald-600 transition-colors">Mading
                        Warga</a>
                    <a href="#agenda"
                        class="text-sm font-bold text-slate-600 hover:text-emerald-600 transition-colors">Agenda
                        Kegiatan</a>
                    @auth
                        <a href="{{ route('warga.surat.index') }}"
                            class="text-sm font-bold text-slate-600 hover:text-emerald-600 transition-colors">Surat
                            Menyurat</a>
                        <a href="{{ route('warga.pengaduan.index') }}"
                            class="text-sm font-bold text-slate-600 hover:text-emerald-600 transition-colors">Pengaduan</a>
                    @else
                        <button onclick="showAuthModal()"
                            class="text-sm font-bold text-slate-600 hover:text-emerald-600 transition-colors focus:outline-none">Surat
                            Menyurat</button>
                        <button onclick="showAuthModal()"
                            class="text-sm font-bold text-slate-600 hover:text-emerald-600 transition-colors focus:outline-none">Pengaduan</button>
                    @endauth
                    <div class="h-6 w-px bg-slate-300 mx-2"></div>
                    @auth
                        <a href="{{ route('login') }}"
                            class="text-sm font-bold text-slate-700 hover:text-emerald-600 transition-colors">Ke
                            Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-bold text-slate-700 hover:text-emerald-600 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="bg-slate-900 hover:bg-emerald-600 text-white text-sm font-bold py-2.5 px-5 rounded-full transition-all duration-300 shadow-md hover:shadow-emerald-500/25 hover:-translate-y-0.5">Daftar</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-slate-600 hover:text-emerald-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-slate-100 px-4 py-4 space-y-3 shadow-xl">
            <a href="#mading" class="block text-base font-bold text-slate-700 hover:text-emerald-600">Mading Warga</a>
            <a href="#agenda" class="block text-base font-bold text-slate-700 hover:text-emerald-600">Agenda
                Kegiatan</a>
            @auth
                <a href="{{ route('warga.surat.index') }}"
                    class="block text-base font-bold text-slate-700 hover:text-emerald-600">Surat Menyurat</a>
                <a href="{{ route('warga.pengaduan.index') }}"
                    class="block text-base font-bold text-slate-700 hover:text-emerald-600">Pengaduan</a>
                <hr class="border-slate-100 my-2">
                <a href="{{ route('login') }}" class="block text-base font-bold text-slate-700 hover:text-emerald-600">Ke
                    Dashboard</a>
            @else
                <button onclick="showAuthModal()"
                    class="block w-full text-left text-base font-bold text-slate-700 hover:text-emerald-600 focus:outline-none">Surat
                    Menyurat</button>
                <button onclick="showAuthModal()"
                    class="block w-full text-left text-base font-bold text-slate-700 hover:text-emerald-600 focus:outline-none">Pengaduan</button>
                <hr class="border-slate-100 my-2">
                <a href="{{ route('login') }}"
                    class="block text-base font-bold text-slate-700 hover:text-emerald-600">Masuk</a>
                <a href="{{ route('register') }}" class="block text-base font-bold text-emerald-600">Daftar Akun Baru</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden min-h-[90vh] flex items-center bg-white">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 z-0">
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-[0.03]"
                style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 32px 32px;"></div>
        </div>

        <!-- Blobs -->
        <div class="blob bg-emerald-500/30 w-96 h-96 rounded-full top-0 left-0 -translate-x-1/2 -translate-y-1/2"></div>
        <div
            class="blob bg-teal-500/20 w-[30rem] h-[30rem] rounded-full bottom-0 right-0 translate-x-1/3 translate-y-1/3 animation-delay-2000">
        </div>
        <div
            class="blob bg-indigo-500/20 w-80 h-80 rounded-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 animation-delay-4000">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="text-center lg:text-left">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold mb-6 backdrop-blur-sm shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Portal Digital Terintegrasi
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-extrabold text-slate-900 tracking-tight mb-6 leading-[1.1]">
                        Membangun <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-500">Rukun
                            Tetangga</span> Yang Lebih Baik.
                    </h1>
                    <p class="text-lg text-slate-600 mb-10 max-w-2xl mx-auto lg:mx-0 font-medium leading-relaxed">
                        Platform layanan mandiri untuk warga RT 08 RW 02 Desa Penambangan. Dapatkan informasi terbaru,
                        ajukan surat, dan sampaikan aspirasi dengan mudah dan cepat.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        @auth
                            <a href="{{ route('login') }}"
                                class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold px-8 py-4 rounded-full transition-all duration-300 shadow-[0_0_20px_-5px_rgba(16,185,129,0.4)] hover:shadow-[0_0_25px_-5px_rgba(16,185,129,0.5)] hover:-translate-y-1 flex items-center justify-center gap-2">
                                Ke Dashboard Warga
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold px-8 py-4 rounded-full transition-all duration-300 shadow-[0_0_20px_-5px_rgba(16,185,129,0.4)] hover:shadow-[0_0_25px_-5px_rgba(16,185,129,0.5)] hover:-translate-y-1 flex items-center justify-center gap-2">
                                Mulai Sekarang
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                            <a href="#mading"
                                class="w-full sm:w-auto bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-bold px-8 py-4 rounded-full transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-center">
                                Lihat Pengumuman
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Visual/Image Content -->
                <div class="hidden lg:block relative perspective-1000">
                    <div
                        class="relative rounded-3xl overflow-hidden shadow-2xl border border-white/50 transform rotate-y-[-5deg] rotate-x-[5deg] hover:rotate-y-0 hover:rotate-x-0 transition-transform duration-700 ease-out bg-white p-4">
                        <img src="{{ asset('images/hero_illustration.jpg') }}" alt="Ilustrasi Komunitas RT"
                            class="w-full h-auto object-cover rounded-2xl mix-blend-multiply opacity-95 hover:opacity-100 transition-opacity">
                    </div>

                    <!-- Floating Badge -->
                    <div class="absolute -bottom-6 -left-6 glass-card p-4 rounded-2xl shadow-xl animate-bounce-slow">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
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
            <svg class="block w-full h-12 lg:h-24" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,133.22,200.83,130,242.87,128.16,283.43,115.53,321.39,56.44Z"
                    class="fill-slate-50"></path>
            </svg>
        </div>
    </section>

    <!-- Mading Pengumuman Section -->
    <section id="mading" class="py-24 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-sm font-black tracking-widest text-emerald-600 uppercase mb-3">Papan Informasi Warga
                </h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Mading Pengumuman Terkini
                </h3>
                <p class="mt-4 text-slate-500 max-w-2xl mx-auto font-medium">Informasi dan berita terbaru seputar
                    kegiatan dan kebijakan di lingkungan RT 08 RW 02.</p>
            </div>

            @if ($pengumuman->isEmpty())
                <div class="bg-white rounded-3xl p-12 text-center border border-slate-100 shadow-sm">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-slate-700">Belum Ada Pengumuman</h4>
                    <p class="text-sm text-slate-500 mt-2">Belum ada informasi terbaru yang dibagikan oleh pengurus RT.
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($pengumuman as $item)
                        <div
                            class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(16,185,129,0.1)] transition-all duration-300 group hover:-translate-y-1 flex flex-col h-full">
                            @if ($item->foto)
                                <div class="h-48 overflow-hidden relative">
                                    <div
                                        class="absolute inset-0 bg-emerald-900/10 group-hover:bg-transparent transition-colors z-10">
                                    </div>
                                    <img src="{{ Str::startsWith($item->foto, 'http') ? $item->foto : Storage::url($item->foto) }}"
                                        alt="{{ $item->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                            @endif
                            <div class="p-8 flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-4">
                                    <span
                                        class="px-3 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase tracking-wider rounded-lg border border-emerald-100">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                                <h4
                                    class="text-xl font-bold text-slate-900 mb-3 group-hover:text-emerald-600 transition-colors line-clamp-2">
                                    {{ $item->judul }}
                                </h4>
                                <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3 flex-1">
                                    {{ Str::limit(strip_tags($item->isi), 120) }}
                                </p>
                                <div class="mt-auto pt-5 border-t border-slate-100 flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <span
                                            class="text-xs font-bold text-slate-600">{{ $item->user->name ?? 'Pengurus RT' }}</span>
                                    </div>
                                    @auth
                                        <a href="{{ route('warga.pengumuman.show', $item->id) }}"
                                            class="text-emerald-600 hover:text-emerald-700 text-sm font-bold flex items-center gap-1 group/link">
                                            Baca <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="text-slate-400 hover:text-emerald-600 text-sm font-bold flex items-center gap-1 group/link transition-colors"
                                            title="Login untuk membaca lengkap">
                                            Login untuk baca <svg
                                                class="w-4 h-4 group-hover/link:translate-x-1 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($pengumuman->count() >= 3)
                    <div class="mt-12 text-center">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-700 hover:text-emerald-600 hover:border-emerald-200 font-bold py-3 px-6 rounded-full transition-all text-sm shadow-sm hover:shadow-md">
                            Lihat Semua Pengumuman
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                @endif
            @endif
        </div>
    </section>

    <!-- Agenda Kegiatan Section -->
    <section id="agenda" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-sm font-black tracking-widest text-indigo-600 uppercase mb-3">Kegiatan Terjadwal</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Agenda Kegiatan RT</h3>
                <p class="mt-4 text-slate-500 max-w-2xl mx-auto font-medium">Jadwal kegiatan rutin dan khusus untuk
                    warga RT 08 RW 02.</p>
            </div>

            @if (isset($kegiatan) && $kegiatan->isEmpty())
                <div class="bg-slate-50 rounded-3xl p-12 text-center border border-slate-100 shadow-sm">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-slate-700">Belum Ada Agenda</h4>
                    <p class="text-sm text-slate-500 mt-2">Belum ada agenda kegiatan yang dijadwalkan dalam waktu
                        dekat.</p>
                </div>
            @elseif(isset($kegiatan))
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($kegiatan as $item)
                        @php
                            $fotos = is_string($item->foto) ? json_decode($item->foto, true) : $item->foto;
                            if (is_string($item->foto) && json_last_error() !== JSON_ERROR_NONE) {
                                $fotos = [$item->foto];
                            }
                        @endphp
                        <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(99,102,241,0.1)] transition-all duration-300 group hover:-translate-y-1 flex flex-col h-full relative cursor-pointer"
                            onclick="openGallery({{ json_encode($fotos) }}, '{{ addslashes($item->nama_kegiatan) }}')">
                            @if ($fotos && count($fotos) > 0)
                                <div class="h-48 overflow-hidden relative">
                                    <div
                                        class="absolute inset-0 bg-indigo-900/40 group-hover:bg-indigo-900/20 transition-colors z-10 flex items-center justify-center">
                                        <div
                                            class="opacity-0 group-hover:opacity-100 transition-all transform translate-y-4 group-hover:translate-y-0 bg-white/95 text-indigo-600 px-5 py-2.5 rounded-full font-bold text-sm shadow-xl flex items-center gap-2 backdrop-blur-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Lihat {{ count($fotos) }} Foto
                                        </div>
                                    </div>
                                    <img src="{{ Str::startsWith($fotos[0], 'http') ? $fotos[0] : Storage::url($fotos[0]) }}"
                                        alt="{{ $item->nama_kegiatan }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                </div>
                            @else
                                <div
                                    class="h-48 bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-indigo-200" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="p-8 flex-1 flex flex-col relative">
                                <div
                                    class="absolute -top-6 right-6 w-12 h-12 bg-white rounded-2xl shadow-lg border border-slate-100 flex flex-col items-center justify-center text-center">
                                    <span
                                        class="text-[10px] font-black uppercase text-slate-400 leading-none">{{ \Carbon\Carbon::parse($item->tanggal)->format('M') }}</span>
                                    <span
                                        class="text-lg font-extrabold text-indigo-600 leading-none mt-1">{{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</span>
                                </div>
                                <h4
                                    class="text-xl font-bold text-slate-900 mb-3 group-hover:text-indigo-600 transition-colors line-clamp-2 pr-8 mt-2">
                                    {{ $item->nama_kegiatan }}
                                </h4>
                                <div class="flex items-center gap-2 mb-4 text-sm text-slate-500">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="line-clamp-1">{{ $item->lokasi }}</span>
                                </div>
                                <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-2 flex-1">
                                    {{ Str::limit(strip_tags($item->deskripsi), 100) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($kegiatan->count() >= 3)
                    <div class="mt-12 text-center">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-700 hover:text-indigo-600 hover:border-indigo-200 font-bold py-3 px-6 rounded-full transition-all text-sm shadow-sm hover:shadow-md">
                            Lihat Semua Kegiatan
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                @endif
            @endif
        </div>
    </section>

    <!-- Features Overview -->
    <section id="tentang" class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-sm font-black tracking-widest text-emerald-600 uppercase mb-3">Layanan Kami</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mb-6">Urus Keperluan
                        RT Dari Genggaman Anda</h3>
                    <p class="text-slate-500 font-medium mb-10 leading-relaxed">
                        Kami mendigitalkan pelayanan administratif RT untuk memudahkan setiap warga. Tidak perlu lagi
                        repot antre atau mencari waktu luang pengurus.
                    </p>

                    <div class="space-y-6">
                        @auth
                            <a href="{{ route('warga.surat.index') }}"
                                class="flex items-center gap-6 p-5 rounded-3xl hover:bg-white border border-transparent hover:border-slate-200 hover:shadow-xl transition-all cursor-pointer group">
                            @else
                                <div onclick="showAuthModal()"
                                    class="flex items-center gap-6 p-5 rounded-3xl hover:bg-white border border-transparent hover:border-slate-200 hover:shadow-xl transition-all cursor-pointer group">
                                @endauth
                                <div
                                    class="w-24 h-24 rounded-2xl bg-white shadow-sm group-hover:shadow-md group-hover:scale-110 transition-all flex items-center justify-center shrink-0 overflow-hidden border border-slate-100 relative">
                                    <div
                                        class="absolute inset-0 bg-emerald-500/5 group-hover:bg-emerald-500/10 transition-colors z-10">
                                    </div>
                                    <img src="{{ asset('images/surat_avatar.jpg') }}"
                                        class="w-full h-full object-cover mix-blend-multiply scale-110"
                                        alt="Surat Avatar">
                                </div>
                                <div>
                                    <h4
                                        class="text-xl font-bold text-slate-900 mb-1 group-hover:text-emerald-600 transition-colors">
                                        Pengajuan Surat Online</h4>
                                    <p class="text-sm text-slate-500 leading-relaxed">Ajukan Surat Pengantar RT untuk
                                        berbagai keperluan administratif (KTP, Domisili, dll) langsung dari HP.</p>
                                </div>
                                @auth
                            </a>
                        @else
                        </div>
                    @endauth

                    @auth
                        <a href="{{ route('warga.pengaduan.index') }}"
                            class="flex items-center gap-6 p-5 rounded-3xl hover:bg-white border border-transparent hover:border-slate-200 hover:shadow-xl transition-all cursor-pointer group">
                        @else
                            <div onclick="showAuthModal()"
                                class="flex items-center gap-6 p-5 rounded-3xl hover:bg-white border border-transparent hover:border-slate-200 hover:shadow-xl transition-all cursor-pointer group">
                            @endauth
                            <div
                                class="w-24 h-24 rounded-2xl bg-white shadow-sm group-hover:shadow-md group-hover:scale-110 transition-all flex items-center justify-center shrink-0 overflow-hidden border border-slate-100 relative">
                                <div
                                    class="absolute inset-0 bg-amber-500/5 group-hover:bg-amber-500/10 transition-colors z-10">
                                </div>
                                <img src="{{ asset('images/pengaduan_avatar.jpg') }}"
                                    class="w-full h-full object-cover mix-blend-multiply scale-110"
                                    alt="Pengaduan Avatar">
                            </div>
                            <div>
                                <h4
                                    class="text-xl font-bold text-slate-900 mb-1 group-hover:text-amber-500 transition-colors">
                                    Pengaduan Warga</h4>
                                <p class="text-sm text-slate-500 leading-relaxed">Sampaikan keluhan, aspirasi, atau
                                    masalah di lingkungan RT. Status penyelesaian dapat dipantau.</p>
                            </div>
                            @auth
                        </a>
                    @else
                    </div>
                @endauth

                <a href="#agenda"
                    class="flex items-center gap-6 p-5 rounded-3xl hover:bg-white border border-transparent hover:border-slate-200 hover:shadow-xl transition-all cursor-pointer group">
                    <div
                        class="w-24 h-24 rounded-2xl bg-white shadow-sm group-hover:shadow-md group-hover:scale-110 transition-all flex items-center justify-center shrink-0 overflow-hidden border border-slate-100 relative">
                        <div
                            class="absolute inset-0 bg-indigo-500/5 group-hover:bg-indigo-500/10 transition-colors z-10">
                        </div>
                        <img src="{{ asset('images/kegiatan_avatar.jpg') }}"
                            class="w-full h-full object-cover mix-blend-multiply scale-110" alt="Kegiatan Avatar">
                    </div>
                    <div>
                        <h4
                            class="text-xl font-bold text-slate-900 mb-1 group-hover:text-indigo-500 transition-colors">
                            Kegiatan Warga</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">Dapatkan informasi jadwal kerja bakti,
                            posyandu, atau pertemuan rutin RT agar tidak tertinggal.</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="relative hidden lg:block">
            <div
                class="absolute inset-0 bg-gradient-to-tr from-emerald-100 to-teal-50 rounded-[3rem] transform rotate-3 scale-105 -z-10">
            </div>
            <div
                class="bg-white rounded-[3rem] shadow-xl border-8 border-white overflow-hidden h-auto w-full p-4 flex items-center justify-center">
                <img src="{{ asset('images/hero_illustration.jpg') }}" alt="Features App"
                    class="object-cover w-full h-full rounded-2xl mix-blend-multiply">
            </div>
        </div>
        </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white text-slate-500 py-12 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center mb-6">
                <div
                    class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center border border-emerald-100">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
            </div>
            <h4 class="text-slate-900 font-extrabold text-xl mb-2">Portal Warga RT 08 / RW 02</h4>
            <p class="text-sm text-slate-500 mb-8">Desa Penambangan • Melayani Dengan Sepenuh Hati</p>
            <div class="h-px w-full max-w-sm mx-auto bg-slate-200 mb-8"></div>
            <p class="text-xs font-semibold text-slate-400">
                &copy; {{ date('Y') }} Sistem Informasi RT 08. Hak Cipta Dilindungi.
            </p>
        </div>
    </footer>

    <!-- Auth Modal -->
    <div id="authModal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeAuthModal()">
        </div>
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-md w-full border border-slate-100 opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95 duration-300"
                id="authModalContent">

                <!-- Decorative Top/Gradient -->
                <div class="h-24 bg-gradient-to-r from-emerald-500 to-teal-500 relative">
                    <div class="absolute inset-0 bg-white/20 blur-xl"></div>
                    <button onclick="closeAuthModal()"
                        class="absolute top-4 right-4 text-white/80 hover:text-white transition-colors focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="px-8 pb-8 pt-0 relative">
                    <!-- Icon -->
                    <div
                        class="w-20 h-20 rounded-2xl bg-white shadow-xl flex items-center justify-center mx-auto -mt-10 mb-6 border border-slate-50 relative z-10 transform rotate-3">
                        <div
                            class="w-16 h-16 rounded-xl bg-amber-50 flex items-center justify-center border border-amber-100">
                            <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>

                    <h3 class="text-2xl font-extrabold text-slate-900 mb-2">Akses Dibatasi</h3>
                    <p class="text-slate-500 font-medium mb-8">Anda harus login terlebih dahulu untuk mengakses menu
                        Surat Menyurat atau Pengaduan.</p>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button onclick="closeAuthModal()"
                            class="w-full sm:w-1/2 py-3 px-4 bg-slate-50 hover:bg-slate-100 text-slate-700 font-bold rounded-xl transition-colors border border-slate-200 focus:outline-none">
                            Tetap Disini
                        </button>
                        <a href="{{ route('login') }}"
                            class="w-full sm:w-1/2 py-3 px-4 bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-extrabold rounded-xl transition-all shadow-[0_0_20px_-5px_rgba(16,185,129,0.5)] hover:shadow-[0_0_25px_-5px_rgba(16,185,129,0.7)] hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            Login Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Modal -->
    <div id="galleryModal" class="fixed inset-0 z-[110] hidden">
        <div class="absolute inset-0 bg-slate-900/95 backdrop-blur-md transition-opacity" onclick="closeGallery()">
        </div>
        <button onclick="closeGallery()"
            class="absolute top-6 right-6 text-white/70 hover:text-white transition-colors focus:outline-none z-[120] bg-white/10 hover:bg-white/20 p-2 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="absolute top-6 left-6 text-white z-[120]">
            <h3 id="galleryTitle" class="text-xl font-bold tracking-tight">Dokumentasi Kegiatan</h3>
            <div class="inline-flex items-center gap-2 mt-2 px-3 py-1 bg-white/10 rounded-full text-sm font-semibold">
                <svg class="w-4 h-4 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span id="galleryCount">1 / 1</span>
            </div>
        </div>

        <div class="flex items-center justify-between h-full px-4 sm:px-12 pointer-events-none relative z-[115]">
            <button onclick="prevGalleryImage()"
                class="p-4 bg-white/10 hover:bg-white/20 rounded-full text-white pointer-events-auto transition-all backdrop-blur-md hover:scale-110 shadow-lg"
                id="btnPrev">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div
                class="w-full max-w-5xl h-[80vh] px-4 sm:px-12 flex items-center justify-center relative pointer-events-auto">
                <img id="galleryImage" src="" alt="Gallery"
                    class="max-w-full max-h-full object-contain rounded-xl shadow-2xl transition-all duration-300">
            </div>

            <button onclick="nextGalleryImage()"
                class="p-4 bg-white/10 hover:bg-white/20 rounded-full text-white pointer-events-auto transition-all backdrop-blur-md hover:scale-110 shadow-lg"
                id="btnNext">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Modal functions
        function showAuthModal() {
            const modal = document.getElementById('authModal');
            const content = document.getElementById('authModalContent');

            // Show overlay
            modal.classList.remove('hidden');

            // Trigger animation
            setTimeout(() => {
                content.classList.remove('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
                content.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
            }, 10);
        }

        function closeAuthModal() {
            const modal = document.getElementById('authModal');
            const content = document.getElementById('authModalContent');

            // Reverse animation
            content.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
            content.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');

            // Hide overlay after animation
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

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

        // Gallery Functions
        let currentGallery = [];
        let currentIndex = 0;

        function openGallery(images, title) {
            if (!images || images.length === 0) return;

            // Clean up double encoding if any
            if (typeof images === 'string') {
                try {
                    images = JSON.parse(images);
                } catch (e) {}
            }

            currentGallery = Array.isArray(images) ? images : [images];
            if (currentGallery.length === 0) return;

            currentIndex = 0;

            document.getElementById('galleryTitle').innerText = title || 'Dokumentasi Kegiatan';
            updateGalleryView();

            const modal = document.getElementById('galleryModal');
            modal.classList.remove('hidden');

            // Disable scroll
            document.body.style.overflow = 'hidden';
        }

        function closeGallery() {
            document.getElementById('galleryModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function updateGalleryView() {
            const imgEl = document.getElementById('galleryImage');

            // Add fade effect
            imgEl.style.opacity = '0';
            imgEl.style.transform = 'scale(0.95)';

            setTimeout(() => {
                let url = currentGallery[currentIndex];
                // Check if JSON
                if (typeof url === 'string' && url.startsWith('[')) {
                    try {
                        url = JSON.parse(url)[0];
                    } catch (e) {}
                }

                imgEl.src = url.startsWith('http') ? url : '/storage/' + url;

                imgEl.onload = () => {
                    imgEl.style.opacity = '1';
                    imgEl.style.transform = 'scale(1)';
                };
            }, 150);

            document.getElementById('galleryCount').innerText = `${currentIndex + 1} / ${currentGallery.length}`;

            const showNav = currentGallery.length > 1;
            document.getElementById('btnPrev').style.display = showNav ? 'block' : 'none';
            document.getElementById('btnNext').style.display = showNav ? 'block' : 'none';
        }

        function prevGalleryImage() {
            if (currentGallery.length <= 1) return;
            currentIndex = (currentIndex === 0) ? currentGallery.length - 1 : currentIndex - 1;
            updateGalleryView();
        }

        function nextGalleryImage() {
            if (currentGallery.length <= 1) return;
            currentIndex = (currentIndex === currentGallery.length - 1) ? 0 : currentIndex + 1;
            updateGalleryView();
        }

        // Keyboard navigation for gallery
        document.addEventListener('keydown', (e) => {
            const modal = document.getElementById('galleryModal');
            if (!modal.classList.contains('hidden')) {
                if (e.key === 'ArrowLeft') prevGalleryImage();
                if (e.key === 'ArrowRight') nextGalleryImage();
                if (e.key === 'Escape') closeGallery();
            }
        });
    </script>
</body>

</html>
