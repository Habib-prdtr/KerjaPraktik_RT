<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanRt extends Model
{
    protected $table = 'kegiatan_rt';

    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'tanggal',
        'lokasi',
        'foto',
        'created_by'
    ];

    protected $casts = [
        'foto' => 'array',
    ];

    // 🔗 relasi ke user (admin/pengurus)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}