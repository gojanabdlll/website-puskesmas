<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeris';

    protected $fillable = [
        'judul',
        'deskripsi',
        'foto',
        'tanggal',
        'status',
        'urutan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'status' => 'boolean',
    ];
}