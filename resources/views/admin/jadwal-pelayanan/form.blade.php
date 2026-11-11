@csrf

<div class="form-group">
    <label for="nama_layanan">Rentang Hari Pelayanan</label>
    <input type="text" id="nama_layanan" name="nama_layanan" class="form-control"
        value="{{ old('nama_layanan', $jadwal->nama_layanan ?? '') }}" placeholder="Contoh: Senin - Rabu" required>
    @error('nama_layanan')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

{{-- Kolom hari dipertahankan untuk kompatibilitas database lama --}}
<input type="hidden" name="hari" value="{{ old('hari', $jadwal->hari ?? 'Hari Kerja') }}">

<div class="form-group">
    <label for="jam_mulai">Jam Mulai</label>
    <input type="time" id="jam_mulai" name="jam_mulai" class="form-control"
        value="{{ old('jam_mulai', isset($jadwal) ? substr($jadwal->jam_mulai, 0, 5) : '') }}" required>
    @error('jam_mulai')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="jam_selesai">Jam Selesai</label>
    <input type="time" id="jam_selesai" name="jam_selesai" class="form-control"
        value="{{ old('jam_selesai', isset($jadwal) ? substr($jadwal->jam_selesai, 0, 5) : '') }}" required>
    @error('jam_selesai')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="keterangan">Keterangan</label>
    <textarea id="keterangan" name="keterangan" class="form-control" rows="3"
        placeholder="Contoh: Pelayanan mulai pukul 08.00 WIB">{{ old('keterangan', $jadwal->keterangan ?? '') }}</textarea>
    @error('keterangan')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="urutan">Urutan Tampilan</label>
    <input type="number" id="urutan" name="urutan" class="form-control" min="1"
        value="{{ old('urutan', $jadwal->urutan ?? 1) }}" required>
    @error('urutan')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="status">Status Jadwal</label>
    <select id="status" name="status" class="form-control" required>
        <option value="1" {{ (string) old('status', isset($jadwal) ? (int) $jadwal->status : 1) === '1' ? 'selected' : '' }}>
            Aktif
        </option>
        <option value="0" {{ (string) old('status', isset($jadwal) ? (int) $jadwal->status : 1) === '0' ? 'selected' : '' }}>
            Tidak Aktif
        </option>
    </select>
    @error('status')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">
        {{ isset($jadwal) ? 'Simpan Perubahan' : 'Tambah Jadwal' }}
    </button>

    <a href="{{ route('admin.jadwal-pelayanan.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>