@extends('layouts.admin')

@section('title', 'Edit Promkes')
@section('page-title', 'Edit Konten Promkes')

@push('styles')
    <link rel="stylesheet"
        href="{{ asset('css/admin-promkes.css') }}?v={{ filemtime(public_path('css/admin-promkes.css')) }}">
@endpush

@section('content')
    <div class="pk-admin-container">

        {{-- HEADER HALAMAN --}}
        <div class="pk-page-heading">
            <div>
                <h2>Edit Konten Promkes</h2>
                <p>Perbarui informasi dan edukasi kesehatan.</p>
            </div>

            <a href="{{ route('admin.promkes.index') }}" class="pk-btn-cancel">
                &larr; Kembali
            </a>
        </div>

        {{-- PESAN VALIDASI --}}
        @if ($errors->any())
            <div class="pk-alert-error">
                <strong>Mohon periksa kembali data berikut:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM EDIT --}}
        <div class="pk-form-panel">
            <form action="{{ route('admin.promkes.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- JUDUL --}}
                <div class="pk-form-group">
                    <label for="judul">
                        Judul Konten <span>*</span>
                    </label>

                    <input type="text" id="judul" name="judul" value="{{ old('judul', $item->judul) }}"
                        placeholder="Masukkan judul konten" required>

                    @error('judul')
                        <small class="pk-field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- RINGKASAN --}}
                <div class="pk-form-group">
                    <label for="ringkasan">Ringkasan Konten</label>

                    <textarea id="ringkasan" name="ringkasan" rows="3" maxlength="1000"
                        placeholder="Tuliskan ringkasan singkat">{{ old('ringkasan', $item->ringkasan) }}</textarea>

                    @error('ringkasan')
                        <small class="pk-field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- ISI KONTEN --}}
                <div class="pk-form-group">
                    <label for="isi">
                        Isi Konten <span>*</span>
                    </label>

                    <textarea id="isi" name="isi" rows="10" placeholder="Tuliskan isi konten secara lengkap"
                        required>{{ old('isi', $item->isi) }}</textarea>

                    @error('isi')
                        <small class="pk-field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- TANGGAL DAN PENULIS --}}
                <div class="pk-form-row">

                    <div class="pk-form-group">
                        <label for="tanggal">Tanggal Publikasi</label>

                        <input type="date" id="tanggal" name="tanggal"
                            value="{{ old('tanggal', $item->tanggal ? \Illuminate\Support\Carbon::parse($item->tanggal)->format('Y-m-d') : '') }}">

                        @error('tanggal')
                            <small class="pk-field-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="pk-form-group">
                        <label for="penulis">Nama Penulis</label>

                        <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $item->penulis) }}"
                            placeholder="Nama penulis">

                        @error('penulis')
                            <small class="pk-field-error">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                {{-- FOTO SAMPUL --}}
                <div class="pk-form-group">
                    <label for="foto">Ganti Foto Sampul</label>

                    @if ($item->foto)
                        <div class="pk-current-image">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}">
                        </div>
                        <small>Foto sampul saat ini. Pilih foto baru jika ingin menggantinya.</small>
                    @endif

                    <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,.webp">

                    <small>
                        Kosongkan jika tidak ingin mengganti foto.
                        Format JPG, JPEG, PNG, atau WEBP, maksimal 2 MB.
                    </small>

                    @error('foto')
                        <small class="pk-field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- STATUS --}}
                <div class="pk-form-group">
                    <label for="status">
                        Status Publikasi <span>*</span>
                    </label>

                    <select id="status" name="status" required>
                        <option value="1" {{ (string) old('status', (int) $item->status) === '1' ? 'selected' : '' }}>
                            Aktif — tampil di website
                        </option>

                        <option value="0" {{ (string) old('status', (int) $item->status) === '0' ? 'selected' : '' }}>
                            Nonaktif — disembunyikan
                        </option>
                    </select>

                    @error('status')
                        <small class="pk-field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- TOMBOL --}}
                <div class="pk-form-actions">
                    <a href="{{ route('admin.promkes.index') }}" class="pk-btn-cancel">
                        Batal
                    </a>

                    <button type="submit" class="pk-btn-add">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection