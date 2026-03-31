<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'created_by'
    ];

    // 🔗 relasi ke user (admin)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}