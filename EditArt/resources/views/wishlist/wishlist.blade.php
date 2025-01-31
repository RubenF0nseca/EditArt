@php
    $layout = 'layouts.guest.base';

    if (auth()->check() && auth()->user()->hasAnyRole(['admin', 'cliente'])) {
        $layout = 'layouts.client.base';
    }
@endphp

@extends($layout)
@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row" id="margin-top">
                <!-- Wishlist ------------------------------------  -->
                <div class="col-lg-12 col-sm-offset-3">
                    <h1 class="section-title font-alt">Wishlist</h1>
                    <hr class="divider">
                    <!-- Os livros -->
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-3 mb-4 d-flex justify-content-center">
                            <div class="product-item text-center">
                                <figure class="product-style">


                                    <img src="" class="product-thumb rounded" alt="" style="max-width: 90%; height: auto;">

                                    <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded" alt="{{ __('homepage.image_not_available') }}" style="max-width: 90%; height: auto;">


                                    <button type="button" class="add-to-cart">
                                        <i class="fa-solid fa-cart-shopping"></i>&nbsp;
                                        {{ __('homepage.add_to_cart') }}
                                    </button>
                                </figure>
                                <figcaption>
                                    <h3>Title</h3>
                                    <p class="font-serif">Author</p>
                                    <span>Type</span>
                                    <div id="wish-price">
                                        <span class="item-price">12.99 €</span>
                                        <span><i class="fa-regular fa-trash-can"></i></span>
                                    </div>
                                </figcaption>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
