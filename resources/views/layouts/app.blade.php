<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{asset('image/SIKAP Hitam.png')}}">

    <title>SIKAP (Sistem Informasi dan Komunikasi Administrasi Perkantoran)</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <style>
        @media only screen and (min-width: 769px) {
            .logo {
                max-width: 40%;
            }
        }

        @media only screen and (max-width: 768px) {
            .logo {
                max-width: 80%;
            }
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <div class="container pt-4" style="text-align: center">
            <img class="logo" src="{{asset('image/Logo SIKAP.png')}}" alt="">
        </div>

        <main class="py-4 mt-2">
            @yield('content')
        </main>
    </div>
</body>
</html>
