@extends('layouts.admin')

@section('title', 'Edit Jadwal Pelayanan')
@section('page-title', 'Edit Jadwal Pelayanan')

@section('content')
    <div class="jadwal-admin-container">

        <div class="jadwal-admin-header">
            <div>
                <h1>Edit Jadwal Pelayanan</h1>
                <p>Perbarui informasi jadwal pelayanan Puskesmas Singaparna.</p>
            </div>
        </div>

        <div class="jadwal-admin-card">
            <form action="{{ route('admin.jadwal-pelayanan.update', $jadwal->id) }}" method="POST">
                @method('PUT')

                @include('admin.jadwal-pelayanan.form')
            </form>
        </div>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet"
        href="{{ asset('css/jadwal-admin.css') }}?v={{ filemtime(public_path('css/jadwal-admin.css')) }}">
@endpush