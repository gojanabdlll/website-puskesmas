@extends('layouts.app')

@section('title', 'Berita - Puskesmas Singaparna')

@section('content')

    {{-- HEADER BERITA --}}
    <section class="berita-page-header">
        <div class="berita-page-header-content">
            <span class="berita-header-label">INFORMASI</span>

            <h1>Berita Puskesmas</h1>

            <p>
                Berita dan kegiatan terbaru Puskesmas Singaparna.
            </p>
        </div>
    </section>

    {{-- DAFTAR BERITA --}}
    <section class="detail-page berita-page">
        <div class="detail-container">

            {{-- JUDUL BAGIAN --}}
            <div class="detail-title">
                <span>BERITA TERKINI</span>

                <h2>Berita Terbaru Puskesmas Singaparna</h2>

                <p>
                    Informasi mengenai kegiatan, pelayanan, dan berbagai
                    informasi terbaru Puskesmas Singaparna.
                </p>
            </div>

            {{-- GRID BERITA --}}
            <div class="berita-grid">

                @forelse ($berita as $item)
                    <article class="berita-card">

                        {{-- FOTO BERITA --}}
                        <div class="berita-image">
                            @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" loading="lazy">
                            @else
                                <img src="{{ asset('image/puskesmas-singaparna.jpg') }}" alt="Puskesmas Singaparna" loading="lazy">
                            @endif
                        </div>

                        {{-- KONTEN BERITA --}}
                        <div class="berita-content">

                            <div class="berita-meta">
                                @if ($item->tanggal)
                                    <span>
                                        {{ $item->tanggal->format('d M Y') }}
                                    </span>
                                @endif

                                @if ($item->penulis)
                                    <span class="berita-penulis">
                                        {{ $item->penulis }}
                                    </span>
                                @endif
                            </div>

                            <h3>{{ $item->judul }}</h3>

                            @if ($item->ringkasan)
                                <p>{{ $item->ringkasan }}</p>
                            @endif

                            <a href="{{ route('berita.show', $item) }}" class="berita-link">
                                Baca Selengkapnya
                                <span aria-hidden="true">→</span>
                            </a>

                        </div>
                    </article>

                @empty
                    <div class="berita-empty">
                        <div class="berita-empty-icon">📰</div>
                        <h3>Belum Ada Berita</h3>
                        <p>
                            Berita terbaru akan ditampilkan di halaman ini
                            setelah tersedia.
                        </p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/informasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">
@endpush