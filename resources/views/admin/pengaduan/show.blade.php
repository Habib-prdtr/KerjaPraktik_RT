@extends('layouts.app')

@section('title', 'Detail Pengaduan — Admin RT 08')
@section('page-title', 'Detail Pengaduan')
@section('page-subtitle', 'Beri tanggapan atas pengaduan warga')

@section('content')
<div class="max-w-3xl mx-auto space-y-5">

    {{-- Detail Pengaduan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">Isi Pengaduan</h2>
            <a href="{{ route('admin.pengaduan.index') }}" class="text-sm text-slate-500 hover:text-blue-600">← Kembali</a>
        </div>

        <div class="px-6 py-5 space-y-4 text-sm">
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Pelapor</p>
                    @if($pengaduan->warga)
                    <a href="{{ route('admin.warga.show', $pengaduan->warga) }}" class="mt-1 block text-blue-600 hover:underline font-semibold text-base">
                        {{ $pengaduan->warga->nama }}
                    </a>
                    @else
                    <p class="mt-1 text-slate-400">Data tidak tersedia</p>
                    @endif
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Tanggal Laporan</p>
                    <p class="mt-1 text-slate-700 font-medium">{{ $pengaduan->created_at->translatedFormat('d F Y, H:i') }}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Status</p>
                    @php
                        $sc = match($pengaduan->status) {
                            'dikirim'  => 'bg-amber-100 text-amber-700',
                            'diproses' => 'bg-blue-100 text-blue-700',
                            'selesai'  => 'bg-green-100 text-green-700',
                            default    => 'bg-slate-100 text-slate-600',
                        };
                    @endphp
                    <span class="text-sm px-3 py-1 rounded-full font-medium {{ $sc }} capitalize">{{ $pengaduan->status }}</span>
                </div>
            </div>

            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Judul</p>
                <p class="text-base font-semibold text-slate-800">{{ $pengaduan->judul }}</p>
            </div>

            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Isi Pengaduan</p>
                <div class="bg-slate-50 rounded-xl p-4 text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $pengaduan->isi }}</div>
            </div>

            @if($pengaduan->foto)
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-2">Foto Lampiran</p>
                <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto Pengaduan"
                     class="max-w-sm rounded-xl border border-slate-200 shadow-sm">
            </div>
            @endif

            @if($pengaduan->tanggapan_admin)
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-1">Tanggapan Admin</p>
                <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $pengaduan->tanggapan_admin }}</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Form Tanggapan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Beri Tanggapan</h2>
            <p class="text-xs text-slate-400 mt-0.5">Tanggapan akan terlihat oleh warga pelapor</p>
        </div>

        <form method="POST" action="{{ route('admin.pengaduan.tanggapi', $pengaduan) }}" class="px-6 py-6 space-y-5">
            @csrf
            @method('PATCH')

            <div>
                <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">Ubah Status <span class="text-red-500">*</span></label>
                @if($pengaduan->status === 'diproses')
                    <input type="hidden" name="status" value="selesai">
                    <div class="px-4 py-2.5 text-sm rounded-xl border border-slate-200 bg-slate-50 text-slate-700 w-full sm:w-48 font-medium cursor-not-allowed">Selesai</div>
                    <p class="mt-1.5 text-xs text-blue-600">Status akan diubah menjadi Selesai.</p>
                @elseif($pengaduan->status === 'selesai')
                    <input type="hidden" name="status" value="selesai">
                    <div class="px-4 py-2.5 text-sm rounded-xl border border-slate-200 bg-slate-50 text-slate-700 w-full sm:w-48 font-medium cursor-not-allowed">Selesai</div>
                @else
                    <select id="status" name="status"
                            class="w-full sm:w-48 px-4 py-2.5 text-sm rounded-xl border @error('status') border-red-400 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        @foreach($statusList as $st)
                            <option value="{{ $st }}" {{ $pengaduan->status === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                        @endforeach
                    </select>
                @endif
                @error('status')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="tanggapan_admin" class="block text-sm font-medium text-slate-700 mb-1.5">Tanggapan <span class="text-red-500">*</span></label>
                <textarea id="tanggapan_admin" name="tanggapan_admin" rows="5"
                          placeholder="Tulis tanggapan resmi atas pengaduan ini…"
                          class="w-full px-4 py-3 text-sm rounded-xl border @error('tanggapan_admin') border-red-400 bg-red-50 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('tanggapan_admin', $pengaduan->tanggapan_admin) }}</textarea>
                @error('tanggapan_admin')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3 pt-1">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                    Kirim Tanggapan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
