@extends('layouts.app')

@section('title', 'Klaster 4 — Pengendalian Penyakit')

@section('content')
    <section class="klaster-header">
        <div class="container">
            <span class="klaster-label">PELAYANAN PUSKESMAS</span>
            <h1>Pengendalian Penyakit</h1>
            <p>
                Informasi upaya pencegahan, deteksi dini, dan pengendalian
                penyakit untuk mendukung kesehatan masyarakat.
            </p>
            <a href="{{ url('/') }}" class="btn-kembali">← Kembali ke Beranda</a>
        </div>
    </section>

    <section class="klaster-content">
        <div class="container">
            <div class="klaster-intro">
                <h2>Pencegahan dan Pengendalian Penyakit</h2>
                <p>
                    Upaya pengendalian penyakit dilakukan melalui edukasi,
                    deteksi dini, pemantauan, dan tindak lanjut sesuai
                    program kesehatan yang tersedia.
                </p>
            </div>

            <div class="klaster-grid">
                <article class="klaster-card">
                    <div class="klaster-icon">🛡️</div>
                    <h3>Pencegahan Penyakit</h3>
                    <p>
                        Edukasi perilaku hidup bersih dan sehat serta
                        langkah pencegahan penyakit sesuai anjuran
                        tenaga kesehatan.
                    </p>
                </article>

                <article class="klaster-card">
                    <div class="klaster-icon">🔬</div>
                    <h3>Deteksi Dini</h3>
                    <p>
                        Informasi pemeriksaan awal dan tindak lanjut
                        apabila ditemukan gejala atau faktor risiko
                        penyakit.
                    </p>
                </article>

                <article class="klaster-card">
                    <div class="klaster-icon">🌿</div>
                    <h3>Edukasi Kesehatan</h3>
                    <p>
                        Informasi mengenai kebersihan lingkungan,
                        pencegahan penularan, dan kebiasaan sehat
                        dalam kehidupan sehari-hari.
                    </p>
                </article>
            </div>

            <div class="klaster-notice">
                <strong>Informasi pelayanan</strong>
                <p>
                    Jenis program pengendalian penyakit dan tindak lanjut
                    disesuaikan dengan program aktif serta kebijakan
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