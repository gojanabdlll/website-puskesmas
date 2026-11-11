@extends('layouts.app')

@section('title', 'Cek Status Pengaduan - Puskesmas Singaparna')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pengaduan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">
@endpush

@section('content')

    {{-- HEADER HALAMAN --}}
    <section class="cek-page-header">
        <div class="cek-header-inner">
            <div class="cek-header-icon">
                <i class="fas fa-comments"></i>
            </div>

            <span class="cek-header-label">LAYANAN MASYARAKAT</span>

            <h1>Cek Status Pengaduan</h1>

            <p>
                Pantau perkembangan pengaduan yang telah disampaikan
                kepada Puskesmas Singaparna secara mudah dan transparan.
            </p>

            <div class="cek-header-decoration"></div>
        </div>
    </section>

    {{-- DAFTAR STATUS PENGADUAN --}}
    <section class="cek-pengaduan-section">
        <div class="aduan-publik">

            <div class="aduan-section-heading">
                <div>
                    <span class="aduan-eyebrow">INFORMASI PENGADUAN</span>
                    <h2>Daftar Status Pengaduan</h2>
                    <p>
                        Berikut adalah ringkasan status pengaduan masyarakat.
                    </p>
                </div>

                <div class="aduan-total">
                    <span class="aduan-total-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </span>
                    <div>
                        <strong>{{ $pengaduanPublik->total() }}</strong>
                        <span>Total Pengaduan</span>
                    </div>
                </div>
            </div>

            <div class="aduan-publik-list">
                @forelse ($pengaduanPublik as $item)

                    @php
                        $status = strtolower(trim($item->status ?? 'menunggu'));

                        $statusClass = match ($status) {
                            'diproses', 'sedang diproses' => 'diproses',
                            'selesai' => 'selesai',
                            'ditolak', 'tidak ditindaklanjuti' => 'ditolak',
                            default => 'menunggu',
                        };

                        $statusLabel = match ($status) {
                            'diproses', 'sedang diproses' => 'Sedang Diproses',
                            'selesai' => 'Selesai',
                            'ditolak', 'tidak ditindaklanjuti' => 'Tidak Ditindaklanjuti',
                            default => 'Menunggu',
                        };

                        $statusIcon = match ($statusClass) {
                            'diproses' => 'fa-spinner',
                            'selesai' => 'fa-check-circle',
                            'ditolak' => 'fa-times-circle',
                            default => 'fa-clock',
                        };
                    @endphp

                    <article class="aduan-publik-card">
                        <div class="aduan-card-top">
                            <div class="aduan-card-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>

                            <span class="aduan-status-badge {{ $statusClass }}">
                                <i class="fas {{ $statusIcon }}"></i>
                                {{ $statusLabel }}
                            </span>
                        </div>

                        <div class="aduan-card-content">
                            <span class="aduan-card-label">
                                KATEGORI PENGADUAN
                            </span>

                            <h3>{{ $item->kategori }}</h3>

                            <div class="aduan-card-date">
                                <i class="far fa-calendar-alt"></i>
                                <span>
                                    Dikirim pada
                                    {{ $item->created_at?->format('d M Y') ?? '-' }}
                                </span>
                            </div>
                        </div>

                        <div class="aduan-card-footer">
                            <span>Informasi status pengaduan</span>
                            <i class="fas fa-shield-alt"></i>
                        </div>
                    </article>

                @empty
                    <div class="aduan-kosong">
                        <div class="aduan-empty-icon">
                            <i class="fas fa-inbox"></i>
                        </div>

                        <h3>Belum Ada Pengaduan</h3>

                        <p>
                            Saat ini belum ada pengaduan yang dapat ditampilkan.
                            Silakan kembali lagi nanti.
                        </p>

                        <a href="{{ route('pengaduan.index') }}" class="aduan-empty-button">
                            <i class="fas fa-arrow-left"></i>
                            Kembali ke Layanan Pengaduan
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if ($pengaduanPublik->hasPages())
                <div class="aduan-pagination">
                    {{ $pengaduanPublik->links() }}
                </div>
            @endif

            {{-- CATATAN PRIVASI --}}
            <div class="aduan-privacy-note">
                <div class="aduan-privacy-icon">
                    <i class="fas fa-lock"></i>
                </div>

                <div>
                    <strong>Privasi Anda Terjaga</strong>
                    <p>
                        Informasi pribadi dan isi laporan tidak ditampilkan
                        pada halaman publik ini.
                    </p>
                </div>
            </div>

        </div>
    </section>

@endsection