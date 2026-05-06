@extends('layouts.app')

@section('title', 'Detail Surat — Admin RT 08')
@section('page-title', 'Detail Surat')
@section('page-subtitle', 'Proses pengajuan surat warga')

@section('content')
<div class="max-w-3xl mx-auto space-y-5">

    {{-- Info Surat --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">Informasi Surat</h2>
            <a href="{{ route('admin.surat.index') }}" class="text-sm text-slate-500 hover:text-blue-600">← Kembali</a>
        </div>

        <div class="px-6 py-5 grid grid-cols-1 sm:grid-cols-2 gap-5 text-sm">
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Nomor Surat</p>
                <p class="mt-1 font-mono font-bold text-slate-800">{{ $surat->nomor_surat }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Jenis Surat</p>
                <p class="mt-1 font-semibold text-slate-800">{{ $surat->jenis_surat }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Nama Warga</p>
                @if($surat->warga)
                <a href="{{ route('admin.warga.show', $surat->warga) }}" class="mt-1 block text-blue-600 hover:underline font-medium">
                    {{ $surat->warga->nama }}
                </a>
                @else
                <p class="mt-1 text-slate-400">-</p>
                @endif
            </div>
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">NIK</p>
                <p class="mt-1 font-mono text-slate-700">{{ $surat->warga->nik ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Kartu Keluarga</p>
                <p class="mt-1 text-slate-700">{{ $surat->warga->kartuKeluarga->no_kk ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Tanggal Pengajuan</p>
                <p class="mt-1 text-slate-700">{{ $surat->created_at->translatedFormat('d F Y, H:i') }}</p>
            </div>
            <div class="sm:col-span-2">
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Keperluan</p>
                <p class="mt-1 text-slate-700 bg-slate-50 rounded-xl p-4 leading-relaxed">{{ $surat->keperluan }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Status Saat Ini</p>
                <div class="mt-1">
                    @php
                        $sc = match($surat->status) {
                            'diajukan'  => 'bg-slate-100 text-slate-600',
                            'diproses'  => 'bg-blue-100 text-blue-700',
                            'selesai'   => 'bg-green-100 text-green-700',
                            'ditolak'   => 'bg-red-100 text-red-700',
                            default     => 'bg-slate-100 text-slate-600',
                        };
                    @endphp
                    <span class="inline-block text-sm px-3 py-1 rounded-full font-medium {{ $sc }} capitalize">{{ $surat->status }}</span>
                </div>
            </div>
            @if($surat->file_pdf)
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">File PDF</p>
                <a href="{{ Storage::url($surat->file_pdf) }}" target="_blank"
                   class="mt-1 inline-flex items-center gap-1.5 text-sm text-blue-600 hover:underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Unduh Surat PDF
                </a>
            </div>
            @endif
        </div>
    </div>

    {{-- Form Update Status --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Update Status Surat</h2>
            <p class="text-xs text-slate-400 mt-0.5">Ubah status dan unggah file PDF jika surat sudah selesai</p>
        </div>

        <form method="POST" action="{{ route('admin.surat.update-status', $surat) }}"
              enctype="multipart/form-data" class="px-6 py-6 space-y-5">
            @csrf
            @method('PATCH')

            <div>
                <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">Status Baru <span class="text-red-500">*</span></label>
                <select id="status" name="status"
                        class="w-full sm:w-64 px-4 py-2.5 text-sm rounded-xl border @error('status') border-red-400 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    @foreach(['diajukan','diproses','selesai','ditolak'] as $st)
                    <option value="{{ $st }}" {{ $surat->status === $st ? 'selected' : '' }} class="capitalize">{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
                @error('status')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="file_pdf" class="block text-sm font-medium text-slate-700 mb-1.5">Upload File Surat (PDF)</label>
                <input type="file" id="file_pdf" name="file_pdf" accept=".pdf"
                       class="w-full text-sm text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                <p class="mt-1 text-xs text-slate-400">Format PDF, maksimal 2MB. Opsional — hanya jika surat sudah diterbitkan.</p>
                @error('file_pdf')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                    Perbarui Status
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
