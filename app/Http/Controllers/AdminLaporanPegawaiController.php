<?php

namespace App\Http\Controllers;

use App\Models\LaporanPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class AdminLaporanPegawaiController extends Controller
{
    public function index()
    {
        $laporanPegawai = LaporanPegawai::latest()
            ->paginate(10);

        $totalLaporan = LaporanPegawai::count();

        $menunggu = LaporanPegawai::where(
            'status',
            'Menunggu Pemeriksaan'
        )->count();

        $diterima = LaporanPegawai::where(
            'status',
            'Diterima'
        )->count();

        $perluRevisi = LaporanPegawai::where(
            'status',
            'Perlu Revisi'
        )->count();

        $tautanUnduh = [];
        $tautanLihat = [];

        foreach ($laporanPegawai as $laporan) {
            $parameter = [
                'laporanPegawai' => $laporan->id,
            ];

            $tautanUnduh[$laporan->id] =
                URL::temporarySignedRoute(
                    'laporan-pegawai.download',
                    now()->addHours(24),
                    $parameter
                );

            $tautanLihat[$laporan->id] =
                URL::temporarySignedRoute(
                    'laporan-pegawai.view',
                    now()->addHours(24),
                    $parameter
                );
        }

        return view('admin.laporan-pegawai.index', compact(
            'laporanPegawai',
            'totalLaporan',
            'menunggu',
            'diterima',
            'perluRevisi',
            'tautanUnduh',
            'tautanLihat'
        ));
    }


    public function update(
        Request $request,
        LaporanPegawai $laporanPegawai
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:Menunggu Pemeriksaan,Diterima,Perlu Revisi',
            ],
            'tanggapan_admin' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        $laporanPegawai->update([
            'status' => $validated['status'],
            'tanggapan_admin' => $validated['tanggapan_admin'] ?? null,
        ]);

        return redirect()
            ->route('admin.laporan-pegawai.index')
            ->with('success', 'Status dan tanggapan laporan berhasil disimpan.');
    }


    public function edit(LaporanPegawai $laporanPegawai)
    {
        return view('admin.laporan-pegawai.edit', compact(
            'laporanPegawai'
        ));
    }

    public function destroy(LaporanPegawai $laporanPegawai)
    {
        // Hapus file dokumen dari penyimpanan lokal.
        if (
            $laporanPegawai->file_path &&
            Storage::exists($laporanPegawai->file_path)
        ) {
            Storage::delete($laporanPegawai->file_path);
        }

        // Hapus data laporan dari database.
        $laporanPegawai->delete();

        return redirect()
            ->route('admin.laporan-pegawai.index')
            ->with('success', 'Laporan dan file dokumennya berhasil dihapus.');
    }

}
