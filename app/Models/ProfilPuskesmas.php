<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPuskesmas extends Model
{
    protected $table = 'profil_puskesmas';

    protected $fillable = [
        'nama_puskesmas',
        'alamat',
        'telepon',
        'email',
        'deskripsi',
        'visi',
        'misi',
        'jam_pelayanan',
        'foto',
        'foto_deskripsi',
    ];
}