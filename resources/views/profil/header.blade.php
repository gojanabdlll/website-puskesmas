<section class="page-header profil-hero" @if(!empty($profil?->foto))
    style="background-image: linear-gradient(rgba(8, 35, 35, .60), rgba(8, 35, 35, .60)), url('{{ asset('storage/' . $profil->foto) }}')"
@endif>

    <div class="page-header-content profil-hero-content">
        <span class="profil-hero-label">PROFIL KAMI</span>

        <h1>{{ $profil->nama_puskesmas ?? 'Profil Puskesmas Singaparna' }}</h1>

        <p>
            Mengenal lebih dekat profil, sejarah, dan lokasi
            {{ $profil->nama_puskesmas ?? 'Puskesmas Singaparna' }}
        </p>
    </div>

</section>