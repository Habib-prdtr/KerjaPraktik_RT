<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    protected $table = 'kartu_keluarga';

    protected $fillable = [
        'no_kk',
        'kepala_keluarga',
        'alamat',
        'rt',
        'rw'
    ];

    // 🔗 relasi ke warga (1 KK punya banyak warga)
    public function warga()
    {
        return $this->hasMany(Warga::class);
    }
}