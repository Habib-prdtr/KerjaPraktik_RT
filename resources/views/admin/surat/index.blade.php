@extends('layouts.app')

@section('title', 'Surat Menyurat — Admin RT 08')
@section('page-title', 'Surat Menyurat')
@section('page-subtitle', 'Kelola semua pengajuan surat warga')

@section('content')
<div class="space-y-5">

    {{-- Filter --}}
    <form method="GET" action="{{ route('admin.surat.index') }}" class="flex flex-wrap items-center gap-2">
        <div class="relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nomor, jenis, atau nama warga…"
                   class="pl-9 pr-4 py-2 text-sm rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 w-64">
        </div>
        <select name="status" class="px-3 py-2 text-sm rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
            <option value="">Semua Status</option>
            @foreach($statusList as $s)
            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }} class="capitalize">{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-sm rounded-xl hover:bg-emerald-700 transition-colors">Filter</button>
        @if(request()->hasAny(['search','status']))
        <a href="{{ route('admin.surat.index') }}" class="px-3 py-2 text-sm text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50">Reset</a>
        @endif
    </form>

    {{-- Status Summary --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        @php
            $statusBadges = [
                'diajukan' => ['bg-slate-100 text-slate-600', 'Diajukan'],
                'diproses' => ['bg-emerald-100 text-emerald-700', 'Diproses'],
                'selesai'  => ['bg-green-100 text-green-700', 'Selesai'],
                'ditolak'  => ['bg-red-100 text-red-700', 'Ditolak'],
            ];
        @endphp
        @foreach($statusBadges as $key => [$cls, $label])
        <a href="{{ route('admin.surat.index', ['status' => $key]) }}"
           class="flex items-center gap-2 px-4 py-2.5 bg-white rounded-xl border border-slate-100 shadow-sm hover:border-emerald-200 transition-colors {{ request('status') === $key ? 'ring-2 ring-emerald-500' : '' }}">
            <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $cls }}">{{ $label }}</span>
        </a>
        @endforeach
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-emerald-600 to-teal-600 border-b-0">
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">Nomor Surat</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">Jenis Surat</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">Warga</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">Tanggal</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3.5"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($surat as $s)
                    <tr class="hover:bg-emerald-50/60 transition-colors border-b border-slate-50">
                        <td class="px-5 py-3.5 font-mono text-xs text-slate-600">{{ $s->nomor_surat }}</td>
                        <td class="px-5 py-3.5 font-medium text-slate-800">{{ $s->jenis_surat }}</td>
                        <td class="px-5 py-3.5 text-slate-600">{{ $s->warga->nama ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-slate-400 text-xs">{{ $s->created_at->format('d/m/Y') }}</td>
                        <td class="px-5 py-3.5">
                            @php
                                $sc = match($s->status) {
                                    'diajukan'  => 'bg-slate-100 text-slate-600',
                                    'diproses'  => 'bg-emerald-100 text-emerald-700',
                                    'selesai'   => 'bg-green-100 text-green-700',
                                    'ditolak'   => 'bg-red-100 text-red-700',
                                    default     => 'bg-slate-100 text-slate-600',
                                };
                            @endphp
                            <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $sc }} capitalize">{{ $s->status }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <a href="{{ route('admin.surat.show', $s) }}"
                               class="inline-flex items-center gap-1 text-xs text-emerald-600 hover:underline">
                                Proses →
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center text-slate-400">
                            <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p>Belum ada pengajuan surat.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($surat->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">
            {{ $surat->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
