<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="shortcut icon" href="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('icons/favicon-16x16.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('icons/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('icons/favicon-192x192.png')}}">
    {{--Aple--}}
    <link rel="apple-touch-icon" href="{{asset('icons/apple-touch-icon.png')}}">

    <link rel="manifest" href="{{asset('icons/site.webmanifest')}}">


    <title>EditArt-Admin</title>
    <!-- CSS files -->
    @vite(['resources/sass/app.scss'])
</head>
<body class="layout-fluid">
<div class="page" id="@yield('id')">
    <!-- Sidebar -->
    <aside class="navbar navbar-vertical navbar-expand-lg shadow-lg" data-bs-theme="dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                    aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark">
                <a href="{{ route('home')}}">
                    <img src="{{asset('imgs/logo-editart.png')}}" width="110" height="110" alt="EditArt">
                </a>
            </h1>

            <div class="collapse navbar-collapse" id="sidebar-menu">

                <ul class="navbar-nav pt-lg-3">
                    <!-- Logout Link -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="nav-link border-0 bg-transparent" type="submit">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-logout fs-5"></i>
                                </span><span class="nav-link-title">
                                {{ __('admin.logout') }}
                                </span>
                            </button>
                        </form>
                    </li>
                    <!-- Home Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-home fs-5"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('admin.home') }}
                            </span>
                        </a>
                    </li>
                    <hr class="m-0">
                    <!-- Admin Section -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-dashboard fs-5"></i>
                            </span>
                            <span class="nav-link-title">
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <!-- Obras Section -->
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#admin-menu" data-bs-toggle="dropdown"
                           data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-book fs-5"></i>
                            </span>
                            <span class="nav-link-title">
                              {{ __('admin.products') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.books.index') }}">{{ __('admin.product_list') }}</a>
                            <a class="dropdown-item" href="{{ route('admin.authors.index') }}">{{__('admin.authors_list') }}</a>
                            <a class="dropdown-item" href="{{ route('admin.reviews.index') }}">{{ __('admin.reviews_list') }}</a>
                            <a class="dropdown-item" href="{{ route('admin.genres.index') }}">{{ __('admin.genres_list') }}</a>

                            <!-- Outros links para Obras podem ser adicionados aqui -->
                        </div>
                    </li>
                    <!-- Forum Section -->
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#admin-menu" data-bs-toggle="dropdown"
                           data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-settings fs-5"></i>
                            </span>
                            <span class="nav-link-title">
                                Forum
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.posts.index') }}">{{ __('admin.posts_list') }}</a>
                            <a class="dropdown-item" href="{{ route('admin.comments.index') }}">{{ __('admin.comments_list') }}</a>
                            <!-- Outros links para Admin podem ser adicionados aqui -->
                        </div>
                    </li>
                    <!-- Cliente Section -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#client-menu" data-bs-toggle="dropdown"
                           data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-user fs-5"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('admin.users') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.users.index') }}">{{ __('admin.user_list') }}</a>
                            <!-- Outros links para Cliente podem ser adicionados aqui -->
                        </div>
                    </li>
                    <hr class="m-0">
                    <!-- Sens mail Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.mail.compose') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-mail fs-5"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('admin.send_email') }}
                            </span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </aside>
    <!-- Main Content -->
    <div class="page-wrapper">
        {{--Page Header --}}
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">Admin</div>
                        <h2 class="page-title font-alt">@yield('title')</h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-md-6 ms-auto text-end">
                        @yield('button')
                        {{--Botões de açao da página--}}
                    </div>
                </div>
            </div>
        </div>
        {{--Page Body--}}
        <div class="page-body">
            <div class="container-xl">
                @yield('content')
            </div>
        </div>
        {{--Footer--}}
        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <hr>
            </div>
            <div class="row text-center align-items-center flex-row-reverse">
                <div class="col font-alt">
                    <p>2025 © EditArt, {{ __('admin.all_rights_reserved') }}</p>
                    <p class="text-center">
                        <a href="https://github.com/RubenF0nseca/EditArt"
                           class="git link-body-emphasis text-decoration-none">
                            <i class="fa-brands fa-github"></i>
                        </a>
                    </p>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- Libs JS -->
@vite(['resources/js/app.js','resources/js/admin.js'])
@stack('scripts')
</body>
</html>
