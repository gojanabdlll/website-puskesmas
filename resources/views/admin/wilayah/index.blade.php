@extends('layouts.admin')

@section('title', 'Wilayah Kerja')

@section('content')

    <div class="admin-page">

        @if(session('success'))

            <div class="admin-alert success">
                ✓ {{ session('success') }}
            </div>

        @endif


        <div class="admin-page-header">

            <div>

                <span class="admin-label">
                    KONTEN WEBSITE
                </span>

                <h1>
                    Wilayah Kerja
                </h1>

                <p>
                    Kelola data wilayah kerja Puskesmas Singaparna.
                </p>

            </div>


            <a href="{{ route('admin.wilayah.create') }}" class="admin-btn">
                + Tambah Wilayah
            </a>

        </div>


        <div class="admin-card">

            <div class="admin-card-header">

                <div>

                    <h2>
                        Daftar Wilayah Kerja
                    </h2>

                    <p>
                        Data wilayah yang ditambahkan akan tampil
                        otomatis pada website.
                    </p>

                </div>

            </div>


            @if($wilayah->count() > 0)

                <div class="wilayah-table-wrapper">

                    <table class="wilayah-table">

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Kecamatan</th>

                                <th>Desa / Kelurahan</th>

                                <th>Jumlah Penduduk</th>

                                <th>Luas Wilayah</th>

                                <th>Aksi</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($wilayah as $item)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $item->kecamatan }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $item->desa_kelurahan }}
                                    </td>

                                    <td>

                                        @if($item->jumlah_penduduk)

                                            {{ number_format($item->jumlah_penduduk, 0, ',', '.') }}

                                            jiwa

                                        @else

                                            -

                                        @endif

                                    </td>

                                    <td>
                                        {{ $item->luas_wilayah ?: '-' }}
                                    </td>

                                    <td>

                                        <div class="admin-actions">

                                            <a href="{{ route('admin.wilayah.edit', $item) }}" class="btn-edit">
                                                Edit
                                            </a>


                                            <form action="{{ route('admin.wilayah.destroy', $item) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data wilayah ini?')">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" class="btn-delete">
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

                <div class="admin-empty">

                    <div class="admin-empty-icon">
                        📍
                    </div>

                    <h3>
                        Belum Ada Data Wilayah
                    </h3>

                    <p>
                        Silakan tambahkan data wilayah kerja
                        Puskesmas terlebih dahulu.
                    </p>


                    <a href="{{ route('admin.wilayah.create') }}" class="admin-btn admin-btn-primary">
                        + Tambah Wilayah
                    </a>

                </div>

            @endif

        </div>

    </div>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/admin-wilayah.css') }}">

@endpush