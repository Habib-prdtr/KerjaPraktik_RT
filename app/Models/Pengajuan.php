<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';

    protected $fillable = [
        'warga_id',
        'judul',
        'isi',
        'foto',
        'status',
        'tanggapan_admin'
    ];

    // 🔗 relasi ke warga
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}