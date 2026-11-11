@extends('layouts.app')

@section('title', 'Laporan Pegawai - Puskesmas Singaparna')

@section('content')
    <section class="lp-hero">
        <div class="lp-hero-content">
            <h1>SIMPEL-BRO</h1>

            <div class="lp-hero-acronym">
                <span><strong>S</strong>istem</span>
                <span><strong>I</strong>nformasi</span>
                <span><strong>M</strong>anajemen</span>
                <span><strong>Pel</strong>aporan</span>
                <span><strong>B</strong>ersama</span>
                <span><strong>R</strong>espons</span>
                <span><strong>O</strong>perasional</span>
            </div>

            <p>
                Unggah laporan kegiatan bulanan pegawai secara praktis,
                cepat, dan terintegrasi dalam format Word atau Excel.
            </p>
        </div>

    </section>

    <section class="lp-section">
        <div class="lp-container">
            <div class="lp-heading">
                <span>FORMULIR LAPORAN</span>
                <h2>Kirim Laporan Bulanan</h2>
                <p>Lengkapi identitas dan periode laporan, lalu unggah dokumen Anda.</p>
            </div>

            @if (session('success'))
                <div class="lp-alert lp-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="lp-alert lp-error">
                    <strong>Periksa kembali formulir Anda:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="lp-form" action="{{ route('laporan-pegawai.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="lp-form-title">
                    <div class="lp-form-icon">📋</div>
                    <div>
                        <h3>Identitas Pegawai</h3>
                        <p>Isi sesuai data kepegawaian Anda.</p>
                    </div>
                </div>

                <div class="lp-grid">
                    <div class="lp-field">
                        <label for="nama">Nama Lengkap *</label>
                        <input id="nama" type="text" name="nama" value="{{ old('nama') }}" maxlength="150" required
                            placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="lp-field">
                        <label for="nip">NIP *</label>
                        <input id="nip" type="text" name="nip" value="{{ old('nip') }}" maxlength="30" required
                            placeholder="Masukkan NIP">
                    </div>

                    <div class="lp-field lp-full">
                        <label for="unit_kerja">Unit Kerja *</label>
                        <select id="unit_kerja" name="unit_kerja" required>
                            <option value="">Pilih unit kerja</option>
                            @foreach ([
                                    'Pendaftaran',
                                    'Pelayanan Umum',
                                    'Pelayanan Gigi',
                                    'KIA',
                                    'Laboratorium',
                                    'Farmasi',
                                    'Promosi Kesehatan',
                                    'Administrasi',
                                    'Lainnya'
                                ] as $unit)
                                <option value="{{ $unit }}" @selected(old('unit_kerja') === $unit)>
                                    {{ $unit }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="lp-divider"></div>

                <div class="lp-form-title">
                    <div class="lp-form-icon">📅</div>
                    <div>
                        <h3>Periode Laporan</h3>
                        <p>Tentukan bulan dan tahun kegiatan yang dilaporkan.</p>
                    </div>
                </div>

                <div class="lp-grid">
                    <div class="lp-field">
                        <label for="bulan">Bulan *</label>
                        <select id="bulan" name="bulan" required>
                            <option value="">Pilih bulan</option>
                            @foreach ([
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember'
                                ] as $angka => $namaBulan)
                                <option value="{{ $angka }}" @selected((string) old('bulan') === (string) $angka)>
                                    {{ $namaBulan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="lp-field">
                        <label for="tahun">Tahun *</label>
                        <input id="tahun" type="number" name="tahun" min="2020" max="{{ date('Y') + 1 }}"
                            value="{{ old('tahun', date('Y')) }}" required>
                    </div>
                </div>

                <div class="lp-divider"></div>

                <div class="lp-form-title">
                    <div class="lp-form-icon">📎</div>
                    <div>
                        <h3>Dokumen Laporan</h3>
                        <p>Unggah laporan bulanan yang sudah disiapkan.</p>
                    </div>
                </div>

                <div class="lp-field">
                    <label for="file_laporan">File Word atau Excel *</label>
                    <input id="file_laporan" type="file" name="file_laporan" accept=".doc,.docx,.xls,.xlsx" required>
                    <small>
                        Format: DOC, DOCX, XLS, XLSX. Ukuran maksimal 10 MB.
                    </small>
                </div>

                <div class="lp-note">
                    <strong>Perhatian:</strong>
                    Pastikan dokumen sudah benar dan tidak memuat data pasien
                    yang tidak diperlukan dalam laporan kegiatan.
                </div>

                <button class="lp-submit" type="submit">
                    Kirim Laporan
                    <span>→</span>
                </button>
            </form>
        </div>
    </section>
    </form>

    {{-- DAFTAR LAPORAN YANG SUDAH DIKIRIM --}}
    <section class="lp-list-section">
        <div class="lp-list-heading">
            <span>ARSIP LAPORAN</span>
            <h2>Laporan yang Sudah Dikirim</h2>
            <p>
                Daftar laporan bulanan pegawai yang tersimpan
                di sistem Puskesmas Singaparna.
            </p>
        </div>

        @forelse ($laporanPegawai as $laporan)
            <article class="lp-report-card">
                <div class="lp-report-icon">
                    @if (in_array($laporan->jenis_file, ['xls', 'xlsx']))
                        📊
                    @else
                        📄
                    @endif
                </div>

                <div class="lp-report-info">
                    <h3>{{ $laporan->nama_file_asli }}</h3>

                    <p>
                        {{ $laporan->nama }}
                        &bull;
                        {{ $laporan->unit_kerja }}
                    </p>

                    <p>
                        Periode:
                        {{ \Carbon\Carbon::createFromDate(
                $laporan->tahun,
                $laporan->bulan,
                1
            )->translatedFormat('F Y') }}
                    </p>

                    <span class="lp-report-status">
                        {{ $laporan->status }}
                    </span>
                </div>

                <a href="{{ $tautanLihat[$laporan->id] }}" class="lp-view">
                    Lihat
                </a>

                <a href="{{ $tautanUnduh[$laporan->id] }}" class="lp-download">
                    Unduh
                </a>
            </article>
        @empty
            <div class="lp-list-empty">
                <div>📂</div>
                <h3>Belum Ada Laporan</h3>
                <p>
                    Laporan yang berhasil dikirim akan muncul
                    di bagian ini.
                </p>
            </div>
        @endforelse

        <div class="lp-pagination">
            {{ $laporanPegawai->links() }}
        </div>
    </section>
    </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/laporan-pegawai.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">
@endpush