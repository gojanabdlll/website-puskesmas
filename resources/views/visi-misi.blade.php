@extends('layouts.app')

@section('title', 'Visi & Misi - Puskesmas Singaparna')

@section('content')

    {{-- HEADER --}}
    <section class="page-header">

        <div class="page-header-content">

            <span>PROFIL PUSKESMAS</span>

            <h1>
                Visi & Misi
            </h1>

            <p>
                {{ $profil->nama_puskesmas ?? 'Puskesmas Singaparna' }}
            </p>

        </div>

    </section>


    {{-- VISI & MISI --}}
    <section class="detail-page">

        <div class="detail-container">

            <div class="detail-title">

                <span>
                    VISI & MISI
                </span>

                <h2>
                    Visi dan Misi
                    {{ $profil->nama_puskesmas ?? 'Puskesmas Singaparna' }}
                </h2>

                <p>
                    Informasi mengenai visi dan misi
                    Puskesmas yang dikelola secara langsung
                    melalui sistem administrasi.
                </p>

            </div>


            <div class="visi-misi-grid">

                {{-- ========================= --}}
                {{-- VISI --}}
                {{-- ========================= --}}

                <div class="visi-card">

                    <div class="detail-icon">
                        V
                    </div>

                    <h3>
                        Visi
                    </h3>

                    <p>
                        {{ $profil->visi ?? 'Visi Puskesmas belum tersedia.' }}
                    </p>

                </div>


                {{-- ========================= --}}
                {{-- MISI --}}
                {{-- ========================= --}}

                <div class="misi-card">

                    <div class="detail-icon">
                        M
                    </div>

                    <h3>
                        Misi
                    </h3>

                    @if(!empty($profil->misi))

                        <div class="misi-content">
                            {!! nl2br(e($profil->misi)) !!}
                        </div>

                    @else

                        <p>
                            Misi Puskesmas belum tersedia.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </section>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/visi-misi.css') }}">

    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">

@endpush