@extends('layouts.app')


@section('title', 'Profil Puskesmas - Puskesmas Singaparna')


@section('content')

    {{-- =====================================================
    HEADER PROFIL
    ====================================================== --}}

    <section class="profil-header">

        <div class="profil-header-overlay">

            <div class="profil-header-content">

                <span class="profil-header-label">
                    PROFIL PUSKESMAS
                </span>

                <h1>
                    {{ $profil->nama_puskesmas ?? 'Puskesmas Singaparna' }}
                </h1>

                <p>
                    Mengenal lebih dekat
                    {{ $profil->nama_puskesmas ?? 'Puskesmas Singaparna' }}
                </p>

            </div>

        </div>

    </section>



    {{-- =====================================================
    TENTANG PUSKESMAS
    ====================================================== --}}

    <section class="profil-content">

        <div class="profil-container">

            <div class="profil-card">

                <span class="section-label">
                    PROFIL
                </span>

                <h2>
                    Tentang
                    {{ $profil->nama_puskesmas ?? 'Puskesmas Singaparna' }}
                </h2>


                {{-- DESKRIPSI DARI DATABASE --}}

                {{-- DESKRIPSI DAN FOTO DI SAMPINGNYA --}}
                <div class="profil-description-layout">

                    <div class="profil-description-text">
                        @if($profil && $profil->deskripsi)
                            {!! nl2br(e($profil->deskripsi)) !!}
                        @else
                            <p>Informasi mengenai Puskesmas belum tersedia.</p>
                        @endif
                    </div>

                    <div class="profil-description-image">
                        @if($profil && $profil->foto_deskripsi)
                            <img src="{{ asset('storage/' . $profil->foto_deskripsi) }}" alt="Foto Puskesmas Singaparna"
                                loading="lazy">
                        @else
                            <div class="profil-image-placeholder">
                                <span>🏥</span>
                                <p>Foto Puskesmas belum diunggah.</p>
                            </div>
                        @endif
                    </div>

                </div>


            </div>

        </div>

    </section>



    {{-- =====================================================
    INFORMASI KONTAK
    ====================================================== --}}

    <section class="profil-info-section">

        <div class="profil-container">

            <div class="profil-section-heading">

                <span>
                    INFORMASI
                </span>

                <h2>
                    Informasi Puskesmas
                </h2>

                <p>
                    Informasi kontak dan alamat
                    {{ $profil->nama_puskesmas ?? 'Puskesmas Singaparna' }}.
                </p>

            </div>


            <div class="profil-info-grid">


                {{-- ALAMAT --}}

                <div class="profil-info-card">

                    <div class="profil-info-icon">
                        📍
                    </div>

                    <div>

                        <span>
                            ALAMAT
                        </span>

                        <h3>
                            Alamat Puskesmas
                        </h3>

                        <p>
                            {{ $profil->alamat ?? 'Alamat belum tersedia.' }}
                        </p>

                    </div>

                </div>



                {{-- TELEPON --}}

                <div class="profil-info-card">

                    <div class="profil-info-icon">
                        ☎
                    </div>

                    <div>

                        <span>
                            TELEPON
                        </span>

                        <h3>
                            Nomor Telepon
                        </h3>

                        <p>
                            {{ $profil->telepon ?? 'Nomor telepon belum tersedia.' }}
                        </p>

                    </div>

                </div>



                {{-- EMAIL --}}

                <div class="profil-info-card">

                    <div class="profil-info-icon">
                        ✉
                    </div>

                    <div>

                        <span>
                            EMAIL
                        </span>

                        <h3>
                            Email
                        </h3>

                        <p>
                            {{ $profil->email ?? 'Email belum tersedia.' }}
                        </p>

                    </div>

                </div>



                {{-- JAM PELAYANAN --}}

                <div class="profil-info-card">

                    <div class="profil-info-icon">
                        🕐
                    </div>

                    <div>

                        <span>
                            JAM PELAYANAN
                        </span>

                        <h3>
                            Jam Pelayanan
                        </h3>

                        <p class="profil-preline">
                            {{ $profil->jam_pelayanan ?? 'Jam pelayanan belum tersedia.' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- =====================================================
    FOTO PUSKESMAS
    ====================================================== --}}

    <section class="profil-photo-section">

        <div class="profil-container">

            <div class="profil-photo-card">

                <div class="profil-photo-content">

                    <span>
                        FOTO PUSKESMAS
                    </span>

                    <h2>
                        {{ $profil->nama_puskesmas ?? 'Puskesmas Singaparna' }}
                    </h2>

                    <p>
                        Informasi dan dokumentasi
                        Puskesmas.
                    </p>

                </div>


                <div class="profil-photo">

                    @if($profil && $profil->foto)

                        <img src="{{ asset('storage/' . $profil->foto) }}" alt="{{ $profil->nama_puskesmas }}">

                    @else

                        <img src="{{ asset('image/puskesmas-singaparna.jpg') }}" alt="Puskesmas Singaparna">

                    @endif

                </div>

            </div>

        </div>

    </section>

    {{-- =====================================================
    VISI & MISI
    ====================================================== --}}

    <section class="profil-visi-misi">

        <div class="profil-container">

            <div class="profil-section-heading">

                <span>
                    VISI & MISI
                </span>

                <h2>
                    Arah dan Tujuan Puskesmas
                </h2>

                <p>
                    Visi dan misi yang dikelola melalui
                    halaman administrasi.
                </p>

            </div>


            <div class="visi-misi-grid">


                {{-- VISI --}}

                <div class="visi-card">

                    <div class="visi-icon">
                        👁
                    </div>

                    <span>
                        VISI
                    </span>

                    <h3>
                        Visi
                    </h3>

                    <p class="profil-preline">

                        @if($profil && $profil->visi)

                            {{ $profil->visi }}

                        @else

                            Visi Puskesmas belum tersedia.

                        @endif

                    </p>

                </div>



                {{-- MISI --}}

                <div class="misi-card">

                    <div class="misi-icon">
                        🎯
                    </div>

                    <span>
                        MISI
                    </span>

                    <h3>
                        Misi
                    </h3>

                    <p class="profil-preline">

                        @if($profil && $profil->misi)

                            {{ $profil->misi }}

                        @else

                            Misi Puskesmas belum tersedia.

                        @endif

                    </p>

                </div>

            </div>

        </div>

    </section>

@endsection



@push('styles')

    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">

    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">

@endpush