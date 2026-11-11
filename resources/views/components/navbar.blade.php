<header class="navbar">

    <a href="/" class="logo">

        <img src="{{ asset('image/logo-puskesmas.png') }}" alt="Logo Puskesmas Singaparna" class="logo-image">

        <div class="logo-text">

            <strong>
                PUSKESMAS
            </strong>

            <span>
                SINGAPARNA
            </span>

        </div>

    </a>


    <ul class="nav-menu">

        <li>
            <a href="/">
                Home
            </a>
        </li>


        <li class="dropdown">

            <a href="/profil">
                Tentang Kami
            </a>

            <div class="dropdown-menu">

                <a href="/profil">
                    Profil Puskesmas
                </a>

                <a href="/visi-misi">
                    Visi & Misi
                </a>

                <a href="/struktur-organisasi">
                    Struktur Organisasi
                </a>

                <a href="/wilayah-kerja">
                    Wilayah Kerja
                </a>

            </div>

        </li>


        <li class="dropdown">

            <a href="/pelayanan/klaster/1">
                Pelayanan
            </a>

            <div class="dropdown-menu">

                <a href="/pelayanan/klaster/1">
                    Klaster 1 
                </a>

                <a href="/pelayanan/klaster/2">
                    Klaster 2
                </a>

                <a href="/pelayanan/klaster/3">
                    Klaster 3
                </a>

                <a href="/pelayanan/klaster/4">
                    Klaster 4
                </a>

                <a href="/pelayanan/klaster/5">
                    Klaster 5
                </a>

            </div>

        </li>


        <li class="dropdown">

            <a href="/informasi/berita">
                Informasi
            </a>

            <div class="dropdown-menu">

                <a href="/informasi/berita">
                    Berita
                </a>

                <a href="/informasi/pengumuman">
                    Pengumuman
                </a>

                <a href="/informasi/jadwal">
                    Jadwal Pelayanan
                </a>

            </div>

        </li>


        <li>
            <a href="/promkes">Promkes</a>
        </li>


        <li>
            <a href="/galeri">Galeri</a>
        </li>


        <li>
            <a href="/layanan-pengaduan">
                Layanan Pengaduan
            </a>
        </li>

        <li>
            <a href="{{ route('laporan-pegawai.create') }}" class="laporan-pegawai-btn">
                <span class="laporan-icon">📋</span>
                Simpel Bro
            </a>
        </li>


        <li>
            <a href="/login" class="login-btn">
                Login
            </a>
        </li>

    </ul>

</header>