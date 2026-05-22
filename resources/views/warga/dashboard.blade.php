@extends('layouts.warga')

@section('title', 'Beranda Warga — Portal Resmi RT 08 RW 02')

@section('content')
<div class="space-y-6 pb-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- ====== HERO SECTION (WELCOME BANNER) ====== --}}
    <div class="hero-warga rounded-[2.5rem] shadow-xl shadow-emerald-900/10">
        <div class="relative z-10 px-6 py-10 md:px-12 md:py-14">
            <!-- Warm decorative glow orbs -->
            <div class="absolute top-0 right-0 w-80 h-80 bg-teal-400/20 rounded-full blur-3xl -translate-y-1/3 translate-x-1/4 pointer-events-none"></div>
            <div class="absolute bottom-0 left-10 w-48 h-48 bg-emerald-400/20 rounded-full blur-3xl translate-y-1/3 pointer-events-none"></div>

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
                            $greetEmoji = $hour < 11 ? '☀️' : ($hour < 15 ? '🌤️' : ($hour < 19 ? '🌇' : '🌙'));
                        @endphp
                        <p class="text-emerald-200 text-xs font-black uppercase tracking-widest mb-1">{{ $greeting }} {{ $greetEmoji }} Bapak/Ibu</p>
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
                                🏠 Lingkungan RT 08 / RW 02
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Info panel & Date -->
                <div class="bg-white/10 backdrop-blur-xl border border-white/15 rounded-2xl p-5 w-full lg:w-auto lg:min-w-[240px] text-white">
                    <p class="text-emerald-200 text-[10px] font-black uppercase tracking-widest mb-0.5">Hari & Tanggal</p>
                    <p class="font-extrabold text-xl leading-tight mb-4">📅 {{ now()->translatedFormat('l, d F Y') }}</p>
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
        <div class="w-12 h-12 rounded-2xl bg-amber-100 border border-amber-200 flex items-center justify-center shrink-0 text-2xl">
            🚨
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
                        'emoji' => '📄',
                        'light' => 'bg-emerald-50 text-emerald-700 border-emerald-100 group-hover:bg-emerald-600 group-hover:text-white',
                        'hover_bg' => 'hover:border-emerald-200 hover:shadow-emerald-500/5'
                    ],
                    [
                        'href' => route('warga.pengaduan.create'),
                        'label' => 'Lapor Masalah / Usulan',
                        'subtext' => 'Laporkan kerusakan jalan, lampu mati, dll',
                        'emoji' => '📢',
                        'light' => 'bg-amber-50 text-amber-700 border-amber-100 group-hover:bg-amber-500 group-hover:text-white',
                        'hover_bg' => 'hover:border-amber-200 hover:shadow-amber-500/5'
                    ],
                    [
                        'href' => route('warga.pengumuman.index'),
                        'label' => 'Mading Pengumuman',
                        'subtext' => 'Baca berita & pengumuman terbaru RT',
                        'emoji' => '📌',
                        'light' => 'bg-teal-50 text-teal-700 border-teal-100 group-hover:bg-teal-600 group-hover:text-white',
                        'hover_bg' => 'hover:border-teal-200 hover:shadow-teal-500/5'
                    ],
                    [
                        'href' => route('warga.kegiatan.index'),
                        'label' => 'Agenda Kegiatan RT',
                        'subtext' => 'Jadwal kerja bakti, posyandu, & rapat',
                        'emoji' => '🤝',
                        'light' => 'bg-rose-50 text-rose-700 border-rose-100 group-hover:bg-rose-600 group-hover:text-white',
                        'hover_bg' => 'hover:border-rose-200 hover:shadow-rose-500/5'
                    ],
                ];
            @endphp
            @foreach($services as $svc)
            <a href="{{ $svc['href'] }}"
               class="bento-hover bg-slate-50/50 hover:bg-white rounded-2xl p-5 border border-slate-100 flex flex-col gap-4 group cursor-pointer shadow-sm hover:shadow-xl transition-all duration-300 {{ $svc['hover_bg'] }}">
                <div class="w-14 h-14 rounded-2xl {{ $svc['light'] }} border flex items-center justify-center transition-all duration-300 text-3xl shadow-sm shrink-0">
                    {{ $svc['emoji'] }}
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
                    <div class="text-4xl mb-3">📭</div>
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
                            'diajukan' => '⏳ Sedang menunggu antrean pemeriksaan Pak RT.',
                            'diproses' => '✍️ Sedang dalam pengetikan/penandatanganan berkas.',
                            'selesai'  => '✅ Surat siap! Ambil fisik di rumah RT atau unduh detail.',
                            'ditolak'  => '❌ Ada data yang salah. Silakan periksa detail surat.',
                            default    => '',
                        };
                    @endphp
                    <a href="{{ route('warga.surat.show', $surat) }}"
                       class="block p-4 rounded-2xl border border-slate-100 hover:border-emerald-200 hover:bg-emerald-50/20 transition-all group">
                        <div class="flex items-center gap-3 justify-between">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                                    <span class="text-lg">📄</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-extrabold text-slate-800 truncate group-hover:text-emerald-700 transition-colors leading-tight">{{ $surat->jenis_surat }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold mt-1">Diajukan: {{ $surat->created_at->translatedFormat('d M Y') }}</p>
                                </div>
                            </div>
                            <span class="{{ $statusCls }} text-[9px] font-black px-2.5 py-1 rounded-lg uppercase tracking-wider shrink-0">{{ $statusLabel }}</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium mt-2.5 pt-2 border-t border-dashed border-slate-100 leading-normal">{{ $friendlyHint }}</p>
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
                    <div class="text-4xl mb-3">📢</div>
                    <p class="text-sm font-bold text-slate-600">Saat ini belum ada pengumuman baru</p>
                </div>
                @else
                    <div class="relative pl-4 border-l-2 border-emerald-100 space-y-4 py-1">
                        @foreach($pengumumanTerbaru->take(3) as $umum)
                        <div class="relative group">
                            <div class="absolute -left-[1.35rem] top-2 w-3.5 h-3.5 bg-white border-2 border-emerald-300 rounded-full group-hover:bg-emerald-600 group-hover:border-emerald-600 transition-all shadow-sm"></div>
                            <a href="{{ route('warga.pengumuman.show', $umum) }}"
                               class="block p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-emerald-50/20 hover:border-emerald-200 transition-all">
                                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">{{ \Carbon\Carbon::parse($umum->tanggal)->translatedFormat('d M Y') }}</p>
                                <p class="text-sm font-extrabold text-slate-800 leading-tight line-clamp-1 group-hover:text-emerald-700 transition-colors">{{ $umum->judul }}</p>
                                <p class="text-xs text-slate-500 mt-1.5 leading-relaxed line-clamp-2">{{ Str::limit(strip_tags($umum->isi), 90) }}</p>
                            </a>
                        </div>
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
                            <span class="text-base">📅</span>
                            <span class="text-[10px] font-black text-rose-700 uppercase tracking-widest">{{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d M Y') }}</span>
                        </div>
                    </div>
                    <h3 class="text-slate-800 font-extrabold text-base leading-snug line-clamp-2 mb-4 group-hover:text-emerald-700 transition-colors">{{ $k->nama_kegiatan }}</h3>
                </div>
                <div class="px-6 py-4 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-1.5 text-slate-500 text-xs font-semibold min-w-0">
                        <span>📍</span>
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

</div>
@endsection
