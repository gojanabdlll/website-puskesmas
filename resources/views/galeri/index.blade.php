@extends('layouts.app')

@section('title', 'Galeri - Puskesmas Singaparna')

@section('content')

    <section class="galeri-hero">
        <div class="galeri-hero-content">
            <span>DOKUMENTASI KEGIATAN</span>
            <h1>Galeri Puskesmas Singaparna</h1>
            <p>
                Dokumentasi kegiatan, pelayanan kesehatan, dan aktivitas
                bersama masyarakat Puskesmas Singaparna.
            </p>
        </div>
    </section>

    <section class="galeri-public-section">
        <div class="galeri-public-container">

            <div class="galeri-public-heading">
                <span>GALERI KEGIATAN</span>
                <h2>Momen Kegiatan Kami</h2>
                <p>
                    Lihat berbagai kegiatan dan pelayanan yang telah
                    dilaksanakan oleh Puskesmas Singaparna.
                </p>
            </div>

            @if($galeri->count())
                <div class="galeri-public-grid">
                    @foreach($galeri as $item)
                        <article class="galeri-public-card">
                            <a class="galeri-public-image" href="{{ asset('storage/' . $item->foto) }}" target="_blank"
                                rel="noopener noreferrer" aria-label="Lihat foto {{ $item->judul }}">
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" loading="lazy">
                                <span class="galeri-image-overlay">
                                    Lihat Foto ↗
                                </span>
                            </a>

                            <div class="galeri-public-info">
                                @if($item->tanggal)
                                    <span class="galeri-public-date">
                                        <span aria-hidden="true">📅</span>
                                        {{ $item->tanggal->format('d M Y') }}
                                    </span>
                                @endif

                                <h3>{{ $item->judul }}</h3>

                                @if($item->deskripsi)
                                    <p>{{ $item->deskripsi }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="galeri-public-empty">
                    <div class="galeri-public-empty-icon">🖼️</div>
                    <h3>Galeri Sedang Dipersiapkan</h3>
                    <p>
                        Dokumentasi kegiatan Puskesmas Singaparna akan
                        ditampilkan di halaman ini.
                    </p>
                </div>
            @endif

        </div>
    </section>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/galeri.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">

@endpush