@extends('layouts.app')

@section('title', 'Kartu Keluarga — Admin RT 08')
@section('page-title', 'Kartu Keluarga')
@section('page-subtitle', 'Kelola data kartu keluarga warga RT 08')

@section('content')
<div class="space-y-5">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <form method="GET" action="{{ route('admin.kartu-keluarga.index') }}" class="flex items-center gap-2 flex-1 max-w-sm">
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari No. KK atau kepala keluarga…"
                       class="w-full pl-9 pr-4 py-2 text-sm rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
            </div>
            <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-sm rounded-xl hover:bg-emerald-700 transition-colors">Cari</button>
            @if(request('search'))
            <a href="{{ route('admin.kartu-keluarga.index') }}" class="px-3 py-2 text-sm text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50">Reset</a>
            @endif
        </form>

        <a href="{{ route('admin.kartu-keluarga.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-xl hover:bg-emerald-700 transition-colors shadow-sm shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah KK
        </a>
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-emerald-600 to-teal-600 border-b-0">
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">No. KK</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">Kepala Keluarga</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">Alamat</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">RT/RW</th>
                        <th class="text-center px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">Anggota</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-white/90 uppercase tracking-wider">Didaftarkan</th>
                        <th class="px-5 py-3.5"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($kartuKeluarga as $kk)
                    <tr class="hover:bg-emerald-50/60 transition-colors border-b border-slate-50">
                        <td class="px-5 py-3.5">
                            <span class="font-mono text-slate-700">{{ $kk->no_kk }}</span>
                        </td>
                        <td class="px-5 py-3.5 font-medium text-slate-800">{{ $kk->kepala_keluarga }}</td>
                        <td class="px-5 py-3.5 text-slate-500 max-w-xs truncate">{{ $kk->alamat }}</td>
                        <td class="px-5 py-3.5 text-slate-600">RT {{ $kk->rt }} / RW {{ $kk->rw }}</td>
                        <td class="px-5 py-3.5 text-center">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold">
                                {{ $kk->warga_count }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-slate-400 text-xs">{{ $kk->created_at->format('d/m/Y') }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-2 justify-end">
                                <a href="{{ route('admin.kartu-keluarga.show', $kk) }}"
                                   class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.kartu-keluarga.edit', $kk) }}"
                                   class="p-1.5 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.kartu-keluarga.destroy', $kk) }}"
                                      onsubmit="confirmAction(event, 'Hapus Kartu Keluarga ini? Pastikan tidak ada anggota warga terdaftar.')">
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
                        <td colspan="7" class="px-5 py-12 text-center text-slate-400">
                            <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="font-medium">Belum ada data Kartu Keluarga.</p>
                            <a href="{{ route('admin.kartu-keluarga.create') }}" class="text-emerald-600 text-sm mt-1 inline-block hover:underline">Tambah sekarang →</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kartuKeluarga->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">
            {{ $kartuKeluarga->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
