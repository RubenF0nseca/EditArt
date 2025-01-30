@php
    $layout = 'layouts.guest.base';

    if (auth()->check() && auth()->user()->hasAnyRole(['admin', 'cliente'])) {
        $layout = 'layouts.client.base';
    }
@endphp

@extends($layout)
@section('content')
    <!-- Banner ------------------------------------  -->
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class="active" aria-current="true"></button>
        </div>

        <!-- ------ Slide 1 ---------------------------  -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('imgs/banner-books.png') }}" alt="Banner" width="100%" height="100%">
                <div class="container">
                    <!-- ------TODO TEXTO--------  -->
                </div>
            </div>
            <!-- ----- Slide 2 ---------------------------  -->
            <div class="carousel-item">
                <img src="{{ asset('imgs/banner-books2.png') }}" alt="Banner" width="100%" height="100%">
                <div class="container">
                    <div class="carousel-caption text-end">
                        <!-- ------TODO TEXTO--------  -->
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

    <!-- ----- Os produtos ---------------------------  -->
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="page-body">
            <div class="container-xl">
                <section id="popular-books" class="bookshelf py-5">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <div class="section-header text-center pb-5">
                                <h2 class="section-title font-alt">{{ __('guest.books.our_publications') }}</h2>
                                <div class="section-subtitle font-serif">{{ __('guest.books.our_authors_works') }}</div> <!-- ------ TODO TEXTO--------  -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- ----- Left sidebar ----------  -->

                        <!-- Pesquisar por títulos de livros  -->
                        <div class="col-sm-3 col-md-3 sidebar">
                            <div class="widget">
                                <form role="form" method="GET" action="{{ route('guest.books') }}">
                                    <div class="search-box">
                                        <input class="form-control" type="text" name="title" placeholder="{{ __('guest.books.search_by_title') }}" value="{{ request('title') }}"/>
                                        <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>

                            <!-- Filtrar por categorias de livros  -->
                            <div class="widget">
                                <h5 class="widget-title font-alt">{{ __('guest.books.categories') }}</h5>
                                <ul class="icon-list">
                                    <li><a href="{{ route('guest.books') }}">{{ __('guest.books.all_genres') }}</a></li>
                                    @foreach($genres as $genre)
                                        <li>
                                            <a href="{{ route('guest.books', ['genre' => $genre->id]) }}">{{ $genre->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- ----- Os livros ----------  -->
                        <div class="col-sm-9 col-sm-offset-1">
                            <div class="row">
                                @foreach($books as $index => $book)
                                    @if($index % 4 === 0 && $index !== 0)
                            </div><div class="row">
                                @endif

                                <div class="col-sm-12 col-md-6 col-lg-3 mb-4 d-flex justify-content-center">
                                    <div class="product-item text-center">
                                        <figure class="product-style">

                                            @if($book->CoverPicture)
                                                <a href="{{route('book', $book->id)}}">
                                                    <img src="{{ asset('storage/'.$book->CoverPicture) }}" class="product-thumb rounded" alt="{{ $book->title }}" style="max-width: 90%; height: auto;">
                                                </a>
                                            @else
                                                <a href="{{route('book', $book->id)}}">
                                                    <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded" alt="{{ __('guest.books.image_not_available') }}" style="max-width: 90%; height: auto;">
                                                </a>
                                            @endif
                                                <button type="button"
                                                        class="add-to-cart"
                                                        data-book-id="{{ $book->id }}">
                                                    <i class="fa-solid fa-cart-shopping"></i>&nbsp;
                                                    {{ __('guest.books.add_to_cart') }}
                                                </button>
                                        </figure>
                                        <figcaption>
                                            <h3>{{ $book->title }}</h3>
                                            <span>{{ $book->type }}</span>
                                            <div id="wish-price">
                                                <span class="item-price">€{{ $book->price, 2 }}</span>
                                                <span id="wish"><i class="fa-regular fa-heart"></i></span>
                                            </div>
                                        </figcaption>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="card-footer">
                                {{ $books->links('layouts.admin.parts.pagination') }}
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection


