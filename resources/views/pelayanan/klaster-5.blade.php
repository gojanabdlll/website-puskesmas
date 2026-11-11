@extends('layouts.app')

@section('title', 'Klaster 5 — Pelayanan Penunjang')

@section('content')
    <section class="klaster-header">
        <div class="container">
            <span class="klaster-label">PELAYANAN PUSKESMAS</span>
            <h1>Pelayanan Penunjang</h1>
            <p>
                Informasi pelayanan penunjang kesehatan yang membantu
                proses pemeriksaan, penegakan diagnosis, dan tindak lanjut
                sesuai fasilitas yang tersedia.
            </p>
            <a href="{{ url('/') }}" class="btn-kembali">← Kembali ke Beranda</a>
        </div>
    </section>

    <section class="klaster-content">
        <div class="container">
            <div class="klaster-intro">
                <h2>Pelayanan Penunjang Kesehatan</h2>
                <p>
                    Halaman ini menyajikan informasi layanan penunjang
                    yang dapat membantu pasien memperoleh pelayanan
                    kesehatan secara terpadu.
                </p>
            </div>

            <div class="klaster-grid">
                <article class="klaster-card">
                    <div class="klaster-icon">🦷</div>
                    <h3>Poli Gigi</h3>
                    <p>
                        Informasi pemeriksaan dan konsultasi kesehatan
                        gigi serta mulut sesuai layanan yang tersedia.
                    </p>
                </article>

                <article class="klaster-card">
                    <div class="klaster-icon">🧪</div>
                    <h3>Laboratorium</h3>
                    <p>
                        Informasi pemeriksaan laboratorium sesuai indikasi,
                        ketersediaan fasilitas, dan arahan tenaga kesehatan.
                    </p>
                </article>

                <article class="klaster-card">
                    <div class="klaster-icon">💊</div>
                    <h3>Farmasi</h3>
                    <p>
                        Informasi pelayanan obat dan edukasi penggunaan
                        obat sesuai resep atau petunjuk tenaga kesehatan.
                    </p>
                </article>
            </div>

            <div class="klaster-notice">
                <strong>Informasi pelayanan</strong>
                <p>
                    Tidak semua pemeriksaan atau fasilitas selalu tersedia.
                    Silakan konfirmasi jadwal dan ketersediaan layanan
                    kepada petugas Puskesmas Singaparna.
                </p>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/klaster.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">
@endpush