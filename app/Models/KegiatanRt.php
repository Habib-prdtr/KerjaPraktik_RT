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

    // protected $casts = [
    //     'foto' => 'array',
    // ];

    /**
     * Accessor: mengembalikan HANYA foto pertama sebagai string.
     * Digunakan di halaman yang hanya butuh 1 thumbnail (misal: card admin).
     */
    public function getFotoAttribute($value)
    {
        if (empty($value)) return null;

        $decoded = json_decode($value, true);
        if (is_array($decoded)) {
            return $decoded[0] ?? null;
        }

        return $value;
    }

    /**
     * Accessor: mengembalikan SEMUA foto sebagai array.
     * Digunakan di landing page untuk galeri foto kegiatan.
     * Akses via: $kegiatan->fotos
     */
    public function getFotosAttribute(): array
    {
        $raw = $this->getRawOriginal('foto');
        if (empty($raw)) return [];

        $decoded = json_decode($raw, true);
        if (is_array($decoded)) {
            return $decoded;
        }

        // Jika bukan JSON array (misal plain string path), bungkus jadi array
        return [$raw];
    }


    public function getFotoUrlAttribute()
    {
        $foto = $this->foto;
        if (empty($foto)) return null;
        
        return str_starts_with($foto, 'http') ? $foto : \Illuminate\Support\Facades\Storage::url($foto);
    }

    // 🔗 relasi ke user (admin/pengurus)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}