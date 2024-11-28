@extends('layouts.guest.base')

@section('content')
    <!-- Main Content -->
    <div class="page-wrapper">
        <section class="banner">
            <div class="text-container">
                <h1>“Think before you speak.<br>Read before you think.”</h1>
                <h5>― Fran Lebowitz</h5>
            </div>
        </section>

        {{--Page Body--}}
        <div class="page-body">
            <div class="container-xl">
                <section id="popular-books" class="bookshelf py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-header text-center pb-5">
                                    <h2 class="section-title">Os livros mais vendidos</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @for($index = 0; $index < min(12, count($books)); $index++)
                                @php
                                    $book = $books[$index];
                                @endphp

                                @if($index % 4 === 0 && $index !== 0)
                        </div><div class="row">
                            @endif

                            <div class="col-md-3 mb-4">
                                <div class="product-item text-center">
                                    <figure class="product-style">

                                        @if($book->CoverPicture)
                                            <img src="{{ asset('storage/'.$book->CoverPicture) }}" class="product-thumb rounded" alt="{{ $book->title }}" style="width: 280px; height: 400px;">
                                        @else
                                            <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded" alt="Imagem não disponível" style="width: 280px; height: 400px;">
                                        @endif

                                        <button type="button" class="add-to-cart">
                                            Adicionar ao carrinho
                                        </button>
                                    </figure>
                                    <figcaption>
                                        <h3>{{ $book->title }}</h3>
                                        <span>{{ $book->type }}</span>
                                        <div class="item-price">€{{ $book->price, 2 }}</div>
                                    </figcaption>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </section>
            </div>
        </div>
        {{--Footer--}}
        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl"></div>
            <div class="row text-center align-items-center flex-row-reverse">
                <div class="col">
                    <p>2024 © EditArt</p>
                    <p class="text-center">
                        <a href="https://github.com/RubenF0nseca/EditArt" class="git link-body-emphasis text-decoration-none">
                            <i class="fa-brands fa-github"></i>
                        </a>
                </div>
            </div>
        </footer>
    </div>
@endsection
