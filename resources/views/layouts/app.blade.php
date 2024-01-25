<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIKAP (Sistem Informasi dan Komunikasi Administrasi Perkantoran)</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <div class="container pt-4" style="text-align: center">
            <h1 class="text-dark"><strong>SIKAP</strong></h1>
            <h5>Sistem Informasi dan Komunikasi</h5>
            <h5>Administrasi Perkantoran</h4>
            <h5><strong>Kabupaten Lamongan</strong></h5>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
