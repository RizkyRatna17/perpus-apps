<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = [
        'id_lokasi',
        'id_kategori',
        'judul',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'keterangan',
        'stok'
    ];
    public function lokasi()
    {
        return $this->belongsTo(Locations::class, 'id_lokasi', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Categories::class, 'id_kategori', 'id');
    }
}
