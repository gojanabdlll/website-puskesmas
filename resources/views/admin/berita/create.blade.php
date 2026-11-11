@extends('layouts.admin')

@section('title', 'Tambah Berita - Admin Puskesmas')

@section('page-title', 'Tambah Berita')

@section('content')

    <div class="admin-page">

        {{-- HEADER --}}
        <div class="admin-content-header">

            <div>
                <span class="admin-section-label">
                    KONTEN WEBSITE
                </span>

                <h2>
                    Tambah Berita
                </h2>

                <p>
                    Tambahkan berita baru yang akan ditampilkan
                    pada website Puskesmas Singaparna.
                </p>
            </div>

            <a href="{{ route('admin.berita.index') }}" class="admin-btn admin-btn-secondary">
                ← Kembali
            </a>

        </div>


        {{-- FORM --}}
        <div class="admin-form-card">

            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">

                @csrf


                {{-- JUDUL --}}
                <div class="admin-form-group">

                    <label for="judul">
                        Judul Berita
                        <span>*</span>
                    </label>

                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                        placeholder="Masukkan judul berita" required>

                    @error('judul')
                        <small class="admin-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- RINGKASAN --}}
                <div class="admin-form-group">

                    <label for="ringkasan">
                        Ringkasan Berita
                    </label>

                    <textarea id="ringkasan" name="ringkasan" rows="4"
                        placeholder="Masukkan ringkasan singkat berita">{{ old('ringkasan') }}</textarea>

                    @error('ringkasan')
                        <small class="admin-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- ISI BERITA --}}
                <div class="admin-form-group">

                    <label for="isi">
                        Isi Berita
                        <span>*</span>
                    </label>

                    <textarea id="isi" name="isi" rows="10" placeholder="Tuliskan isi berita..."
                        required>{{ old('isi') }}</textarea>

                    @error('isi')
                        <small class="admin-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- TANGGAL + PENULIS --}}
                <div class="admin-form-grid">

                    <div class="admin-form-group">

                        <label for="tanggal">
                            Tanggal Berita
                            <span>*</span>
                        </label>

                        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>

                        @error('tanggal')
                            <small class="admin-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <div class="admin-form-group">

                        <label for="penulis">
                            Penulis
                        </label>

                        <input type="text" id="penulis" name="penulis" value="{{ old('penulis') }}"
                            placeholder="Contoh: Admin Puskesmas">

                        @error('penulis')
                            <small class="admin-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>


                {{-- FOTO --}}
                <div class="admin-form-group">

                    <label for="foto">
                        Foto Berita
                    </label>

                    <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,.webp">

                    <small class="admin-form-help">
                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </small>

                    @error('foto')
                        <small class="admin-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- STATUS --}}
                <div class="admin-form-group">

                    <label for="status">
                        Status Berita
                    </label>

                    <select id="status" name="status">

                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
                            Tidak Aktif
                        </option>

                    </select>

                    @error('status')
                        <small class="admin-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- BUTTON --}}
                <div class="admin-form-actions">

                    <a href="{{ route('admin.berita.index') }}" class="admin-btn admin-btn-secondary">
                        Batal
                    </a>

                    <button type="submit" class="admin-btn admin-btn-primary">
                        Simpan Berita
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/admin-berita.css') }}">

@endpush