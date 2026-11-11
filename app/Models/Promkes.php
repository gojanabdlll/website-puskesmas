<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promkes extends Model
{
    protected $table = 'promkes';

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'isi',
        'foto',
        'tanggal',
        'penulis',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'status' => 'boolean',
        ];
    }
}
