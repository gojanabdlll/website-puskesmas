<section class="galeri">

    <div class="section-title">
        <span>GALERI</span>

        <h2>Galeri Kegiatan</h2>

        <p>
            Dokumentasi kegiatan, pelayanan kesehatan,
            dan aktivitas Puskesmas Singaparna.
        </p>
    </div>

    <div class="galeri-container">

        @forelse ($galeriHome as $item)

            <div class="galeri-item">
                <img src="{{ asset('storage/' . $item->foto) }}"
                    alt="{{ $item->judul ?? 'Dokumentasi Puskesmas Singaparna' }}" loading="lazy">
            </div>

        @empty

            <div class="galeri-empty">
                <p>Belum ada foto galeri yang tersedia.</p>
            </div>

        @endforelse

    </div>

</section>