<aside class="admin-sidebar">

    {{-- LOGO --}}
    <div class="admin-logo">

        <a href="{{ url('/admin/dashboard') }}">

            <img src="{{ asset('image/logo-puskesmas.png') }}" alt="Logo Puskesmas Singaparna">

            <div class="admin-logo-text">

                <strong>
                    PUSKESMAS
                </strong>

                <span>
                    SINGAPARNA
                </span>

            </div>

        </a>

    </div>


    {{-- MENU UTAMA --}}
    <div class="admin-menu-section">

        <span class="admin-menu-title">
            MENU UTAMA
        </span>


        <a href="{{ url('/admin/dashboard') }}"
            class="admin-menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">

            <span class="menu-icon">
                ▦
            </span>

            <span>
                Dashboard
            </span>

        </a>


        <a href="{{ url('/admin/pengaduan') }}"
            class="admin-menu-item {{ request()->is('admin/pengaduan*') ? 'active' : '' }}">

            <span class="menu-icon">
                ✉
            </span>

            <span>
                Pengaduan
            </span>

            @php
                $jumlahPengaduan = \App\Models\Pengaduan::where('status', 'Menunggu')->count();
            @endphp

            @if($jumlahPengaduan > 0)

                <span class="menu-badge">
                    {{ $jumlahPengaduan }}
                </span>

            @endif

        </a>
        {{-- Menu Laporan Pegawai --}}
        <a href="{{ route('admin.laporan-pegawai.index') }}"
            class="admin-menu-item {{ request()->is('admin/laporan-pegawai*') ? 'active' : '' }}">

            <span class="menu-icon">
                📄
            </span>

            <span>
                Simpel Bro
            </span>
        </a>

    </div>


    {{-- KONTEN WEBSITE --}}
    <div class="admin-menu-section">

        <span class="admin-menu-title">
            KONTEN WEBSITE
        </span>
        <a href="{{ route('admin.banner.index') }}"
            class="admin-menu-item {{ request()->is('admin/banner*') ? 'active' : '' }}">

            <span class="menu-icon">
                🖼️
            </span>

            <span>
                Kelola Banner
            </span>

        </a>

        <a href="{{ url('/admin/profil') }}"
            class="admin-menu-item {{ request()->is('admin/profil*') ? 'active' : '' }}">

            <span class="menu-icon">
                🏥
            </span>

            <span>
                Profil Puskesmas
            </span>

        </a>




        <a href="{{ url('/admin/wilayah') }}"
            class="admin-menu-item {{ request()->is('admin/wilayah-kerja*') ? 'active' : '' }}">

            <span class="menu-icon">
                📍
            </span>

            <span>
                Wilayah Kerja
            </span>

        </a>


        <a href="{{ url('/admin/struktur') }}"
            class="admin-menu-item {{ request()->is('admin/struktur*') ? 'active' : '' }}">

            <span class="menu-icon">
                👥
            </span>

            <span>
                Struktur Organisasi
            </span>

        </a>


        <a href="{{ url('/admin/berita') }}"
            class="admin-menu-item {{ request()->is('admin/berita*') ? 'active' : '' }}">

            <span class="menu-icon">
                📰
            </span>

            <span>
                Berita
            </span>

        </a>


        <a href="{{ url('/admin/pengumuman') }}"
            class="admin-menu-item {{ request()->is('admin/pengumuman*') ? 'active' : '' }}">

            <span class="menu-icon">
                📢
            </span>

            <span>
                Pengumuman
            </span>

        </a>
        <a href="{{ route('admin.jadwal-pelayanan.index') }}"
            class="admin-menu-item {{ request()->is('admin/jadwal-pelayanan*') ? 'active' : '' }}">

            <span class="menu-icon">
                🗓️
            </span>

            <span>
                Jadwal Pelayanan
            </span>

        </a>


        <a href="{{ url('/admin/galeri') }}"
            class="admin-menu-item {{ request()->is('admin/galeri*') ? 'active' : '' }}">

            <span class="menu-icon">
                🖼
            </span>

            <span>
                Galeri
            </span>

        </a>


        <a href="{{ url('/admin/promkes') }}"
            class="admin-menu-item {{ request()->is('admin/promkes*') ? 'active' : '' }}">

            <span class="menu-icon">
                ❤️
            </span>

            <span>
                Promkes
            </span>

        </a>

        <a href="{{ route('admin.footer.edit') }}"
            class="admin-menu-item {{ request()->is('admin/footer*') ? 'active' : '' }}">

            <span class="menu-icon">⚙️</span>

            <span>Pengaturan Footer</span>

        </a>


    </div>


    {{-- SISTEM --}}
    <div class="admin-menu-section admin-system-menu">

        <span class="admin-menu-title">
            SISTEM
        </span>


        <a href="{{ url('/') }}" target="_blank" class="admin-menu-item">

            <span class="menu-icon">
                ↗
            </span>

            <span>
                Lihat Website
            </span>

        </a>


        <form action="{{ url('/logout') }}" method="POST">

            @csrf

            <button type="submit" class="admin-menu-item admin-logout">

                <span class="menu-icon">
                    ↪
                </span>

                <span>
                    Logout
                </span>

            </button>

        </form>

    </div>


    {{-- STATUS --}}
    <div class="admin-sidebar-bottom">

        <div class="online-dot"></div>

        <div>

            <strong>
                Sistem Online
            </strong>

            <small>
                Puskesmas Singaparna
            </small>

        </div>

    </div>

</aside>