@extends('layouts.app')

@section('title', 'Klaster 1 — Manajemen dan Pendaftaran')

@section('content')
    <section class="klaster-header">
        <div class="container">
            <span class="klaster-label">PELAYANAN PUSKESMAS</span>
            <h1>Manajemen dan Pendaftaran</h1>
            <p>
                Informasi manajemen pelayanan dan alur pendaftaran
                pasien di Puskesmas Singaparna.
            </p>
            <a href="{{ url('/') }}" class="btn-kembali">
                ← Kembali ke Beranda
            </a>
        </div>
    </section>

    <section class="klaster-content">
        <div class="container">
            <div class="klaster-intro">
                <h2>Manajemen dan Pendaftaran</h2>
                <p>
                    Halaman ini menyediakan informasi awal bagi pengunjung
                    yang akan mengakses pelayanan kesehatan di Puskesmas
                    Singaparna.
                </p>
            </div>

            <div class="klaster-grid">
                <article class="klaster-card">
                    <div class="klaster-icon">📋</div>
                    <h3>Pendaftaran Pasien</h3>
                    <p>
                        Informasi mengenai proses pendaftaran pasien
                        sebelum mendapatkan pelayanan kesehatan.
                    </p>
                </article>

                <article class="klaster-card">
                    <div class="klaster-icon">🪪</div>
                    <h3>Persiapan Dokumen</h3>
                    <p>
                        Siapkan identitas dan dokumen yang diperlukan
                        sesuai ketentuan pendaftaran yang berlaku.
                    </p>
                </article>

                <article class="klaster-card">
                    <div class="klaster-icon">ℹ️</div>
                    <h3>Informasi Pelayanan</h3>
                    <p>
                        Pengunjung dapat mencari informasi mengenai alur
                        pelayanan melalui petugas pendaftaran.
                    </p>
                </article>
            </div>

            <div class="klaster-notice">
                <strong>Informasi penting</strong>
                <p>
                    Persyaratan dan alur pendaftaran dapat berbeda sesuai
                    jenis pelayanan. Silakan konfirmasi kepada petugas
                    Puskesmas Singaparna untuk informasi resmi.
                </p>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/klaster.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">
@endpush