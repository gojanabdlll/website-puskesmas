<div class="struktur-personel">
    <div class="struktur-personel-foto">
        @if($item->foto)
            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto {{ $item->nama }}" loading="lazy">
        @else
            <div class="struktur-personel-placeholder">
                <span>👤</span>
            </div>
        @endif
    </div>

    <div class="struktur-personel-info">
        <span class="struktur-personel-jabatan">
            {{ $item->jabatan }}
        </span>

        <strong class="struktur-personel-nama">
            {{ $item->nama }}
        </strong>
    </div>
</div>