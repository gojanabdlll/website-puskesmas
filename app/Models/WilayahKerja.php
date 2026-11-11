<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WilayahKerja extends Model
{
    protected $table = 'wilayah_kerjas';

    protected $fillable = [
        'kecamatan',
        'desa_kelurahan',
        'jumlah_penduduk',
        'luas_wilayah',
        'keterangan',
        'urutan',
    ];
}