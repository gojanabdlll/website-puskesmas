<section class="informasi">

    <div class="section-title">
        <span>INFORMASI</span>

        <h2>Informasi Terbaru</h2>

        <p>
            Informasi dan kegiatan terbaru
            Puskesmas Singaparna.
        </p>
    </div>

    <div class="informasi-container">
        {{-- KARTU PENGUMUMAN: SEMENTARA TETAP --}}
        {{-- BERITA TERBARU DARI DATABASE --}}
        @forelse($beritaHome as $berita)

            <article class="informasi-card">

                <div class="informasi-image">

                    @if($berita->foto)
                        <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}">
                    @else
                        <img src="{{ asset('image/logo-puskesmas.png') }}" alt="Puskesmas Singaparna">
                    @endif

                </div>

                <div class="informasi-content">

                    <small>Berita</small>

                    <h3>{{ $berita->judul }}</h3>

                    @if($berita->tanggal || $berita->penulis)
                        <small class="informasi-meta">
                            {{ $berita->tanggal?->format('d M Y') }}

                            @if($berita->penulis)
                                • {{ $berita->penulis }}
                            @endif
                        </small>
                    @endif

                    @if($berita->ringkasan)
                        <p>
                            {{ \Illuminate\Support\Str::limit($berita->ringkasan, 100) }}
                        </p>
                    @endif

                    <a href="{{ route('berita.show', $berita) }}">
                        Baca Selengkapnya →
                    </a>

                </div>

            </article>

        @empty
            <div class="informasi-kosong">
                <p>Belum ada berita yang diterbitkan.</p>
            </div>
        @endforelse
    </div>

</section>