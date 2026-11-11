
@php
    $isEdit = isset($banner);
@endphp

<div class="ab-form-grid">

    {{-- KOLOM INFORMASI UTAMA --}}
    <div class="ab-form-main">

        <section class="ab-form-card">
            <div class="ab-form-heading">
                <div class="ab-form-icon">✏️</div>
                <div>
                    <h2>Informasi Banner</h2>
                    <p>Isi konten yang akan dilihat oleh pengunjung website.</p>
                </div>
            </div>

            {{-- JUDUL --}}
            <div class="ab-field">
                <label for="judul">Judul Banner <span>*</span></label>

                <input
                    type="text"
                    id="judul"
                    name="judul"
                    value="{{ old('judul', $banner->judul ?? '') }}"
                    placeholder="Contoh: Pelayanan Kesehatan Puskesmas"
                    maxlength="255"
                    required
                >

                @error('judul')
                    <small class="ab-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- DESKRIPSI --}}
            <div class="ab-field">
                <label for="deskripsi">Deskripsi Banner</label>

                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="5"
                    placeholder="Tuliskan deskripsi singkat banner..."
                >{{ old('deskripsi', $banner->deskripsi ?? '') }}</textarea>

                @error('deskripsi')
                    <small class="ab-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- GAMBAR --}}
            <div class="ab-field">
                <label for="gambar">
                    Gambar Banner
                    @if(!$isEdit || empty($banner->gambar))
                        <span>*</span>
                    @endif
                </label>

                @if($isEdit && $banner->gambar)
                    <div class="ab-current-image">
                        <p>Gambar yang digunakan saat ini:</p>
                        <img
                            src="{{ asset('storage/' . $banner->gambar) }}"
                            alt="Banner saat ini"
                        >
                    </div>
                @endif

                <input
                    type="file"
                    id="gambar"
                    name="gambar"
                    accept=".jpg,.jpeg,.png,.webp"
                    @if(!$isEdit || empty($banner->gambar)) required @endif
                >

                <small class="ab-help">
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB,
                    sesuai batas validasi controller.
                    @if($isEdit)
                        Kosongkan jika ingin tetap menggunakan gambar lama.
                    @endif
                </small>

                @error('gambar')
                    <small class="ab-error">{{ $message }}</small>
                @enderror
            </div>
        </section>

        {{-- PENGATURAN TOMBOL --}}
        <section class="ab-form-card">
            <div class="ab-form-heading">
                <div class="ab-form-icon">🔗</div>
                <div>
                    <h2>Tombol Banner</h2>
                    <p>Atur teks dan tujuan tautan tombol, jika diperlukan.</p>
                </div>
            </div>

            <div class="ab-field">
                <label for="teks_tombol">Teks Tombol</label>

                <input
                    type="text"
                    id="teks_tombol"
                    name="teks_tombol"
                    value="{{ old('teks_tombol', $banner->teks_tombol ?? '') }}"
                    placeholder="Contoh: Selengkapnya"
                    maxlength="255"
                >

                @error('teks_tombol')
                    <small class="ab-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="ab-field">
                <label for="url_tombol">URL Tombol</label>

                <input
                    type="text"
                    id="url_tombol"
                    name="url_tombol"
                    value="{{ old('url_tombol', $banner->url_tombol ?? '') }}"
                    placeholder="Contoh: /profil atau https://..."
                >

                <small class="ab-help">
                    Isi URL tujuan jika banner menggunakan tombol.
                </small>

                @error('url_tombol')
                    <small class="ab-error">{{ $message }}</small>
                @enderror
            </div>
        </section>
    </div>

    {{-- KOLOM PENGATURAN --}}
    <aside class="ab-form-side">

        <section class="ab-form-card">
            <div class="ab-form-heading">
                <div class="ab-form-icon">⚙️</div>
                <div>
                    <h2>Pengaturan Banner</h2>
                    <p>Atur urutan dan status tampilan.</p>
                </div>
            </div>

            <div class="ab-field">
                <label for="urutan">Urutan Banner <span>*</span></label>

                <input
                    type="number"
                    id="urutan"
                    name="urutan"
                    min="0"
                    value="{{ old('urutan', $banner->urutan ?? 1) }}"
                    required
                >

                <small class="ab-help">
                    Angka lebih kecil ditampilkan lebih dahulu.
                </small>

                @error('urutan')
                    <small class="ab-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="ab-field">
                <label for="status">Status Banner <span>*</span></label>

                <select id="status" name="status" required>
                    <option
                        value="1"
                        @selected((string) old('status', isset($banner) ? (int) $banner->status : 1) === '1')
                    >
                        Aktif
                    </option>

                    <option
                        value="0"
                        @selected((string) old('status', isset($banner) ? (int) $banner->status : 1) === '0')
                    >
                        Nonaktif
                    </option>
                </select>

                @error('status')
                    <small class="ab-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="ab-tip">
                <strong>💡 Tips Banner</strong>
                <p>
                    Gunakan gambar yang jelas dan teks singkat.
                    Pastikan teks tetap terbaca pada layar komputer
                    maupun ponsel.
                </p>
            </div>
        </section>

        {{-- TOMBOL SIMPAN --}}
        <section class="ab-form-card ab-form-actions">
            <button type="submit" class="ab-btn ab-btn-primary ab-btn-full">
                ✓ {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Banner' }}
            </button>

            <a href="{{ route('admin.banner.index') }}"
               class="ab-btn ab-btn-cancel ab-btn-full">
                Batal
            </a>
        </section>

    </aside>
</div>
