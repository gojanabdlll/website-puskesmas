@extends('layouts.admin')

@section('title', 'Edit Wilayah Kerja')

@section('content')

    <div class="admin-page">

        <div class="admin-page-header">

            <div>

                <span class="admin-label">
                    KONTEN WEBSITE
                </span>

                <h1>
                    Edit Wilayah Kerja
                </h1>

                <p>
                    Perbarui informasi wilayah kerja.
                </p>

            </div>

        </div>


        <div class="admin-card">

            <form action="{{ route('admin.wilayah.update', $wilayah) }}" method="POST" class="wilayah-form">

                @csrf
                @method('PUT')


                <div class="form-grid">

                    <div class="form-group">

                        <label>
                            Kecamatan
                        </label>

                        <input type="text" name="kecamatan" value="{{ old('kecamatan', $wilayah->kecamatan) }}" required>

                    </div>


                    <div class="form-group">

                        <label>
                            Desa / Kelurahan
                        </label>

                        <input type="text" name="desa_kelurahan"
                            value="{{ old('desa_kelurahan', $wilayah->desa_kelurahan) }}" required>

                    </div>


                    <div class="form-group">

                        <label>
                            Jumlah Penduduk
                        </label>

                        <input type="number" name="jumlah_penduduk"
                            value="{{ old('jumlah_penduduk', $wilayah->jumlah_penduduk) }}" min="0">

                    </div>


                    <div class="form-group">

                        <label>
                            Luas Wilayah
                        </label>

                        <input type="text" name="luas_wilayah" value="{{ old('luas_wilayah', $wilayah->luas_wilayah) }}">

                    </div>


                    <div class="form-group full">

                        <label>
                            Keterangan
                        </label>

                        <textarea name="keterangan" rows="5">{{ old('keterangan', $wilayah->keterangan) }}</textarea>

                    </div>


                    <div class="form-group">

                        <label>
                            Urutan
                        </label>

                        <input type="number" name="urutan" value="{{ old('urutan', $wilayah->urutan) }}" min="0">

                    </div>

                </div>


                <div class="form-actions">

                    <a href="{{ route('admin.wilayah.index') }}" class="btn-cancel">
                        Batal
                    </a>

                    <button type="submit" class="admin-btn">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/admin-wilayah.css') }}">

@endpush