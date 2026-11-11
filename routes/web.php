<?php

use Illuminate\Support\Facades\Route;

// Models
use App\Models\ProfilPuskesmas;
use App\Models\StrukturOrganisasi;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Pengumuman;
use App\Models\Pengaduan;
use App\Models\JadwalPelayanan;


// Controllers
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPengaduanController;
use App\Http\Controllers\AdminProfilController;
use App\Http\Controllers\AdminStrukturOrganisasiController;
use App\Http\Controllers\AdminWilayahKerjaController;
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\AdminPengumumanController;
use App\Http\Controllers\AdminGaleriController;
use App\Http\Controllers\AdminPromkesController;
use App\Http\Controllers\AdminJadwalPelayananController;
use App\Http\Controllers\AdminFooterSettingController;
use App\Http\Controllers\AdminLaporanPegawaiController;
use App\Http\Controllers\LaporanPegawaiController;



/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    // 1. Banner aktif
    $banners = \App\Models\Banner::where('status', true)
        ->orderBy('urutan')
        ->orderBy('id')
        ->get();

    // 2. Jadwal pelayanan aktif
    $jadwalPelayanan = \App\Models\JadwalPelayanan::where('status', true)
        ->orderBy('urutan')
        ->get();

    // 3. Berita terbaru untuk papan informasi Home
    $beritaHome = \App\Models\Berita::where('status', 1)
        ->latest()
        ->take(3)
        ->get();

    // 4. Informasi terbaru
    // Menggunakan data berita yang sama agar variabel $informasi tersedia
    $informasi = $beritaHome;

    // 5. Layanan
    // Sementara menggunakan data jadwal pelayanan aktif
    $layanan = $jadwalPelayanan;

    // 6. Galeri foto Home
    $galeriHome = \App\Models\Galeri::where('status', true)
        ->orderBy('urutan')
        ->take(4)
        ->get();

    // 7. Pengumuman Home
    $pengumuman = \App\Models\Pengumuman::where('status', true)
        ->orderByDesc('tanggal')
        ->take(3)
        ->get();

    // 8. Pengaduan yang sudah diselesaikan admin
    $pengaduanSelesai = Pengaduan::where('status', 'Selesai')
        ->latest()
        ->take(3)
        ->get();

    // 8. Kirim data ke halaman Home
    return view('home', compact(
        'banners',
        'jadwalPelayanan',
        'beritaHome',
        'informasi',
        'layanan',
        'galeriHome',
        'pengumuman',
        'pengaduanSelesai'
    ));
})->name('home');



/*
|--------------------------------------------------------------------------
| PROFIL PUSKESMAS
|--------------------------------------------------------------------------
*/

Route::get('/profil', [
    ProfilController::class,
    'index'
])->name('profil');


/*
|--------------------------------------------------------------------------
| VISI & MISI
|--------------------------------------------------------------------------
*/

Route::get('/visi-misi', function () {

    $profil = ProfilPuskesmas::first();

    return view('profil.visi-misi', compact('profil'));

})->name('visi-misi');


/*
|--------------------------------------------------------------------------
| STRUKTUR ORGANISASI
|--------------------------------------------------------------------------
*/
Route::get('/struktur-organisasi', function () {

    $struktur = StrukturOrganisasi::orderBy('urutan')
        ->orderBy('id')
        ->get();

    return view('profil.struktur', compact('struktur'));

});

/*
|--------------------------------------------------------------------------
| WILAYAH KERJA
|--------------------------------------------------------------------------
*/

Route::get('/wilayah-kerja', function () {

    $wilayah = \App\Models\WilayahKerja::orderBy('urutan')
        ->orderBy('id')
        ->get();

    return view(
        'profil.wilayah-kerja',
        compact('wilayah')
    );

});

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource(
            'wilayah',
            AdminWilayahKerjaController::class
        );

    });


Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('berita', AdminBeritaController::class)
            ->parameters([
                'berita' => 'berita'
            ]);

    });

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('pengumuman', AdminPengumumanController::class)
            ->parameters([
                'pengumuman' => 'pengumuman'
            ]);

    });


