@extends('layouts.app')


@section('title', 'Wilayah Kerja - Puskesmas Singaparna')


@section('content')


    <section class="page-header">

        <div class="page-header-content">

            <h1>
                Wilayah Kerja
            </h1>

            <p>
                Puskesmas Singaparna
            </p>

        </div>

    </section>


    <section class="detail-page">

        <div class="detail-container">


            <div class="detail-title">

                <span>
                    WILAYAH KERJA
                </span>

                <h2>
                    Wilayah Kerja Puskesmas Singaparna
                </h2>

                <p>
                    Informasi wilayah kerja dan cakupan
                    pelayanan Puskesmas Singaparna.
                </p>

            </div>


            <div class="wilayah-content">


                <div class="wilayah-card">

                    <div class="detail-icon">
                        📍
                    </div>

                    <h3>
                        Wilayah Kerja
                    </h3>

                    <p>
                        Kecamatan Singaparna,
                        Kabupaten Tasikmalaya,
                        Jawa Barat.
                    </p>

                </div>


                <div class="wilayah-card">

                    <div class="detail-icon">
                        🏘
                    </div>

                    <h3>
                        Wilayah Cakupan
                    </h3>

                    <p>
                        Daftar desa atau wilayah yang
                        menjadi cakupan pelayanan
                        Puskesmas Singaparna akan
                        ditampilkan pada bagian ini.
                    </p>

                </div>


            </div>


            <div class="wilayah-table">

                <h3>
                    Daftar Wilayah Cakupan
                </h3>

                <table>

                    <thead>

                        <tr>

                            <th>
                                No
                            </th>

                            <th>
                                Nama Wilayah
                            </th>

                            <th>
                                Keterangan
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>
                                1
                            </td>

                            <td>
                                Nama Desa
                            </td>

                            <td>
                                Wilayah Kerja
                            </td>

                        </tr>

                        <tr>

                            <td>
                                2
                            </td>

                            <td>
                                Nama Desa
                            </td>

                            <td>
                                Wilayah Kerja
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>


        </div>

    </section>


@endsection


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/wilayah-kerja.css') }}">

@endpush