@extends('layouts.admin')

@section('title', 'Profil Puskesmas')

@section('content')

    <div class="admin-profil-page">

        {{-- HEADER HALAMAN --}}
        <div class="admin-profil-header">

            <div class="admin-profil-heading">

                <span class="admin-profil-label">
                    INFORMASI PUSKESMAS
                </span>

                <h1>
                    Data Profil Puskesmas
                </h1>

                <p>
                    Kelola informasi utama Puskesmas yang akan
                    ditampilkan kepada masyarakat.
                </p>

            </div>

        </div>


        {{-- PESAN BERHASIL --}}
        @if(session('success'))

            <div class="alert-success">

                <div class="alert-success-icon">
                    ✓
                </div>

                <div>
                    <strong>Berhasil!</strong>

                    <p>
                        {{ session('success') }}
                    </p>
                </div>

            </div>

        @endif


        {{-- PESAN ERROR --}}
        @if($errors->any())

            <div class="alert-error">

                <div class="alert-error-icon">
                    !
                </div>

                <div>

                    <strong>
                        Data belum dapat disimpan.
                    </strong>

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        @endif


        {{-- FORM PROFIL --}}
        <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="profil-form">

            @csrf

            @method('PUT')


            {{-- =====================================================
            IDENTITAS PUSKESMAS
            ====================================================== --}}

            <div class="profil-card">

                <div class="profil-card-header">

                    <div class="profil-card-icon">
                        🏥
                    </div>

                    <div>

                        <span>
                            INFORMASI DASAR
                        </span>

                        <h2>
                            Identitas Puskesmas
                        </h2>

                        <p>
                            Informasi utama mengenai Puskesmas.
                        </p>

                    </div>

                </div>


                <div class="profil-card-body">

                    {{-- NAMA --}}
                    <div class="form-group full">

                        <label for="nama_puskesmas">
                            Nama Puskesmas
                            <span>*</span>
                        </label>

                        <input type="text" id="nama_puskesmas" name="nama_puskesmas"
                            value="{{ old('nama_puskesmas', $profil->nama_puskesmas ?? 'Puskesmas Singaparna') }}"
                            placeholder="Masukkan nama Puskesmas" required>

                    </div>


                    {{-- TELEPON --}}
                    <div class="form-group">

                        <label for="telepon">
                            Nomor Telepon
                        </label>

                        <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $profil->telepon ?? '') }}"
                            placeholder="Contoh: 0265xxxxxxx">

                    </div>


                    {{-- EMAIL --}}
                    <div class="form-group">

                        <label for="email">
                            Email
                        </label>

                        <input type="email" id="email" name="email" value="{{ old('email', $profil->email ?? '') }}"
                            placeholder="contoh@puskesmas.go.id">

                    </div>


                    {{-- ALAMAT --}}
                    <div class="form-group full">

                        <label for="alamat">
                            Alamat
                        </label>

                        <textarea id="alamat" name="alamat" rows="4"
                            placeholder="Masukkan alamat lengkap Puskesmas">{{ old('alamat', $profil->alamat ?? '') }}</textarea>

                    </div>

                </div>

            </div>


            {{-- =====================================================
            DESKRIPSI
            ====================================================== --}}

            <div class="profil-card">

                <div class="profil-card-header">

                    <div class="profil-card-icon">
                        📝
                    </div>

                    <div>

                        <span>
                            TENTANG PUSKESMAS
                        </span>

                        <h2>
                            Deskripsi Puskesmas
                        </h2>

                        <p>
                            Informasi singkat mengenai Puskesmas.
                        </p>

                    </div>

                </div>


                <div class="profil-card-body">

                    <div class="form-group full">

                        <label for="deskripsi">
                            Deskripsi
                        </label>

                        <textarea id="deskripsi" name="deskripsi" rows="7"
                            placeholder="Tuliskan deskripsi mengenai Puskesmas...">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>

                        <small>
                            Deskripsi ini nantinya dapat ditampilkan pada halaman profil website.
                        </small>

                    </div>
                    {{-- FOTO DI SAMPING DESKRIPSI --}}
                    <div class="form-group full">
                        <label for="foto_deskripsi">
                            Foto di Samping Deskripsi
                        </label>

                        @if(isset($profil) && $profil && $profil->foto_deskripsi)
                            <div style="margin-bottom: 15px;">
                                <img src="{{ asset('storage/' . $profil->foto_deskripsi) }}" alt="Foto Deskripsi Puskesmas"
                                    style="
                                                                                                    width: 220px;
                                                                                                    max-width: 100%;
                                                                                                    height: 160px;
                                                                                                    object-fit: cover;
                                                                                                    border-radius: 12px;
                                                                                                    border: 1px solid #e3ecee;
                                                                                                ">
                            </div>
                        @else
                            <p>Belum ada foto deskripsi yang diunggah.</p>
                        @endif

                        <input type="file" id="foto_deskripsi" name="foto_deskripsi" accept=".jpg,.jpeg,.png,.webp">

                        <small>
                            Unggah foto yang akan tampil di sebelah deskripsi.
                            Format JPG, JPEG, PNG, atau WEBP, maksimal 2 MB.
                            Kosongkan jika ingin mempertahankan foto saat ini.
                        </small>
                    </div>

                </div>


            </div>

            {{-- =====================================================
            VISI MISI
            ====================================================== --}}

            <div class="profil-card">

                <div class="profil-card-header">

                    <div class="profil-card-icon">
                        🎯
                    </div>

                    <div>

                        <span>
                            ARAH DAN TUJUAN
                        </span>

                        <h2>
                            Visi & Misi
                        </h2>

                        <p>
                            Masukkan visi dan misi resmi Puskesmas.
                        </p>

                    </div>

                </div>


                <div class="profil-card-body">

                    {{-- VISI --}}
                    <div class="form-group full">

                        <label for="visi">
                            Visi
                        </label>

                        <textarea id="visi" name="visi" rows="5"
                            placeholder="Masukkan visi Puskesmas...">{{ old('visi', $profil->visi ?? '') }}</textarea>

                    </div>


                    {{-- MISI --}}
                    <div class="form-group full">

                        <label for="misi">
                            Misi
                        </label>

                        <textarea id="misi" name="misi" rows="8"
                            placeholder="Masukkan misi Puskesmas...">{{ old('misi', $profil->misi ?? '') }}</textarea>

                        <small>
                            Jika terdapat beberapa poin misi, pisahkan setiap poin dengan baris baru.
                        </small>

                    </div>

                </div>

            </div>


            {{-- =====================================================
            JAM PELAYANAN
            ====================================================== --}}

            <div class="profil-card">

                <div class="profil-card-header">

                    <div class="profil-card-icon">
                        🕐
                    </div>

                    <div>

                        <span>
                            INFORMASI PELAYANAN
                        </span>

                        <h2>
                            Jam Pelayanan
                        </h2>

                        <p>
                            Atur informasi jam operasional Puskesmas.
                        </p>

                    </div>

                </div>


                <div class="profil-card-body">

                    <div class="form-group full">

                        <label for="jam_pelayanan">
                            Jam Pelayanan
                        </label>

                        <textarea id="jam_pelayanan" name="jam_pelayanan" rows="6"
                            placeholder="Contoh:
                                                        Senin - Kamis : 08.00 - 14.00
                                                        Jumat : 08.00 - 11.30
                                                        Sabtu : 08.00 - 12.00">{{ old('jam_pelayanan', $profil->jam_pelayanan ?? '') }}</textarea>

                    </div>

                </div>

            </div>


            {{-- =====================================================
            FOTO PUSKESMAS
            ====================================================== --}}

            <div class="profil-card">

                <div class="profil-card-header">

                    <div class="profil-card-icon">
                        📷
                    </div>

                    <div>

                        <span>
                            MEDIA WEBSITE
                        </span>

                        <h2>
                            Foto Puskesmas
                        </h2>

                        <p>
                            Foto utama yang akan digunakan pada website.
                        </p>

                    </div>

                </div>


                <div class="profil-card-body">

                    <div class="photo-upload-area">

                        {{-- PREVIEW FOTO --}}
                        <div class="photo-preview">

                            @if(isset($profil) && $profil && $profil->foto)

                                <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto Puskesmas">

                            @else

                                <div class="photo-placeholder">

                                    <span>
                                        🏥
                                    </span>

                                    <p>
                                        Belum ada foto
                                    </p>

                                </div>

                            @endif

                        </div>


                        {{-- INPUT FOTO --}}
                        <div class="photo-input">

                            <label for="foto">
                                Pilih Foto Puskesmas
                            </label>

                            <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,.webp">

                            <p>
                                Format JPG, JPEG, PNG atau WEBP.
                                Maksimal ukuran 2 MB.
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
            ACTION
            ====================================================== --}}

            <div class="profil-form-footer">

                <div class="form-status">
                    <span class="status-dot"></span>
                    <span>
                        Perubahan disimpan setelah tombol Simpan Perubahan ditekan.
                    </span>
                </div>

                <div class="profil-form-actions">

                    <button type="button" class="btn-reset-form" id="btnKosongkanForm">
                        ↺ Kosongkan Form
                    </button>

                    <button type="submit" class="btn-save">
                        <span>✓</span>
                        Simpan Perubahan
                    </button>

                </div>

            </div>


        </form>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tombolKosongkan = document.getElementById('btnKosongkanForm');
            const form = document.querySelector('.profil-form');

            if (!tombolKosongkan || !form) return;

            tombolKosongkan.addEventListener('click', function () {
                const yakin = confirm(
                    'Kosongkan semua isian pada form profil? Perubahan ini belum disimpan ke database.'
                );

                if (!yakin) return;

                form.querySelectorAll('input, textarea, select').forEach(function (field) {
                    if (
                        field.type === 'hidden' ||
                        field.name === '_token' ||
                        field.name === '_method' ||
                        field.type === 'submit' ||
                        field.type === 'button'
                    ) {
                        return;
                    }

                    if (field.type === 'checkbox' || field.type === 'radio') {
                        field.checked = false;
                    } else {
                        field.value = '';
                    }
                });
            });
        });
    </script>
@endpush


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/admin-profil.css') }}">

@endpush