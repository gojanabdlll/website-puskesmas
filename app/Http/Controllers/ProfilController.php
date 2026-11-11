<?php

namespace App\Http\Controllers;

use App\Models\ProfilPuskesmas;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = ProfilPuskesmas::first();

        return view(
            'profil.profil',
            compact('profil')
        );
    }
}