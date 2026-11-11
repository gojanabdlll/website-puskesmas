<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('urutan')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'teks_tombol' => 'nullable|string|max:100',
            'url_tombol' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'urutan' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')
                ->store('banner', 'public');
        }

        Banner::create($validated);

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner berhasil ditambahkan.');
    }

    public function show(Banner $banner)
    {
        return redirect()->route('admin.banner.index');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'teks_tombol' => 'nullable|string|max:100',
            'url_tombol' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'urutan' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            if ($banner->gambar) {
                Storage::disk('public')->delete($banner->gambar);
            }

            $validated['gambar'] = $request->file('gambar')
                ->store('banner', 'public');
        } else {
            unset($validated['gambar']);
        }

        $banner->update($validated);

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->gambar) {
            Storage::disk('public')->delete($banner->gambar);
        }

        $banner->delete();

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner berhasil dihapus.');
    }
}
