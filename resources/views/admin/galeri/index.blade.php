@extends('layouts.admin')

@section('title', 'Galeri - Admin Puskesmas')
@section('page-title', 'Galeri')

@section('content')
    <div class="admin-page galeri-admin-page">

        <div class="admin-content-header">
            <div>
                <span class="admin-section-label">KONTEN WEBSITE</span>
                <h2>Galeri Kegiatan</h2>
                <p>Kelola foto kegiatan dan pelayanan Puskesmas Singaparna.</p>
            </div>

            <a href="{{ route('admin.galeri.create') }}" class="admin-btn admin-btn-primary">
                + Tambah Foto
            </a>
        </div>

        @if(session('success'))
            <div class="galeri-alert">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="galeri-alert galeri-alert-error">
                Periksa kembali data yang dimasukkan. Ada data yang belum sesuai.
            </div>
        @endif

        <div class="galeri-admin-card">
            <div class="galeri-admin-card-header">
                <div>
                    <h3>Daftar Galeri</h3>
                    <p>Foto dengan status aktif akan ditampilkan di website.</p>
                </div>

                <span class="galeri-count">{{ $galeri->total() }}</span>
            </div>

            @if($galeri->count())
                <div class="galeri-admin-grid">
                    @foreach($galeri as $item)
                        <article class="galeri-admin-item">
                            <div class="galeri-admin-photo">
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" loading="lazy">

                                <span class="galeri-status {{ $item->status ? 'is-active' : 'is-inactive' }}">
                                    {{ $item->status ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>

                            <div class="galeri-admin-info">
                                <h4>{{ $item->judul }}</h4>

                                <p class="galeri-admin-date">
                                    {{ $item->tanggal?->format('d M Y') ?? 'Tanggal belum diisi' }}
                                </p>

                                <p class="galeri-admin-description">
                                    {{ $item->deskripsi ?: 'Belum ada deskripsi.' }}
                                </p>

                                <div class="galeri-admin-actions">
                                    <a href="{{ route('admin.galeri.edit', $item) }}" class="admin-btn admin-btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.galeri.destroy', $item) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="admin-btn admin-btn-delete">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="galeri-pagination">
                    {{ $galeri->links() }}
                </div>
            @else
                <div class="galeri-admin-empty">
                    <div class="galeri-empty-icon">🖼️</div>
                    <h3>Belum Ada Foto Galeri</h3>
                    <p>Tambahkan foto kegiatan Puskesmas agar tampil di halaman website.</p>

                    <a href="{{ route('admin.galeri.create') }}" class="admin-btn admin-btn-primary">
                        + Tambah Foto Pertama
                    </a>
                </div>
            @endif
        </div>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-galeri.css') }}">
@endpush