@extends('layouts.app')

@section('title', 'Detail Laporan Pegawai - Puskesmas Singaparna')

@section('content')
    <section class="lp-section" style="margin-top: 78px; min-height: 70vh;">
        <div class="lp-container">
            <div class="lp-form">

                {{-- JUDUL HALAMAN --}}
                <div class="lp-form-title">
                    <div class="lp-form-icon">📄</div>
                    <div>
                        <h3>Detail Laporan Pegawai</h3>
                        <p>Informasi dokumen yang telah dikirim.</p>
                    </div>
                </div>

                {{-- INFORMASI LAPORAN --}}
                <div class="lp-report-detail">
                    <p>
                        <strong>Nama Pegawai:</strong>
                        {{ $laporan->nama }}
                    </p>

                    <p>
                        <strong>Unit Kerja:</strong>
                        {{ $laporan->unit_kerja }}
                    </p>

                    <p>
                        <strong>Periode:</strong>
                        {{ \Carbon\Carbon::createFromDate(
        $laporan->tahun,
        $laporan->bulan,
        1
    )->translatedFormat('F Y') }}
                    </p>

                    <p>
                        <strong>Nama File:</strong>
                        {{ $laporan->nama_file_asli }}
                    </p>

                    <p>
                        <strong>Status:</strong>
                        {{ $laporan->status }}
                    </p>
                    {{-- TANGGAPAN ADMIN --}}
                    @if ($laporan->tanggapan_admin)
                        <div class="lp-admin-feedback">
                            <h3>Catatan dari Admin</h3>

                            <p>
                                {{ $laporan->tanggapan_admin }}
                            </p>
                        </div>
                    @elseif ($laporan->status === 'Perlu Revisi')
                        <div class="lp-admin-feedback">
                            <h3>Catatan dari Admin</h3>

                            <p>
                                Laporan perlu diperbaiki. Silakan hubungi Admin
                                untuk mendapatkan informasi mengenai bagian yang perlu direvisi.
                            </p>
                        </div>
                    @endif

                </div>

                {{-- PRATINJAU ISI DOKUMEN --}}
                <div class="lp-preview">
                    <h3>Pratinjau Isi Dokumen</h3>

                    @if ($previewType === 'excel')
                        <div class="lp-excel-wrapper">
                            <table class="lp-excel-table">
                                <tbody>
                                    @forelse ($excelRows as $row)
                                        <tr>
                                            @foreach ($row as $cell)
                                                <td>{{ $cell }}</td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>Dokumen Excel tidak memiliki data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    @elseif ($previewType === 'word')
                        {{-- Aktifkan setelah HTML Word disanitasi --}}
                        <div class="lp-note">
                            Pratinjau Word belum diaktifkan. Silakan unduh
                            dokumen untuk melihat isi lengkapnya.
                        </div>

                    @else
                        <div class="lp-note">
                            {{ $previewMessage ?? 'Pratinjau belum tersedia untuk format ini.' }}
                        </div>
                    @endif
                </div>

                {{-- KETERANGAN --}}
                <div class="lp-note">
                    Pratinjau Excel menampilkan data dari lembar kerja aktif.
                    Untuk melihat format dokumen aslinya, silakan unduh file.
                </div>


                {{-- TOMBOL AKSI --}}
                <div class="lp-report-actions">
                    <a href="{{ route('laporan-pegawai.create') }}" class="lp-view">
                        Kembali ke Daftar Laporan
                    </a>

                    <a href="{{ URL::temporarySignedRoute(
        'laporan-pegawai.download',
        now()->addHours(24),
        ['laporanPegawai' => $laporan->id]
    ) }}" class="lp-download">
                        Unduh Dokumen
                    </a>
                </div>


            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/laporan-pegawai.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">
@endpush