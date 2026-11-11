<?php

namespace App\Http\Controllers;

use App\Models\ProfilPuskesmas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProfilController extends Controller
{
    /**
     * Menampilkan halaman profil Puskesmas
     */
    public function index()
    {
        $profil = ProfilPuskesmas::first();

        return view('admin.profil.index', compact('profil'));
    }


    /**
     * Menyimpan / memperbarui profil Puskesmas
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_puskesmas' => 'required|string|max:255',

            'alamat' => 'nullable|string|max:1000',

            'telepon' => 'nullable|string|max:50',

            'email' => 'nullable|email|max:255',

            'deskripsi' => 'nullable|string|max:5000',

            'visi' => 'nullable|string|max:5000',

            'misi' => 'nullable|string|max:5000',

            'jam_pelayanan' => 'nullable|string|max:5000',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'foto_deskripsi' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Ambil data pertama
        |--------------------------------------------------------------------------
        */

        $profil = ProfilPuskesmas::first();


        /*
        |--------------------------------------------------------------------------
        | Jika belum ada, buat data baru
        |--------------------------------------------------------------------------
        */

        if (!$profil) {
            $profil = new ProfilPuskesmas();
        }


        /*
        |--------------------------------------------------------------------------
        | Data profil
        |--------------------------------------------------------------------------
        */

        $profil->nama_puskesmas = $request->nama_puskesmas;

        $profil->alamat = $request->alamat;

        $profil->telepon = $request->telepon;

        $profil->email = $request->email;

        $profil->deskripsi = $request->deskripsi;

        $profil->visi = $request->visi;

        $profil->misi = $request->misi;

        $profil->jam_pelayanan = $request->jam_pelayanan;


        /*
        |--------------------------------------------------------------------------
        | Upload foto Puskesmas
        |--------------------------------------------------------------------------
        */


        // Upload foto utama Puskesmas
        if ($request->hasFile('foto')) {

            // Hapus foto utama lama
            if (
                $profil->foto &&
                Storage::disk('public')->exists($profil->foto)
            ) {
                Storage::disk('public')->delete($profil->foto);
            }

            // Simpan foto utama baru
            $profil->foto = $request
                ->file('foto')
                ->store('profil-puskesmas', 'public');
        }


        // Upload foto di samping deskripsi
        if ($request->hasFile('foto_deskripsi')) {

            // Hapus foto deskripsi lama jika ada
            if (
                $profil->foto_deskripsi &&
                Storage::disk('public')->exists($profil->foto_deskripsi)
            ) {
                Storage::disk('public')->delete(
                    $profil->foto_deskripsi
                );
            }

            // Simpan lokasi foto baru ke objek profil
            $profil->foto_deskripsi = $request
                ->file('foto_deskripsi')
                ->store('profil-puskesmas/deskripsi', 'public');
        }



        /*
        |--------------------------------------------------------------------------
        | Simpan database
        |--------------------------------------------------------------------------
        */

        $profil->save();


        /*
        |--------------------------------------------------------------------------
        | Kembali ke halaman profil
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.profil.index')
            ->with(
                'success',
                'Profil Puskesmas berhasil disimpan.'
            );

    }

}
