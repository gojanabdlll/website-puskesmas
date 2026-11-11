@extends('layouts.admin')

@section('title', 'Laporan Pegawai - Admin')
@section('page-title', 'Laporan Pegawai')

@section('content')

    <div class="admin-lp-page">

        {{-- HEADER HALAMAN --}}
        <section class="admin-lp-heading">
            <div>
                <span class="admin-lp-eyebrow">PENGELOLAAN LAPORAN</span>
                <h2>Laporan Pegawai</h2>
                <p>
                    Kelola, periksa, dan tindak lanjuti laporan kegiatan
                    pegawai Puskesmas Singaparna.
                </p>
            </div>

            <div class="admin-lp-total">
                <span>Total Laporan</span>
                <strong>{{ $totalLaporan }}</strong>
            </div>
        </section>

        {{-- NOTIFIKASI --}}
        @if ($errors->any())
            <div class="admin-lp-alert admin-lp-alert-error">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- STATISTIK --}}
        <section class="admin-lp-stats">

            <div class="admin-lp-stat-card">
                <div class="admin-lp-stat-icon icon-total">▤</div>
                <div>
                    <span>Total Laporan</span>
                    <strong>{{ $totalLaporan }}</strong>
                    <small>Seluruh laporan masuk</small>
                </div>
            </div>

            <div class="admin-lp-stat-card">
                <div class="admin-lp-stat-icon icon-pending">◷</div>
                <div>
                    <span>Menunggu</span>
                    <strong>{{ $menunggu }}</strong>
                    <small>Perlu diperiksa</small>
                </div>
            </div>

            <div class="admin-lp-stat-card">
                <div class="admin-lp-stat-icon icon-accepted">✓</div>
                <div>
                    <span>Diterima</span>
                    <strong>{{ $diterima }}</strong>
                    <small>Laporan telah diterima</small>
                </div>
            </div>

            <div class="admin-lp-stat-card">
                <div class="admin-lp-stat-icon icon-revision">↻</div>
                <div>
                    <span>Perlu Revisi</span>
                    <strong>{{ $perluRevisi }}</strong>
                    <small>Perlu perbaikan</small>
                </div>
            </div>

        </section>

        {{-- DAFTAR LAPORAN --}}
        <section class="admin-lp-table-card">

            <div class="admin-lp-table-header">
                <div>
                    <span>DATA LAPORAN</span>
                    <h3>Daftar Laporan Masuk</h3>
                    <p>Periksa dokumen dan tentukan tindak lanjutnya.</p>
                </div>

                <div class="admin-lp-count">
                    {{ $laporanPegawai->total() }} laporan
                </div>
            </div>

            <div class="admin-lp-table-wrapper">
                <table class="admin-lp-table">
                    <thead>
                        <tr>
                            <th>Pegawai</th>
                            <th>Unit Kerja</th>
                            <th>Periode</th>
                            <th>Dokumen</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($laporanPegawai as $laporan)
                                            <tr>
                                                <td>
                                                    <div class="admin-lp-employee">
                                                        <strong>{{ $laporan->nama }}</strong>
                                                        <small>{{ $laporan->nip }}</small>
                                                    </div>
                                                </td>

                                                <td>{{ $laporan->unit_kerja }}</td>

                                                <td>
                                                    {{ \Carbon\Carbon::createFromDate(
                                $laporan->tahun,
                                $laporan->bulan,
                                1
                            )->translatedFormat('F Y') }}
                                                </td>

                                                <td>
                                                    <div class="admin-lp-document">
                                                        <span class="admin-lp-file-icon">
                                                            {{ in_array(strtolower($laporan->jenis_file), ['xls', 'xlsx']) ? '📊' : '📄' }}
                                                        </span>

                                                        <span>{{ $laporan->nama_file_asli }}</span>
                                                    </div>
                                                </td>

                                                <td>
                                                    @if ($laporan->status === 'Diterima')
                                                        <span class="admin-lp-status status-accepted">
                                                            Diterima
                                                        </span>
                                                    @elseif ($laporan->status === 'Perlu Revisi')
                                                        <span class="admin-lp-status status-revision">
                                                            Perlu Revisi
                                                        </span>
                                                    @else
                                                        <span class="admin-lp-status status-pending">
                                                            Menunggu Pemeriksaan
                                                        </span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="admin-lp-actions">

                                                        {{-- UNDUH --}}
                                                        <a href="{{ $tautanUnduh[$laporan->id] }}" class="admin-lp-btn btn-download">
                                                            <span>↓</span> Unduh
                                                        </a>

                                                        {{-- EDIT --}}
                                                        <a href="{{ route('admin.laporan-pegawai.edit', $laporan->id) }}"
                                                            class="admin-lp-btn btn-edit">
                                                            ✎ Edit
                                                        </a>

                                                        {{-- HAPUS --}}
                                                        <form action="{{ route('admin.laporan-pegawai.destroy', $laporan->id) }}" method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus laporan ini beserta file dokumennya? Tindakan ini tidak dapat dibatalkan.');">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="admin-lp-btn btn-delete">
                                                                Hapus
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="admin-lp-empty">
                                        <span>📂</span>
                                        <strong>Belum Ada Laporan</strong>
                                        <p>
                                            Laporan pegawai yang masuk akan
                                            ditampilkan di sini.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if ($laporanPegawai->hasPages())
                <div class="admin-lp-pagination">
                    {{ $laporanPegawai->links() }}
                </div>
            @endif

        </section>

    </div>

@endsection

