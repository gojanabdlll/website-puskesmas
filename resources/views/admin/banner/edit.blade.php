@extends('layouts.admin')

@section('title', 'Edit Banner')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-banner.css') }}">
@endpush

@section('content')
    <div class="ab-page">

        <section class="ab-hero">
            <div class="ab-hero-content">
                <span class="ab-eyebrow">KONTEN WEBSITE</span>
                <h1>Edit Banner</h1>
                <p>
                    Perbarui informasi dan pengaturan banner
                    tanpa mengubah data lain yang tidak diperlukan.
                </p>
                <a href="{{ route('admin.banner.index') }}" class="ab-btn ab-btn-light">
                    ← Kembali ke Daftar Banner
                </a>
            </div>
        </section>

        @if($errors->any())
            <div class="ab-alert ab-alert-error">
                <strong>Data belum dapat diperbarui.</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('admin.banner._form', ['banner' => $banner])

        </form>
    </div>
@endsection