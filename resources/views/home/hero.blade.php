<section class="hero hero-dynamic">
    <div class="hero-slides">

        @forelse ($banners as $banner)
            <div class="hero-slide {{ $loop->first ? 'active' : '' }}" @if ($banner->gambar)
            style="background-image: url('{{ asset('storage/' . $banner->gambar) }}');" @else
                style="background-image: linear-gradient(120deg, #087f5b, #064e3b);" @endif>
                <div class="hero-overlay"></div>

                <div class="hero-content">
                    <h1>{{ $banner->judul }}</h1>

                    @if ($banner->deskripsi)
                        <p>{{ $banner->deskripsi }}</p>
                    @endif

                    @if ($banner->teks_tombol && $banner->url_tombol)
                        <a href="{{ $banner->url_tombol }}" class="hero-button">
                            {{ $banner->teks_tombol }}
                        </a>
                    @endif
                </div>
            </div>

        @empty
            <div class="hero-slide active">
                <div class="hero-overlay"></div>

                <div class="hero-content">
                    <h1>
                        Selamat Datang di<br>
                        Puskesmas Singaparna
                    </h1>

                    <p>
                        Melayani masyarakat dengan ramah,
                        profesional, dan sepenuh hati.
                    </p>

                    <a href="{{ url('/profil') }}" class="hero-button">
                        Selengkapnya
                    </a>
                </div>
            </div>
        @endforelse

    </div>

    @if ($banners->count() > 1)
        <button type="button" class="hero-arrow hero-prev" aria-label="Banner sebelumnya">
            &#10094;
        </button>

        <button type="button" class="hero-arrow hero-next" aria-label="Banner berikutnya">
            &#10095;
        </button>

        <div class="hero-dots">
            @foreach ($banners as $banner)
                <button type="button" class="hero-dot {{ $loop->first ? 'active' : '' }}"
                    aria-label="Buka banner {{ $loop->iteration }}"></button>
            @endforeach
        </div>
    @endif
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.hero-dynamic').forEach(function (hero) {
            const slides = hero.querySelectorAll('.hero-slide');
            const dots = hero.querySelectorAll('.hero-dot');
            const previous = hero.querySelector('.hero-prev');
            const next = hero.querySelector('.hero-next');

            if (slides.length <= 1) {
                return;
            }

            let current = 0;
            let timer;

            function showSlide(index) {
                current = (index + slides.length) % slides.length;

                slides.forEach(function (slide, i) {
                    slide.classList.toggle('active', i === current);
                });

                dots.forEach(function (dot, i) {
                    dot.classList.toggle('active', i === current);
                });
            }

            function startAutoSlide() {
                clearInterval(timer);

                timer = setInterval(function () {
                    showSlide(current + 1);
                }, 5000);
            }

            if (previous) {
                previous.addEventListener('click', function () {
                    showSlide(current - 1);
                    startAutoSlide();
                });
            }

            if (next) {
                next.addEventListener('click', function () {
                    showSlide(current + 1);
                    startAutoSlide();
                });
            }

            dots.forEach(function (dot, index) {
                dot.addEventListener('click', function () {
                    showSlide(index);
                    startAutoSlide();
                });
            });

            startAutoSlide();
        });
    });
</script>