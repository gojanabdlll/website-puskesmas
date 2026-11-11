<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PengaduanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN UTAMA PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        // Data publik hanya mengambil kolom yang aman ditampilkan.
        // Nama, kontak, nomor tiket, subjek, dan isi laporan tidak diambil.
        $pengaduanPublik = Pengaduan::query()
            ->select([
                'id',
                'kategori',
                'status',
                'created_at',
            ])
            ->latest()
            ->paginate(6);

        return view('pengaduan.index', compact('pengaduanPublik'));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'kontak' => ['nullable', 'string', 'max:100'],
            'kategori' => ['required', 'string', 'max:100'],
            'subjek' => ['required', 'string', 'max:150'],
            'isi_pengaduan' => [
                'required',
                'string',
                'min:10',
                'max:5000',
            ],
            'anonim' => ['nullable', 'boolean'],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'kategori.required' => 'Silakan pilih kategori pengaduan.',
            'subjek.required' => 'Subjek pengaduan wajib diisi.',
            'isi_pengaduan.required' => 'Isi pengaduan wajib diisi.',
            'isi_pengaduan.min' => 'Isi pengaduan minimal 10 karakter.',
        ]);

        // Membuat nomor tiket unik.
        do {
            $nomorTiket = 'PS-'
                . now()->format('Ymd')
                . '-'
                . strtoupper(Str::random(5));
        } while (
            Pengaduan::where('nomor_tiket', $nomorTiket)->exists()
        );

        // Menyimpan pengaduan ke database.
        $pengaduan = Pengaduan::create([
            'nomor_tiket' => $nomorTiket,
            'nama' => $validated['nama'],
            'kontak' => $validated['kontak'] ?? null,
            'kategori' => $validated['kategori'],
            'subjek' => $validated['subjek'],
            'isi_pengaduan' => $validated['isi_pengaduan'],
            'anonim' => $request->boolean('anonim'),
            'status' => 'Menunggu',
        ]);

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim.')
            ->with('nomor_tiket', $pengaduan->nomor_tiket);
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN CEK STATUS
    |--------------------------------------------------------------------------
    */


    public function cek()
    {
        $pengaduanPublik = Pengaduan::query()
            ->select(['id', 'kategori', 'status', 'created_at'])
            ->whereRaw('LOWER(TRIM(status)) = ?', ['selesai'])
            ->latest()
            ->paginate(10);

        return view('pengaduan.cek', compact('pengaduanPublik'));
    }


    /*
    |--------------------------------------------------------------------------
    | CEK STATUS PENGADUAN BERDASARKAN NOMOR TIKET
    |--------------------------------------------------------------------------
    */

    public function cekStatus(Request $request)
    {
        $request->validate([
            'nomor_tiket' => ['required', 'string', 'max:50'],
        ], [
            'nomor_tiket.required' => 'Nomor tiket wajib diisi.',
        ]);

        $pengaduan = Pengaduan::where(
            'nomor_tiket',
            strtoupper(trim($request->nomor_tiket))
        )->first();

        if (!$pengaduan) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Nomor tiket tidak ditemukan. Silakan periksa kembali nomor tiket Anda.'
                );
        }

        return view('pengaduan.cek', compact('pengaduan'));
    }
}
