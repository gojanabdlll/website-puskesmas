@extends('layouts.app')

@section('title', 'Jadwal Pelayanan - Puskesmas Singaparna')

@section('content')

    {{-- HEADER HALAMAN --}}
    {{-- HEADER HALAMAN JADWAL --}}
    <section class="jadwal-page-header">
        <div class="jadwal-page-header-content">

            <span class="jadwal-header-label">
                INFORMASI
            </span>

            <h1>Jadwal Pelayanan</h1>

            <p>
                Informasi jadwal pelayanan Puskesmas Singaparna
                untuk membantu masyarakat merencanakan kunjungan.
            </p>

        </div>
    </section>

    {{-- ISI JADWAL --}}
    <section class="informasi-page">

        <div class="informasi-page-title">
            <span>JADWAL PELAYANAN</span>
            <h2>Jadwal Pelayanan Puskesmas</h2>
            <p>
                Informasi mengenai jadwal pelayanan
                Puskesmas Singaparna.
            </p>
        </div>

        <div class="jadwal-container">

            @forelse ($jadwalPelayanan as $item)

                <div class="jadwal-card">

                    <div class="jadwal-icon">
                        📅
                    </div>

                    <span class="jadwal-label">
                        HARI KERJA
                    </span>

                    <h3>
                        {{ $item->nama_layanan }}
                    </h3>

                    <div class="jadwal-time">
                        <strong>
                            {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H.i') }}
                            -
                            {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H.i') }}
                        </strong>
                    </div>

                    <p>
                        {{ $item->keterangan ?: 'Pelayanan kesehatan Puskesmas Singaparna.' }}
                    </p>

                </div>

            @empty

                <div class="jadwal-kosong">
                    <div class="jadwal-icon">📅</div>
                    <h3>Jadwal Belum Tersedia</h3>
                    <p>
                        Mohon maaf, informasi jadwal pelayanan
                        belum tersedia saat ini.
                    </p>
                </div>

            @endforelse

        </div>

    </section>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/informasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">
@endpush