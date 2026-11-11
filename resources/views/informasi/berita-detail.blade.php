@extends('layouts.app')

@section('title', $berita->judul . ' - Puskesmas Singaparna')

@section('content')

    <section class="page-header">

        <div class="page-header-content">

            <span>BERITA</span>

            <h1>Berita Puskesmas Singaparna</h1>

            <p>Informasi terbaru Puskesmas Singaparna</p>

        </div>

    </section>


    <section class="detail-page">

        <div class="detail-container berita-detail-container">

            <div class="detail-title">

                <span>BERITA PUSKESMAS</span>

                <h2>
                    {{ $berita->judul }}
                </h2>

                <p>
                    {{ $berita->tanggal?->format('d F Y') }}

                    @if($berita->penulis)
                        • {{ $berita->penulis }}
                    @endif
                </p>

            </div>


            {{-- FOTO --}}

            @if($berita->foto)

                <div class="berita-detail-image">

                    <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}">

                </div>

            @endif


            {{-- RINGKASAN --}}

            @if($berita->ringkasan)

                <div class="berita-detail-summary">

                    {{ $berita->ringkasan }}

                </div>

            @endif


            {{-- ISI --}}

            <div class="berita-detail-content">

                {!! nl2br(e($berita->isi)) !!}

            </div>


            {{-- KEMBALI --}}

            <div class="berita-detail-back">

                <a href="{{ route('informasi.berita') }}" class="berita-link">
                    ← Kembali ke Berita
                </a>

            </div>

        </div>

    </section>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/informasi.css') }}">

    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">

@endpush
