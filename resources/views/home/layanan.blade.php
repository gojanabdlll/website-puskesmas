<section class="layanan-section" id="pelayanan">
    <div class="layanan-header">
        <span class="layanan-label">LAYANAN KESEHATAN</span>
        <h2>Pelayanan Puskesmas</h2>
        <p>
            Temukan informasi pelayanan kesehatan berdasarkan
            pengelompokan klaster Puskesmas Singaparna.
        </p>
    </div>

    <div class="layanan-container layanan-klaster-container">

        {{-- KLASTER 1 --}}
        <article class="layanan-card layanan-klaster-card">
            <div class="klaster-nomor">KLASTER 01</div>
            <div class="klaster-icon">📋</div>
            <div class="layanan-content">
                <h3>Manajemen dan Pendaftaran</h3>
                <p>
                    Informasi pendaftaran pasien dan administrasi
                    pelayanan kesehatan.
                </p>
                <a href="{{ url('/pelayanan/klaster/1') }}" class="klaster-button">
                    Lihat Pelayanan <span>→</span>
                </a>
            </div>
        </article>

        {{-- KLASTER 2 --}}
        <article class="layanan-card layanan-klaster-card">
            <div class="klaster-nomor">KLASTER 02</div>
            <div class="klaster-icon">👩‍⚕️</div>
            <div class="layanan-content">
                <h3>Kesehatan Ibu dan Anak</h3>
                <p>
                    Informasi pelayanan kesehatan ibu, bayi,
                    balita, dan anak.
                </p>
                <a href="{{ url('/pelayanan/klaster/2') }}" class="klaster-button">
                    Lihat Pelayanan <span>→</span>
                </a>
            </div>
        </article>

        {{-- KLASTER 3 --}}
        <article class="layanan-card layanan-klaster-card">
            <div class="klaster-nomor">KLASTER 03</div>
            <div class="klaster-icon">🩺</div>
            <div class="layanan-content">
                <h3>Kesehatan Dewasa dan Lansia</h3>
                <p>
                    Informasi pemeriksaan kesehatan usia dewasa
                    dan lanjut usia.
                </p>
                <a href="{{ url('/pelayanan/klaster/3') }}" class="klaster-button">
                    Lihat Pelayanan <span>→</span>
                </a>
            </div>
        </article>

        {{-- KLASTER 4 --}}
        <article class="layanan-card layanan-klaster-card">
            <div class="klaster-nomor">KLASTER 04</div>
            <div class="klaster-icon">🌿</div>
            <div class="layanan-content">
                <h3>Pengendalian Penyakit</h3>
                <p>
                    Informasi kegiatan pencegahan penyakit,
                    promosi kesehatan, dan kesehatan masyarakat.
                </p>
                <a href="{{ url('/pelayanan/klaster/4') }}" class="klaster-button">
                    Lihat Pelayanan <span>→</span>
                </a>
            </div>
        </article>

        {{-- KLASTER 5 --}}
        <article class="layanan-card layanan-klaster-card">
            <div class="klaster-nomor">KLASTER 05</div>
            <div class="klaster-icon">🏥</div>
            <div class="layanan-content">
                <h3>Pelayanan Penunjang</h3>
                <p>
                    Informasi poli gigi dan mulut, tindakan/IGD,
                    farmasi, serta laboratorium.
                </p>
                <a href="{{ url('/pelayanan/klaster/5') }}" class="klaster-button">
                    Lihat Pelayanan <span>→</span>
                </a>
            </div>
        </article>

    </div>
</section>