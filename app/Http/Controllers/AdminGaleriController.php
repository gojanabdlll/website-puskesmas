<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::orderBy('urutan')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal' => 'nullable|date',
            'status' => 'required|boolean',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['foto'] = $request->file('foto')
            ->store('galeri', 'public');

        $validated['urutan'] = $validated['urutan'] ?? 0;

        Galeri::create($validated);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal' => 'nullable|date',
            'status' => 'required|boolean',
            'urutan' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            if ($galeri->foto) {
                Storage::disk('public')->delete($galeri->foto);
            }

            $validated['foto'] = $request->file('foto')
                ->store('galeri', 'public');
        } else {
            unset($validated['foto']);
        }

        $validated['urutan'] = $validated['urutan'] ?? 0;

        $galeri->update($validated);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->foto) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
