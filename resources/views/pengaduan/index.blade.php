@extends('layouts.app')

@section('title', 'Layanan Pengaduan - Puskesmas Singaparna')


@section('content')

    {{-- =====================================================
    HEADER
    ====================================================== --}}

    <section class="page-header">

        <div class="page-header-content">

            <span>
                PELAYANAN MASYARAKAT
            </span>

            <h1>
                Layanan Pengaduan
            </h1>

            <p>
                Sampaikan kritik, saran, dan pengaduan untuk
                meningkatkan kualitas pelayanan
            </p>

        </div>

    </section>


    {{-- =====================================================
    HALAMAN PENGADUAN
    ====================================================== --}}

    <section class="pengaduan-page">

        <div class="pengaduan-container">


            {{-- =================================================
            INTRO
            ================================================== --}}

            <div class="pengaduan-intro">

                <span class="pengaduan-label">
                    SUARA MASYARAKAT
                </span>

                <h2>
                    Kami Siap Mendengarkan
                </h2>

                <p>
                    Sampaikan pengalaman, kritik, saran, maupun
                    pengaduan terkait pelayanan Puskesmas Singaparna.
                    Masukan Anda menjadi bahan evaluasi untuk
                    meningkatkan kualitas pelayanan kepada masyarakat.
                </p>

            </div>


            {{-- =================================================
            PESAN BERHASIL
            ================================================== --}}

            @if(session('success'))

                <div class="pengaduan-success">

                    <div class="success-icon">
                        ✓
                    </div>

                    <div>

                        <strong>
                            {{ session('success') }}
                        </strong>

                        <p>
                            Simpan nomor tiket berikut untuk
                            mengetahui perkembangan pengaduan Anda.
                        </p>

                        <div class="ticket-number">

                            {{ session('nomor_tiket') }}

                        </div>

                        <a href="{{ route('pengaduan.cek') }}" class="success-link">
                            Cek Status Pengaduan →
                        </a>

                    </div>

                </div>

            @endif


            {{-- =================================================
            GRID UTAMA
            ================================================== --}}

            <div class="pengaduan-grid">


                {{-- =================================================
                INFORMASI
                ================================================== --}}

                <div class="pengaduan-info">

                    <div class="info-heading">

                        <div class="info-heading-icon">
                            💬
                        </div>

                        <div>

                            <span>
                                LAYANAN PENGADUAN
                            </span>

                            <h3>
                                Sampaikan Masukan Anda
                            </h3>

                        </div>

                    </div>


                    <p>
                        Gunakan formulir di samping untuk menyampaikan
                        pengaduan atau saran mengenai pelayanan
                        Puskesmas Singaparna.
                    </p>


                    <div class="pengaduan-points">

                        <div class="pengaduan-point">

                            <div class="point-icon">
                                ✓
                            </div>

                            <div>

                                <strong>
                                    Mudah Disampaikan
                                </strong>

                                <p>
                                    Isi formulir pengaduan dengan
                                    informasi yang jelas dan lengkap.
                                </p>

                            </div>

                        </div>


                        <div class="pengaduan-point">

                            <div class="point-icon">
                                ✓
                            </div>

                            <div>

                                <strong>
                                    Tercatat dalam Sistem
                                </strong>

                                <p>
                                    Setiap pengaduan mendapatkan
                                    nomor tiket sebagai identitas laporan.
                                </p>

                            </div>

                        </div>


                        <div class="pengaduan-point">

                            <div class="point-icon">
                                ✓
                            </div>

                            <div>

                                <strong>
                                    Dapat Dipantau
                                </strong>

                                <p>
                                    Gunakan nomor tiket untuk mengetahui
                                    status pengaduan Anda.
                                </p>

                            </div>

                        </div>


                        <div class="pengaduan-point">

                            <div class="point-icon">
                                ✓
                            </div>

                            <div>

                                <strong>
                                    Membantu Perbaikan
                                </strong>

                                <p>
                                    Setiap masukan menjadi bahan evaluasi
                                    untuk peningkatan pelayanan.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="pengaduan-note">

                        <strong>
                            ⚠️ Perhatian
                        </strong>

                        <p>
                            Layanan ini digunakan untuk kritik, saran,
                            dan pengaduan pelayanan. Untuk kondisi
                            kegawatdaruratan, segera gunakan layanan
                            kesehatan darurat yang tersedia.
                        </p>

                    </div>

                </div>


                {{-- =================================================
                FORM
                ================================================== --}}

                <div class="pengaduan-form-card">

                    <div class="form-heading">

                        <span>
                            FORMULIR
                        </span>

                        <h3>
                            Kirim Pengaduan
                        </h3>

                        <p>
                            Silakan isi data berikut dengan benar.
                        </p>

                    </div>


                    <form action="{{ route('pengaduan.store') }}" method="POST">

                        @csrf


                        {{-- NAMA --}}

                        <div class="form-group">

                            <label for="nama">
                                Nama Lengkap
                                <span>*</span>
                            </label>

                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                placeholder="Masukkan nama lengkap" required>

                            @error('nama')
                                <small class="form-error">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- KONTAK --}}

                        <div class="form-group">

                            <label for="kontak">
                                No. HP / Email
                                <small>(opsional)</small>
                            </label>

                            <input type="text" id="kontak" name="kontak" value="{{ old('kontak') }}"
                                placeholder="Contoh: 081234567890">

                            <small class="form-hint">
                                Digunakan apabila Puskesmas perlu
                                menghubungi Anda.
                            </small>

                            @error('kontak')
                                <small class="form-error">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- KATEGORI --}}

                        <div class="form-group">

                            <label for="kategori">
                                Kategori Pengaduan
                                <span>*</span>
                            </label>

                            <select id="kategori" name="kategori" required>

                                <option value="">
                                    -- Pilih kategori --
                                </option>

                                <option value="Pelayanan" {{ old('kategori') == 'Pelayanan' ? 'selected' : '' }}>
                                    Pelayanan
                                </option>

                                <option value="Petugas" {{ old('kategori') == 'Petugas' ? 'selected' : '' }}>
                                    Petugas
                                </option>

                                <option value="Fasilitas" {{ old('kategori') == 'Fasilitas' ? 'selected' : '' }}>
                                    Fasilitas
                                </option>

                                <option value="Administrasi" {{ old('kategori') == 'Administrasi' ? 'selected' : '' }}>
                                    Administrasi
                                </option>

                                <option value="Informasi" {{ old('kategori') == 'Informasi' ? 'selected' : '' }}>
                                    Informasi
                                </option>

                                <option value="Saran" {{ old('kategori') == 'Saran' ? 'selected' : '' }}>
                                    Saran
                                </option>

                                <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>
                                    Lainnya
                                </option>

                            </select>

                            @error('kategori')
                                <small class="form-error">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- SUBJEK --}}

                        <div class="form-group">

                            <label for="subjek">
                                Subjek Pengaduan
                                <span>*</span>
                            </label>

                            <input type="text" id="subjek" name="subjek" value="{{ old('subjek') }}"
                                placeholder="Contoh: Pelayanan di Poli Umum" required>

                            @error('subjek')
                                <small class="form-error">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- ISI PENGADUAN --}}

                        <div class="form-group">

                            <label for="isi_pengaduan">
                                Isi Pengaduan
                                <span>*</span>
                            </label>

                            <textarea id="isi_pengaduan" name="isi_pengaduan" rows="6" maxlength="5000"
                                placeholder="Tuliskan pengaduan, kritik, atau saran Anda secara jelas..."
                                required>{{ old('isi_pengaduan') }}</textarea>

                            <div class="textarea-footer">

                                <small>
                                    Maksimal 5.000 karakter
                                </small>

                                <small id="charCount">
                                    0 / 5000
                                </small>

                            </div>

                            @error('isi_pengaduan')
                                <small class="form-error">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- ANONIM --}}

                        <div class="anonymous-box">

                            <label class="checkbox-label">

                                <input type="checkbox" name="anonim" value="1" {{ old('anonim') ? 'checked' : '' }}>

                                <span>
                                    Saya ingin identitas saya
                                    tidak ditampilkan.
                                </span>

                            </label>

                        </div>


                        {{-- SUBMIT --}}

                        <button type="submit" class="submit-btn">

                            <span>
                                Kirim Pengaduan
                            </span>

                            <strong>
                                →
                            </strong>

                        </button>


                        <p class="form-required">
                            * Wajib diisi
                        </p>

                    </form>

                </div>

            </div>


            {{-- =================================================
            CEK STATUS
            ================================================== --}}

            <div class="cek-status-card">

                <div class="cek-status-icon">
                    🔎
                </div>

                <div class="cek-status-content">

                    <span>
                        SUDAH MENGIRIM PENGADUAN?
                    </span>

                    <h3>
                        Cek Status Pengaduan Anda
                    </h3>

                    <p>
                        Masukkan nomor tiket untuk mengetahui
                        perkembangan pengaduan yang telah disampaikan.
                    </p>

                </div>

                <a href="{{ route('pengaduan.cek') }}" class="cek-status-btn">
                    Cek Status
                </a>

            </div>


        </div>

    </section>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/pengaduan.css') }}">

    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">

@endpush


@push('scripts')

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const textarea =
                document.getElementById('isi_pengaduan');

            const counter =
                document.getElementById('charCount');


            if (textarea && counter) {

                function updateCounter() {

                    counter.textContent =
                        textarea.value.length + ' / 5000';

                }

                textarea.addEventListener(
                    'input',
                    updateCounter
                );

                updateCounter();

            }

        });

    </script>

@endpush