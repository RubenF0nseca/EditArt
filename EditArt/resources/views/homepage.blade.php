<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="">
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

<body class="layout-fluid" style="background-color: #131313">
    <div class="wrapper">
        <div class="content">
            @php
                $layout = 'layouts.guest.parts.menu';

                if (auth()->check() && auth()->user()->hasAnyRole(['admin', 'cliente'])) {
                    $layout = 'layouts.client.parts.menu';
                }
            @endphp
            @extends($layout)

            <header class="main-header">
                <div class="layers">

                    <div class="layer__header">
                        <div class="layers__title font-serif">"Think before you speak.<br>&nbsp; Read before you think."</div>
                        <div class="layers__caption text-end">― Fran Lebowitz</div>
                    </div>
                    <div class="layer layers_4"></div>
                    <div class="layer layers_3"></div>
                    <div class="layer layers_2"></div>
                    <div class="layer layers_1"></div>
                </div>
            </header>

            <article class="main-article">
                <div class="main-article__content">
                    <h2 class="main-article__header font-alt">Os nossos serviços</h2>
                </div>
            </article>

            <!-- Menu-carousel ------------------------------------  -->

            <div id="myCarousel" class="carousel slide mt-0 mb-5" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class="active" aria-current="true"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class="active" aria-current="true"></button>
                </div>

                <div class="carousel-inner">
                    <!-- ------ Slide 1 ---------------------------  -->
                    <div class="carousel-item active">
                        <img src="{{ asset('imgs/store-bg.jpg') }}" class="opacity-50" width="100%" height="100%" alt="">
                        <div class="container">
                            <div class="carousel-caption">
                                <h2 id="titulo" class="font-alt">Loja</h2>
                            </div>
                            <div class="row">
                                <div class="col-6"></div>
                                <div class="col-6 carousel-text text-end">
                                    <p>
                                        Apresentamos as obras dos nossos autores.
                                    </p>
                                    <a href="{{route('guest.books')}}" class="btn btn-solid">Entrar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ----- Slide 2 ---------------------------  -->
                    <div class="carousel-item">
                        <img src="{{ asset('imgs/publisher-bg.jpg') }}" class="opacity-50" width="100%" height="100%" alt="">
                        <div class="container">
                            <div class="carousel-caption">
                                <h2 id="titulo" class="font-alt">Editora</h2>
                            </div>
                            <div class="row">
                                <div class="col-6"></div>
                                <div class="col-6 carousel-text text-end">
                                    <p>
                                        A nossa editora oferece uma plataforma acessível para escritores que desejam transformar as suas ideias em trabalhos publicados.
                                    </p>
                                    <a href="{{route('publisher')}}" class="btn btn-solid">Entrar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ----- Slide 3 ---------------------------  -->
                    <div class="carousel-item">
                        <img src="{{ asset('imgs/forum_bg.png') }}" class="opacity-50" width="100%" height="100%" alt="">
                        <div class="container">
                            <div class="carousel-caption">
                                <h2 id="titulo" class="font-alt">Forum</h2>
                            </div>
                            <div class="row">
                                <div class="col-6"></div>
                                <div class="col-6 carousel-text text-end">
                                    <p>
                                        Dispomos de um fórum para que os autores e os leitores possam interagir, trocar experiências e expandir o universo literário.
                                    </p>
                                    <a href="{{route('forum')}}" class="btn btn-solid">Entrar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ----- As setas ---------------------------  -->
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- ----- Footer ---------------------------  -->
            @include('layouts.guest.parts.footer')
        </div>
    </div>

<!-- Libs JS -->
@vite(['resources/js/guest.js', 'resources/js/cart.js'])

<!--GSAP e ScrollSmoother -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://assets.codepen.io/16327/ScrollSmoother.min.js"></script>

<script>
    window.addEventListener('scroll', () => {
        document.documentElement.style.setProperty('--scrollTop', `${this.scrollY}px`);
    });

    gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

    ScrollSmoother.create({
        wrapper: '.wrapper',
        content: '.content'
    });
</script>

</body>
</html>
