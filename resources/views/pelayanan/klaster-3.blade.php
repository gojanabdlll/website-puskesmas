@extends('layouts.app')

@section('title', 'Klaster 3 — Kesehatan Dewasa dan Lansia')

@section('content')
    <section class="klaster-header">
        <div class="container">
            <span class="klaster-label">PELAYANAN PUSKESMAS</span>
            <h1>Kesehatan Dewasa dan Lansia</h1>
            <p>
                Informasi pelayanan kesehatan bagi masyarakat usia dewasa
                dan lanjut usia untuk mendukung kesehatan dan kualitas
                hidup yang lebih baik.
            </p>
            <a href="{{ url('/') }}" class="btn-kembali">← Kembali ke Beranda</a>
        </div>
    </section>

    <section class="klaster-content">
        <div class="container">
            <div class="klaster-intro">
                <h2>Layanan Dewasa dan Lansia</h2>
                <p>
                    Pelayanan berfokus pada pemantauan kesehatan,
                    deteksi dini faktor risiko, serta edukasi untuk
                    menjaga kesehatan sesuai kebutuhan pasien.
                </p>
            </div>

            <div class="klaster-grid">
                <article class="klaster-card">
                    <div class="klaster-icon">🩺</div>
                    <h3>Pemeriksaan Kesehatan</h3>
                    <p>
                        Informasi pemeriksaan kondisi kesehatan dan
                        konsultasi awal sesuai jenis pelayanan yang
                        tersedia di Puskesmas.
                    </p>
                </article>

                <article class="klaster-card">
                    <div class="klaster-icon">❤️</div>
                    <h3>Pemantauan Penyakit Kronis</h3>
                    <p>
                        Edukasi dan pemantauan kondisi kesehatan seperti
                        tekanan darah serta faktor risiko penyakit kronis
                        sesuai arahan tenaga kesehatan.
                    </p>
                </article>

                <article class="klaster-card">
                    <div class="klaster-icon">🚶</div>
                    <h3>Kesehatan Lansia</h3>
                    <p>
                        Informasi pemeriksaan kesehatan, aktivitas fisik
                        yang sesuai, dan edukasi untuk membantu lansia
                        menjaga kemandirian.
                    </p>
                </article>
            </div>

            <div class="klaster-notice">
                <strong>Informasi pelayanan</strong>
                <p>
                    Jenis pemeriksaan, jadwal, dan tindak lanjut mengikuti
                    hasil penilaian tenaga kesehatan serta ketentuan
                    Puskesmas Singaparna.
                </p>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/klaster.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">
@endpush