@extends('layouts.admin')

@section('title', 'Tambah Jadwal Pelayanan')
@section('page-title', 'Tambah Jadwal Pelayanan')

@section('content')
    <div class="jadwal-admin-container">

        <div class="jadwal-admin-header">
            <div>
                <h1>Tambah Jadwal Pelayanan</h1>
                <p>Tambahkan jadwal pelayanan Puskesmas Singaparna.</p>
            </div>
        </div>

        <div class="jadwal-admin-card">
            <form action="{{ route('admin.jadwal-pelayanan.store') }}" method="POST">
                @include('admin.jadwal-pelayanan.form')
            </form>
        </div>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet"
        href="{{ asset('css/jadwal-admin.css') }}?v={{ filemtime(public_path('css/jadwal-admin.css')) }}">
@endpush