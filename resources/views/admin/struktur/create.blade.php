@extends('layouts.admin')

@section('title', 'Tambah Struktur Organisasi')

@section('content')

    <div class="admin-page">

        <div class="admin-page-header">

            <div>

                <span class="admin-label">
                    KONTEN WEBSITE
                </span>

                <h1>
                    Tambah Struktur Organisasi
                </h1>

                <p>
                    Tambahkan jabatan dan anggota organisasi.
                </p>

            </div>

        </div>


        <div class="admin-card">

            <form action="{{ route('admin.struktur.store') }}" method="POST" enctype="multipart/form-data"
                class="admin-form">

                @csrf


                <div class="form-group">

                    <label>
                        Jabatan
                    </label>

                    <input type="text" name="jabatan" value="{{ old('jabatan') }}" placeholder="Contoh: Kepala Puskesmas"
                        required>

                    @error('jabatan')
                        <small class="error-text">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <div class="form-group">

                    <label>
                        Nama
                    </label>

                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>

                    @error('nama')
                        <small class="error-text">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <div class="form-group">

                    <label>
                        Foto
                    </label>

                    <input type="file" name="foto" accept=".jpg,.jpeg,.png,.webp">

                    <small>
                        Maksimal 2 MB.
                    </small>

                </div>


                <div class="form-group">

                    <label>
                        Urutan Tampilan
                    </label>

                    <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0">

                    <small>
                        Semakin kecil angka, semakin awal ditampilkan.
                    </small>

                </div>


                <div class="form-actions">

                    <a href="{{ route('admin.struktur.index') }}" class="admin-btn admin-btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="admin-btn admin-btn-primary">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/admin-struktur.css') }}">

@endpush