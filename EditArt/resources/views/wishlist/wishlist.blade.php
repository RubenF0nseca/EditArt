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
                <!-- Wishlist -->
                <div class="col-lg-12">
                    <h1 class="section-title font-alt">Wishlist</h1>
                    <hr class="divider">
                    <!-- Mensagens de sucesso ou erro -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row">
                        @forelse($wishlists as $wishlist)
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-4 d-flex justify-content-center">
                                <div class="product-item text-center">
                                    <figure class="product-style">
                                        <a href="{{ route('guest.books', $wishlist->book->id) }}">
                                            @if($wishlist->book->CoverPicture)
                                                <img src="{{ asset('storage/' . $wishlist->book->CoverPicture) }}" class="product-thumb rounded" alt="{{ $wishlist->book->title }}" style="max-width: 90%; height: auto;">
                                            @else
                                                <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded" alt="{{ __('cart.image_not_available') }}" style="max-width: 90%; height: auto;">
                                            @endif
                                        </a>
                                        <!-- Exemplo opcional: botão para adicionar ao carrinho -->
                                        <button type="button" class="add-to-cart btn btn-outline-primary btn-sm mt-2">
                                            <i class="fa-solid fa-cart-shopping"></i>&nbsp;
                                            {{ __('homepage.add_to_cart') }}
                                        </button>
                                    </figure>
                                    <figcaption>
                                        <h3>{{ $wishlist->book->title }}</h3>
                                        <p class="font-serif">
                                            @if($wishlist->book->relationLoaded('authors') && $wishlist->book->authors->isNotEmpty())
                                                {{ $wishlist->book->authors->pluck('name')->join(', ') }}
                                            @endif
                                        </p>
                                        <span>{{ $wishlist->book->type }}</span>
                                        <div class="d-flex justify-content-between align-items-center mt-2" id="wish-price">
                                            <span class="item-price">{{ number_format($wishlist->book->price, 2) }} €</span>
                                            <form action="{{ route('client.wishlist.remove', $wishlist->book->id) }}" method="POST" class="ms-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0" title="Remover">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </figcaption>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p>A sua wishlist está vazia.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
