@extends('layouts.guest.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="page-body">
            <div class="container-xl">
                <section id="popular-books" class="bookshelf py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 mt-5">
                                <div class="section-header text-center pb-5">
                                    <h2 class="section-title">As nossas publicações</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($books as $index => $book)
                                @if($index % 4 === 0 && $index !== 0)
                                    </div><div class="row">
                                @endif

                                <div class="col-md-3 mb-4">
                                    <div class="product-item text-center">
                                        <figure class="product-style">

                                            @if($book->CoverPicture)
                                                <img src="{{ asset('storage/'.$book->CoverPicture) }}" class="product-thumb rounded" alt="{{ $book->title }}" style="max-width: 90%; height: auto;">
                                            @else
                                                <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded" alt="Imagem não disponível" style="max-width: 90%; height: auto;">
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
                            @endforeach
                        </div>
                        <div class="card-footer">
                            {{ $books->links('layouts.admin.parts.pagination') }}
                        </div>
                    </div>
                </section>
            </div>
        </div>
@endsection
