@extends('layouts.admin')

@section('title', 'Edit Pengumuman - Admin Puskesmas')

@section('page-title', 'Edit Pengumuman')

@section('content')

    <div class="admin-page">

        {{-- HEADER --}}
        <div class="admin-content-header">

            <div>

                <span class="admin-section-label">
                    KONTEN WEBSITE
                </span>

                <h2>
                    Edit Pengumuman
                </h2>

                <p>
                    Perbarui informasi pengumuman Puskesmas Singaparna.
                </p>

            </div>

            <a href="{{ route('admin.pengumuman.index') }}" class="admin-btn admin-btn-secondary">
                ← Kembali
            </a>

        </div>


        {{-- FORM --}}
        <div class="admin-form-card">

            <form action="{{ route('admin.pengumuman.update', $pengumuman) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')


                {{-- JUDUL --}}
                <div class="admin-form-group">

                    <label for="judul">
                        Judul Pengumuman
                        <span>*</span>
                    </label>

                    <input type="text" id="judul" name="judul" value="{{ old('judul', $pengumuman->judul) }}"
                        placeholder="Masukkan judul pengumuman" required>

                    @error('judul')
                        <small class="admin-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- RINGKASAN --}}
                <div class="admin-form-group">

                    <label for="ringkasan">
                        Ringkasan pengumuman
                    </label>

                    <textarea id="ringkasan" name="ringkasan" rows="4"
                        placeholder="Masukkan ringkasan pengumuman">{{ old('ringkasan', $pengumuman->ringkasan) }}</textarea>

                    @error('ringkasan')
                        <small class="admin-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- ISI --}}
                <div class="admin-form-group">

                    <label for="isi">
                        Isi pengumuman
                        <span>*</span>
                    </label>

                    <textarea id="isi" name="isi" rows="10" placeholder="Tuliskan isi pengumuman..."
                        required>{{ old('isi', $pengumuman->isi) }}</textarea>

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
                            Tanggal Pengumuman
                            <span>*</span>
                        </label>

                        <input type="date" id="tanggal" name="tanggal"
                            value="{{ old('tanggal', optional($pengumuman->tanggal)->format('Y-m-d')) }}" required>

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

                        <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $pengumuman->penulis) }}"
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

                    @if($pengumuman->foto)

                        <div class="pengumuman-edit-preview">

                            <img src="{{ asset('storage/' . $pengumuman->foto) }}" alt="{{ $pengumuman->judul }}">

                        </div>

                    @else

                        <small class="admin-form-help">
                            Belum ada foto pengumuman.
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
                        Status Pengumuman
                    </label>

                    <select id="status" name="status">

                        <option value="1" {{ old('status', $pengumuman->status) == '1' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="0" {{ old('status', $pengumuman->status) == '0' ? 'selected' : '' }}>
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

                    <a href="{{ route('admin.pengumuman.index') }}" class="admin-btn admin-btn-secondary">
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

    <link rel="stylesheet" href="{{ asset('css/admin-pengumuman.css') }}">

@endpush