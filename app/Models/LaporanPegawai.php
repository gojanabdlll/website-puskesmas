<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPegawai extends Model
{
    protected $fillable = [
        'nama',
        'nip',
        'unit_kerja',
        'bulan',
        'tahun',
        'nama_file_asli',
        'file_path',
        'jenis_file',
        'status',
        'tanggapan_admin',
    ];
}