<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'ringkasan',
        'isi',
        'foto',
        'tanggal',
        'penulis',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'status' => 'boolean',
    ];
}