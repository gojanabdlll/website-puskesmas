
@extends('layouts.app')

@section('title', 'Tindak Lanjut Laporan Pegawai - Admin')

@section('content')
<section class="lp-admin-edit">
    <div class="lp-admin-edit-container">

        {{-- HEADER --}}
        <div class="lp-admin-edit-heading">
            <div class="lp-admin-edit-icon">📋</div>
            <div>
                <span class="lp-admin-edit-eyebrow">PENGELOLAAN LAPORAN</span>
                <h1>Tindak Lanjut Laporan</h1>
                <p>Periksa dokumen, tentukan status, dan berikan catatan kepada pegawai.</p>
            </div>
        </div>

        {{-- ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="lp-admin-alert lp-admin-alert-error">
                <strong>Periksa kembali data berikut:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- INFORMASI LAPORAN --}}
        <div class="lp-admin-info-card">
            <div class="lp-admin-card-heading">
                <span class="lp-admin-card-icon">📄</span>
                <div>
                    <h2>Informasi Laporan</h2>
                    <p>Identitas pegawai dan dokumen yang dikirim.</p>
                </div>
            </div>

            <div class="lp-admin-info-grid">
                <div class="lp-admin-info-item">
                    <span>Nama Pegawai</span>
                    <strong>{{ $laporanPegawai->nama }}</strong>
                </div>

                <div class="lp-admin-info-item">
                    <span>NIP</span>
                    <strong>{{ $laporanPegawai->nip }}</strong>
                </div>

                <div class="lp-admin-info-item">
                    <span>Unit Kerja</span>
                    <strong>{{ $laporanPegawai->unit_kerja }}</strong>
                </div>

                <div class="lp-admin-info-item">
                    <span>Periode Laporan</span>
                    <strong>
                        {{ \Carbon\Carbon::createFromDate(
                            $laporanPegawai->tahun,
                            $laporanPegawai->bulan,
                            1
                        )->translatedFormat('F Y') }}
                    </strong>
                </div>

                <div class="lp-admin-info-item lp-admin-info-file">
                    <span>Nama Dokumen</span>
                    <strong>📎 {{ $laporanPegawai->nama_file_asli }}</strong>
                </div>

                <div class="lp-admin-info-item">
                    <span>Status Saat Ini</span>
                    <strong>
                        @if ($laporanPegawai->status === 'Diterima')
                            <span class="lp-admin-status lp-status-accepted">Diterima</span>
                        @elseif ($laporanPegawai->status === 'Perlu Revisi')
                            <span class="lp-admin-status lp-status-revision">Perlu Revisi</span>
                        @else
                            <span class="lp-admin-status lp-status-pending">Menunggu Pemeriksaan</span>
                        @endif
                    </strong>
                </div>
            </div>
        </div>

        {{-- FORM TINDAK LANJUT --}}
        <div class="lp-admin-form-card">
            <div class="lp-admin-card-heading">
                <span class="lp-admin-card-icon">✍️</span>
                <div>
                    <h2>Keputusan dan Catatan Admin</h2>
                    <p>Pilih keputusan pemeriksaan dan tuliskan catatan yang jelas.</p>
                </div>
            </div>

            <form
                action="{{ route('admin.laporan-pegawai.update', $laporanPegawai->id) }}"
                method="POST"
                class="lp-admin-review-form"
            >
                @csrf
                @method('PUT')

                <div class="lp-admin-field">
                    <label for="status">Status Laporan <span>*</span></label>

                    <select name="status" id="status" required>
                        <option value="Menunggu Pemeriksaan"
                            @selected(old('status', $laporanPegawai->status) === 'Menunggu Pemeriksaan')>
                            Menunggu Pemeriksaan
                        </option>

                        <option value="Diterima"
                            @selected(old('status', $laporanPegawai->status) === 'Diterima')>
                            Diterima
                        </option>

                        <option value="Perlu Revisi"
                            @selected(old('status', $laporanPegawai->status) === 'Perlu Revisi')>
                            Perlu Revisi
                        </option>
                    </select>

                    <small>
                        Pilih Diterima jika laporan sudah sesuai, atau Perlu Revisi jika masih ada yang harus diperbaiki.
                    </small>
                </div>

                <div class="lp-admin-field">
                    <label for="tanggapan_admin">Catatan atau Tanggapan <span>*</span></label>

                    <textarea
                        name="tanggapan_admin"
                        id="tanggapan_admin"
                        rows="5"
                        maxlength="5000"
                        placeholder="Contoh: Mohon perbaiki tata tulis, lengkapi uraian kegiatan, dan periksa kembali format laporan."
                    >{{ old('tanggapan_admin', $laporanPegawai->tanggapan_admin) }}</textarea>

                    <small>
                        Tuliskan alasan revisi atau keterangan penerimaan agar pegawai memahami hasil pemeriksaan.
                    </small>
                </div>

                <div class="lp-admin-form-actions">
                    <a
                        href="{{ route('admin.laporan-pegawai.index') }}"
                        class="lp-admin-btn lp-admin-btn-back"
                    >
                        ← Kembali
                    </a>

                    <button type="submit" class="lp-admin-btn lp-admin-btn-save">
                        <span>✓</span> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/laporan-pegawai.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">
@endpush
