@extends('layouts.admin')

@section('title', 'Edit Struktur Organisasi')

@section('content')

    <div class="admin-page">

        <div class="admin-page-header">

            <div>

                <span class="admin-label">
                    KONTEN WEBSITE
                </span>

                <h1>
                    Edit Struktur Organisasi
                </h1>

                <p>
                    Perbarui data struktur organisasi.
                </p>

            </div>

        </div>


        <div class="admin-card">

            <form action="{{ route('admin.struktur.update', $struktur) }}" method="POST" enctype="multipart/form-data"
                class="admin-form">

                @csrf

                @method('PUT')


                <div class="form-group">

                    <label>
                        Jabatan
                    </label>

                    <input type="text" name="jabatan" value="{{ old('jabatan', $struktur->jabatan) }}" required>

                </div>


                <div class="form-group">

                    <label>
                        Nama
                    </label>

                    <input type="text" name="nama" value="{{ old('nama', $struktur->nama) }}" required>

                </div>


                <div class="form-group">

                    <label>
                        Foto
                    </label>


                    @if($struktur->foto)

                        <img src="{{ asset('storage/' . $struktur->foto) }}" class="edit-photo" alt="{{ $struktur->nama }}">

                    @endif


                    <input type="file" name="foto" accept=".jpg,.jpeg,.png,.webp">

                </div>


                <div class="form-group">

                    <label>
                        Urutan Tampilan
                    </label>

                    <input type="number" name="urutan" value="{{ old('urutan', $struktur->urutan) }}" min="0">

                </div>


                <div class="form-actions">

                    <a href="{{ route('admin.struktur.index') }}" class="admin-btn admin-btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="admin-btn admin-btn-primary">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/admin-struktur.css') }}">

@endpush