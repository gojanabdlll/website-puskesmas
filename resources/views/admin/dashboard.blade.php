@extends('layouts.admin')


@section('title', 'Dashboard Admin - Puskesmas Singaparna')

@section('page-title', 'Dashboard')


@section('content')

    @php
        $total = \App\Models\Pengaduan::count();

        $menunggu = \App\Models\Pengaduan::where(
            'status',
            'Menunggu'
        )->count();

        $diproses = \App\Models\Pengaduan::where(
            'status',
            'Diproses'
        )->count();

        $selesai = \App\Models\Pengaduan::where(
            'status',
            'Selesai'
        )->count();

        $pengaduanTerbaru = \App\Models\Pengaduan::latest()->take(5)->get();
    @endphp


    {{-- HERO --}}

    <section class="dashboard-welcome">

        <div>

            <span>
                PUSKESMAS SINGAPARNA
            </span>

            <h2>
                Selamat Datang, Admin Puskesmas 👋
            </h2>

            <p>
                Kelola pengaduan masyarakat dan konten
                website Puskesmas melalui dashboard admin.
            </p>

        </div>


        <div class="dashboard-date">

            <small>
                Hari ini
            </small>

            <strong>
                {{ now()->translatedFormat('d F Y') }}
            </strong>

        </div>

    </section>


    {{-- STATISTIK --}}

    <section class="dashboard-stat-grid">


        <div class="dashboard-stat-card">

            <div class="stat-icon total">
                ▣
            </div>

            <div>

                <span>
                    TOTAL PENGADUAN
                </span>

                <strong>
                    {{ $total }}
                </strong>

                <small>
                    Seluruh pengaduan masuk
                </small>

            </div>

        </div>


        <div class="dashboard-stat-card">

            <div class="stat-icon waiting">
                ⏱
            </div>

            <div>

                <span>
                    MENUNGGU
                </span>

                <strong>
                    {{ $menunggu }}
                </strong>

                <small>
                    Perlu ditindaklanjuti
                </small>

            </div>

        </div>


        <div class="dashboard-stat-card">

            <div class="stat-icon process">
                ↻
            </div>

            <div>

                <span>
                    DIPROSES
                </span>

                <strong>
                    {{ $diproses }}
                </strong>

                <small>
                    Sedang ditangani
                </small>

            </div>

        </div>


        <div class="dashboard-stat-card">

            <div class="stat-icon done">
                ✓
            </div>

            <div>

                <span>
                    SELESAI
                </span>

                <strong>
                    {{ $selesai }}
                </strong>

                <small>
                    Telah ditindaklanjuti
                </small>

            </div>

        </div>

    </section>


    {{-- GRID BAWAH --}}

    <section class="dashboard-bottom-grid">


        {{-- PENGADUAN TERBARU --}}

        <div class="dashboard-panel">

            <div class="panel-header">

                <div>

                    <span>
                        MONITORING
                    </span>

                    <h3>
                        Pengaduan Terbaru
                    </h3>

                </div>

                <div class="panel-count">
                    {{ $total }}
                </div>

            </div>


            @if($pengaduanTerbaru->count())

                <div class="complaint-list">

                    @foreach($pengaduanTerbaru as $pengaduan)

                        <div class="complaint-item">

                            <div class="complaint-icon">
                                ✉
                            </div>


                            <div class="complaint-info">

                                <div class="complaint-top">

                                    <strong>
                                        {{ $pengaduan->nomor_tiket }}
                                    </strong>

                                    <span class="status-badge
                                                                            {{ strtolower($pengaduan->status) }}">
                                        {{ $pengaduan->status }}
                                    </span>

                                </div>

                                <p>
                                    {{ $pengaduan->subjek ?? '-' }}
                                </p>

                                <small>
                                    {{ $pengaduan->kategori }}
                                    ·
                                    {{ $pengaduan->created_at?->format('d/m/Y H:i') }}
                                </small>

                            </div>


                            <a href="{{ url('/admin/pengaduan/' . $pengaduan->id) }}" class="complaint-arrow">
                                →
                            </a>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-dashboard">

                    <div>
                        ✓
                    </div>

                    <strong>
                        Belum Ada Pengaduan
                    </strong>

                    <p>
                        Pengaduan masyarakat yang masuk
                        akan muncul di sini.
                    </p>

                </div>

            @endif

        </div>


        {{-- INFORMASI SISTEM --}}

        <div class="dashboard-panel">

            <div class="panel-header">

                <div>

                    <span>
                        INFORMASI
                    </span>

                    <h3>
                        Sistem Pengaduan
                    </h3>

                </div>

            </div>


            <div class="system-status">

                <div class="system-check">
                    ✓
                </div>

                <div>

                    <strong>
                        Sistem Berjalan Normal
                    </strong>

                    <p>
                        Sistem pengaduan Puskesmas Singaparna
                        sedang aktif dan dapat digunakan.
                    </p>

                </div>

            </div>


            <div class="system-step">

                <span>
                    01
                </span>

                <div>

                    <strong>
                        Terima Pengaduan
                    </strong>

                    <p>
                        Periksa laporan masyarakat secara berkala.
                    </p>

                </div>

            </div>


            <div class="system-step">

                <span>
                    02
                </span>

                <div>

                    <strong>
                        Berikan Tanggapan
                    </strong>

                    <p>
                        Berikan respons terhadap pengaduan.
                    </p>

                </div>

            </div>


            <div class="system-step">

                <span>
                    03
                </span>

                <div>

                    <strong>
                        Selesaikan Pengaduan
                    </strong>

                    <p>
                        Perbarui status setelah ditindaklanjuti.
                    </p>

                </div>

            </div>

        </div>

    </section>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">

@endpush