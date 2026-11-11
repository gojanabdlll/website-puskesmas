@extends('layouts.app')

@section('title', 'Struktur Organisasi - Puskesmas Singaparna')

@section('content')

    {{-- HEADER HALAMAN --}}
    <section class="page-header">
        <div class="page-header-content">
            <span>ORGANISASI</span>
            <h1>Struktur Organisasi</h1>
            <p>Struktur organisasi Puskesmas Singaparna</p>
        </div>
    </section>

    {{-- KONTEN STRUKTUR ORGANISASI --}}
    <section class="detail-page">
        <div class="detail-container">

            {{-- JUDUL --}}
            <div class="detail-title">
                <span>STRUKTUR ORGANISASI</span>
                <h2>Struktur Organisasi Puskesmas Singaparna</h2>
                <p>
                    Susunan pimpinan dan personel Puskesmas
                    Singaparna beserta jabatan masing-masing.
                </p>
            </div>

            @if(isset($struktur) && $struktur->count() > 0)

                {{-- LAPANGAN FORMASI --}}
                <div class="struktur-lapangan">


                    <div class="struktur-pitch">

                        {{-- GARIS LAPANGAN --}}
                        <div class="pitch-center-circle"></div>
                        <div class="pitch-center-line"></div>
                        <div class="pitch-center-spot"></div>

                        <div class="pitch-top-box">
                            <div class="pitch-top-box-inner"></div>
                        </div>

                        <div class="pitch-bottom-box">
                            <div class="pitch-bottom-box-inner"></div>
                        </div>

                        {{-- FORMASI DINAMIS --}}
                        <div class="struktur-formasi">

                            @foreach($struktur->take(11)->values() as $index => $item)

                                @if($index === 0)
                                    {{-- BARIS 1: PIMPINAN --}}
                                    <div class="formasi-row formasi-pimpinan">
                                        @include('profil.partials.kartu-struktur', [
                                            'item' => $item,
                                            'index' => $index,
                                            'label' => 'PIMPINAN'
                                        ])
                                    </div>

                                @elseif($index === 1)
                                    {{-- BARIS 2: 4 PERSONEL --}}
                                    <div class="formasi-row formasi-empat">
                                        @include('profil.partials.kartu-struktur', [
                                            'item' => $item,
                                            'index' => $index,
                                            'label' => 'PERSONEL'
                                        ])

                                @elseif($index === 5)
                                        </div>

                                        {{-- BARIS 3: 6 PERSONEL --}}
                                        <div class="formasi-row formasi-enam">
                                            @include('profil.partials.kartu-struktur', [
                                                'item' => $item,
                                                'index' => $index,
                                                'label' => 'PERSONEL'
                                            ])

                                    @else
                                        @include('profil.partials.kartu-struktur', [
                                            'item' => $item,
                                            'index' => $index,
                                            'label' => 'PERSONEL'
                                        ])
                                    @endif

                            @endforeach

                                {{-- Tutup baris 4 personel bila hanya 2-5 data --}}
                                @if($struktur->count() > 1 && $struktur->count() < 6)
                                    </div>
                                @endif

                        </div>
                    </div>

                    <div class="struktur-lapangan-footer">
                        <span>UPTD PUSKESMAS SINGAPARNA</span>
                        <span>STRUKTUR ORGANISASI</span>
                    </div>

                </div>

                {{-- DATA TAMBAHAN JIKA LEBIH DARI 11 --}}
                @if($struktur->count() > 11)
                    <div class="struktur-data-tambahan">
                        <h3>Personel Lainnya</h3>

                        <div class="struktur-tambahan-grid">
                            @foreach($struktur->skip(11) as $item)
                                <div class="struktur-tambahan-card">
                                    <div class="struktur-tambahan-foto">
                                        @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" loading="lazy">
                                        @else
                                            <span>👤</span>
                                        @endif
                                    </div>

                                    <div>
                                        <span>{{ $item->jabatan }}</span>
                                        <strong>{{ $item->nama }}</strong>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            @else

                <div class="struktur-empty">
                    <div class="struktur-empty-icon">👥</div>
                    <h3>Data Struktur Belum Tersedia</h3>
                    <p>
                        Data struktur organisasi Puskesmas Singaparna
                        belum ditambahkan melalui halaman administrasi.
                    </p>
                </div>

            @endif

        </div>
    </section>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/struktur.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">
@endpush