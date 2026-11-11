@extends('layouts.admin')

@section('title', 'Tambah Promkes')
@section('page-title', 'Tambah Konten Promkes')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-promkes.css') }}">
@endpush

@section('content')
    <div class="promkes-admin">

        <div class="promkes-header">
            <div>
                <h2>Tambah Konten Promkes</h2>
                <p>Tambahkan informasi dan edukasi kesehatan terbaru.</p>
            </div>

            <a href="{{ route('admin.promkes.index') }}" class="btn-edit-promkes">
                ← Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="alert-error-promkes">
                <strong>Mohon periksa kembali data berikut:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="promkes-form-card">
            <form action="{{ route('admin.promkes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="promkes-form-group">
                    <label for="judul">Judul Konten <span>*</span></label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                        placeholder="Contoh: Pentingnya Menjaga Pola Hidup Sehat" required>
                    @error('judul')
                        <small class="promkes-field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="promkes-form-group">
                    <label for="ringkasan">Ringkasan Konten</label>
                    <textarea id="ringkasan" name="ringkasan" rows="3" maxlength="1000"
                        placeholder="Tuliskan ringkasan singkat untuk ditampilkan pada halaman Promkes.">{{ old('ringkasan') }}</textarea>
                    @error('ringkasan')
                        <small class="promkes-field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="promkes-form-group">
                    <label for="isi">Isi Konten <span>*</span></label>
                    <textarea id="isi" name="isi" rows="10"
                        placeholder="Tuliskan informasi atau edukasi kesehatan secara lengkap..."
                        required>{{ old('isi') }}</textarea>
                    @error('isi')
                        <small class="promkes-field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="promkes-form-row">
                    <div class="promkes-form-group">
                        <label for="tanggal">Tanggal Publikasi</label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}">
                        @error('tanggal')
                            <small class="promkes-field-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="promkes-form-group">
                        <label for="penulis">Nama Penulis</label>
                        <input type="text" id="penulis" name="penulis" value="{{ old('penulis') }}"
                            placeholder="Contoh: Tim Promkes Puskesmas">
                        @error('penulis')
                            <small class="promkes-field-error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="promkes-form-group">
                    <label for="foto">Foto Sampul</label>
                    <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,.webp">
                    <small class="promkes-form-help">
                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </small>
                    @error('foto')
                        <small class="promkes-field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="promkes-form-group">
                    <label for="status">Status Publikasi <span>*</span></label>
                    <select id="status" name="status" required>
                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>
                            Aktif — tampil di website
                        </option>
                        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
                            Nonaktif — disembunyikan
                        </option>
                    </select>
                    @error('status')
                        <small class="promkes-field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="promkes-form-actions">
                    <a href="{{ route('admin.promkes.index') }}" class="btn-batal-promkes">
                        Batal
                    </a>

                    <button type="submit" class="btn-tambah-promkes">
                        Simpan Konten
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection