@extends('layouts.admin')

@section('title', 'Berita - Admin Puskesmas')

@section('page-title', 'Berita')

@section('content')

    <div class="admin-page">

        {{-- HEADER HALAMAN --}}
        <div class="admin-content-header">

            <div>
                <span class="admin-section-label">
                    KONTEN WEBSITE
                </span>

                <h2>
                    Berita
                </h2>

                <p>
                    Kelola berita dan informasi Puskesmas Singaparna
                    yang ditampilkan kepada masyarakat.
                </p>
            </div>

            <a href="{{ route('admin.berita.create') }}" class="admin-btn admin-btn-primary">
                + Tambah Berita
            </a>

        </div>


        {{-- DAFTAR BERITA --}}
        <div class="admin-card">

            <div class="admin-card-header">

                <div>
                    <h3>
                        Daftar Berita
                    </h3>

                    <p>
                        Berita yang ditambahkan di sini akan
                        ditampilkan pada website.
                    </p>
                </div>

                <span class="admin-count">
                    {{ $berita->count() }}
                </span>

            </div>


            @if($berita->count() > 0)

                <div class="berita-admin-list">

                    @foreach($berita as $item)

                        <div class="berita-admin-item">

                            {{-- FOTO --}}
                            <div class="berita-admin-image">

                                @if($item->foto)

                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}">

                                @else

                                    <div class="berita-no-image">
                                        📰
                                    </div>

                                @endif

                            </div>


                            {{-- INFORMASI --}}
                            <div class="berita-admin-info">

                                <div class="berita-admin-meta">

                                    <span>
                                        {{ $item->tanggal->format('d M Y') }}
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


                                <h3>
                                    {{ $item->judul }}
                                </h3>


                                <p>
                                    {{ $item->ringkasan ?? Str::limit(strip_tags($item->isi), 120) }}
                                </p>


                                @if($item->penulis)

                                    <small>
                                        Oleh {{ $item->penulis }}
                                    </small>

                                @endif

                            </div>


                            {{-- AKSI --}}
                            <div class="berita-admin-actions">

                                <a href="{{ route('admin.berita.edit', $item->id) }}" class="admin-btn admin-btn-edit">
                                    Edit
                                </a>


                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus berita ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="admin-btn admin-btn-delete">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                {{-- KOSONG --}}
                <div class="admin-empty">

                    <div class="admin-empty-icon">
                        📰
                    </div>

                    <h3>
                        Belum Ada Berita
                    </h3>

                    <p>
                        Belum ada berita yang ditambahkan.
                    </p>

                    <a href="{{ route('admin.berita.create') }}" class="admin-btn admin-btn-primary">
                        + Tambah Berita
                    </a>

                </div>

            @endif

        </div>

    </div>

@endsection


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-berita.css') }}">
@endpush