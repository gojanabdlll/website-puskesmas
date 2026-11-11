<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Detail Pengaduan - Admin
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

                    <a href="{{ route('admin.pengaduan.index') }}" class="back-button">
                        ←
                    </a>

                    <div>

                        <span class="topbar-small">
                            ADMINISTRATOR
                        </span>

                        <h1>
                            Detail Pengaduan
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



            <div class="dashboard-content">


                {{-- SUCCESS MESSAGE --}}

                @if(session('success'))

                    <div class="success-alert">

                        <span>
                            ✓
                        </span>

                        <div>
                            {{ session('success') }}
                        </div>

                    </div>

                @endif



                {{-- VALIDATION ERROR --}}

                @if($errors->any())

                    <div class="error-alert">

                        <strong>
                            Terdapat kesalahan:
                        </strong>

                        <ul>

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif



                {{-- DETAIL HEADER --}}

                <section class="detail-top-card">


                    <div>

                        <span class="detail-label">
                            NOMOR TIKET
                        </span>

                        <h2>
                            {{ $pengaduan->nomor_tiket }}
                        </h2>

                        <p>
                            Pengaduan masyarakat
                            Puskesmas Singaparna
                        </p>

                    </div>


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


                    <span class="status-badge large-status {{ $statusClass }}">

                        {{ $pengaduan->status ?? 'Menunggu' }}

                    </span>


                </section>



                <section class="detail-grid">


                    {{-- ==================================================
                    ISI PENGADUAN
                    =================================================== --}}

                    <div class="detail-card">


                        <div class="detail-card-header">

                            <span>
                                LAPORAN MASYARAKAT
                            </span>

                            <h3>
                                Informasi Pengaduan
                            </h3>

                        </div>


                        <div class="detail-body">


                            <div class="detail-row">

                                <span>
                                    Kategori
                                </span>

                                <strong>
                                    {{ $pengaduan->kategori ?? '-' }}
                                </strong>

                            </div>


                            <div class="detail-row">

                                <span>
                                    Subjek
                                </span>

                                <strong>
                                    {{ $pengaduan->subjek ?? '-' }}
                                </strong>

                            </div>


                            <div class="detail-row">

                                <span>
                                    Tanggal Pengaduan
                                </span>

                                <strong>

                                    {{ $pengaduan->created_at
    ? $pengaduan->created_at->format('d F Y, H:i')
    : '-' }}

                                </strong>

                            </div>


                            <div class="detail-message">

                                <span>
                                    Isi Pengaduan
                                </span>

                                <div>
                                    {{ $pengaduan->isi_pengaduan ?? '-' }}
                                </div>

                            </div>


                        </div>


                    </div>



                    {{-- ==================================================
                    TANGGAPAN ADMIN
                    =================================================== --}}

                    <div class="detail-card response-card">


                        <div class="detail-card-header">

                            <span>
                                TINDAK LANJUT
                            </span>

                            <h3>
                                Tanggapan Admin
                            </h3>

                        </div>


                        <form action="{{ route(
    'admin.pengaduan.update',
    $pengaduan->id
) }}" method="POST" class="response-form">

                            @csrf

                            @method('PUT')


                            <div class="form-group">

                                <label for="status">
                                    Status Pengaduan
                                </label>

                                <select name="status" id="status" required>

                                    <option value="Menunggu" {{ $pengaduan->status === 'Menunggu' ? 'selected' : '' }}>
                                        Menunggu
                                    </option>

                                    <option value="Diproses" {{ $pengaduan->status === 'Diproses' ? 'selected' : '' }}>
                                        Diproses
                                    </option>

                                    <option value="Selesai" {{ $pengaduan->status === 'Selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>

                                </select>

                            </div>


                            <div class="form-group">

                                <label for="tanggapan">
                                    Tanggapan untuk Masyarakat
                                </label>

                                <textarea name="tanggapan" id="tanggapan" rows="8"
                                    placeholder="Tuliskan tanggapan atau informasi tindak lanjut untuk masyarakat...">{{ old('tanggapan', $pengaduan->tanggapan ?? '') }}</textarea>

                                <small>
                                    Tanggapan ini akan dapat dilihat
                                    oleh masyarakat melalui nomor tiket.
                                </small>

                            </div>


                            <button type="submit" class="save-response-button">

                                <span>
                                    ✓
                                </span>

                                Simpan Tanggapan

                            </button>


                        </form>


                    </div>


                </section>


            </div>


        </main>


    </div>


</body>

</html>