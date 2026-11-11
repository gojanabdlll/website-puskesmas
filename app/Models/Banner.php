<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'teks_tombol',
        'url_tombol',
        'status',
        'urutan',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
