@extends('layouts.app')

@section('title', 'Pengaduan Warga — Admin RT 08')
@section('page-title', 'Pengaduan Warga')
@section('page-subtitle', 'Tangani laporan dan pengaduan warga')

@section('content')
<div class="space-y-5">

    {{-- Filter --}}
    <form method="GET" action="{{ route('admin.pengaduan.index') }}" class="flex flex-wrap items-center gap-2">
        <div class="relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari judul atau nama warga…"
                   class="pl-9 pr-4 py-2 text-sm rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 w-60">
        </div>
        <select name="status" class="px-3 py-2 text-sm rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
            <option value="">Semua Status</option>
            @foreach($statusList as $s)
            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-sm rounded-xl hover:bg-emerald-700 transition-colors">Filter</button>
        @if(request()->hasAny(['search','status']))
        <a href="{{ route('admin.pengaduan.index') }}" class="px-3 py-2 text-sm text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50">Reset</a>
        @endif
    </form>

    {{-- Tabel --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-emerald-600 to-teal-600 border-b-0">
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">Judul Pengaduan</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">Warga</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">Tanggal</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">Foto</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3.5"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($pengaduan as $p)
                    <tr class="hover:bg-emerald-50/60 transition-colors border-b border-slate-50">
                        <td class="px-5 py-3.5">
                            <p class="font-medium text-slate-800">{{ $p->judul }}</p>
                            <p class="text-xs text-slate-400 mt-0.5 line-clamp-1">{{ Str::limit($p->isi, 60) }}</p>
                        </td>
                        <td class="px-5 py-3.5 text-slate-600">{{ $p->warga->nama ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-slate-400 text-xs">{{ $p->created_at->diffForHumans() }}</td>
                        <td class="px-5 py-3.5">
                            @if($p->foto)
                            <span class="inline-block w-5 h-5 text-green-500">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            @else
                            <span class="text-slate-300 text-xs">-</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5">
                            @php
                                $sc = match($p->status) {
                                    'dikirim'  => 'bg-amber-100 text-amber-700',
                                    'diproses' => 'bg-emerald-100 text-emerald-700',
                                    'selesai'  => 'bg-green-100 text-green-700',
                                    default    => 'bg-slate-100 text-slate-600',
                                };
                            @endphp
                            <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $sc }} capitalize">{{ $p->status }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <a href="{{ route('admin.pengaduan.show', $p) }}" class="text-xs text-emerald-600 hover:underline">Tanggapi →</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center text-slate-400">
                            <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <p>Belum ada pengaduan masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pengaduan->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">
            {{ $pengaduan->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
