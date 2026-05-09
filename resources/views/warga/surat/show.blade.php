@extends('layouts.warga')

@section('title', 'Detail Surat')
@section('page-subtitle', 'Status Surat')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="bg-white border-b border-slate-100 px-4 py-4 flex items-center gap-3">
        <a href="{{ route('warga.surat.index') }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-base font-bold text-slate-800">Detail Surat</h1>
    </div>

    @php
        $statusConf = match($surat->status) {
            'diajukan' => ['emoji'=>'⏳','bg'=>'from-slate-500 to-slate-600','label'=>'Menunggu Diproses','desc'=>'Pengajuan Anda sudah diterima dan menunggu diproses oleh Admin RT.'],
            'diproses' => ['emoji'=>'🔄','bg'=>'from-blue-500 to-indigo-600','label'=>'Sedang Diproses','desc'=>'Surat Anda sedang dalam proses pembuatan oleh Admin RT.'],
            'selesai'  => ['emoji'=>'✅','bg'=>'from-green-500 to-emerald-600','label'=>'Selesai','desc'=>'Surat Anda sudah selesai! Silakan ambil ke kantor RT.'],
            'ditolak'  => ['emoji'=>'❌','bg'=>'from-red-500 to-rose-600','label'=>'Ditolak','desc'=>'Maaf, pengajuan surat Anda ditolak. Lihat keterangan di bawah.'],
            default    => ['emoji'=>'📄','bg'=>'from-slate-500 to-slate-600','label'=>$surat->status,'desc'=>''],
        };
    @endphp

    {{-- Status Hero --}}
    <div class="bg-gradient-to-br {{ $statusConf['bg'] }} px-4 pt-6 pb-10 relative overflow-hidden rounded-3xl">
        <div class="absolute top-0 right-0 w-36 h-36 bg-white/10 rounded-full -translate-y-1/3 translate-x-1/3"></div>
        <div class="relative z-10 text-center">
            <div class="text-5xl mb-3">{{ $statusConf['emoji'] }}</div>
            <p class="text-white text-xl font-black">{{ $statusConf['label'] }}</p>
            <p class="text-white/75 text-xs mt-2 max-w-xs mx-auto">{{ $statusConf['desc'] }}</p>
        </div>
    </div>

    <div class="px-4 -mt-5 space-y-4 pb-6">
        {{-- Info Utama --}}
        <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/60 border border-slate-100 overflow-hidden">
            <div class="px-5 py-3 border-b border-slate-100 bg-slate-50">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Informasi Surat</p>
            </div>
            <div class="divide-y divide-slate-50">
                <div class="px-5 py-3.5 flex items-center justify-between">
                    <span class="text-xs text-slate-400 font-medium">Nomor Surat</span>
                    <span class="text-xs font-bold font-mono text-slate-700">{{ $surat->nomor_surat }}</span>
                </div>
                <div class="px-5 py-3.5 flex items-center justify-between">
                    <span class="text-xs text-slate-400 font-medium">Jenis Surat</span>
                    <span class="text-xs font-bold text-slate-700 text-right max-w-[60%]">{{ $surat->jenis_surat }}</span>
                </div>
                <div class="px-5 py-3.5 flex items-center justify-between">
                    <span class="text-xs text-slate-400 font-medium">Tanggal Ajuan</span>
                    <span class="text-xs font-bold text-slate-700">{{ $surat->created_at->translatedFormat('d M Y') }}</span>
                </div>
                <div class="px-5 py-3.5 flex items-start justify-between gap-3">
                    <span class="text-xs text-slate-400 font-medium shrink-0">Keperluan</span>
                    <span class="text-xs text-slate-700 text-right">{{ $surat->keperluan ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- Keterangan Admin --}}
        @if($surat->keterangan)
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4">
            <p class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-2">💬 Keterangan dari Admin RT</p>
            <p class="text-sm text-blue-800 leading-relaxed">{{ $surat->keterangan }}</p>
        </div>
        @endif

        {{-- Timeline / Steps --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Status Pengajuan</p>
            <div class="space-y-3">
                @php
                    $steps = ['diajukan','diproses','selesai'];
                    $currentIdx = array_search($surat->status, $steps);
                @endphp
                @foreach($steps as $i => $step)
                @php
                    $isDone = $currentIdx !== false && $i <= $currentIdx && $surat->status !== 'ditolak';
                    $isCurrent = $surat->status === $step;
                    $labels = ['diajukan'=>'Surat Diajukan','diproses'=>'Sedang Diproses','selesai'=>'Surat Selesai'];
                @endphp
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-full {{ $isDone ? 'bg-green-500' : 'bg-slate-200' }} flex items-center justify-center shrink-0 transition-colors">
                        @if($isDone)
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        @else
                        <div class="w-2 h-2 rounded-full bg-slate-400"></div>
                        @endif
                    </div>
                    <p class="text-sm font-semibold {{ $isDone ? 'text-green-700' : 'text-slate-400' }}">{{ $labels[$step] }}</p>
                    @if($isCurrent && $surat->status !== 'selesai')
                    <span class="ml-auto text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-bold">Saat ini</span>
                    @endif
                </div>
                @endforeach
                @if($surat->status === 'ditolak')
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-full bg-red-500 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <p class="text-sm font-semibold text-red-600">Pengajuan Ditolak</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
