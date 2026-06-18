@extends('layouts.warga')
@section('title', 'Detail Pengaduan — Portal Warga RT 08')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 space-y-6 pb-8">

    {{-- Back Header --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('warga.pengaduan.index') }}"
           class="w-11 h-11 rounded-2xl bg-white border border-slate-200 hover:border-emerald-300 hover:bg-emerald-50 flex items-center justify-center transition-all shadow-sm group">
            <svg class="w-5 h-5 text-slate-600 group-hover:text-emerald-600 group-hover:-translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 leading-tight">Detail Laporan & Pengaduan</h1>
            <p class="text-xs text-slate-500 font-bold mt-0.5">Pantau status laporan dan tanggapan dari Pengurus RT</p>
        </div>
    </div>

    @php
        $sc = match($pengaduan->status) {
            'dikirim'  => [
                'from' => 'from-amber-500',
                'to' => 'to-amber-600',
                'accent' => 'text-amber-100',
                'label' => 'Menunggu Tanggapan RT',
                'desc' => 'Laporan Bapak/Ibu sudah masuk ke sistem kami dan sedang menunggu tanggapan resmi dari Pak RT.',
                'emoji' => '<svg class="w-12 h-12 inline-block text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
            ],
            'diproses' => [
                'from' => 'from-teal-600',
                'to' => 'to-emerald-700',
                'accent' => 'text-teal-100',
                'label' => 'Sedang Ditinjau',
                'desc' => 'Laporan Bapak/Ibu sedang diproses dan ditindaklanjuti oleh Pengurus RT. Mohon ditunggu ya.',
                'emoji' => '<svg class="w-12 h-12 inline-block text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>'
            ],
            'selesai'  => [
                'from' => 'from-emerald-600',
                'to' => 'to-teal-600',
                'accent' => 'text-emerald-100',
                'label' => 'Selesai Ditangani',
                'desc' => 'Alhamdulillah, masalah yang dilaporkan telah selesai ditangani oleh Pengurus RT. Terima kasih atas kepedulian Bapak/Ibu!',
                'emoji' => '<svg class="w-12 h-12 inline-block text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
            ],
            default    => [
                'from' => 'from-slate-600',
                'to' => 'to-slate-700',
                'accent' => 'text-slate-100',
                'label' => 'Laporan Diajukan',
                'desc' => 'Laporan terkirim.',
                'emoji' => '<svg class="w-12 h-12 inline-block text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>'
            ],
        };
    @endphp

    {{-- Status Hero Banner --}}
    <div class="bg-gradient-to-br {{ $sc['from'] }} {{ $sc['to'] }} rounded-[2rem] overflow-hidden shadow-xl shadow-emerald-900/10 relative">
        <div class="absolute inset-0" style="background-image: linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px); background-size: 30px 30px;"></div>
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -translate-y-1/3 translate-x-1/4 blur-2xl pointer-events-none"></div>
        <div class="relative z-10 px-8 py-10 text-center">
            <div class="mb-4 animate-bounce flex justify-center">{!! $sc['emoji'] !!}</div>
            <p class="text-white text-xl md:text-2xl font-black mb-1.5">{{ $sc['label'] }}</p>
            <p class="text-emerald-50 text-xs font-bold max-w-sm mx-auto leading-relaxed">{{ $sc['desc'] }}</p>
        </div>
    </div>

    {{-- Isi Pengaduan --}}
    <div class="card-premium overflow-hidden bg-white border border-slate-100 shadow-sm">
        <div class="px-6 py-4 bg-gradient-to-r from-slate-50 to-emerald-50/20 border-b border-slate-100 flex items-center justify-between">
            <p class="text-[10px] font-black text-emerald-700 uppercase tracking-widest">Detail Laporan Warga</p>
            <div class="flex items-center gap-1.5 text-xs text-slate-500 font-bold">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $pengaduan->created_at->translatedFormat('d M Y • H:i') }} WIB
            </div>
        </div>
        <div class="p-6">
            <h2 class="text-lg md:text-xl font-extrabold text-slate-900 mb-4 leading-snug">{{ $pengaduan->judul }}</h2>
            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5">
                <p class="text-sm text-slate-700 font-bold leading-relaxed whitespace-pre-wrap">{{ $pengaduan->isi }}</p>
            </div>

            @if($pengaduan->foto)
            <div class="mt-5">
                <p class="flex items-center gap-1.5 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2.5"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> FOTO BUKTI / LAMPIRAN</p>
                <a href="{{ Storage::url($pengaduan->foto) }}" target="_blank"
                   class="block overflow-hidden rounded-2xl border border-slate-200 hover:border-emerald-300 hover:shadow-lg hover:shadow-emerald-500/10 transition-all group">
                    <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto Bukti Pengaduan"
                          class="w-full h-auto max-h-80 object-contain bg-slate-100 group-hover:scale-[1.01] transition-transform duration-500">
                </a>
            </div>
            @endif
        </div>
    </div>

    {{-- Tanggapan RT --}}
    @if($pengaduan->tanggapan_admin)
    <div class="bg-gradient-to-br from-emerald-50 to-teal-50/50 border border-emerald-100 rounded-3xl p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-emerald-600 to-teal-600 flex items-center justify-center shadow-md shadow-emerald-600/20 shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-emerald-800 uppercase tracking-wider">Tanggapan Resmi</p>
                <div class="flex items-center gap-1.5">
                    <span class="text-sm font-extrabold text-slate-800">Pak RT 08</span>
                    <span class="text-[9px] bg-emerald-500/10 text-emerald-700 font-black px-1.5 py-0.5 rounded-full flex items-center gap-0.5">
                        <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Terverifikasi
                    </span>
                </div>
            </div>
        </div>
        <div class="bg-white border border-emerald-100 rounded-2xl p-5 shadow-sm relative">
            {{-- Little chat tail decoration --}}
            <div class="absolute -top-2 left-6 w-4 h-4 bg-white rotate-45 border-l border-t border-emerald-100/50"></div>
            <p class="text-sm font-bold text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $pengaduan->tanggapan_admin }}</p>
        </div>
    </div>
    @else
    <div class="bg-white border-2 border-dashed border-slate-200 rounded-3xl p-10 text-center shadow-none">
        <div class="text-emerald-500 mb-3 animate-pulse flex justify-center">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="text-base font-extrabold text-slate-700 mb-1">Sedang Ditinjau RT</h3>
        <p class="text-xs text-slate-400 font-bold max-w-xs mx-auto leading-normal">Laporan Bapak/Ibu saat ini sedang dibaca dan akan segera ditanggapi oleh Pak RT demi kerukunan warga.</p>
    </div>
    @endif

    {{-- Batalkan Laporan (only if masih dikirim) --}}
    @if($pengaduan->status === 'dikirim')
    <div class="pt-2">
        <form method="POST" action="{{ route('warga.pengaduan.destroy', $pengaduan) }}"
              onsubmit="confirmAction(event, 'Apakah Bapak/Ibu yakin ingin membatalkan dan menghapus laporan pengaduan ini secara permanen?')">
            @csrf @method('DELETE')
            <button type="submit"
                    class="w-full py-4 bg-white border-2 border-slate-200 text-slate-500 hover:border-red-300 hover:text-red-600 hover:bg-rose-50/20 font-black rounded-2xl transition-all text-sm flex items-center justify-center gap-2 group shadow-sm">
                <svg class="w-4.5 h-4.5 text-slate-400 group-hover:text-red-500 group-hover:scale-110 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Batalkan & Hapus Pengaduan Saya
            </button>
        </form>
    </div>
    @endif
</div>
@endsection

