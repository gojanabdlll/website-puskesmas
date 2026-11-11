<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminStrukturOrganisasiController extends Controller
{
    /**
     * Menampilkan data struktur organisasi
     */
    public function index()
    {
        $struktur = StrukturOrganisasi::orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view('admin.struktur.index', compact('struktur'));
    }


    /**
     * Menampilkan form tambah
     */
    public function create()
    {
        return view('admin.struktur.create');
    }


    /**
     * Menyimpan data baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'nullable|integer|min:0',
        ]);


        $data = [
            'jabatan' => $request->jabatan,
            'nama' => $request->nama,
            'urutan' => $request->urutan ?? 0,
        ];


        if ($request->hasFile('foto')) {

            $data['foto'] = $request
                ->file('foto')
                ->store('struktur-organisasi', 'public');

        }


        StrukturOrganisasi::create($data);


        return redirect()
            ->route('admin.struktur.index')
            ->with(
                'success',
                'Data struktur organisasi berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan form edit
     */
    public function edit(StrukturOrganisasi $struktur)
    {
        return view(
            'admin.struktur.edit',
            compact('struktur')
        );
    }


    /**
     * Memperbarui data
     */
    public function update(
        Request $request,
        StrukturOrganisasi $struktur
    ) {

        $request->validate([
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'nullable|integer|min:0',
        ]);


        $data = [
            'jabatan' => $request->jabatan,
            'nama' => $request->nama,
            'urutan' => $request->urutan ?? 0,
        ];


        if ($request->hasFile('foto')) {

            if (
                $struktur->foto &&
                Storage::disk('public')->exists($struktur->foto)
            ) {

                Storage::disk('public')->delete(
                    $struktur->foto
                );
            }


            $data['foto'] = $request
                ->file('foto')
                ->store('struktur-organisasi', 'public');
        }


        $struktur->update($data);


        return redirect()
            ->route('admin.struktur.index')
            ->with(
                'success',
                'Data struktur organisasi berhasil diperbarui.'
            );
    }


    /**
     * Menghapus data
     */
    public function destroy(StrukturOrganisasi $struktur)
    {
        if (
            $struktur->foto &&
            Storage::disk('public')->exists($struktur->foto)
        ) {

            Storage::disk('public')->delete(
                $struktur->foto
            );
        }


        $struktur->delete();


        return redirect()
            ->route('admin.struktur.index')
            ->with(
                'success',
                'Data struktur organisasi berhasil dihapus.'
            );
    }
}