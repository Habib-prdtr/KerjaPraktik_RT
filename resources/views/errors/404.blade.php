<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Portal Warga RT 08</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .mesh-bg {
            background-color: #f8fafc;
            background-image: radial-gradient(at 0% 0%, hsla(158,100%,74%,0.15) 0px, transparent 50%),
                              radial-gradient(at 100% 100%, hsla(173,100%,74%,0.15) 0px, transparent 50%);
        }
        .float-slow {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(2deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
    </style>
</head>
<body class="mesh-bg min-h-screen flex items-center justify-center p-4">
    <div class="max-w-xl w-full text-center">
        <!-- Illustration -->
        <div class="relative w-48 h-48 sm:w-64 sm:h-64 mx-auto mb-8 float-slow">
            <div class="absolute inset-0 bg-emerald-200/50 rounded-full blur-3xl"></div>
            <svg class="relative z-10 w-full h-full text-emerald-600 drop-shadow-xl" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                <circle cx="15" cy="9" r="3" class="fill-white" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9l2 2" />
            </svg>
        </div>

        <!-- Content -->
        <h1 class="text-7xl sm:text-9xl font-black text-slate-800 tracking-tighter mb-2">404</h1>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-700 mb-4 tracking-tight">Waduh, Anda Tersesat!</h2>
        <p class="text-slate-500 font-medium mb-8 leading-relaxed max-w-md mx-auto">
            Halaman yang Anda cari sepertinya berada di luar wilayah RT 08. Mungkin halamannya sudah dihapus atau Anda salah memasukkan alamat.
        </p>

        <!-- Button -->
        <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-extrabold px-8 py-4 rounded-2xl shadow-xl shadow-emerald-600/30 hover:shadow-emerald-600/50 hover:-translate-y-1 transition-all group">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>
