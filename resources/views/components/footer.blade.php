@php
    $namaPuskesmas = $footer?->nama_puskesmas ?? 'Puskesmas Singaparna';
    $alamat = $footer?->alamat ?? '';
    $telepon = $footer?->telepon ?? '';
    $email = $footer?->email ?? '';
    $pintasan = $footer?->pintasan ?? [];
    $terkait = $footer?->tautan_terkait ?? [];
    $logo = $footer?->logo
        ? asset('storage/' . $footer->logo)
        : asset('image/logo-puskesmas.png');
@endphp

<footer class="footer-modern">

    {{-- BAGIAN ATAS: KONTAK DAN PETA --}}
    <div class="footer-contact">
        <div class="footer-modern-container footer-contact-grid">

            <div class="footer-contact-info">
                <span class="footer-eyebrow">INFORMASI DAN LAYANAN</span>

                <h2>Hubungi Kami</h2>

                <p class="footer-contact-desc">
                    Kami siap melayani Anda. Jangan ragu untuk
                    menghubungi kami jika ada pertanyaan atau membutuhkan bantuan.
                </p>

                @if($alamat)
                    <div class="footer-contact-item">
                        <span class="footer-icon">📍</span>
                        <span>{{ $alamat }}</span>
                    </div>
                @endif

                @if($telepon)
                    <a class="footer-contact-item" href="tel:{{ $telepon }}">
                        <span class="footer-icon">☎</span>
                        <span>{{ $telepon }}</span>
                    </a>
                @endif

                @if($email)
                    <a class="footer-contact-item" href="mailto:{{ $email }}">
                        <span class="footer-icon">✉</span>
                        <span>{{ $email }}</span>
                    </a>
                @endif

                <div class="footer-socials">
                    @foreach($terkait as $link)
                        @if(!empty($link['label']) && !empty($link['url']))
                            @if(
                                    str_contains(strtolower($link['label']), 'instagram')
                                    || str_contains(strtolower($link['label']), 'facebook')
                                    || str_contains(strtolower($link['label']), 'youtube')
                                )
                                <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer">
                                    {{ $link['label'] }}
                                </a>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="footer-map">
                @if($alamat)
                    <iframe src="https://maps.google.com/maps?q={{ urlencode($alamat) }}&output=embed"
                        title="Peta lokasi {{ $namaPuskesmas }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen>
                    </iframe>
                @else
                    <div class="footer-map-placeholder">
                        <span>📍</span>
                        <p>Alamat lokasi belum diatur oleh admin.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>


    {{-- BAGIAN BAWAH: NAVIGASI WEBSITE --}}
    <div class="footer-navigation">
        <div class="footer-modern-container">

            <div class="footer-navigation-grid">

                {{-- IDENTITAS PUSKESMAS --}}
                <div class="footer-nav-brand">
                    <div class="footer-brand-heading">
                        <img src="{{ $logo }}" alt="Logo {{ $namaPuskesmas }}">
                        <h3>{{ $namaPuskesmas }}</h3>
                    </div>

                    @if($alamat)
                        <p class="footer-nav-detail">
                            <span>📍</span>
                            <span>{{ $alamat }}</span>
                        </p>
                    @endif

                    @if($telepon)
                        <p class="footer-nav-detail">
                            <span>☎</span>
                            <a href="tel:{{ $telepon }}">{{ $telepon }}</a>
                        </p>
                    @endif

                    @if($email)
                        <p class="footer-nav-detail">
                            <span>✉</span>
                            <a href="mailto:{{ $email }}">{{ $email }}</a>
                        </p>
                    @endif
                </div>


                {{-- PROFIL DAN PINTASAN --}}
                <div class="footer-nav-column">
                    <h3>Profil Puskesmas</h3>

                    <ul>
                        @forelse($pintasan as $link)
                            @if(!empty($link['label']) && !empty($link['url']))
                                <li>
                                    <a href="{{ $link['url'] }}">
                                        {{ $link['label'] }}
                                    </a>
                                </li>
                            @endif
                        @empty
                            <li><span>Belum ada tautan.</span></li>
                        @endforelse
                    </ul>
                </div>


                {{-- PENGUMUMAN DAN INFORMASI --}}
                <div class="footer-nav-column">
                    <h3>Pengumuman & Informasi</h3>

                    <ul>
                        @forelse($terkait as $link)
                            @if(!empty($link['label']) && !empty($link['url']))
                                <li>
                                    <a href="{{ $link['url'] }}">
                                        {{ $link['label'] }}
                                    </a>
                                </li>
                            @endif
                        @empty
                            <li><span>Belum ada tautan.</span></li>
                        @endforelse
                    </ul>
                </div>


                {{-- PENDAFTARAN ONLINE --}}
                <div class="footer-nav-column">
                    <h3>Pendaftaran Online</h3>

                    <a class="footer-online-button footer-online-blue"
                        href="https://play.google.com/store/search?q=Mobile%20JKN&c=apps" target="_blank"
                        rel="noopener noreferrer">
                        <span>▣</span> Mobile JKN
                    </a>

                    <a class="footer-online-button footer-online-green" href="https://satusehat.kemkes.go.id/"
                        target="_blank" rel="noopener noreferrer">
                        <span>✚</span> SATUSEHAT
                    </a>
                </div>

            </div>

            {{-- COPYRIGHT --}}
            <div class="footer-modern-bottom">
                <p>
                    {{ $footer?->copyright ?? '© Copyright ' . $namaPuskesmas }}
                </p>

                @if($footer?->kredit)
                    <small>{{ $footer->kredit }}</small>
                @endif
            </div>

        </div>
    </div>

</footer>