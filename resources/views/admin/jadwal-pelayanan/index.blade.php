@extends('layouts.admin')

@section('content')
    <div class="jadwal-admin-page">

        {{-- HEADER --}}
        <div class="jadwal-public-heading">
            <span>JADWAL PELAYANAN</span>
            <h1>Jadwal Pelayanan Puskesmas</h1>
            <p>
                Kelola informasi jadwal pelayanan Puskesmas Singaparna.
            </p>

            <a href="{{ route('admin.jadwal-pelayanan.create') }}" class="jadwal-btn-add">
                + Tambah Jadwal
            </a>
        </div>

        {{-- NOTIFIKASI --}}
        @if(session('success'))
            <div class="jadwal-alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- KARTU JADWAL --}}
        <div class="jadwal-public-grid">

            @forelse($jadwal as $item)
                <article class="jadwal-public-card">

                    <div class="jadwal-public-icon">🗓️</div>

                    <span class="jadwal-public-label">
                        {{ $item->status ? 'JADWAL AKTIF' : 'NONAKTIF' }}
                    </span>

                    <h2>{{ $item->nama_layanan }}</h2>

                    <div class="jadwal-public-detail">
                        <p><strong>Hari:</strong> {{ $item->hari }}</p>
                        <p>
                            <strong>Jam:</strong>
                            {{ substr($item->jam_mulai, 0, 5) }}
                            –
                            {{ substr($item->jam_selesai, 0, 5) }}
                        </p>

                        @if($item->keterangan)
                            <p>{{ $item->keterangan }}</p>
                        @endif
                    </div>

                    <div class="jadwal-public-actions">
                        <a href="{{ route('admin.jadwal-pelayanan.edit', $item) }}" class="jadwal-btn-edit">
                            Edit Jadwal
                        </a>

                        <form action="{{ route('admin.jadwal-pelayanan.destroy', $item) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="jadwal-btn-delete">
                                Hapus
                            </button>
                        </form>
                    </div>

                </article>
            @empty
                <div class="jadwal-empty-card">
                    <div class="jadwal-public-icon">🗓️</div>
                    <h2>Belum Ada Jadwal Pelayanan</h2>
                    <p>Silakan tambahkan jadwal pelayanan terlebih dahulu.</p>
                </div>
            @endforelse

        </div>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/jadwal-admin.css') }}">
@endpush