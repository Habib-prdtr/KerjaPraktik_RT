@extends('layouts.warga')
@section('title', 'Laporan & Usul Warga — Portal Warga RT 08')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- ====== HERO BANNER ====== --}}
    <div class="hero-warga rounded-[2.5rem] shadow-xl shadow-emerald-900/10">
        <div class="relative z-10 px-7 py-10 md:px-12 md:py-14">
            <div class="absolute top-0 right-0 w-80 h-80 bg-teal-400/25 rounded-full blur-3xl -translate-y-1/3 translate-x-1/4 pointer-events-none"></div>
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shadow-xl text-3xl">
                        <svg class="w-6 h-6 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <h1 class="text-white text-2xl md:text-4xl font-extrabold mb-2">Laporan & Pengaduan Saya</h1>
                        <p class="text-emerald-100 text-sm font-medium leading-relaxed">Laporkan masalah lingkungan seperti jalan rusak, sampah, atau berikan usulan kegiatan RT</p>
                    </div>
                </div>
                <a href="{{ route('warga.pengaduan.create') }}"
                   class="group inline-flex items-center gap-2.5 bg-white text-emerald-800 hover:bg-emerald-50 font-black px-6 py-4 rounded-2xl shadow-lg hover:shadow-xl transition-all w-full lg:w-auto justify-center hover:-translate-y-0.5">
                    <span><svg class="w-6 h-6 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg></span>
                    Buat Laporan Baru
                </a>
            </div>
        </div>
    </div>

    @if($pengaduanSaya->isEmpty())
    {{-- ====== EMPTY STATE ====== --}}
    <div class="card-premium p-16 text-center bg-white">
        <div class="w-24 h-24 mx-auto mb-6 rounded-3xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-5xl shadow-sm">
            <svg class="w-12 h-12 inline-block text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="text-xl font-extrabold text-slate-800 mb-2">Lingkungan Aman, Rukun & Nyaman!</h3>
        <p class="text-slate-500 font-medium mb-8 max-w-sm mx-auto text-sm leading-relaxed">
            Bapak/Ibu belum memiliki riwayat pengaduan. Jika menemui masalah lingkungan atau memiliki usulan kegiatan RT, jangan ragu untuk melapor ya!
        </p>
        <a href="{{ route('warga.pengaduan.create') }}"
           class="inline-flex items-center gap-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-extrabold px-8 py-4 rounded-2xl shadow-lg shadow-emerald-500/25 hover:-translate-y-0.5 transition-all">
            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg> Laporkan Masalah Pertama
        </a>
    </div>
    @else

    {{-- ====== GRID ADUAN CARDS ====== --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($pengaduanSaya as $aduan)
        @php
            $statusData = match($aduan->status) {
                'dikirim'  => [
                    'cls' => 'pill-dikirim',
                    'bar' => 'from-slate-400 to-slate-500',
                    'label' => 'Terkirim',
                    'icon' => '<svg class="w-3.5 h-3.5 inline-block mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    'desc' => 'Laporan masuk, menunggu pemeriksaan Pak RT.'
                ],
                'diproses' => [
                    'cls' => 'pill-diproses',
                    'bar' => 'from-amber-400 to-orange-500',
                    'label' => 'Ditinjau',
                    'icon' => '<svg class="w-3.5 h-3.5 inline-block mr-1 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065zM15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
                    'desc' => 'Sedang ditindaklanjuti/didiskusikan Pengurus RT.'
                ],
                'selesai'  => [
                    'cls' => 'pill-selesai',
                    'bar' => 'from-emerald-400 to-teal-500',
                    'label' => 'Selesai',
                    'icon' => '<svg class="w-3.5 h-3.5 inline-block mr-1 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    'desc' => 'Selesai! Laporan telah ditanggapi dan selesai.'
                ],
                default    => [
                    'cls' => 'pill-pending',
                    'bar' => 'from-slate-400 to-slate-500',
                    'label' => 'Diajukan',
                    'icon' => '<svg class="w-4 h-4 inline-block text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>',
                    'desc' => 'Terkirim.'
                ],
            };
        @endphp
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-emerald-500/5 hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col">
            <div class="h-1.5 bg-gradient-to-r {{ $statusData['bar'] }}"></div>
            <div class="p-6 flex flex-col flex-1">
                <div class="flex items-start justify-between gap-3 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0 text-2xl">
                        <svg class="w-6 h-6 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <span class="{{ $statusData['cls'] }} text-[9px] font-black px-2.5 py-1 rounded-lg uppercase tracking-wider">
                        {!! $statusData['icon'] !!} {{ $statusData['label'] }}
                    </span>
                </div>

                <h3 class="text-[15px] font-extrabold text-slate-800 mb-2 leading-snug line-clamp-2">{{ $aduan->judul }}</h3>
                <p class="text-xs text-slate-500 font-medium line-clamp-3 mb-4 flex-1 leading-relaxed">{{ $aduan->isi }}</p>

                @if($aduan->tanggapan_admin)
                <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-4 mb-4">
                    <p class="text-[10px] font-black text-emerald-800 uppercase tracking-wider mb-1 flex items-center gap-1">
                        <svg class="w-4 h-4 text-emerald-800 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg> Balasan Pak RT:
                    </p>
                    <p class="text-xs text-slate-700 font-bold leading-normal line-clamp-2">{{ $aduan->tanggapan_admin }}</p>
                </div>
                @endif

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                    <div>
                        <p class="text-[9px] text-slate-400 font-black uppercase tracking-wider leading-none">Tanggal Lapor</p>
                        <p class="text-xs font-bold text-slate-600 mt-1">{{ $aduan->created_at->translatedFormat('d M Y') }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        @if($aduan->status === 'dikirim')
                        <form method="POST" action="{{ route('warga.pengaduan.destroy', $aduan) }}"
                               onsubmit="confirmAction(event, 'Apakah Bapak/Ibu yakin ingin membatalkan dan menghapus laporan pengaduan ini?')">
                            @csrf @method('DELETE')
                            <button class="w-10 h-10 rounded-xl bg-rose-50 border border-rose-100 hover:bg-rose-500 hover:border-rose-500 text-rose-600 hover:text-white flex items-center justify-center transition-all shadow-sm shrink-0" title="Batalkan Laporan">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('warga.pengaduan.show', $aduan) }}"
                           class="inline-flex items-center gap-1.5 bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white text-xs font-extrabold px-4 py-2.5 rounded-xl transition-all shadow-sm">
                            Detail
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- pagination --}}
    <div class="flex justify-center mt-6">
        {{ $pengaduanSaya->links() }}
    </div>
    @endif
</div>
@endsection

