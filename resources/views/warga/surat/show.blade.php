@extends('layouts.warga')

@section('title', 'Detail Surat')
@section('page-subtitle', 'Status Surat')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">
    <div class="glass-panel rounded-[2rem] p-6 flex items-center gap-4 relative overflow-hidden">
        <a href="{{ route('warga.surat.index') }}" class="w-12 h-12 rounded-[1rem] bg-white border border-slate-200 hover:bg-slate-50 flex items-center justify-center transition-all shadow-sm hover:shadow group shrink-0 relative z-10">
            <svg class="w-6 h-6 text-slate-600 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div class="relative z-10">
            <h1 class="text-xl lg:text-2xl font-black text-slate-800">Detail Surat</h1>
            <p class="text-sm font-medium text-slate-500 mt-0.5">Lacak status proses surat pengantar Anda</p>
        </div>
    </div>

    @php
        $statusConf = match($surat->status) {
            'diajukan' => ['emoji'=>'⏳','bg'=>'from-slate-400 to-slate-600','label'=>'Menunggu Diproses','desc'=>'Pengajuan Anda sudah diterima dan menunggu diproses oleh Admin RT.'],
            'diproses' => ['emoji'=>'🔄','bg'=>'from-blue-500 to-indigo-600','label'=>'Sedang Diproses','desc'=>'Surat Anda sedang dalam proses pembuatan oleh Admin RT.'],
            'selesai'  => ['emoji'=>'✅','bg'=>'from-green-400 to-emerald-600','label'=>'Selesai','desc'=>'Surat Anda sudah selesai! Silakan ambil ke kantor RT.'],
            'ditolak'  => ['emoji'=>'❌','bg'=>'from-red-500 to-rose-600','label'=>'Ditolak','desc'=>'Maaf, pengajuan surat Anda ditolak. Lihat keterangan di bawah.'],
            default    => ['emoji'=>'📄','bg'=>'from-slate-500 to-slate-600','label'=>$surat->status,'desc'=>''],
        };
    @endphp

    {{-- Status Hero --}}
    <div class="bg-gradient-to-br {{ $statusConf['bg'] }} px-6 pt-8 pb-12 relative overflow-hidden rounded-[2rem] shadow-xl shadow-slate-500/20">
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full -translate-y-1/3 translate-x-1/3 blur-xl"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-black/10 rounded-full translate-y-1/3 -translate-x-1/3 blur-xl"></div>
        <div class="relative z-10 text-center">
            <div class="w-24 h-24 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center mx-auto mb-4 border border-white/30 shadow-inner">
                <div class="text-5xl drop-shadow-md">{{ $statusConf['emoji'] }}</div>
            </div>
            <p class="text-white text-2xl font-black tracking-tight drop-shadow-sm">{{ $statusConf['label'] }}</p>
            <p class="text-white/80 text-sm font-medium mt-2 max-w-sm mx-auto leading-relaxed">{{ $statusConf['desc'] }}</p>
        </div>
    </div>

    <div class="-mt-8 relative z-20 space-y-6 pb-6">
        {{-- Info Utama --}}
        <div class="glass-panel rounded-[2rem] shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100/50 bg-white/50 backdrop-blur-md">
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Informasi Surat</p>
            </div>
            <div class="divide-y divide-slate-100/50 bg-white/80">
                <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50/50 transition-colors">
                    <span class="text-sm text-slate-500 font-bold">Nomor Surat</span>
                    <span class="text-sm font-black font-mono text-slate-800 bg-slate-100 px-3 py-1 rounded-md">{{ $surat->nomor_surat }}</span>
                </div>
                <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50/50 transition-colors">
                    <span class="text-sm text-slate-500 font-bold">Jenis Surat</span>
                    <span class="text-sm font-black text-slate-800 text-right max-w-[60%]">{{ $surat->jenis_surat }}</span>
                </div>
                <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50/50 transition-colors">
                    <span class="text-sm text-slate-500 font-bold">Tanggal Ajuan</span>
                    <span class="text-sm font-black text-slate-800">{{ $surat->created_at->translatedFormat('d M Y') }}</span>
                </div>
                <div class="px-6 py-4 flex items-start justify-between gap-4 hover:bg-slate-50/50 transition-colors">
                    <span class="text-sm text-slate-500 font-bold shrink-0">Keperluan</span>
                    <span class="text-sm font-semibold text-slate-700 text-right leading-relaxed">{{ $surat->keperluan ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- Keterangan Admin --}}
        @if($surat->keterangan)
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200/60 rounded-[1.5rem] p-5 shadow-sm">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/></svg>
                <p class="text-sm font-black text-blue-700 uppercase tracking-widest">Keterangan Admin RT</p>
            </div>
            <p class="text-sm text-blue-900 font-medium leading-relaxed bg-white/50 rounded-xl p-3 border border-blue-100">{{ $surat->keterangan }}</p>
        </div>
        @endif

        {{-- Timeline / Steps --}}
        <div class="glass-panel rounded-[2rem] p-6 lg:p-8">
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-6">Jejak Status</p>
            <div class="space-y-6 relative before:absolute before:inset-0 before:ml-[1.1rem] before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-200 before:to-transparent">
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
                <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                    <!-- Icon -->
                    <div class="flex items-center justify-center w-9 h-9 rounded-full border-4 border-white {{ $isDone ? 'bg-green-500 shadow-md shadow-green-500/20' : 'bg-slate-200' }} text-slate-500 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 transition-colors duration-300 z-10">
                        @if($isDone)
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        @else
                        <div class="w-2.5 h-2.5 rounded-full bg-slate-400"></div>
                        @endif
                    </div>
                    <!-- Card -->
                    <div class="w-[calc(100%-3rem)] md:w-[calc(50%-2.5rem)] p-4 rounded-xl {{ $isCurrent ? 'bg-white shadow-md border border-blue-100 ring-2 ring-blue-50' : 'bg-slate-50/50 border border-slate-100' }} transition-all">
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="font-bold {{ $isDone ? 'text-green-700' : 'text-slate-500' }}">{{ $labels[$step] }}</h3>
                            @if($isCurrent && $surat->status !== 'selesai')
                            <span class="text-[10px] font-black bg-blue-100 text-blue-700 px-2 py-1 rounded-md uppercase tracking-wider">Saat ini</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                
                @if($surat->status === 'ditolak')
                <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                    <div class="flex items-center justify-center w-9 h-9 rounded-full border-4 border-white bg-red-500 shadow-md shadow-red-500/20 shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <div class="w-[calc(100%-3rem)] md:w-[calc(50%-2.5rem)] p-4 rounded-xl bg-red-50 border border-red-100 ring-2 ring-red-50">
                        <h3 class="font-bold text-red-600">Pengajuan Ditolak</h3>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
