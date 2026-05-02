<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login') — RT 08 RW 02</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-900 via-blue-800 to-cyan-700 min-h-screen flex items-center justify-center font-sans antialiased p-4">

    <div class="w-full max-w-sm">

        {{-- Branding --}}
        <div class="text-center mb-8">
            {{-- Ikon Rumah --}}
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/20 backdrop-blur mb-4 shadow-lg">
                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>

            {{-- Judul --}}
            <h1 class="text-white text-2xl font-extrabold tracking-tight">
                RT. 08 / RW. 02
            </h1>
            <p class="text-cyan-200 text-sm font-semibold mt-0.5">Sistem Informasi Warga</p>

            {{-- Lokasi --}}
            <div class="mt-3 inline-flex items-center gap-1.5 bg-white/10 backdrop-blur rounded-full px-4 py-1.5">
                <svg class="w-3.5 h-3.5 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-blue-100 text-xs">Ds. Penambangan, Kec. Balongbendo, Kab. Sidoarjo</span>
            </div>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            @yield('content')
        </div>

        {{-- Footer text --}}
        <p class="text-center text-blue-200 text-xs mt-6">
            © {{ date('Y') }} Sistem Informasi RT 08 RW 02
        </p>
    </div>

</body>
</html>
