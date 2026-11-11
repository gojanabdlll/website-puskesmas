<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin - Puskesmas Singaparna')
    </title>

    {{-- GLOBAL WEBSITE --}}
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">

    {{-- ADMIN LAYOUT --}}
    <link rel="stylesheet" href="{{ asset('css/admin-layout.css') }}">

    {{-- CSS TAMBAHAN HALAMAN --}}
    @stack('styles')

</head>

<body class="admin-body">

    <div class="admin-wrapper">

        {{-- SIDEBAR --}}
        @include('components.admin-sidebar')


        {{-- AREA UTAMA --}}
        <div class="admin-main">

            {{-- TOPBAR --}}
            <header class="admin-topbar">

                <div class="admin-page-heading">

                    <span>
                        ADMINISTRATOR
                    </span>

                    <h1>
                        @yield('page-title', 'Dashboard')
                    </h1>

                </div>


                {{-- ADMIN PROFILE --}}
                <div class="admin-user">

                    <div class="admin-user-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>

                    <div class="admin-user-info">

                        <strong>
                            {{ Auth::user()->name ?? 'Admin Puskesmas' }}
                        </strong>

                        <small>
                            Administrator
                        </small>

                    </div>

                </div>

            </header>


            {{-- CONTENT --}}
            <main class="admin-content">

                @if(session('success'))

                    <div class="admin-alert success">
                        <span>✓</span>
                        {{ session('success') }}
                    </div>

                @endif


                @if(session('error'))

                    <div class="admin-alert error">
                        <span>!</span>
                        {{ session('error') }}
                    </div>

                @endif


                @yield('content')

            </main>

        </div>

    </div>


    @stack('scripts')

</body>

</html>