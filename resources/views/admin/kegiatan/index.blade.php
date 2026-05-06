@extends('layouts.app')

@section('title', 'Kegiatan RT — Admin RT 08')
@section('page-title', 'Kegiatan RT')
@section('page-subtitle', 'Kelola agenda dan kegiatan RT 08')

@section('content')
<div class="space-y-5">

    {{-- Filter & Header --}}
    <div class="flex flex-col sm:flex-row gap-3 justify-between items-start sm:items-center">
        <form method="GET" action="{{ route('admin.kegiatan.index') }}" class="flex flex-wrap items-center gap-2">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama atau lokasi…"
                       class="pl-9 pr-4 py-2 text-sm rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 w-52">
            </div>
            <select name="filter" class="px-3 py-2 text-sm rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Kegiatan</option>
                <option value="mendatang" {{ request('filter') === 'mendatang' ? 'selected' : '' }}>Mendatang</option>
                <option value="lewat" {{ request('filter') === 'lewat' ? 'selected' : '' }}>Sudah Lewat</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-slate-100 text-slate-700 text-sm rounded-xl hover:bg-slate-200 transition-colors">Filter</button>
            @if(request()->hasAny(['search','filter']))
            <a href="{{ route('admin.kegiatan.index') }}" class="text-sm text-slate-500 hover:underline">Reset</a>
            @endif
        </form>

        <a href="{{ route('admin.kegiatan.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors shadow-sm shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Kegiatan
        </a>
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50">
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Kegiatan</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Lokasi</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3.5"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($kegiatan as $k)
                    @php $isMendatang = \Carbon\Carbon::parse($k->tanggal)->isFuture(); @endphp
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3.5">
                            <p class="font-medium text-slate-800">{{ $k->nama_kegiatan }}</p>
                            @if($k->deskripsi)
                            <p class="text-xs text-slate-400 mt-0.5 line-clamp-1">{{ $k->deskripsi }}</p>
                            @endif
                        </td>
                        <td class="px-5 py-3.5">
                            <p class="text-slate-700 font-medium">{{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d F Y') }}</p>
                        </td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $k->lokasi }}</td>
                        <td class="px-5 py-3.5">
                            <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $isMendatang ? 'bg-teal-100 text-teal-700' : 'bg-slate-100 text-slate-500' }}">
                                {{ $isMendatang ? 'Mendatang' : 'Selesai' }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-1.5 justify-end">
                                <a href="{{ route('admin.kegiatan.show', $k) }}"
                                   class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.kegiatan.edit', $k) }}"
                                   class="p-1.5 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.kegiatan.destroy', $k) }}"
                                      onsubmit="return confirm('Hapus kegiatan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-slate-400">
                            <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p>Belum ada data kegiatan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($kegiatan->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">
            {{ $kegiatan->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
