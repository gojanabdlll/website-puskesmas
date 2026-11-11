@extends('layouts.app')

@section('title', 'Struktur Organisasi - Puskesmas Singaparna')

@section('content')

    <section class="page-header">
        <div class="page-header-content">
            <span>ORGANISASI</span>
            <h1>Struktur Organisasi</h1>
            <p>Struktur organisasi Puskesmas Singaparna</p>
        </div>
    </section>

    <section class="detail-page">
        <div class="detail-container">

            <div class="detail-title">
                <span>STRUKTUR ORGANISASI</span>
                <h2>Struktur Organisasi Puskesmas Singaparna</h2>
                <p>
                    Susunan pimpinan dan personel Puskesmas
                    Singaparna beserta jabatan masing-masing.
                </p>
            </div>

            @if(isset($struktur) && $struktur->count() > 0)

                @php
                    $personel = $struktur->values();
                @endphp

                <div class="struktur-lapangan">
                    <div class="struktur-pitch">

                        {{-- GARIS LAPANGAN --}}
                        <div class="pitch-center-line"></div>
                        <div class="pitch-center-circle"></div>
                        <div class="pitch-center-spot"></div>

                        <div class="pitch-top-box">
                            <div class="pitch-top-box-inner"></div>
                        </div>

                        <div class="pitch-bottom-box">
                            <div class="pitch-bottom-box-inner"></div>
                        </div>

                        {{-- FORMASI 1 --}}
                        <div class="formasi-row formasi-pimpinan">
                            @if(isset($personel[0]))
                                @php $item = $personel[0]; @endphp

                                <div class="struktur-personel">
                                    <div class="struktur-personel-foto">
                                        @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}">
                                        @else
                                            <span>👤</span>
                                        @endif
                                    </div>

                                    <div class="struktur-personel-info">
                                        <span class="struktur-personel-jabatan">
                                            {{ $item->jabatan }}
                                        </span>
                                        <strong class="struktur-personel-nama">
                                            {{ $item->nama }}
                                        </strong>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- FORMASI 4 --}}
                        <div class="formasi-row formasi-empat">
                            @foreach($personel->slice(1, 4) as $item)
                                <div class="struktur-personel">
                                    <div class="struktur-personel-foto">
                                        @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}">
                                        @else
                                            <span>👤</span>
                                        @endif
                                    </div>

                                    <div class="struktur-personel-info">
                                        <span class="struktur-personel-jabatan">
                                            {{ $item->jabatan }}
                                        </span>
                                        <strong class="struktur-personel-nama">
                                            {{ $item->nama }}
                                        </strong>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- FORMASI 6 --}}
                        <div class="formasi-row formasi-enam">
                            @foreach($personel->slice(5, 6) as $item)
                                <div class="struktur-personel">
                                    <div class="struktur-personel-foto">
                                        @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}">
                                        @else
                                            <span>👤</span>
                                        @endif
                                    </div>

                                    <div class="struktur-personel-info">
                                        <span class="struktur-personel-jabatan">
                                            {{ $item->jabatan }}
                                        </span>
                                        <strong class="struktur-personel-nama">
                                            {{ $item->nama }}
                                        </strong>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="struktur-lapangan-footer">
                        <span>UPTD PUSKESMAS SINGAPARNA</span>
                        <span>STRUKTUR ORGANISASI</span>
                    </div>

                </div>

                {{-- PERSONEL KE-12 DAN SETERUSNYA --}}
                @if($personel->count() > 11)
                    <div class="struktur-data-tambahan">
                        <h3>Personel Lainnya</h3>

                        <div class="struktur-tambahan-grid">
                            @foreach($personel->slice(11) as $item)
                                <div class="struktur-tambahan-card">
                                    <div class="struktur-tambahan-foto">
                                        @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}">
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