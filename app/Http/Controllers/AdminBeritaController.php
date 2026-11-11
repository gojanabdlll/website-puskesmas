<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBeritaController extends Controller
{
    /**
     * Menampilkan daftar berita
     */
    public function index()
    {
        $berita = Berita::orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.berita.index', compact('berita'));
    }


    /**
     * Form tambah berita
     */
    public function create()
    {
        return view('admin.berita.create');
    }


    /**
     * Menyimpan berita
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string|max:1000',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal' => 'required|date',
            'penulis' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
        ]);


        $data = [
            'judul' => $request->judul,
            'ringkasan' => $request->ringkasan,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'penulis' => $request->penulis,
            'status' => $request->has('status'),
        ];


        if ($request->hasFile('foto')) {

            $data['foto'] = $request
                ->file('foto')
                ->store('berita', 'public');
        }


        Berita::create($data);


        return redirect()
            ->route('admin.berita.index')
            ->with(
                'success',
                'Berita berhasil ditambahkan.'
            );
    }


    /**
     * Form edit berita
     */
    public function edit(Berita $berita)
    {
        return view(
            'admin.berita.edit',
            compact('berita')
        );
    }


    /**
     * Memperbarui berita
     */
    public function update(
        Request $request,
        Berita $berita
    ) {

        $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string|max:1000',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal' => 'required|date',
            'penulis' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
        ]);


        $data = [
            'judul' => $request->judul,
            'ringkasan' => $request->ringkasan,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'penulis' => $request->penulis,
            'status' => $request->has('status'),
        ];


        if ($request->hasFile('foto')) {

            if (
                $berita->foto &&
                Storage::disk('public')->exists($berita->foto)
            ) {
                Storage::disk('public')->delete(
                    $berita->foto
                );
            }


            $data['foto'] = $request
                ->file('foto')
                ->store('berita', 'public');
        }


        $berita->update($data);


        return redirect()
            ->route('admin.berita.index')
            ->with(
                'success',
                'Berita berhasil diperbarui.'
            );
    }


    /**
     * Menghapus berita
     */
    public function destroy(Berita $berita)
    {
        if (
            $berita->foto &&
            Storage::disk('public')->exists($berita->foto)
        ) {
            Storage::disk('public')->delete(
                $berita->foto
            );
        }


        $berita->delete();


        return redirect()
            ->route('admin.berita.index')
            ->with(
                'success',
                'Berita berhasil dihapus.'
            );
    }
}