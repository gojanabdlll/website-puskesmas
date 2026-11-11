@extends('layouts.admin')

@section('title', 'Tambah Foto Galeri - Admin Puskesmas')
@section('page-title', 'Tambah Foto Galeri')

@section('content')
    <div class="admin-page galeri-admin-page">

        <div class="admin-content-header">
            <div>
                <span class="admin-section-label">KONTEN WEBSITE</span>
                <h2>Tambah Foto Galeri</h2>
                <p>Tambahkan dokumentasi kegiatan Puskesmas Singaparna.</p>
            </div>

            <a href="{{ route('admin.galeri.index') }}" class="admin-btn admin-btn-secondary">
                ← Kembali
            </a>
        </div>

        <div class="galeri-form-card">
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="galeri-form-group">
                    <label for="judul">Judul Kegiatan <span>*</span></label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                        placeholder="Contoh: Kegiatan Senam Prolanis" required>
                    @error('judul') <small class="galeri-error">{{ $message }}</small> @enderror
                </div>

                <div class="galeri-form-group">
                    <label for="deskripsi">Deskripsi Kegiatan</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"
                        placeholder="Tuliskan keterangan kegiatan...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <small class="galeri-error">{{ $message }}</small> @enderror
                </div>

                <div class="galeri-form-grid">
                    <div class="galeri-form-group">
                        <label for="tanggal">Tanggal Kegiatan</label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                        @error('tanggal') <small class="galeri-error">{{ $message }}</small> @enderror
                    </div>

                    <div class="galeri-form-group">
                        <label for="urutan">Urutan Tampilan</label>
                        <input type="number" id="urutan" name="urutan" min="0" value="{{ old('urutan', 0) }}">
                        @error('urutan') <small class="galeri-error">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="galeri-form-group">
                    <label for="foto">Foto Kegiatan <span>*</span></label>
                    <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,.webp" required>
                    <small class="galeri-form-help">
                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </small>
                    @error('foto') <small class="galeri-error">{{ $message }}</small> @enderror
                </div>

                <div class="galeri-form-group">
                    <label for="status">Status Foto</label>
                    <select id="status" name="status" required>
                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Aktif — tampil di website</option>
                        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Tidak Aktif — disembunyikan</option>
                    </select>
                    @error('status') <small class="galeri-error">{{ $message }}</small> @enderror
                </div>

                <div class="galeri-form-actions">
                    <a href="{{ route('admin.galeri.index') }}" class="admin-btn admin-btn-secondary">
                        Batal
                    </a>

                    <button type="submit" class="admin-btn admin-btn-primary">
                        Simpan Foto
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-galeri.css') }}">
@endpush