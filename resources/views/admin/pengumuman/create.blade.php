@extends('layouts.admin')

@section('title', 'Tambah Pengumuman - Admin Puskesmas')

@section('page-title', 'Tambah Pengumuman')

@section('content')

    <div class="admin-page">

        {{-- HEADER --}}
        <div class="admin-content-header">

            <div>

                <span class="admin-section-label">
                    KONTEN WEBSITE
                </span>

                <h2>
                    Tambah Pengumuman
                </h2>

                <p>
                    Tambahkan informasi pengumuman baru
                    untuk ditampilkan kepada masyarakat.
                </p>

            </div>

            <a href="{{ route('admin.pengumuman.index') }}" class="admin-btn admin-btn-secondary">
                ← Kembali
            </a>

        </div>


        {{-- FORM --}}
        <div class="pengumuman-form-card">

            <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">

                @csrf


                {{-- JUDUL --}}
                <div class="pengumuman-form-group">

                    <label for="judul">
                        Judul Pengumuman
                        <span>*</span>
                    </label>

                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                        placeholder="Masukkan judul Pengumuman" required>

                    @error('judul')
                        <small class="pengumuman-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- RINGKASAN --}}
                <div class="pengumuman-form-group">

                    <label for="ringkasan">
                        Ringkasan Pengumuman
                    </label>

                    <textarea id="ringkasan" name="ringkasan" rows="4"
                        placeholder="Masukkan ringkasan pengumuman">{{ old('ringkasan') }}</textarea>

                    @error('ringkasan')
                        <small class="pengumuman-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- ISI --}}
                <div class="pengumuman-form-group">

                    <label for="isi">
                        Isi Pengumuman
                        <span>*</span>
                    </label>

                    <textarea id="isi" name="isi" rows="8" placeholder="Tuliskan isi pengumuman..."
                        required>{{ old('isi') }}</textarea>

                    @error('isi')
                        <small class="pengumuman-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- TANGGAL + PENULIS --}}
                <div class="pengumuman-form-grid">

                    {{-- TANGGAL --}}
                    <div class="pengumuman-form-group">

                        <label for="tanggal">
                            Tanggal Pengumuman
                            <span>*</span>
                        </label>

                        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>

                        @error('tanggal')
                            <small class="pengumuman-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- PENULIS --}}
                    <div class="pengumuman-form-group">

                        <label for="penulis">
                            Penulis
                        </label>

                        <input type="text" id="penulis" name="penulis" value="{{ old('penulis') }}"
                            placeholder="Contoh: Admin Puskesmas">

                        @error('penulis')
                            <small class="pengumuman-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>


                {{-- FOTO --}}
                <div class="pengumuman-form-group">

                    <label for="foto">
                        Foto / Gambar Pengumuman
                    </label>

                    <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,.webp">

                    <small class="pengumuman-form-help">
                        Format JPG, JPEG, PNG, atau WEBP.
                        Maksimal 2 MB.
                    </small>

                    @error('foto')
                        <small class="pengumuman-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- STATUS --}}
                <div class="pengumuman-form-group">

                    <label for="status">
                        Status Pengumuman
                    </label>

                    <select id="status" name="status">

                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                            Tidak Aktif
                        </option>

                    </select>

                    @error('status')
                        <small class="pengumuman-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- BUTTON --}}
                <div class="pengumuman-form-actions">

                    <a href="{{ route('admin.pengumuman.index') }}" class="admin-btn admin-btn-secondary">
                        Batal
                    </a>

                    <button type="submit" class="admin-btn admin-btn-primary">
                        Simpan Pengumuman
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/admin-pengumuman.css') }}">

@endpush