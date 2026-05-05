<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login') — RT 08 RW 02</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Quicksand', sans-serif; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center font-sans antialiased p-4 md:p-8">

    <div class="w-full max-w-5xl bg-white rounded-[2rem] shadow-2xl overflow-hidden flex flex-col md:flex-row">
        
        {{-- Kolom Kiri: Branding & Visual --}}
        <div class="w-full md:w-5/12 bg-gradient-to-br from-blue-800 via-blue-500 to-blue-300 p-10 md:p-12 text-white flex flex-col justify-between relative overflow-hidden">
            {{-- Decorative elements --}}
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 rounded-full bg-blue-900/20 blur-2xl"></div>

            <div class="relative z-10">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-md mb-6 shadow-lg border border-white/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>

                <h1 class="text-3xl md:text-4xl font-bold tracking-tight mb-2">
                    RT 08 / RW 02
                </h1>
                <p class="text-blue-100 text-lg font-medium mb-8">Sistem Informasi Warga</p>

                <div class="inline-flex items-center gap-2 bg-black/10 backdrop-blur-md rounded-xl px-4 py-2 border border-white/10">
                    <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-white text-sm font-medium">Ds. Penambangan, Sidoarjo</span>
                </div>
            </div>

            <div class="relative z-10 mt-12 md:mt-0 hidden md:block">
                <p class="text-blue-100/80 text-sm">
                    © {{ date('Y') }} Sistem Informasi RT 08 RW 02.<br>
                    Membangun lingkungan yang rukun dan tertata.
                </p>
            </div>
        </div>

        {{-- Kolom Kanan: Form Area --}}
        <div class="w-full md:w-7/12 p-8 md:p-14 lg:p-16 bg-white flex flex-col justify-center">
            @yield('content')
            
            {{-- Mobile footer --}}
            <p class="text-center text-slate-400 text-xs mt-10 md:hidden">
                © {{ date('Y') }} Sistem Informasi RT 08 RW 02
            </p>
        </div>

    </div>

</body>
</html>
