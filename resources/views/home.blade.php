@extends('layouts.app')

@section('title', 'Beranda - Puskesmas Singaparna')

@section('content')
    @include('home.hero')
    @include('home.profil')
    @include('home.informasi')
    @include('home.layanan')
    @include('home.jadwal')
    @include('home.galeri')
    @include('home.pengumuman')
    @include('home.pengaduan')
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/informasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">
@endpush