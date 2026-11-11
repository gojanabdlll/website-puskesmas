<?php

namespace App\Http\Controllers;

use App\Models\LaporanPegawai;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use PhpOffice\PhpSpreadsheet\IOFactory as SpreadsheetIOFactory;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;

class LaporanPegawaiController extends Controller
{
    /**
     * Menampilkan formulir laporan pegawai.
     */

    public function create()
    {
        $laporanPegawai = LaporanPegawai::latest()
            ->paginate(10);

        $tautanUnduh = [];
        $tautanLihat = [];

        foreach ($laporanPegawai as $laporan) {
            $parameter = [
                'laporanPegawai' => $laporan->id
            ];

            // Tautan unduh berlaku selama 24 jam.
            $tautanUnduh[$laporan->id] = URL::temporarySignedRoute(
                'laporan-pegawai.download',
                now()->addHours(24),
                $parameter
            );

            // Tautan lihat berlaku selama 24 jam.
            $tautanLihat[$laporan->id] = URL::temporarySignedRoute(
                'laporan-pegawai.view',
                now()->addHours(24),
                $parameter
            );
        }

        return view('laporan-pegawai', compact(
            'laporanPegawai',
            'tautanUnduh',
            'tautanLihat'
        ));
    }

    public function download(Request $request, $laporanPegawai)
    {
        $laporan = LaporanPegawai::findOrFail($laporanPegawai);

        abort_unless($request->hasValidSignature(), 403);

        abort_unless(
            Storage::exists($laporan->file_path),
            404,
            'File laporan tidak ditemukan.'
        );

        return Storage::download(
            $laporan->file_path,
            $laporan->nama_file_asli
        );
    }

    public function view(Request $request, $laporanPegawai)
    {
        abort_unless($request->hasValidSignature(), 403);

        $laporan = LaporanPegawai::findOrFail($laporanPegawai);

        abort_unless(
            Storage::exists($laporan->file_path),
            404,
            'File laporan tidak ditemukan.'
        );

        $ekstensi = strtolower($laporan->jenis_file);
        $filePath = Storage::path($laporan->file_path);

        $previewType = 'unsupported';
        $excelRows = [];
        $wordHtml = null;
        $previewMessage = null;

        try {
            if (in_array($ekstensi, ['xlsx', 'xls'])) {
                $spreadsheet = SpreadsheetIOFactory::load($filePath);
                $sheet = $spreadsheet->getActiveSheet();

                $excelRows = $sheet->toArray(
                    null,
                    true,
                    true,
                    false
                );

                $previewType = 'excel';
                $spreadsheet->disconnectWorksheets();
            } elseif ($ekstensi === 'docx') {
                $document = WordIOFactory::load($filePath);
                $writer = WordIOFactory::createWriter($document, 'HTML');

                $temp = fopen('php://temp', 'w+b');

                $writer->save($temp);
                rewind($temp);

                $wordHtml = stream_get_contents($temp);

                fclose($temp);

                $previewType = 'word';
            } else {
                $previewMessage = $ekstensi === 'doc'
                    ? 'Pratinjau DOC lama belum didukung. Silakan unduh file untuk membukanya.'
                    : 'Format file ini belum didukung untuk pratinjau.';
            }
        } catch (\Throwable $e) {
            report($e);

            $previewMessage = 'Dokumen tidak dapat ditampilkan. Silakan unduh file aslinya.';
        }

        return view('laporan-pegawai-lihat', compact(
            'laporan',
            'previewType',
            'excelRows',
            'wordHtml',
            'previewMessage'
        ));
    }


    /**
     * Menyimpan data dan file laporan pegawai.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'nip' => ['required', 'string', 'max:30'],
            'unit_kerja' => ['required', 'string', 'max:150'],
            'bulan' => ['required', 'integer', 'between:1,12'],
            'tahun' => [
                'required',
                'integer',
                'min:2020',
                'max:' . (date('Y') + 1),
            ],
            'file_laporan' => [
                'required',
                'file',
                'max:10240',
                'mimes:doc,docx,xls,xlsx',
            ],
        ], [
            'nama.required' => 'Nama pegawai wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'unit_kerja.required' => 'Unit kerja wajib dipilih.',
            'bulan.required' => 'Bulan laporan wajib dipilih.',
            'tahun.required' => 'Tahun laporan wajib diisi.',
            'file_laporan.required' => 'Silakan pilih file laporan.',
            'file_laporan.mimes' => 'File harus berformat Word atau Excel.',
            'file_laporan.max' => 'Ukuran file maksimal 10 MB.',
        ]);

        $file = $request->file('file_laporan');

        // Simpan file pada penyimpanan lokal, bukan folder publik.
        $path = $file->store('laporan-pegawai');

        try {
            LaporanPegawai::create([
                'nama' => $validated['nama'],
                'nip' => $validated['nip'],
                'unit_kerja' => $validated['unit_kerja'],
                'bulan' => $validated['bulan'],
                'tahun' => $validated['tahun'],
                'nama_file_asli' => $file->getClientOriginalName(),
                'file_path' => $path,
                'jenis_file' => strtolower($file->getClientOriginalExtension()),
                'status' => 'Menunggu Pemeriksaan',
            ]);
        } catch (\Throwable $e) {
            Storage::delete($path);
            throw $e;
        }

        return redirect()
            ->route('laporan-pegawai.create')
            ->with('success', 'Laporan berhasil dikirim. Terima kasih.');
    }
}
