<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = [
        'nama_puskesmas',
        'alamat',
        'telepon',
        'email',
        'logo',
        'pintasan',
        'tautan_terkait',
        'copyright',
        'kredit',
    ];

    protected $casts = [
        'pintasan' => 'array',
        'tautan_terkait' => 'array',
    ];
}
