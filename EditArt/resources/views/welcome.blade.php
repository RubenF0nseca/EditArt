<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">

    <main class="container">
        <h1> Instalação UI bootstrap em Laravel</h1>
        <div class="card m-3">
            <div class="card-header">
                Exemplo de Icons
            </div>
            <div class="card-body text-center">
                <i class="bi bi-bag-heart-fill"></i>
                <i class="bi bi-arrow-90deg-right"></i>
            </div>
        </div>
        <div class="card m-3">
            <div class="card-header">
                Exemplo botões
            </div>
            <div class="card-body text-center">
                <button type="button" class="btn btn-primary">Primary</button>
                <button type="button" class="btn btn-danger"><i class="bi bi-arrow-90deg-right">Perigo</i></button>

            </div>
        </div>
    </main>
</div>
</body>
</html>
