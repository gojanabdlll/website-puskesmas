<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = [
        'nomor_tiket',
        'nama',
        'kontak',
        'kategori',
        'subjek',
        'isi_pengaduan',
        'anonim',
        'status',
        'tanggapan',
        'tanggal_ditanggapi',
    ];

    protected $casts = [
        'anonim' => 'boolean',
        'tanggal_ditanggapi' => 'datetime',
    ];
}