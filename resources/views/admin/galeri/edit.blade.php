@extends('layouts.admin')

@section('title', 'Edit Foto Galeri - Admin Puskesmas')
@section('page-title', 'Edit Foto Galeri')

@section('content')
    <div class="admin-page galeri-admin-page">

        <div class="admin-content-header">
            <div>
                <span class="admin-section-label">KONTEN WEBSITE</span>
                <h2>Edit Foto Galeri</h2>
                <p>Perbarui informasi atau ganti foto kegiatan.</p>
            </div>

            <a href="{{ route('admin.galeri.index') }}" class="admin-btn admin-btn-secondary">
                ← Kembali
            </a>
        </div>

        <div class="galeri-form-card">
            <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="galeri-form-group">
                    <label for="judul">Judul Kegiatan <span>*</span></label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $galeri->judul) }}" required>
                    @error('judul') <small class="galeri-error">{{ $message }}</small> @enderror
                </div>

                <div class="galeri-form-group">
                    <label for="deskripsi">Deskripsi Kegiatan</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                    @error('deskripsi') <small class="galeri-error">{{ $message }}</small> @enderror
                </div>

                <div class="galeri-form-grid">
                    <div class="galeri-form-group">
                        <label for="tanggal">Tanggal Kegiatan</label>
                        <input type="date" id="tanggal" name="tanggal"
                            value="{{ old('tanggal', $galeri->tanggal?->format('Y-m-d')) }}">
                        @error('tanggal') <small class="galeri-error">{{ $message }}</small> @enderror
                    </div>

                    <div class="galeri-form-group">
                        <label for="urutan">Urutan Tampilan</label>
                        <input type="number" id="urutan" name="urutan" min="0" value="{{ old('urutan', $galeri->urutan) }}">
                        @error('urutan') <small class="galeri-error">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="galeri-form-group">
                    <label>Foto Saat Ini</label>
                    <div class="galeri-current-photo">
                        <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}">
                    </div>
                </div>

                <div class="galeri-form-group">
                    <label for="foto">Ganti Foto (Opsional)</label>
                    <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,.webp">
                    <small class="galeri-form-help">
                        Kosongkan jika tidak ingin mengganti foto. Maksimal 2 MB.
                    </small>
                    @error('foto') <small class="galeri-error">{{ $message }}</small> @enderror
                </div>

                <div class="galeri-form-group">
                    <label for="status">Status Foto</label>
                    <select id="status" name="status" required>
                        <option value="1" {{ old('status', (string) $galeri->status) === '1' ? 'selected' : '' }}>Aktif —
                            tampil di website</option>
                        <option value="0" {{ old('status', (string) $galeri->status) === '0' ? 'selected' : '' }}>Tidak Aktif
                            — disembunyikan</option>
                    </select>
                    @error('status') <small class="galeri-error">{{ $message }}</small> @enderror
                </div>

                <div class="galeri-form-actions">
                    <a href="{{ route('admin.galeri.index') }}" class="admin-btn admin-btn-secondary">
                        Batal
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
    <link rel="stylesheet" href="{{ asset('css/admin-galeri.css') }}">
@endpush