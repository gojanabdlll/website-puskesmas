@extends('layouts.admin')

@section('title', 'Promkes')
@section('page-title', 'Promkes')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-promkes.css') }}">
@endpush

@section('content')
    <div class="pk-admin-container">

        {{-- Judul halaman --}}
        <div class="pk-page-heading">
            <div>
                <span class="pk-eyebrow">KONTEN WEBSITE</span>
                <h2>Promosi Kesehatan</h2>
                <p>Kelola informasi dan edukasi kesehatan Puskesmas Singaparna.</p>
            </div>

            <a href="{{ route('admin.promkes.create') }}" class="pk-btn-add">
                + Tambah Konten
            </a>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="pk-alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="pk-alert-error">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Panel daftar konten --}}
        <div class="pk-panel">

            <div class="pk-panel-header">
                <div>
                    <h3>Daftar Promkes</h3>
                    <p>Konten dengan status aktif akan ditampilkan di website.</p>
                </div>

                <span class="pk-count">
                    {{ $promkes->total() }}
                </span>
            </div>

            <div class="pk-panel-body">
                <div class="pk-card-grid">

                    @forelse ($promkes as $item)
                                <article class="pk-card">

                                    {{-- Foto --}}
                                    <div class="pk-card-image">
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}">
                                        @else
                                            <div class="pk-no-image">
                                                <span>🏥</span>
                                                <p>Belum ada foto</p>
                                            </div>
                                        @endif

                                        <span class="pk-status {{ $item->status ? 'is-active' : 'is-inactive' }}">
                                            {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </div>

                                    {{-- Informasi --}}
                                    <div class="pk-card-content">
                                        <h4>{{ $item->judul }}</h4>

                                        <span class="pk-card-date">
                                            {{ $item->tanggal
                        ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y')
                        : $item->created_at->format('d M Y') }}
                                        </span>

                                        <p class="pk-card-description">
                                            {{ $item->ringkasan
                        ?: \Illuminate\Support\Str::limit(strip_tags($item->isi), 100) }}
                                        </p>

                                        <div class="pk-card-actions">
                                            <a href="{{ route('admin.promkes.edit', $item->id) }}" class="pk-btn-edit">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.promkes.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus konten Promkes ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="pk-btn-delete">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </article>
                    @empty
                        <div class="pk-empty">
                            <div class="pk-empty-icon">📢</div>
                            <h4>Belum Ada Konten Promkes</h4>
                            <p>Silakan tambahkan informasi edukasi kesehatan.</p>

                            <a href="{{ route('admin.promkes.create') }}" class="pk-btn-add">
                                + Tambah Konten Pertama
                            </a>
                        </div>
                    @endforelse

                </div>
            </div>

            {{-- Pagination --}}
            @if ($promkes->hasPages())
                <div class="pk-panel-footer">
                    {{ $promkes->links() }}
                </div>
            @else
                <div class="pk-panel-footer"></div>
            @endif

        </div>

    </div>
@endsection