/*
|--------------------------------------------------------------------------
| PELAYANAN
|--------------------------------------------------------------------------
*/

Route::get('/pelayanan/poli-umum', function () {
    return view('pelayanan.poli-umum');
});

Route::get('/pelayanan/poli-gigi', function () {
    return view('pelayanan.poli-gigi');
});

Route::get('/pelayanan/kia', function () {
    return view('pelayanan.kia');
});

Route::get('/pelayanan/laboratorium', function () {
    return view('pelayanan.laboratorium');
});

Route::get('/pelayanan/farmasi', function () {
    return view('pelayanan.farmasi');
});


/*
|--------------------------------------------------------------------------
| INFORMASI
|--------------------------------------------------------------------------
*/

Route::get('/informasi/berita', function () {

    $berita = Berita::where('status', 1)
        ->orderBy('tanggal', 'desc')
        ->get();

    return view('informasi.berita', compact('berita'));

})->name('informasi.berita');


// DETAIL BERITA
Route::get('/informasi/berita', function () {

    $berita = Berita::where('status', 1)
        ->orderBy('tanggal', 'desc')
        ->get();

    return view('informasi.berita', compact('berita'));

})->name('informasi.berita');


// DETAIL BERITA
Route::get('/informasi/berita/{berita}', function (Berita $berita) {

    if (!$berita->status) {
        abort(404);
    }

    return view('informasi.berita-detail', [
        'berita' => $berita
    ]);

})->name('berita.show');



Route::get('/informasi/pengumuman', function () {
    $pengumuman = \App\Models\Pengumuman::where('status', 1)
        ->orderByDesc('tanggal')
        ->orderByDesc('id')
        ->get();

    return view('informasi.pengumuman', compact('pengumuman'));
})->name('informasi.pengumuman');



Route::get('/informasi/jadwal', function () {
    $jadwalPelayanan = JadwalPelayanan::where('status', true)
        ->orderBy('urutan')
        ->orderBy('id')
        ->get();

    return view('informasi.jadwal', compact('jadwalPelayanan'));
})->name('informasi.jadwal');
/*
|--------------------------------------------------------------------------
| PROMKES
|--------------------------------------------------------------------------
*/

Route::get('/promkes', function () {
    $promkes = \App\Models\Promkes::where('status', 1)
        ->orderByDesc('tanggal')
        ->orderByDesc('id')
        ->get();

    return view('promkes.index', compact('promkes'));
})->name('promkes');



/*
|--------------------------------------------------------------------------
| KLASTER PELAYANAN
|--------------------------------------------------------------------------
*/

Route::view(
    '/pelayanan/klaster/1',
    'pelayanan.klaster-1'
)->name('pelayanan.klaster.1');

Route::view(
    '/pelayanan/klaster/2',
    'pelayanan.klaster-2'
)->name('pelayanan.klaster.2');

Route::view(
    '/pelayanan/klaster/3',
    'pelayanan.klaster-3'
)->name('pelayanan.klaster.3');

Route::view(
    '/pelayanan/klaster/4',
    'pelayanan.klaster-4'
)->name('pelayanan.klaster.4');

Route::view(
    '/pelayanan/klaster/5',
    'pelayanan.klaster-5'
)->name('pelayanan.klaster.5');


/*
|--------------------------------------------------------------------------
| GALERI
|--------------------------------------------------------------------------
*/

Route::get('/galeri', function () {
    $galeri = \App\Models\Galeri::where('status', true)
        ->orderBy('urutan')
        ->orderByDesc('tanggal')
        ->orderByDesc('created_at')
        ->get();

    return view('galeri.index', compact('galeri'));
})->name('galeri');


/*
|--------------------------------------------------------------------------
| LAYANAN PENGADUAN
|--------------------------------------------------------------------------
*/

Route::get('/layanan-pengaduan', [
    PengaduanController::class,
    'index'
])->name('pengaduan.index');

Route::post('/layanan-pengaduan', [
    PengaduanController::class,
    'store'
])->name('pengaduan.store');


