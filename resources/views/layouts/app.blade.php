<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Puskesmas Singaparna')
    </title>

    {{-- CSS GLOBAL --}}
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/promkes.css') }}">

    {{-- CSS HALAMAN --}}
    @stack('styles')

</head>

<body>

    {{-- NAVBAR --}}
    @include('components.navbar')


    {{-- ISI HALAMAN --}}
    @yield('content')


    {{-- ASSISTANT --}}
    @include('components.assistant')


    {{-- FOOTER --}}
    @include('components.footer')


    @stack('scripts')

</body>

</html>