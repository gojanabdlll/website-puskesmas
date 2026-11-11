@extends('layouts.app')


@section('title', 'Visi & Misi - Puskesmas Singaparna')


@section('content')

    <section class="profil-header">

        <div class="profil-header-overlay">

            <div class="profil-header-content">

                <h1>
                    Visi & Misi
                </h1>

                <p>
                    Visi dan misi Puskesmas Singaparna
                </p>

            </div>

        </div>

    </section>


    <section class="profil-content">

        <div class="visi-misi-grid">


            {{-- VISI --}}
            <div class="visi-misi-card">

                <div class="visi-misi-icon">
                    V
                </div>

                <p>
                    {{ $profil->visi ?? '-' }}
                </p>

            </div>


            {{-- MISI --}}
            <div class="visi-misi-card">

                <div class="visi-misi-icon">
                    M
                </div>

                <p style="white-space: pre-line;">
                    {{ $profil->misi ?? '-' }}
                </p>

            </div>


        </div>

    </section>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/visi-misi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">

@endpush