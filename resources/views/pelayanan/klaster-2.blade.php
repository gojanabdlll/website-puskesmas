@extends('layouts.app')

@section('title', 'Klaster 2 — Kesehatan Ibu dan Anak')

@section('content')
    <section class="klaster-header">
        <div class="container">
            <span class="klaster-label">PELAYANAN PUSKESMAS</span>
            <h1>Kesehatan Ibu dan Anak</h1>
            <p>
                Informasi pelayanan kesehatan bagi ibu, bayi, balita,
                anak, remaja, serta kesehatan reproduksi sesuai
                pelayanan yang tersedia di Puskesmas Singaparna.
            </p>
            <a href="{{ url('/') }}" class="btn-kembali">← Kembali ke Beranda</a>
        </div>
    </section>

    <section class="klaster-content">
        <div class="container">
            <div class="klaster-intro">
                <h2>Layanan Kesehatan Ibu dan Anak</h2>
                <p>
                    Pelayanan ini mendukung pemantauan kesehatan ibu dan
                    tumbuh kembang anak melalui pemeriksaan serta edukasi
                    kesehatan sesuai kebutuhan.
                </p>
            </div>

            <div class="klaster-grid">
                <article class="klaster-card">
                    <div class="klaster-icon">🤰</div>
                    <h3>Kesehatan Ibu Hamil</h3>
                    <p>
                        Informasi pemeriksaan kehamilan, pemantauan kondisi
                        ibu, dan edukasi untuk menjaga kesehatan selama
                        masa kehamilan.
                    </p>
                </article>

                <article class="klaster-card">
                    <div class="klaster-icon">👶</div>
                    <h3>Kesehatan Bayi dan Balita</h3>
                    <p>
                        Informasi pemantauan pertumbuhan, perkembangan,
                        imunisasi, dan edukasi kesehatan anak sesuai
                        program pelayanan yang tersedia.
                    </p>
                </article>

                <article class="klaster-card">
                    <div class="klaster-icon">🧒</div>
                    <h3>Kesehatan Anak dan Remaja</h3>
                    <p>
                        Edukasi mengenai pola hidup sehat, pemantauan
                        kesehatan, serta dukungan kesehatan bagi anak
                        dan remaja.
                    </p>
                </article>
            </div>

            <div class="klaster-notice">
                <strong>Informasi pelayanan</strong>
                <p>
                    Jadwal, persyaratan, dan jenis pemeriksaan mengikuti
                    ketentuan Puskesmas Singaparna. Silakan konfirmasi
                    kepada petugas untuk mendapatkan informasi terbaru.
                </p>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/klaster.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">
@endpush