/*
|--------------------------------------------------------------------------
| CEK STATUS PENGADUAN
|--------------------------------------------------------------------------
*/

Route::get('/cek-pengaduan', [
    PengaduanController::class,
    'cek'
])->name('pengaduan.cek');

Route::post('/cek-pengaduan', [
    PengaduanController::class,
    'cekStatus'
])->name('pengaduan.cek-status');


/*
|--------------------------------------------------------------------------
| LAPORAN PEGAWAI
|--------------------------------------------------------------------------
*/
Route::get('/laporan-pegawai', [
    LaporanPegawaiController::class,
    'create'
])->name('laporan-pegawai.create');

Route::post('/laporan-pegawai', [
    LaporanPegawaiController::class,
    'store'
])->name('laporan-pegawai.store');

Route::get('/laporan-pegawai/{laporanPegawai}/download', [
    \App\Http\Controllers\LaporanPegawaiController::class,
    'download'
])->middleware('signed')->name('laporan-pegawai.download');

Route::get('/laporan-pegawai/{laporanPegawai}/lihat', [
    \App\Http\Controllers\LaporanPegawaiController::class,
    'view'
])->middleware('signed')->name('laporan-pegawai.view');


/*
|--------------------------------------------------------------------------
| ADMIN LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [
    AdminAuthController::class,
    'showLogin'
])->name('login');

Route::post('/login', [
    AdminAuthController::class,
    'login'
])->name('login.process');

Route::post('/logout', [
    AdminAuthController::class,
    'logout'
])->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
|
| Semua halaman di bawah ini hanya bisa dibuka setelah login.
|
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            AdminDashboardController::class,
            'index'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | LAPORAN PEGAWAI
        |--------------------------------------------------------------------------
        */

        Route::get('/laporan-pegawai', [
            AdminLaporanPegawaiController::class,
            'index'
        ])->name('laporan-pegawai.index');

        Route::get('/laporan-pegawai/{laporanPegawai}/edit', [
            AdminLaporanPegawaiController::class,
            'edit'
        ])->name('laporan-pegawai.edit');

        Route::put('/laporan-pegawai/{laporanPegawai}', [
            AdminLaporanPegawaiController::class,
            'update'
        ])->name('laporan-pegawai.update');

        Route::delete('/laporan-pegawai/{laporanPegawai}', [
            AdminLaporanPegawaiController::class,
            'destroy'
        ])->name('laporan-pegawai.destroy');

        /*
        |--------------------------------------------------------------------------
        | PENGADUAN
        |--------------------------------------------------------------------------
        */

        Route::get('/pengaduan', [
            AdminPengaduanController::class,
            'index'
        ])->name('pengaduan.index');

        Route::get('/pengaduan/{id}', [
            AdminPengaduanController::class,
            'show'
        ])->name('pengaduan.show');

        Route::put('/pengaduan/{id}', [
            AdminPengaduanController::class,
            'update'
        ])->name('pengaduan.update');


        /*
        |--------------------------------------------------------------------------
        | PROFIL PUSKESMAS
        |--------------------------------------------------------------------------
        */

        Route::get('/profil', [
            AdminProfilController::class,
            'index'
        ])->name('profil.index');

        Route::put('/profil', [
            AdminProfilController::class,
            'update'
        ])->name('profil.update');


        /*
        |--------------------------------------------------------------------------
        | STRUKTUR ORGANISASI
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'struktur',
            AdminStrukturOrganisasiController::class
        );

        Route::resource(
            'galeri',
            AdminGaleriController::class
        );

        Route::resource(
            'banner',
            \App\Http\Controllers\AdminBannerController::class
        );

        Route::resource(
            'promkes',
            AdminPromkesController::class
        );

        Route::resource(
            'jadwal-pelayanan',
            AdminJadwalPelayananController::class
        );

        Route::get('/footer', [
            AdminFooterSettingController::class,
            'edit'
        ])->name('footer.edit');

        Route::put('/footer', [
            AdminFooterSettingController::class,
            'update'
        ])->name('footer.update');

    });
