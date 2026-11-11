@extends('layouts.admin')

@section('content')
    <div class="admin-footer-settings">
        <div class="settings-heading">
            <div>
                <h1>Pengaturan Footer</h1>
                <p>Kelola informasi yang ditampilkan pada bagian bawah website.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="settings-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="settings-error">
                <strong>Periksa kembali data berikut:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.footer.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <section class="settings-panel">
                <h2>Informasi Puskesmas</h2>

                <label>Nama Puskesmas</label>
                <input type="text" name="nama_puskesmas" value="{{ old('nama_puskesmas', $footer->nama_puskesmas) }}"
                    required>

                <label>Alamat</label>
                <textarea name="alamat" rows="3">{{ old('alamat', $footer->alamat) }}</textarea>

                <div class="settings-grid">
                    <div>
                        <label>Nomor Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $footer->telepon) }}">
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', $footer->email) }}">
                    </div>
                </div>
            </section>

            <section class="settings-panel">
                <h2>Logo Footer</h2>

                @if($footer->logo)
                    <img src="{{ asset('storage/' . $footer->logo) }}" alt="Logo footer saat ini"
                        style="width:100px;height:100px;object-fit:contain;">
                @else
                    <p>Logo saat ini menggunakan logo bawaan website.</p>
                @endif

                <label>Unggah Logo Baru</label>
                <input type="file" name="logo" accept="image/png,image/jpeg,image/webp">
                <small>Format JPG, PNG, atau WebP. Maksimal 2 MB.</small>
            </section>

            @foreach([
                    'pintasan' => 'Pintasan Halaman',
                    'tautan_terkait' => 'Tautan Terkait'
                ] as $field => $heading)
                @php
                    $items = old($field, $footer->{$field} ?? []);
                    if (empty($items)) {
                        $items = [['label' => '', 'url' => '']];
                    }
                @endphp

                <section class="settings-panel">
                    <h2>{{ $heading }}</h2>

                    <div id="{{ $field }}-list">
                        @foreach($items as $i => $item)
                            <div class="settings-link-row">
                                <input type="text" name="{{ $field }}[{{ $i }}][label]" value="{{ $item['label'] ?? '' }}"
                                    placeholder="Nama tautan">

                                <input type="text" name="{{ $field }}[{{ $i }}][url]" value="{{ $item['url'] ?? '' }}"
                                    placeholder="URL, contoh: /profil">

                                <button type="button" class="settings-remove" onclick="this.parentElement.remove()">
                                    Hapus
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="settings-add" onclick="addFooterLink('{{ $field }}')">
                        + Tambah Tautan
                    </button>
                </section>
            @endforeach

            <section class="settings-panel">
                <h2>Copyright</h2>

                <label>Teks Copyright</label>
                <input type="text" name="copyright" value="{{ old('copyright', $footer->copyright) }}">

                <label>Kredit Pembuat Website</label>
                <input type="text" name="kredit" value="{{ old('kredit', $footer->kredit) }}">
            </section>

            <button type="submit" class="settings-save">
                Simpan Pengaturan Footer
            </button>
        </form>
    </div>

    <script>
        function addFooterLink(field) {
            const list = document.getElementById(field + '-list');
            const index = list.querySelectorAll('.settings-link-row').length;
            const row = document.createElement('div');

            row.className = 'settings-link-row';
            row.innerHTML = `
                    <input type="text" name="${field}[${index}][label]"
                           placeholder="Nama tautan">
                    <input type="text" name="${field}[${index}][url]"
                           placeholder="URL, contoh: /profil">
                    <button type="button" class="settings-remove"
                            onclick="this.parentElement.remove()">Hapus</button>
                `;

            list.appendChild(row);
        }
    </script>

    <style>
        .admin-footer-settings {
            max-width: 1100px;
            margin: 0 auto;
            padding: 24px;
            color: #243b3b;
        }

        .settings-heading {
            margin-bottom: 24px;
        }

        .settings-heading h1 {
            margin: 0 0 8px;
            font-size: 27px;
        }

        .settings-heading p {
            color: #647575;
            margin: 0;
        }

        .settings-panel {
            background: #fff;
            padding: 24px;
            margin-bottom: 20px;
            border: 1px solid #e3eceb;
            border-radius: 12px;
        }

        .settings-panel h2 {
            margin: 0 0 20px;
            font-size: 18px;
        }

        .settings-panel label {
            display: block;
            margin: 15px 0 7px;
            font-weight: 600;
            font-size: 14px;
        }

        .settings-panel input:not([type=file]),
        .settings-panel textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d6e0df;
            border-radius: 7px;
            font: inherit;
            box-sizing: border-box;
        }

        .settings-panel small {
            display: block;
            margin-top: 8px;
            color: #647575;
        }

        .settings-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .settings-link-row {
            display: grid;
            grid-template-columns: 1fr 1.4fr auto;
            gap: 10px;
            margin-bottom: 12px;
        }

        .settings-add,
        .settings-remove,
        .settings-save {
            border: 0;
            border-radius: 7px;
            padding: 11px 15px;
            cursor: pointer;
            font-weight: 600;
        }

        .settings-add {
            background: #e2f5f1;
            color: #087f72;
            margin-top: 5px;
        }

        .settings-remove {
            background: #fee9e7;
            color: #b42318;
        }

        .settings-save {
            background: #087f72;
            color: #fff;
            padding: 14px 22px;
        }

        .settings-success {
            background: #e5f7eb;
            color: #176534;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        .settings-error {
            background: #fff0ef;
            color: #a61b1b;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        @media(max-width:650px) {
            .admin-footer-settings {
                padding: 15px;
            }

            .settings-grid,
            .settings-link-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection