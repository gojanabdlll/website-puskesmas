{{-- DAFTAR PENGADUAN YANG TELAH SELESAI --}}
<section class="home-pengaduan-selesai">
    <div class="home-pengaduan-selesai-container">

        <div class="home-pengaduan-selesai-heading">
            <div>
                <span class="home-pengaduan-label">
                    TRANSPARANSI PELAYANAN
                </span>

                <h2>Pengaduan Telah Diselesaikan</h2>

                <p>
                    Berikut beberapa pengaduan masyarakat yang telah
                    ditindaklanjuti oleh Puskesmas Singaparna.
                </p>
            </div>

            <div class="home-pengaduan-selesai-icon" aria-hidden="true">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>

        <div class="home-pengaduan-selesai-grid">
            @forelse ($pengaduanSelesai as $item)
                <article class="home-pengaduan-selesai-card">

                    <div class="home-pengaduan-selesai-card-top">
                        <div class="home-pengaduan-selesai-card-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>

                        <span class="home-pengaduan-selesai-badge">
                            <i class="fas fa-check-circle"></i>
                            Selesai
                        </span>
                    </div>

                    <span class="home-pengaduan-selesai-category">
                        KATEGORI PENGADUAN
                    </span>

                    <h3>{{ $item->kategori }}</h3>

                    <p class="home-pengaduan-selesai-date">
                        <i class="far fa-calendar-check"></i>
                        Dikirim pada
                        {{ $item->created_at?->format('d M Y') ?? '-' }}
                    </p>

                    <div class="home-pengaduan-selesai-footer">
                        <i class="fas fa-shield-alt"></i>
                        Pengaduan telah ditindaklanjuti
                    </div>

                </article>
            @empty
                <div class="home-pengaduan-selesai-empty">
                    <div class="home-pengaduan-selesai-empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>

                    <h3>Belum Ada Pengaduan Selesai</h3>

                    <p>
                        Pengaduan yang telah diselesaikan oleh admin
                        akan ditampilkan di bagian ini.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="home-pengaduan-selesai-bottom">
            <i class="fas fa-lock"></i>
            <span>
                Privasi pelapor dijaga. Identitas dan isi laporan
                tidak ditampilkan kepada publik.
            </span>

            <a href="{{ url('/cek-pengaduan') }}">
                Lihat Status Pengaduan
                <span aria-hidden="true">→</span>
            </a>
        </div>

    </div>
</section>