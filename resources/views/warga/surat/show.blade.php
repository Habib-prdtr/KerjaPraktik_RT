@extends('layouts.warga')
@section('title', 'Detail Surat Pengantar — Portal Warga RT 08')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 space-y-5 pb-8">

    {{-- ====== BACK HEADER ====== --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('warga.surat.index') }}"
           class="w-11 h-11 rounded-2xl bg-white border border-slate-200 hover:border-emerald-300 hover:bg-emerald-50 flex items-center justify-center transition-all shadow-sm group">
            <svg class="w-5 h-5 text-slate-600 group-hover:text-emerald-600 group-hover:-translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 leading-tight">Detail Surat Pengantar</h1>
            <p class="text-xs text-slate-500 font-bold mt-0.5">Pantau proses pengurusan surat pengantar Anda</p>
        </div>
    </div>

    @php
        $statusConf = match($surat->status) {
            'diajukan' => [
                'icon'    => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                'from'    => 'from-slate-700',
                'to'      => 'to-slate-900',
                'accent'  => 'text-slate-300',
                'label'   => 'Menunggu Pengurus RT',
                'desc'    => 'Pengajuan Bapak/Ibu sudah terkirim ke sistem. Pak RT akan segera memvalidasi berkas.',
                'emoji'   => '<svg class="w-12 h-12 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            ],
            'diproses' => [
                'icon'    => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15',
                'from'    => 'from-amber-600',
                'to'      => 'to-orange-700',
                'accent'  => 'text-amber-200',
                'label'   => 'Surat Sedang Dibuat',
                'desc'    => 'Pengurus RT sedang memproses surat pengantar Bapak/Ibu. Mohon ditunggu ya.',
                'emoji'   => '<svg class="w-12 h-12 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>',
            ],
            'selesai'  => [
                'icon'    => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                'from'    => 'from-emerald-600',
                'to'      => 'to-teal-700',
                'accent'  => 'text-emerald-200',
                'label'   => 'Surat Selesai & Siap',
                'desc'    => 'Selamat! Surat pengantar sudah selesai. Silakan ambil fisik surat resmi di rumah Pak RT.',
                'emoji'   => '<svg class="w-12 h-12 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            ],
            'ditolak'  => [
                'icon'    => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
                'from'    => 'from-rose-600',
                'to'      => 'to-red-800',
                'accent'  => 'text-rose-200',
                'label'   => 'Perlu Perbaikan / Ditolak',
                'desc'    => 'Pengajuan ini ditolak oleh Pengurus RT. Baca alasan penolakannya pada catatan di bawah.',
                'emoji'   => '<svg class="w-12 h-12 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            ],
            default    => [
                'icon'    => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                'from'    => 'from-slate-700',
                'to'      => 'to-slate-900',
                'accent'  => 'text-slate-300',
                'label'   => $surat->status,
                'desc'    => '',
                'emoji'   => '<svg class="w-12 h-12 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
            ],
        };
    @endphp

    {{-- ====== STATUS HERO CARD ====== --}}
    <div class="bg-gradient-to-br {{ $statusConf['from'] }} {{ $statusConf['to'] }} rounded-[2.5rem] overflow-hidden shadow-lg shadow-slate-900/10 relative">
        <div class="absolute inset-0" style="background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 30px 30px;"></div>
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -translate-y-1/3 translate-x-1/4 blur-2xl pointer-events-none"></div>
        <div class="relative z-10 px-8 py-10 text-center">
            <div class="mb-4">{!! $statusConf['emoji'] !!}</div>
            <div class="w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mx-auto mb-5 border border-white/25">
                <svg class="w-8 h-8 {{ $statusConf['accent'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $statusConf['icon'] }}"/>
                </svg>
            </div>
            <p class="text-white text-2xl font-extrabold mb-2">{{ $statusConf['label'] }}</p>
            <p class="text-white/70 text-xs font-semibold max-w-md mx-auto leading-relaxed">{{ $statusConf['desc'] }}</p>
        </div>
    </div>

    {{-- ====== MAIN INFO CARD ====== --}}
    <div class="card-premium overflow-hidden bg-white">
        <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
            <p class="text-xs font-black text-emerald-700 uppercase tracking-widest">Detail Dokumen Pengantar</p>
            @if($surat->status == 'selesai')
            <span class="text-xs font-bold text-emerald-600">Dokumen Resmi Terbit</span>
            @endif
        </div>
        <div class="divide-y divide-slate-100">
            @foreach([
                ['label' => 'Nomor Pengantar', 'value' => '<span class="font-mono text-xs bg-slate-100 border border-slate-200 px-3 py-1 rounded-lg font-bold text-slate-700">'.($surat->nomor_surat ?? 'Menunggu Persetujuan RT').'</span>', 'raw' => true],
                ['label' => 'Jenis Surat', 'value' => $surat->jenis_surat, 'raw' => false],
                ['label' => 'Tanggal Pengajuan', 'value' => $surat->created_at->translatedFormat('d F Y'), 'raw' => false],
                ['label' => 'Keperluan Surat', 'value' => $surat->keperluan ?? '-', 'raw' => false],
            ] as $row)
            <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-6 hover:bg-slate-50/50 transition-colors">
                <span class="text-xs text-slate-400 font-extrabold shrink-0 uppercase tracking-wider">{{ $row['label'] }}</span>
                @if($row['raw'])
                    <div class="text-slate-800 text-left sm:text-right mt-1 sm:mt-0">{!! $row['value'] !!}</div>
                @else
                    <span class="text-sm font-bold text-slate-800 text-left sm:text-right leading-relaxed">{{ $row['value'] }}</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    {{-- ====== KETERANGAN DARI ADMIN RT ====== --}}
    @if($surat->keterangan)
    <div class="bg-amber-50/50 border border-amber-200 rounded-3xl p-5">
        <div class="flex items-center gap-2.5 mb-3">
            <div class="w-8 h-8 rounded-xl bg-amber-100 border border-amber-200 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            </div>
            <p class="text-xs font-black text-amber-800 uppercase tracking-widest">Catatan Pengurus RT</p>
        </div>
        <div class="bg-white border border-amber-100 rounded-2xl p-4">
            <p class="text-sm text-slate-700 font-bold leading-relaxed">{{ $surat->keterangan }}</p>
        </div>
    </div>
    @endif

    {{-- ====== DOWNLOAD PDF ====== --}}
    @if($surat->file_pdf)
    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-3xl p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-500/25 shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            </div>
            <div>
                <h4 class="font-extrabold text-emerald-950 text-base">Surat Siap Diunduh!</h4>
                <p class="text-xs font-bold text-emerald-700 mt-0.5">Dokumen digital PDF telah diunggah oleh Pak RT</p>
            </div>
        </div>
        <a href="{{ Storage::url($surat->file_pdf) }}" download
           class="w-full sm:w-auto flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-extrabold px-6 py-3.5 rounded-2xl transition-all hover:-translate-y-0.5 shadow-lg shadow-emerald-500/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Unduh Berkas PDF
        </a>
    </div>
    @endif

    {{-- ====== VISUAL TIMELINE STEPS ====== --}}
    <div class="card-premium p-6 bg-white">
        <p class="text-xs font-black text-emerald-700 uppercase tracking-widest mb-6">Langkah Proses Pembuatan Surat</p>
        @php
            $steps = ['diajukan', 'diproses', 'selesai'];
            $currentIdx = array_search($surat->status, $steps);
            $stepLabels = ['diajukan' => 'Surat Pengantar Diajukan', 'diproses' => 'Pengecekan & Pengisian Data', 'selesai' => 'Surat Pengantar Selesai'];
            $stepDescs = [
                'diajukan' => 'Permohonan terkirim, menunggu Pak RT mengecek berkas.',
                'diproses' => 'Data diketik dan ditandatangani basah oleh Pengurus RT.',
                'selesai' => 'Surat sudah selesai dibuat, dicap basah, dan siap diserahkan.'
            ];
        @endphp
        <div class="relative">
            <div class="absolute left-[1.15rem] top-2 bottom-2 w-0.5 bg-slate-100"></div>
            <div class="space-y-6">
                @foreach($steps as $i => $step)
                @php
                    $done = $currentIdx !== false && $i <= $currentIdx && $surat->status !== 'ditolak';
                    $isCur = $surat->status === $step;
                @endphp
                <div class="relative flex items-start gap-4">
                    <div class="relative z-10 w-9 h-9 rounded-full border-4 border-white shadow-md flex items-center justify-center shrink-0
                                {{ $done ? 'bg-gradient-to-br from-emerald-500 to-teal-600' : 'bg-slate-100' }}">
                        @if($done)
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        @else
                        <div class="w-2 h-2 rounded-full bg-slate-300"></div>
                        @endif
                    </div>
                    <div class="flex-1 pt-1 pb-1">
                        <div class="flex items-center justify-between gap-3">
                            <p class="font-extrabold text-sm {{ $done ? 'text-emerald-800' : 'text-slate-400' }}">{{ $stepLabels[$step] }}</p>
                            @if($isCur && $surat->status !== 'selesai')
                            <span class="text-[9px] font-black bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-md uppercase tracking-wider">Langkah Aktif</span>
                            @endif
                        </div>
                        <p class="text-xs text-slate-500 font-medium mt-1 leading-normal">{{ $stepDescs[$step] }}</p>
                    </div>
                </div>
                @endforeach

                @if($surat->status === 'ditolak')
                <div class="relative flex items-start gap-4">
                    <div class="relative z-10 w-9 h-9 rounded-full border-4 border-white shadow-md flex items-center justify-center shrink-0 bg-gradient-to-br from-rose-500 to-red-600">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <div class="flex-1 pt-1">
                        <div class="flex items-center justify-between">
                            <p class="font-extrabold text-sm text-red-600">Pengajuan Dihentikan / Perlu Perbaikan</p>
                            <span class="text-[9px] font-black bg-red-100 text-red-700 px-2 py-0.5 rounded-md uppercase tracking-wider">Perbaiki</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium mt-1 leading-normal">Silakan hubungi pengurus RT atau ajukan kembali dengan memperbaiki rincian data Anda.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
