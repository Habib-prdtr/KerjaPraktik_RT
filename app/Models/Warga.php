<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';

    protected $fillable = [
        'kartu_keluarga_id',
        'nik',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'agama',
        'pekerjaan',
        'status_perkawinan',
        'status'
    ];

    // relasi ke kartu keluarga
    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class);
    }

    // relasi ke surat
    public function surat()
    {
        return $this->hasMany(Surat::class);
    }

    // relasi ke pengajuan
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }
}