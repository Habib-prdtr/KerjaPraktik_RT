<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';

    protected $fillable = [
        'warga_id',
        'jenis_surat',
        'nomor_surat',
        'keperluan',
        'status',
        'file_pdf'
    ];

    // 🔗 relasi ke warga
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}