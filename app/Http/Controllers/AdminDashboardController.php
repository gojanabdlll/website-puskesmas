<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;

class AdminDashboardController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function index()
    {
        // Total seluruh pengaduan
        $totalPengaduan = Pengaduan::count();

        // Pengaduan menunggu
        $menunggu = Pengaduan::where('status', 'Menunggu')->count();

        // Pengaduan sedang diproses
        $diproses = Pengaduan::where('status', 'Diproses')->count();

        // Pengaduan selesai
        $selesai = Pengaduan::where('status', 'Selesai')->count();

        // 5 pengaduan terbaru
        $pengaduanTerbaru = Pengaduan::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPengaduan',
            'menunggu',
            'diproses',
            'selesai',
            'pengaduanTerbaru'
        ));
    }
}