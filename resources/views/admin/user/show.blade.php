@extends('layouts.app')

@section('title', 'Detail Pengguna — Admin RT 08')
@section('page-title', 'Detail Pengguna')
@section('page-subtitle', 'Informasi akun pengguna sistem')

@section('content')
<div class="max-w-3xl mx-auto space-y-5">

    {{-- Info User --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">Profil Pengguna</h2>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.user.edit', $user) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-amber-700 bg-amber-50 rounded-xl hover:bg-amber-100 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                @if($user->id !== Auth::id())
                <form method="POST" action="{{ route('admin.user.destroy', $user) }}"
                      onsubmit="return confirm('Hapus akun {{ $user->name }}?')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-red-700 bg-red-50 rounded-xl hover:bg-red-100 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
                @endif
                <a href="{{ route('admin.user.index') }}"
                   class="px-3 py-2 text-sm text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors">
                    ← Kembali
                </a>
            </div>
        </div>

        <div class="px-6 py-5">
            <div class="flex items-center gap-5 mb-6">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shrink-0">
                    <span class="text-white text-2xl font-bold">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-800">{{ $user->name }}</h3>
                    <p class="text-slate-500 text-sm mt-0.5">{{ $user->email }}</p>
                    @php $roleColor = $user->role === 'admin' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600'; @endphp
                    <span class="inline-block mt-1 text-xs px-2.5 py-0.5 rounded-full font-medium capitalize {{ $roleColor }}">{{ $user->role }}</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-5 text-sm">
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Terdaftar sejak</p>
                    <p class="mt-1 text-slate-700 font-medium">{{ $user->created_at->translatedFormat('d F Y') }}</p>
                </div>
                @if($user->warga)
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Status Warga</p>
                    <p class="mt-1">
                        <span class="text-green-600 font-medium">✓ Terhubung ke data warga</span>
                    </p>
                </div>
                @else
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Status Warga</p>
                    <p class="mt-1 text-slate-400 text-xs">Tidak terhubung ke data warga</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Data Warga Terhubung --}}
    @if($user->warga)
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">Data Warga Terhubung</h2>
            <a href="{{ route('admin.warga.show', $user->warga) }}" class="text-sm text-blue-600 hover:underline">Lihat Detail →</a>
        </div>
        <div class="px-6 py-5 grid grid-cols-2 lg:grid-cols-3 gap-5 text-sm">
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Nama</p>
                <p class="mt-1 font-semibold text-slate-800">{{ $user->warga->nama }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">NIK</p>
                <p class="mt-1 font-mono text-slate-700">{{ $user->warga->nik }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Status</p>
                @php
                    $sc = match($user->warga->status) {
                        'aktif'     => 'bg-green-100 text-green-700',
                        'pindah'    => 'bg-amber-100 text-amber-700',
                        'meninggal' => 'bg-slate-100 text-slate-500',
                        default     => 'bg-slate-100 text-slate-500',
                    };
                @endphp
                <span class="inline-block mt-1 text-xs px-2.5 py-0.5 rounded-full font-medium capitalize {{ $sc }}">{{ $user->warga->status }}</span>
            </div>
            @if($user->warga->kartuKeluarga)
            <div class="col-span-2 lg:col-span-3">
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Kartu Keluarga</p>
                <a href="{{ route('admin.kartu-keluarga.show', $user->warga->kartuKeluarga) }}"
                   class="mt-1 block text-blue-600 hover:underline">
                    {{ $user->warga->kartuKeluarga->kepala_keluarga }} ({{ $user->warga->kartuKeluarga->no_kk }})
                </a>
            </div>
            @endif
        </div>
    </div>
    @endif

</div>
@endsection
