@extends('layouts.admin')

@section('title', 'Kelola Banner')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-banner.css') }}">
@endpush

@section('content')
    <div class="ab-page">

        {{-- HEADER FOTO PUSKESMAS --}}
        <section class="ab-hero">
            <div class="ab-hero-content">
                <span class="ab-eyebrow">ADMINISTRASI WEBSITE</span>
                <h1>Kelola Banner</h1>
                <p>
                    Atur gambar, informasi, dan tampilan banner
                    pada halaman utama Puskesmas Singaparna.
                </p>
                <a href="{{ route('admin.banner.create') }}" class="ab-btn ab-btn-primary">
                    <span>＋</span> Tambah Banner
                </a>
            </div>
        </section>

        {{-- NOTIFIKASI --}}
        @if(session('success'))
            <div class="ab-alert ab-alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="ab-alert ab-alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="ab-alert ab-alert-error">
                <strong>Periksa kembali data berikut:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- RINGKASAN --}}
        <div class="ab-stats">
            <div class="ab-stat-card">
                <div class="ab-stat-icon">🖼️</div>
                <div>
                    <span>Total Banner</span>
                    <strong>{{ $banners->count() }}</strong>
                </div>
            </div>

            <div class="ab-stat-card">
                <div class="ab-stat-icon">🟢</div>
                <div>
                    <span>Banner Aktif</span>
                    <strong>{{ $banners->where('status', true)->count() }}</strong>
                </div>
            </div>

            <div class="ab-stat-card">
                <div class="ab-stat-icon">⚪</div>
                <div>
                    <span>Banner Nonaktif</span>
                    <strong>{{ $banners->where('status', false)->count() }}</strong>
                </div>
            </div>
        </div>

        {{-- DAFTAR BANNER --}}
        <section class="ab-panel">
            <div class="ab-panel-heading">
                <div>
                    <h2>Daftar Banner Website</h2>
                    <p>Kelola banner yang tersimpan di sistem.</p>
                </div>
                <span class="ab-count">{{ $banners->count() }} data</span>
            </div>

            @if($banners->count() > 0)
                <div class="ab-table-wrap">
                    <table class="ab-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Gambar</th>
                                <th>Informasi Banner</th>
                                <th>Urutan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($banners as $banner)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        @if($banner->gambar)
                                            <img class="ab-thumbnail" src="{{ asset('storage/' . $banner->gambar) }}"
                                                alt="{{ $banner->judul }}" loading="lazy">
                                        @else
                                            <div class="ab-no-image">Tidak ada gambar</div>
                                        @endif
                                    </td>

                                    <td class="ab-banner-info">
                                        <strong>{{ $banner->judul }}</strong>

                                        <p>
                                            {{ \Illuminate\Support\Str::limit($banner->deskripsi ?? '', 110) }}
                                        </p>

                                        @if($banner->teks_tombol)
                                            <span class="ab-button-label">
                                                {{ $banner->teks_tombol }}
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="ab-order">
                                            {{ $banner->urutan }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($banner->status)
                                            <span class="ab-status ab-status-active">Aktif</span>
                                        @else
                                            <span class="ab-status ab-status-inactive">Nonaktif</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="ab-actions">
                                            <a href="{{ route('admin.banner.edit', $banner->id) }}" class="ab-btn ab-btn-edit">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus banner ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="ab-btn ab-btn-delete">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="ab-empty">
                    <div class="ab-empty-icon">🖼️</div>
                    <h3>Belum Ada Banner</h3>
                    <p>Silakan tambahkan banner pertama untuk halaman utama website.</p>
                    <a href="{{ route('admin.banner.create') }}" class="ab-btn ab-btn-primary">
                        ＋ Tambah Banner
                    </a>
                </div>
            @endif
        </section>

    </div>
@endsection