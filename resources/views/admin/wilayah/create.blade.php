@extends('layouts.admin')

@section('title', 'Tambah Wilayah Kerja')

@section('content')

    <div class="admin-page">

        <div class="admin-page-header">

            <div>

                <span class="admin-label">
                    KONTEN WEBSITE
                </span>

                <h1>
                    Tambah Wilayah Kerja
                </h1>

                <p>
                    Tambahkan data wilayah kerja Puskesmas Singaparna.
                </p>

            </div>

        </div>


        <div class="admin-card">

            <form action="{{ route('admin.wilayah.store') }}" method="POST" class="wilayah-form">

                @csrf


                <div class="form-grid">

                    <div class="form-group">

                        <label>
                            Kecamatan
                        </label>

                        <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" placeholder="Contoh: Singaparna"
                            required>

                        @error('kecamatan')
                            <small class="form-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label>
                            Desa / Kelurahan
                        </label>

                        <input type="text" name="desa_kelurahan" value="{{ old('desa_kelurahan') }}"
                            placeholder="Contoh: Singasari" required>

                        @error('desa_kelurahan')
                            <small class="form-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label>
                            Jumlah Penduduk
                        </label>

                        <input type="number" name="jumlah_penduduk" value="{{ old('jumlah_penduduk') }}"
                            placeholder="Contoh: 12500" min="0">

                    </div>


                    <div class="form-group">

                        <label>
                            Luas Wilayah
                        </label>

                        <input type="text" name="luas_wilayah" value="{{ old('luas_wilayah') }}"
                            placeholder="Contoh: 2,5 km²">

                    </div>


                    <div class="form-group full">

                        <label>
                            Keterangan
                        </label>

                        <textarea name="keterangan" rows="5"
                            placeholder="Masukkan informasi tambahan mengenai wilayah...">{{ old('keterangan') }}</textarea>

                    </div>


                    <div class="form-group">

                        <label>
                            Urutan
                        </label>

                        <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0">

                        <small>
                            Semakin kecil angka, semakin awal ditampilkan.
                        </small>

                    </div>

                </div>


                <div class="form-actions">

                    <a href="{{ route('admin.wilayah.index') }}" class="btn-cancel">
                        Batal
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

    <link rel="stylesheet" href="{{ asset('css/admin-wilayah.css') }}">

@endpush