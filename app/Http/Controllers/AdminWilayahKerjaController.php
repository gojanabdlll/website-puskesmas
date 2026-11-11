<?php

namespace App\Http\Controllers;

use App\Models\WilayahKerja;
use Illuminate\Http\Request;

class AdminWilayahKerjaController extends Controller
{
    /**
     * Menampilkan daftar wilayah kerja
     */
    public function index()
    {
        $wilayah = WilayahKerja::orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view('admin.wilayah.index', compact('wilayah'));
    }


    /**
     * Menampilkan form tambah wilayah
     */
    public function create()
    {
        return view('admin.wilayah.create');
    }


    /**
     * Menyimpan wilayah baru
     */
    public function store(Request $request)
    {
        $request->validate([

            'kecamatan' => 'required|string|max:255',

            'desa_kelurahan' => 'required|string|max:255',

            'jumlah_penduduk' => 'nullable|integer|min:0',

            'luas_wilayah' => 'nullable|string|max:100',

            'keterangan' => 'nullable|string|max:2000',

            'urutan' => 'nullable|integer|min:0',

        ]);


        WilayahKerja::create([

            'kecamatan' => $request->kecamatan,

            'desa_kelurahan' => $request->desa_kelurahan,

            'jumlah_penduduk' => $request->jumlah_penduduk,

            'luas_wilayah' => $request->luas_wilayah,

            'keterangan' => $request->keterangan,

            'urutan' => $request->urutan ?? 0,

        ]);


        return redirect()
            ->route('admin.wilayah.index')
            ->with(
                'success',
                'Data wilayah kerja berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan form edit
     */
    public function edit(WilayahKerja $wilayah)
    {
        return view(
            'admin.wilayah.edit',
            compact('wilayah')
        );
    }


    /**
     * Memperbarui data wilayah
     */
    public function update(
        Request $request,
        WilayahKerja $wilayah
    ) {

        $request->validate([

            'kecamatan' => 'required|string|max:255',

            'desa_kelurahan' => 'required|string|max:255',

            'jumlah_penduduk' => 'nullable|integer|min:0',

            'luas_wilayah' => 'nullable|string|max:100',

            'keterangan' => 'nullable|string|max:2000',

            'urutan' => 'nullable|integer|min:0',

        ]);


        $wilayah->update([

            'kecamatan' => $request->kecamatan,

            'desa_kelurahan' => $request->desa_kelurahan,

            'jumlah_penduduk' => $request->jumlah_penduduk,

            'luas_wilayah' => $request->luas_wilayah,

            'keterangan' => $request->keterangan,

            'urutan' => $request->urutan ?? 0,

        ]);


        return redirect()
            ->route('admin.wilayah.index')
            ->with(
                'success',
                'Data wilayah kerja berhasil diperbarui.'
            );
    }


    /**
     * Menghapus wilayah
     */
    public function destroy(WilayahKerja $wilayah)
    {
        $wilayah->delete();


        return redirect()
            ->route('admin.wilayah.index')
            ->with(
                'success',
                'Data wilayah kerja berhasil dihapus.'
            );
    }
}