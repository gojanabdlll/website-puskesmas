<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'ringkasan',
        'isi',
        'tanggal',
        'penulis',
        'foto',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'status' => 'boolean',
    ];
}