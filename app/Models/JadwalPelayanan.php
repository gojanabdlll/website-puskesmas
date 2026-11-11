<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPelayanan extends Model
{
    protected $table = 'jadwal_pelayanans';

    protected $fillable = [
        'nama_layanan',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'keterangan',
        'status',
        'urutan',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
