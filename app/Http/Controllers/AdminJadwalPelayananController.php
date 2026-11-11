<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelayanan;
use Illuminate\Http\Request;

class AdminJadwalPelayananController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPelayanan::orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view('admin.jadwal-pelayanan.index', compact('jadwal'));
    }

    public function create()
    {
        return view('admin.jadwal-pelayanan.create');
    }

    public function store(Request $request)
    {
        $data = $this->validasiJadwal($request);

        JadwalPelayanan::create($data);

        return redirect()
            ->route('admin.jadwal-pelayanan.index')
            ->with('success', 'Jadwal pelayanan berhasil ditambahkan.');
    }

    public function edit(JadwalPelayanan $jadwal_pelayanan)
    {
        return view('admin.jadwal-pelayanan.edit', [
            'jadwal' => $jadwal_pelayanan,
        ]);
    }

    public function update(
        Request $request,
        JadwalPelayanan $jadwal_pelayanan
    ) {
        $data = $this->validasiJadwal($request);

        $jadwal_pelayanan->update($data);

        return redirect()
            ->route('admin.jadwal-pelayanan.index')
            ->with('success', 'Jadwal pelayanan berhasil diperbarui.');
    }

    public function destroy(JadwalPelayanan $jadwal_pelayanan)
    {
        $jadwal_pelayanan->delete();

        return redirect()
            ->route('admin.jadwal-pelayanan.index')
            ->with('success', 'Jadwal pelayanan berhasil dihapus.');
    }


    private function validasiJadwal(Request $request): array
    {
        return $request->validate([
            'nama_layanan' => 'required|string|max:255',

            // Kolom hari dipertahankan agar sesuai dengan database lama.
            'hari' => 'required|string|max:100',

            'jam_mulai' => 'required|date_format:H:i',

            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',

            'keterangan' => 'nullable|string|max:1000',

            'urutan' => 'required|integer|min:1',

            'status' => 'required|boolean',
        ]);
    }

}
