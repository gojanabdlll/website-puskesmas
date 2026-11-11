<section class="home-pengumuman">
    <div class="home-pengumuman-container">

        <div class="home-pengumuman-heading">
            <span>PUSKESMAS SINGAPARNA</span>
            <h2>Pengumuman Terbaru</h2>
            <p>Informasi dan pemberitahuan penting untuk masyarakat.</p>
        </div>

        <div class="home-pengumuman-grid">
            @forelse ($pengumuman as $item)
                <article class="home-pengumuman-card">

                    @if ($item->foto)
                        <div class="home-pengumuman-image">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" loading="lazy">
                        </div>
                    @else
                        <div class="home-pengumuman-image home-pengumuman-no-image">
                            📢
                        </div>
                    @endif

                    <div class="home-pengumuman-body">
                        <span class="home-pengumuman-label">PENGUMUMAN</span>

                        <h3>{{ $item->judul }}</h3>

                        @if ($item->tanggal)
                            <p class="home-pengumuman-date">
                                {{ $item->tanggal->format('d M Y') }}
                            </p>
                        @endif

                        <p class="home-pengumuman-description">
                            {{ $item->ringkasan ?: \Illuminate\Support\Str::limit(strip_tags($item->isi), 120) }}
                        </p>

                        <details class="home-pengumuman-detail">
                            <summary>Baca selengkapnya →</summary>
                            <div>
                                {!! nl2br(e($item->isi)) !!}
                            </div>
                        </details>
                    </div>
                </article>
            @empty
                <p class="home-pengumuman-empty">
                    Belum ada pengumuman terbaru.
                </p>
            @endforelse
        </div>

        <div class="home-pengumuman-footer">
            <a href="{{ url('/informasi/pengumuman') }}">
                Lihat Semua Pengumuman →
            </a>
        </div>

    </div>
</section>