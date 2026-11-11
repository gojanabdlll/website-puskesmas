@extends('layouts.admin')

@section('title', 'Struktur Organisasi')

@section('content')

    <div class="admin-page">

        <div class="admin-page-header">

            <div>
                <span class="admin-label">
                    KONTEN WEBSITE
                </span>

                <h1>
                    Struktur Organisasi
                </h1>

                <p>
                    Kelola struktur organisasi Puskesmas Singaparna.
                </p>
            </div>

            <a href="{{ route('admin.struktur.create') }}" class="admin-btn admin-btn-primary">
                + Tambah Struktur
            </a>

        </div>


        @if(session('success'))

            <div class="admin-alert success">
                {{ session('success') }}
            </div>

        @endif


        <div class="admin-card">

            <div class="admin-card-header">

                <div>
                    <h2>
                        Daftar Struktur Organisasi
                    </h2>

                    <p>
                        Data yang ditambahkan di sini akan tampil
                        otomatis pada website.
                    </p>
                </div>

            </div>


            <div class="struktur-admin-list">

                @forelse($struktur as $item)

                    <div class="struktur-admin-item">

                        <div class="struktur-admin-number">
                            {{ $item->urutan }}
                        </div>


                        <div class="struktur-admin-info">

                            @if($item->foto)

                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}"
                                    class="struktur-admin-photo">

                            @else

                                <div class="struktur-admin-photo placeholder">
                                    {{ strtoupper(substr($item->nama, 0, 1)) }}
                                </div>

                            @endif


                            <div>

                                <strong>
                                    {{ $item->nama }}
                                </strong>

                                <span>
                                    {{ $item->jabatan }}
                                </span>

                            </div>

                        </div>


                        <div class="struktur-admin-actions">

                            <a href="{{ route('admin.struktur.edit', $item) }}" class="admin-btn admin-btn-edit">
                                Edit
                            </a>


                            <form action="{{ route('admin.struktur.destroy', $item) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                @csrf

                                @method('DELETE')

                                <button type="submit" class="admin-btn admin-btn-delete">
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="admin-empty">

                        <div class="admin-empty-icon">
                            👥
                        </div>

                        <h3>
                            Belum Ada Data
                        </h3>

                        <p>
                            Belum ada struktur organisasi yang ditambahkan.
                        </p>

                        <a href="{{ route('admin.struktur.create') }}" class="admin-btn admin-btn-primary">
                            + Tambah Data
                        </a>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/admin-struktur.css') }}">

@endpush