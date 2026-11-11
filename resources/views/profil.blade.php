@extends('layouts.app')

@section('title', 'Profil - Puskesmas Singaparna')

@section('content')
    @include('profil.header')
    @include('profil.tentang')
    @include('profil.visi-misi')
    @include('profil.struktur')
    @include('profil.wilayah-kerja')
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}?v={{ time() }}">

    <link rel="stylesheet" href="{{ asset('css/assistant.css') }}">
@endpush