@extends('layouts.admin')

@section('title', 'Pengumuman - Admin Puskesmas')

@section('page-title', 'Pengumuman')

@section('content')

    <div class="admin-page">

        {{-- =====================================================
        HEADER HALAMAN
        ===================================================== --}}
        <div class="admin-content-header">

            <div>
                <span class="admin-section-label">
                    KONTEN WEBSITE
                </span>

                <h2>
                    Pengumuman
                </h2>

                <p>
                    Kelola pengumuman Puskesmas Singaparna
                    yang ditampilkan kepada masyarakat.
                </p>
            </div>

            <a href="{{ route('admin.pengumuman.create') }}" class="admin-btn admin-btn-primary">
                + Tambah Pengumuman
            </a>

        </div>


        {{-- =====================================================
        DAFTAR PENGUMUMAN
        ===================================================== --}}

        @if($pengumuman->count() > 0)

            <div class="admin-form-card">

                {{-- HEADER CARD --}}
                <div class="admin-card-heading">

                    <div>

                        <h3>
                            Daftar Pengumuman
                        </h3>

                        <p>
                            Pengumuman yang ditambahkan di sini
                            akan ditampilkan pada website.
                        </p>

                    </div>

                    <span class="admin-count">
                        {{ $pengumuman->count() }}
                    </span>

                </div>


                {{-- LIST PENGUMUMAN --}}
                <div class="pengumuman-admin-list">

                    @foreach($pengumuman as $item)

                        <div class="pengumuman-admin-item">

                            {{-- FOTO --}}
                            <div class="pengumuman-admin-image">

                                @if($item->foto)

                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}">

                                @else

                                    <div class="pengumuman-placeholder">
                                        📢
                                    </div>

                                @endif

                            </div>


                            {{-- INFORMASI --}}
                            <div class="pengumuman-admin-info">

                                {{-- TANGGAL + STATUS --}}
                                <div class="pengumuman-admin-meta">

                                    <span>
                                        {{ $item->tanggal ? $item->tanggal->format('d M Y') : '-' }}
                                    </span>

                                    @if($item->status)

                                        <span class="status-active">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="status-inactive">
                                            Tidak Aktif
                                        </span>

                                    @endif

                                </div>


                                {{-- JUDUL --}}
                                <h3>
                                    {{ $item->judul }}
                                </h3>


                                {{-- RINGKASAN --}}
                                @if($item->ringkasan)

                                    <p>
                                        {{ $item->ringkasan }}
                                    </p>

                                @endif


                                {{-- PENULIS --}}
                                @if($item->penulis)

                                    <small>
                                        Oleh {{ $item->penulis }}
                                    </small>

                                @endif

                            </div>


                            {{-- AKSI --}}
                            <div class="pengumuman-admin-actions">

                                <a href="{{ route('admin.pengumuman.edit', $item) }}" class="admin-btn admin-btn-secondary">
                                    Edit
                                </a>


                                <form action="{{ route('admin.pengumuman.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit" class="admin-btn admin-btn-danger">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>


        @else

            {{-- =================================================
            EMPTY STATE
            ================================================= --}}
            <div class="empty-admin-card">

                <div class="empty-admin-icon">
                    📢
                </div>

                <h3>
                    Belum Ada Pengumuman
                </h3>

                <p>
                    Belum ada pengumuman yang ditambahkan.
                    Silakan tambahkan pengumuman baru untuk
                    ditampilkan kepada masyarakat.
                </p>

                <a href="{{ route('admin.pengumuman.create') }}" class="admin-btn admin-btn-primary">
                    + Tambah Pengumuman
                </a>

            </div>

        @endif

    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-pengumuman.css') }}">
@endpush