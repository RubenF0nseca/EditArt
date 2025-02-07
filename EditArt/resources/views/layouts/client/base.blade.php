<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="">
    <script src="https://sandbox.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=EUR"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('icons/favicon-16x16.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('icons/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('icons/favicon-192x192.png')}}">
    {{--Aple--}}
    <link rel="apple-touch-icon"  href="{{asset('icons/apple-touch-icon.png')}}">
    <link rel="manifest" href="{{asset('icons/site.webmanifest')}}">

    <title>EditArt</title>
    <!-- CSS files -->
    @vite(['resources/sass/guest.scss'])
</head>

<body class="layout-fluid">
<header>
    @include('layouts.client.parts.menu')
</header>

<main class="main" id="top">

    @yield('content')
    @include('layouts.guest.parts.footer')
</main>
<!-- Libs JS -->
@vite(['resources/js/guest.js', 'resources/js/quill.js', 'resources/js/cart.js', 'resources/js/filter.js', 'resources/js/wishlist.js'])
@stack('scripts')
</body>
</html>