@push('styles')
    <style>
        /* HALAMAN LAPORAN PEGAWAI ADMIN */
        .admin-lp-page {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
            color: #183b3a;
        }

        .admin-lp-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .admin-lp-eyebrow,
        .admin-lp-table-header>div>span {
            display: block;
            color: #008b80;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
        }

        .admin-lp-heading h2 {
            margin: 0 0 8px;
            font-size: 27px;
            font-weight: 800;
        }

        .admin-lp-heading p,
        .admin-lp-table-header p {
            margin: 0;
            color: #71817e;
            font-size: 13px;
            line-height: 1.7;
        }

        .admin-lp-total {
            min-width: 125px;
            padding: 15px 20px;
            border: 1px solid #dcebe8;
            border-radius: 12px;
            background: #fff;
        }

        .admin-lp-total span,
        .admin-lp-stat-card span {
            display: block;
            color: #71817e;
            font-size: 11px;
        }

        .admin-lp-total strong {
            display: block;
            margin-top: 5px;
            color: #008b80;
            font-size: 27px;
        }

        /* STATISTIK */
        .admin-lp-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .admin-lp-stat-card {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
            padding: 20px 17px;
            background: #fff;
            border: 1px solid #e1ecea;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(24, 59, 58, .035);
        }

        .admin-lp-stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 43px;
            height: 43px;
            border-radius: 12px;
            font-size: 22px;
            font-weight: 800;
        }

        .icon-total {
            color: #008b80;
            background: #ddf7f3;
        }

        .icon-pending {
            color: #d97706;
            background: #fff3d8;
        }

        .icon-accepted {
            color: #059669;
            background: #ddf8ee;
        }

        .icon-revision {
            color: #b45309;
            background: #fff0df;
        }

        .admin-lp-stat-card strong {
            display: block;
            margin: 4px 0;
            color: #183b3a;
            font-size: 26px;
            line-height: 1.2;
        }

        .admin-lp-stat-card small {
            color: #87938f;
            font-size: 10px;
        }

        /* TABEL */
        .admin-lp-table-card {
            overflow: hidden;
            border: 1px solid #e1ecea;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 4px 16px rgba(24, 59, 58, .035);
        }

        .admin-lp-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 23px 24px;
            border-bottom: 1px solid #e8efed;
        }

        .admin-lp-table-header h3 {
            margin: 0 0 7px;
            font-size: 19px;
            font-weight: 800;
        }

        .admin-lp-count {
            padding: 9px 12px;
            border-radius: 9px;
            background: #e3f7f3;
            color: #087f75;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .admin-lp-table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .admin-lp-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 12px;
        }

        .admin-lp-table thead {
            background: #f3f8f8;
        }

        .admin-lp-table th {
            padding: 15px 16px;
            color: #526565;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .admin-lp-table td {
            padding: 17px 16px;
            border-top: 1px solid #edf2f1;
            vertical-align: middle;
        }

        .admin-lp-table tbody tr:hover {
            background: #fbfdfd;
        }

        .admin-lp-employee strong,
        .admin-lp-employee small {
            display: block;
        }

        .admin-lp-employee strong {
            color: #183b3a;
            font-size: 12px;
        }

        .admin-lp-employee small {
            margin-top: 5px;
            color: #87938f;
            font-size: 11px;
        }

        .admin-lp-document {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 170px;
            max-width: 245px;
            overflow-wrap: anywhere;
            line-height: 1.6;
        }

        .admin-lp-file-icon {
            flex-shrink: 0;
            font-size: 19px;
        }

        .admin-lp-status {
            display: inline-block;
            padding: 7px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-pending {
            color: #0369a1;
            background: #e0f2fe;
        }

        .status-accepted {
            color: #15803d;
            background: #dcfce7;
        }

        .status-revision {
            color: #a16207;
            background: #fef3c7;
        }

        /* TOMBOL AKSI */
        .admin-lp-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .admin-lp-actions form {
            margin: 0;
        }

        .admin-lp-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-height: 34px;
            padding: 8px 10px;
            border: 1px solid transparent;
            border-radius: 7px;
            font-family: inherit;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none !important;
            cursor: pointer;
            transition: .2s ease;
        }

        .admin-lp-btn:hover {
            transform: translateY(-1px);
        }

        .btn-download {
            background: #087f75;
            color: #fff !important;
        }

        .btn-download:hover {
            background: #06685f;
        }

        .btn-edit {
            background: #e4f7f3;
            color: #087f75 !important;
            border-color: #c6ebe4;
        }

        .btn-edit:hover {
            background: #c9eee7;
        }

        .btn-delete {
            background: #fff0f0;
            color: #b91c1c;
            border-color: #fee0e0;
        }

        .btn-delete:hover {
            background: #fee2e2;
        }

        /* KOSONG DAN PAGINATION */
        .admin-lp-empty {
            padding: 45px 20px;
            text-align: center;
        }

        .admin-lp-empty>span {
            display: block;
            margin-bottom: 12px;
            font-size: 32px;
        }

        .admin-lp-empty strong {
            display: block;
            color: #183b3a;
            font-size: 15px;
        }

        .admin-lp-empty p {
            margin: 8px 0 0;
            color: #71817e;
            font-size: 12px;
        }

        .admin-lp-pagination {
            padding: 18px 22px;
            border-top: 1px solid #e8efed;
        }

        .admin-lp-alert {
            margin-bottom: 20px;
            padding: 14px 17px;
            border-radius: 10px;
            font-size: 13px;
        }

        .admin-lp-alert-error {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #991b1b;
        }

        .admin-lp-alert ul {
            margin: 7px 0 0;
            padding-left: 20px;
        }

        /* RESPONSIVE */
        @media (max-width: 1050px) {
            .admin-lp-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 600px) {
            .admin-lp-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .admin-lp-total {
                width: 100%;
            }

            .admin-lp-stats {
                grid-template-columns: 1fr;
            }

            .admin-lp-table-header {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px;
            }
        }
    </style>
@endpush