@extends('layouts.app')

@section('title', 'Wilayah Kerja - Puskesmas Singaparna')

@section('content')

    {{-- HEADER --}}
    <section class="page-header">

        <div class="page-header-content">

            <span>WILAYAH KERJA</span>

            <h1>
                Wilayah Kerja
            </h1>

            <p>
                Wilayah kerja Puskesmas Singaparna
            </p>

        </div>

    </section>


    {{-- KONTEN --}}
    <section class="detail-page">

        <div class="detail-container">


            <div class="detail-title">

                <span>
                    WILAYAH KERJA
                </span>

                <h2>
                    Wilayah Kerja Puskesmas Singaparna
                </h2>

                <p>
                    Informasi mengenai wilayah kerja
                    Puskesmas Singaparna.
                </p>

            </div>


            @if($wilayah->count() > 0)

                <div class="wilayah-public-grid">

                    @foreach($wilayah as $item)

                        <div class="wilayah-public-card">

                            <div class="wilayah-number">
                                {{ sprintf('%02d', $loop->iteration) }}
                            </div>


                            <div class="wilayah-public-content">

                                <span>
                                    Kecamatan
                                </span>

                                <h3>
                                    {{ $item->kecamatan }}
                                </h3>

                                <p class="wilayah-desa">
                                    Desa / Kelurahan:
                                    <strong>
                                        {{ $item->desa_kelurahan }}
                                    </strong>
                                </p>


                                @if($item->jumlah_penduduk)

                                    <div class="wilayah-info">

                                        <span>
                                            👥 Jumlah Penduduk
                                        </span>

                                        <strong>
                                            {{ number_format($item->jumlah_penduduk, 0, ',', '.') }}
                                            jiwa
                                        </strong>

                                    </div>

                                @endif


                                @if($item->luas_wilayah)

                                    <div class="wilayah-info">

                                        <span>
                                            📍 Luas Wilayah
                                        </span>

                                        <strong>
                                            {{ $item->luas_wilayah }}
                                        </strong>

                                    </div>

                                @endif


                                @if($item->keterangan)

                                    <p class="wilayah-keterangan">
                                        {{ $item->keterangan }}
                                    </p>

                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="struktur-empty">

                    <div class="struktur-empty-icon">
                        📍
                    </div>

                    <h3>
                        Data Wilayah Belum Tersedia
                    </h3>

                    <p>
                        Informasi wilayah kerja Puskesmas
                        Singaparna belum ditambahkan.
                    </p>

                </div>

            @endif


        </div>

    </section>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/wilayah-kerja.css') }}">

    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">

@endpush