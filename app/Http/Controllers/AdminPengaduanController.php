<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class AdminPengaduanController extends Controller
{
    /**
     * Menampilkan semua pengaduan
     */
    public function index()
    {
        $pengaduans = Pengaduan::latest()->get();

        return view('admin.pengaduan.index', compact('pengaduans'));
    }


    /**
     * Menampilkan detail pengaduan
     */
    public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        return view(
            'admin.pengaduan.show',
            compact('pengaduan')
        );
    }


    /**
     * Menyimpan tanggapan dan status
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai,Ditolak',
            'tanggapan' => 'nullable|string|max:5000',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->status = $request->status;
        $pengaduan->tanggapan = $request->tanggapan;

        // Isi tanggal ketika admin memberikan tanggapan
        if (!empty($request->tanggapan)) {
            $pengaduan->tanggal_ditanggapi = now();
        }

        $pengaduan->save();

        return redirect()
            ->route('admin.pengaduan.show', $pengaduan->id)
            ->with(
                'success',
                'Tanggapan dan status pengaduan berhasil diperbarui.'
            );
    }
}