@extends('layouts.app')

@section('title', 'Detail Pengumuman — Admin RT 08')
@section('page-title', 'Detail Pengumuman')
@section('page-subtitle', 'Isi pengumuman lengkap')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">Detail Pengumuman</h2>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.pengumuman.edit', $pengumuman) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-amber-700 bg-amber-50 rounded-xl hover:bg-amber-100 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form method="POST" action="{{ route('admin.pengumuman.destroy', $pengumuman) }}"
                      onsubmit="confirmAction(event, 'Hapus pengumuman ini?')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-red-700 bg-red-50 rounded-xl hover:bg-red-100 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
                <a href="{{ route('admin.pengumuman.index') }}"
                   class="px-3 py-2 text-sm text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors">
                    ← Kembali
                </a>
            </div>
        </div>

        <div class="px-6 py-5 space-y-5">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-purple-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-slate-800">{{ $pengumuman->judul }}</h1>
                    <div class="flex items-center gap-3 mt-1">
                        <span class="text-sm text-slate-400">
                            {{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('d F Y') }}
                        </span>
                        @if($pengumuman->user)
                        <span class="text-slate-300">·</span>
                        <span class="text-sm text-slate-400">oleh <span class="text-slate-600 font-medium">{{ $pengumuman->user->name }}</span></span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="prose prose-slate max-w-none text-sm leading-relaxed text-slate-700 bg-slate-50 rounded-xl p-5 whitespace-pre-wrap">{{ $pengumuman->isi }}</div>

            @if($pengumuman->foto)
            <div class="mt-4">
                <img src="{{ Str::startsWith($pengumuman->foto, 'http') ? $pengumuman->foto : Storage::url($pengumuman->foto) }}" alt="Foto Pengumuman" class="rounded-xl max-w-full lg:max-w-xl border border-slate-200">
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
