@extends('layouts.app')

@section('title', 'Promkes - Puskesmas Singaparna')

@section('content')

    {{-- =========================================
    HEADER HALAMAN
    ========================================== --}}
    {{-- HEADER HALAMAN PROMKES --}}
    <section class="promkes-page-header">
        <div class="promkes-page-header-content">
            <span class="promkes-header-label">PROMOSI KESEHATAN</span>
            <h1>Promkes</h1>
            <p>Informasi dan edukasi kesehatan untuk masyarakat.</p>
        </div>
    </section>


    {{-- =========================================
    INTRO PROMKES
    ========================================== --}}
    <section class="promkes-page">

        <div class="promkes-container">

            <div class="promkes-intro">

                <span class="promkes-label">
                    PROMOSI KESEHATAN
                </span>

                <h2>
                    Edukasi Kesehatan untuk Masyarakat
                </h2>

                <p>
                    Promosi kesehatan merupakan bagian dari upaya
                    Puskesmas dalam memberikan informasi dan edukasi
                    kepada masyarakat untuk meningkatkan kesadaran,
                    pengetahuan, dan perilaku hidup sehat.
                </p>

            </div>


            {{-- =========================================
            KARTU EDUKASI
            ========================================== --}}
            <div class="promkes-grid">

                @forelse ($promkes as $item)

                    <article class="promkes-card">

                        @if ($item->foto)
                            <div class="promkes-image">
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" loading="lazy">
                            </div>
                        @else
                            <div class="promkes-icon">🩺</div>
                        @endif

                        <div class="promkes-content">

                            <span>EDUKASI KESEHATAN</span>

                            <h3>{{ $item->judul }}</h3>

                            @if ($item->tanggal)
                                <small class="promkes-date">
                                    {{ \Illuminate\Support\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                </small>
                            @endif

                            <p>
                                {{ $item->ringkasan ?: \Illuminate\Support\Str::limit(strip_tags($item->isi), 180) }}
                            </p>

                            @if ($item->penulis)
                                <small class="promkes-author">
                                    Penulis: {{ $item->penulis }}
                                </small>
                            @endif

                        </div>

                    </article>

                @empty

                    <div class="promkes-empty">
                        <div class="promkes-icon">🩺</div>
                        <h3>Belum Ada Konten Promkes</h3>
                        <p>
                            Informasi dan edukasi kesehatan akan ditampilkan
                            di halaman ini setelah tersedia.
                        </p>
                    </div>

                @endforelse

            </div>

            {{-- =========================================
            BAGIAN AJAKAN
            ========================================== --}}
            <div class="promkes-callout">

                <div class="callout-icon">
                    ❤️
                </div>

                <div class="callout-content">

                    <span>
                        HIDUP SEHAT
                    </span>

                    <h2>
                        Bersama Membangun Masyarakat yang Sehat
                    </h2>

                    <p>
                        Mari mulai menerapkan pola hidup sehat dari
                        diri sendiri, keluarga, dan lingkungan sekitar.
                        Kesehatan merupakan investasi untuk kehidupan
                        yang lebih baik.
                    </p>

                </div>

            </div>

        </div>

    </section>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/promkes.css') }}">

    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">

    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">

@endpush

