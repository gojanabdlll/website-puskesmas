@extends('layouts.admin')

@section('title', 'Tambah Banner')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-banner.css') }}">
@endpush

@section('content')
    <div class="ab-page">

        <section class="ab-hero">
            <div class="ab-hero-content">
                <span class="ab-eyebrow">KONTEN WEBSITE</span>
                <h1>Tambah Banner</h1>
                <p>
                    Buat banner yang informatif dan menarik
                    untuk halaman utama Puskesmas Singaparna.
                </p>
                <a href="{{ route('admin.banner.index') }}" class="ab-btn ab-btn-light">
                    ← Kembali ke Daftar Banner
                </a>
            </div>
        </section>

        @if($errors->any())
            <div class="ab-alert ab-alert-error">
                <strong>Data belum dapat disimpan.</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('admin.banner._form')

        </form>
    </div>
@endsection