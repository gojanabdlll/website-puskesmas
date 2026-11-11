@extends('layouts.app')

@section('title', 'Pengumuman - Puskesmas Singaparna')

@section('content')

    {{-- HEADER --}}
    <section class="jadwal-page-header">
        <div class="jadwal-page-header-content">

            <span class="jadwal-header-label">
                INFORMASI
            </span>

            <h1>Pengumuman Puskesmas</h1>

            <p>
                Informasi dan pengumuman resmi Puskesmas Singaparna
                untuk masyarakat.
            </p>

        </div>
    </section>

    {{-- DAFTAR PENGUMUMAN DARI DATABASE --}}
    <section class="informasi-page">

        <div class="informasi-page-title">
            <span>PENGUMUMAN</span>

            <h2>Pengumuman Puskesmas</h2>

            <p>
                Informasi dan pengumuman terbaru Puskesmas Singaparna.
            </p>
        </div>

        <div class="pengumuman-container">

            @forelse($pengumuman as $item)

                <article class="pengumuman-card">

                    {{-- FOTO PENGUMUMAN --}}
                    <div class="pengumuman-foto">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}">
                        @else
                            <div class="pengumuman-icon">
                                📢
                            </div>
                        @endif
                    </div>

                    {{-- INFORMASI PENGUMUMAN --}}
                    <small class="pengumuman-label">
                        PENGUMUMAN
                    </small>

                    <h3>{{ $item->judul }}</h3>

                    @if($item->tanggal)
                        <p class="pengumuman-meta">
                            {{ $item->tanggal->format('d M Y') }}
                            @if($item->penulis)
                                &bull; {{ $item->penulis }}
                            @endif
                        </p>
                    @endif

                    @if($item->ringkasan)
                        <p>
                            {{ $item->ringkasan }}
                        </p>
                    @else
                            <p>
                                {{ \Illuminate\Support\Str::limit(
                            strip_tags($item->isi),
                            150
                        ) }}
                            </p>
                    @endif

                    {{-- ISI LENGKAP --}}
                    <details class="pengumuman-detail">
                        <summary>Baca Selengkapnya →</summary>

                        <div class="pengumuman-isi">
                            {!! nl2br(e($item->isi)) !!}
                        </div>
                    </details>

                </article>

            @empty

                <div class="pengumuman-kosong">
                    <div class="pengumuman-icon">📢</div>

                    <h3>Belum Ada Pengumuman</h3>

                    <p>
                        Pengumuman terbaru akan ditampilkan di halaman ini.
                    </p>
                </div>

            @endforelse

        </div>

    </section>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/informasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">

    <style>
        .pengumuman-foto {
            width: 100%;
            height: 190px;
            margin-bottom: 18px;
            overflow: hidden;
            border-radius: 12px;
            background: #e8f5f3;
        }

        .pengumuman-foto img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .pengumuman-label {
            display: inline-block;
            margin-bottom: 10px;
            color: #009688;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .pengumuman-meta {
            color: #64748b;
            font-size: 13px;
        }

        .pengumuman-detail {
            margin-top: 16px;
            color: #008f83;
        }

        .pengumuman-detail summary {
            cursor: pointer;
            font-weight: 600;
        }

        .pengumuman-isi {
            margin-top: 12px;
            color: #475569;
            line-height: 1.8;
            overflow-wrap: anywhere;
        }

        .pengumuman-kosong {
            grid-column: 1 / -1;
            padding: 35px 20px;
            text-align: center;
            background: white;
            border-radius: 16px;
        }

        .pengumuman-kosong .pengumuman-icon {
            font-size: 32px;
            margin-bottom: 12px;
        }
    </style>
@endpush