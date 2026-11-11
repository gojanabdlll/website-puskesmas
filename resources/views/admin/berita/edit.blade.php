@extends('layouts.admin')

@section('title', 'Edit Berita - Admin Puskesmas')

@section('page-title', 'Edit Berita')

@section('content')

    <div class="admin-page">

        {{-- HEADER --}}
        <div class="admin-content-header">

            <div>

                <span class="admin-section-label">
                    KONTEN WEBSITE
                </span>

                <h2>
                    Edit Berita
                </h2>

                <p>
                    Perbarui informasi berita Puskesmas Singaparna.
                </p>

            </div>

            <a href="{{ route('admin.berita.index') }}" class="admin-btn admin-btn-secondary">
                ← Kembali
            </a>

        </div>


        {{-- FORM --}}
        <div class="admin-form-card">

            <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')


                {{-- JUDUL --}}
                <div class="admin-form-group">

                    <label for="judul">
                        Judul Berita
                        <span>*</span>
                    </label>

                    <input type="text" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}"
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
                        placeholder="Masukkan ringkasan berita">{{ old('ringkasan', $berita->ringkasan) }}</textarea>

                    @error('ringkasan')
                        <small class="admin-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- ISI --}}
                <div class="admin-form-group">

                    <label for="isi">
                        Isi Berita
                        <span>*</span>
                    </label>

                    <textarea id="isi" name="isi" rows="10" placeholder="Tuliskan isi berita..."
                        required>{{ old('isi', $berita->isi) }}</textarea>

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

                        <input type="date" id="tanggal" name="tanggal"
                            value="{{ old('tanggal', optional($berita->tanggal)->format('Y-m-d')) }}" required>

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

                        <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $berita->penulis) }}"
                            placeholder="Contoh: Admin Puskesmas">

                        @error('penulis')
                            <small class="admin-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>


                {{-- FOTO LAMA --}}
                <div class="admin-form-group">

                    <label>
                        Foto Saat Ini
                    </label>

                    @if($berita->foto)

                        <div class="berita-edit-preview">

                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}">

                        </div>

                    @else

                        <small class="admin-form-help">
                            Belum ada foto berita.
                        </small>

                    @endif

                </div>


                {{-- FOTO BARU --}}
                <div class="admin-form-group">

                    <label for="foto">
                        Ganti Foto
                    </label>

                    <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,.webp">

                    <small class="admin-form-help">
                        Kosongkan jika tidak ingin mengganti foto.
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

                        <option value="1" {{ old('status', $berita->status) == '1' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="0" {{ old('status', $berita->status) == '0' ? 'selected' : '' }}>
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
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/admin-berita.css') }}">

@endpush