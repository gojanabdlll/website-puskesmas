<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPengumumanController extends Controller
{
    /**
     * Menampilkan daftar pengumuman
     */
    public function index()
    {
        $pengumuman = Pengumuman::orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'admin.pengumuman.index',
            compact('pengumuman')
        );
    }


    /**
     * Form tambah pengumuman
     */
    public function create()
    {
        return view('admin.pengumuman.create');
    }


    /**
     * Menyimpan pengumuman
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',

            'ringkasan' => 'nullable|string|max:1000',

            'isi' => 'required|string',

            'tanggal' => 'required|date',

            'penulis' => 'nullable|string|max:255',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'required|boolean',
        ]);


        $data = [
            'judul' => $request->judul,

            'ringkasan' => $request->ringkasan,

            'isi' => $request->isi,

            'tanggal' => $request->tanggal,

            'penulis' => $request->penulis,

            'status' => $request->status,
        ];


        if ($request->hasFile('foto')) {

            $data['foto'] = $request
                ->file('foto')
                ->store('pengumuman', 'public');
        }


        Pengumuman::create($data);


        return redirect()
            ->route('admin.pengumuman.index')
            ->with(
                'success',
                'Pengumuman berhasil ditambahkan.'
            );
    }


    /**
     * Form edit
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view(
            'admin.pengumuman.edit',
            compact('pengumuman')
        );
    }


    /**
     * Update pengumuman
     */
    public function update(
        Request $request,
        Pengumuman $pengumuman
    ) {

        $request->validate([
            'judul' => 'required|string|max:255',

            'ringkasan' => 'nullable|string|max:1000',

            'isi' => 'required|string',

            'tanggal' => 'required|date',

            'penulis' => 'nullable|string|max:255',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'required|boolean',
        ]);


        $data = [
            'judul' => $request->judul,

            'ringkasan' => $request->ringkasan,

            'isi' => $request->isi,

            'tanggal' => $request->tanggal,

            'penulis' => $request->penulis,

            'status' => $request->status,
        ];


        if ($request->hasFile('foto')) {

            if (
                $pengumuman->foto &&
                Storage::disk('public')->exists(
                    $pengumuman->foto
                )
            ) {

                Storage::disk('public')->delete(
                    $pengumuman->foto
                );
            }


            $data['foto'] = $request
                ->file('foto')
                ->store('pengumuman', 'public');
        }


        $pengumuman->update($data);


        return redirect()
            ->route('admin.pengumuman.index')
            ->with(
                'success',
                'Pengumuman berhasil diperbarui.'
            );
    }


    /**
     * Hapus pengumuman
     */
    public function destroy(Pengumuman $pengumuman)
    {
        if (
            $pengumuman->foto &&
            Storage::disk('public')->exists(
                $pengumuman->foto
            )
        ) {

            Storage::disk('public')->delete(
                $pengumuman->foto
            );
        }


        $pengumuman->delete();


        return redirect()
            ->route('admin.pengumuman.index')
            ->with(
                'success',
                'Pengumuman berhasil dihapus.'
            );
    }
}