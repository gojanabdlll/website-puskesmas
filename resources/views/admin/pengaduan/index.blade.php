@extends('layouts.admin')

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Pengaduan Masyarakat - Admin
    </title>

    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin-pengaduan.css') }}">

</head>


<body>


    <div class="admin-layout">


        {{-- SIDEBAR --}}

        <aside class="admin-sidebar">

            <div class="sidebar-brand">

                <img src="{{ asset('image/logo-puskesmas.png') }}" alt="Logo Puskesmas">

                <div>

                    <strong>
                        PUSKESMAS
                    </strong>

                    <span>
                        SINGAPARNA
                    </span>

                </div>

            </div>


            <nav class="sidebar-menu">


                <div class="menu-label">
                    MENU UTAMA
                </div>


                <a href="{{ route('admin.dashboard') }}" class="sidebar-link">

                    <span class="menu-icon">
                        ▦
                    </span>

                    <span>
                        Dashboard
                    </span>

                </a>


                <a href="{{ route('admin.pengaduan.index') }}" class="sidebar-link active">

                    <span class="menu-icon">
                        ✉
                    </span>

                    <span>
                        Pengaduan
                    </span>

                </a>


                <div class="menu-label menu-label-space">
                    SISTEM
                </div>


                <a href="{{ url('/') }}" target="_blank" class="sidebar-link">

                    <span class="menu-icon">
                        ↗
                    </span>

                    <span>
                        Lihat Website
                    </span>

                </a>


                <form action="{{ route('logout') }}" method="POST" class="logout-form">

                    @csrf

                    <button type="submit" class="sidebar-link logout-button">

                        <span class="menu-icon">
                            ↪
                        </span>

                        <span>
                            Logout
                        </span>

                    </button>

                </form>

            </nav>


            <div class="sidebar-footer">

                <div class="sidebar-status-dot"></div>

                <div>

                    <strong>
                        Sistem Online
                    </strong>

                    <span>
                        Puskesmas Singaparna
                    </span>

                </div>

            </div>

        </aside>



        {{-- MAIN --}}

        <main class="admin-main">


            {{-- TOPBAR --}}

            <header class="admin-topbar">

                <div class="topbar-left">

                    <a href="{{ route('admin.dashboard') }}" class="back-button">
                        ←
                    </a>

                    <div>

                        <span class="topbar-small">
                            ADMINISTRATOR
                        </span>

                        <h1>
                            Pengaduan Masyarakat
                        </h1>

                    </div>

                </div>


                <div class="admin-profile">

                    <div class="profile-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="profile-info">

                        <strong>
                            {{ Auth::user()->name }}
                        </strong>

                        <span>
                            Administrator
                        </span>

                    </div>

                </div>

            </header>



            {{-- CONTENT --}}

            <div class="dashboard-content">


                <section class="page-intro">

                    <div>

                        <span>
                            PENGELOLAAN PENGADUAN
                        </span>

                        <h2>
                            Pengaduan Masyarakat
                        </h2>

                        <p>
                            Kelola laporan, status, dan tanggapan
                            masyarakat Puskesmas Singaparna.
                        </p>

                    </div>

                    <div class="total-box">

                        <strong>
                            {{ $pengaduans->count() }}
                        </strong>

                        <span>
                            Total Pengaduan
                        </span>

                    </div>

                </section>



                {{-- TABLE --}}

                <section class="admin-table-card">


                    <div class="table-header">

                        <div>

                            <span>
                                DATA LAPORAN
                            </span>

                            <h3>
                                Daftar Pengaduan
                            </h3>

                        </div>

                    </div>


                    @if($pengaduans->count() > 0)


                        <div class="table-wrapper">

                            <table>

                                <thead>

                                    <tr>

                                        <th>
                                            No Tiket
                                        </th>

                                        <th>
                                            Kategori
                                        </th>

                                        <th>
                                            Subjek
                                        </th>

                                        <th>
                                            Tanggal
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th>
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach($pengaduans as $pengaduan)

                                                                <tr>


                                                                    <td>

                                                                        <strong class="ticket-number">
                                                                            {{ $pengaduan->nomor_tiket }}
                                                                        </strong>

                                                                    </td>


                                                                    <td>
                                                                        {{ $pengaduan->kategori ?? '-' }}
                                                                    </td>


                                                                    <td>

                                                                        <span class="subject-text">
                                                                            {{ $pengaduan->subjek ?? '-' }}
                                                                        </span>

                                                                    </td>


                                                                    <td>

                                                                        {{ $pengaduan->created_at
                                            ? $pengaduan->created_at->format('d/m/Y H:i')
                                            : '-' }}

                                                                    </td>


                                                                    <td>

                                                                        @php

                                                                            $statusClass = match (
                                                                            strtolower($pengaduan->status ?? '')
                                                                            ) {

                                                                                'selesai' =>
                                                                                    'status-selesai',

                                                                                'diproses' =>
                                                                                    'status-diproses',

                                                                                default =>
                                                                                    'status-menunggu',

                                                                            };

                                                                        @endphp


                                                                        <span class="status-badge {{ $statusClass }}">

                                                                            {{ $pengaduan->status ?? 'Menunggu' }}

                                                                        </span>

                                                                    </td>


                                                                    <td>

                                                                        <a href="{{ route(
                                            'admin.pengaduan.show',
                                            $pengaduan->id
                                        ) }}" class="detail-button">

                                                                            Detail

                                                                            <span>
                                                                                →
                                                                            </span>

                                                                        </a>

                                                                    </td>


                                                                </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>


                    @else


                        <div class="empty-admin">

                            <div>
                                ✉
                            </div>

                            <h3>
                                Belum Ada Pengaduan
                            </h3>

                            <p>
                                Belum ada laporan masyarakat
                                yang masuk ke sistem.
                            </p>

                        </div>


                    @endif


                </section>


            </div>


        </main>


    </div>


</body>

</html>