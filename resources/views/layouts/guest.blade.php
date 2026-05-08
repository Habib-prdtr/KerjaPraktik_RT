<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login') — RT 08 RW 02</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        .bg-mesh {
            background-color: #0f172a;
            background-image: 
                radial-gradient(at 40% 20%, hsla(220,100%,74%,1) 0px, transparent 50%),
                radial-gradient(at 80% 0%, hsla(189,100%,56%,1) 0px, transparent 50%),
                radial-gradient(at 0% 50%, hsla(355,100%,93%,1) 0px, transparent 50%),
                radial-gradient(at 80% 50%, hsla(340,100%,76%,1) 0px, transparent 50%),
                radial-gradient(at 0% 100%, hsla(22,100%,77%,1) 0px, transparent 50%),
                radial-gradient(at 80% 100%, hsla(242,100%,70%,1) 0px, transparent 50%),
                radial-gradient(at 0% 0%, hsla(343,100%,76%,1) 0px, transparent 50%);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-mesh min-h-screen flex items-center justify-center antialiased p-4 py-8 md:p-8 relative overflow-y-auto overflow-x-hidden">
    
    <!-- Background Decor Overlay -->
    <div class="fixed inset-0 z-0 bg-slate-900/20 backdrop-blur-[100px]"></div>

    <div class="w-full max-w-4xl z-10 grid grid-cols-1 md:grid-cols-2 rounded-[2rem] shadow-2xl overflow-hidden glass-panel transform transition-all duration-500 hover:shadow-[0_20px_50px_rgba(8,112,184,0.2)]">
        
        {{-- Kolom Kiri: Branding & Visual --}}
        <div class="hidden md:flex relative p-8 lg:p-10 flex-col justify-between overflow-hidden group">
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1449844908441-8829872d2607?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Neighborhood">
                <div class="absolute inset-0 bg-linear-to-t from-slate-900 via-slate-900/60 to-transparent"></div>
                <div class="absolute inset-0 bg-blue-900/40 mix-blend-multiply transition-opacity duration-500 group-hover:opacity-80"></div>
            </div>

            <div class="relative z-10 animate-float">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-md mb-8 shadow-2xl border border-white/30">
                    <svg class="w-8 h-8 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>

                <h1 class="text-4xl xl:text-5xl font-extrabold text-white tracking-tight mb-4 drop-shadow-lg leading-tight">
                    Portal <br><span class="text-blue-300">RT 08 / RW 02</span>
                </h1>
                <p class="text-slate-200 text-lg font-medium max-w-sm drop-shadow-md leading-relaxed">
                    Sistem informasi digital terpadu untuk pelayanan warga yang responsif dan transparan.
                </p>
            </div>

            <div class="relative z-10 flex items-center gap-4 bg-white/10 p-4 rounded-2xl backdrop-blur-md border border-white/10 w-fit">
                <div class="flex -space-x-3">
                    <img class="w-10 h-10 rounded-full border-2 border-slate-800 object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop" alt="Avatar">
                    <img class="w-10 h-10 rounded-full border-2 border-slate-800 object-cover" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop" alt="Avatar">
                    <img class="w-10 h-10 rounded-full border-2 border-slate-800 object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop" alt="Avatar">
                    <div class="w-10 h-10 rounded-full border-2 border-slate-800 bg-blue-600 text-white flex items-center justify-center text-xs font-bold shadow-lg">+50</div>
                </div>
                <div class="text-sm font-medium text-slate-300 drop-shadow-md">
                    <span class="text-white font-bold">Warga terdaftar</span><br>di sistem kami.
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Form Area --}}
        <div class="p-6 sm:p-8 lg:p-10 flex flex-col justify-center relative">
            
            <!-- Mobile Header Logo -->
            <div class="md:hidden mb-8 flex justify-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-linear-to-br from-blue-600 to-indigo-700 shadow-xl shadow-blue-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
            </div>

            <div class="w-full max-w-md mx-auto relative z-10">
                @yield('content')
            </div>
            
            {{-- Mobile footer --}}
            <p class="text-center text-slate-400 font-medium text-xs mt-10 md:hidden">
                © {{ date('Y') }} Sistem Informasi RT 08 RW 02
            </p>
        </div>

    </div>

</body>
</html>
