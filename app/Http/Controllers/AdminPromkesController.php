<?php

namespace App\Http\Controllers;

use App\Models\Promkes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminPromkesController extends Controller
{
    /**
     * Menampilkan daftar konten Promkes.
     */
    public function index()
    {
        $promkes = Promkes::latest()->paginate(9);

        return view('admin.promkes.index', compact('promkes'));
    }

    /**
     * Menampilkan formulir tambah Promkes.
     */
    public function create()
    {
        return view('admin.promkes.create');
    }

    /**
     * Menyimpan konten Promkes baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string|max:1000',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal' => 'nullable|date',
            'penulis' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $validated['slug'] = $this->buatSlugUnik(
            $validated['judul']
        );

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('promkes', 'public');
        }

        Promkes::create($validated);

        return redirect()
            ->route('admin.promkes.index')
            ->with('success', 'Konten Promkes berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail atau mengarahkan ke halaman edit.
     */
    public function show(Promkes $promke)
    {
        return redirect()->route('admin.promkes.edit', $promke);
    }

    /**
     * Menampilkan formulir edit Promkes.
     */
    public function edit(Promkes $promke)
    {
        return view('admin.promkes.edit', [
            'item' => $promke,
        ]);
    }

    /**
     * Memperbarui konten Promkes.
     */
    public function update(Request $request, Promkes $promke)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string|max:1000',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal' => 'nullable|date',
            'penulis' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $validated['slug'] = $this->buatSlugUnik(
            $validated['judul'],
            $promke->id
        );

        if ($request->hasFile('foto')) {
            if ($promke->foto) {
                Storage::disk('public')->delete($promke->foto);
            }

            $validated['foto'] = $request->file('foto')
                ->store('promkes', 'public');
        } else {
            // Pertahankan foto lama jika tidak ada foto baru.
            unset($validated['foto']);
        }

        $promke->update($validated);

        return redirect()
            ->route('admin.promkes.index')
            ->with('success', 'Konten Promkes berhasil diperbarui.');
    }

    /**
     * Menghapus konten Promkes beserta fotonya.
     */
    public function destroy(Promkes $promke)
    {
        if ($promke->foto) {
            Storage::disk('public')->delete($promke->foto);
        }

        $promke->delete();

        return redirect()
            ->route('admin.promkes.index')
            ->with('success', 'Konten Promkes berhasil dihapus.');
    }

    /**
     * Membuat slug unik berdasarkan judul.
     */
    private function buatSlugUnik(
        string $judul,
        ?int $id = null
    ): string {
        $slugDasar = Str::slug($judul);

        if (empty($slugDasar)) {
            $slugDasar = 'promkes';
        }

        $slug = $slugDasar;
        $nomor = 2;

        while (
            Promkes::where('slug', $slug)
                ->when(
                    $id,
                    fn($query) => $query->where('id', '!=', $id)
                )
                ->exists()
        ) {
            $slug = $slugDasar . '-' . $nomor;
            $nomor++;
        }

        return $slug;
    }
}
