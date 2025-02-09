<!-- ----- Lista dos livros com paginação ----------  -->
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
                <h3 class="font-serif book-title">{{ $book->title }}</h3>
                <h4 class="book-author">
                    @if($book->authors->isNotEmpty())
                        {{ $book->authors->first()->name }}
                    @else
                        Sem author
                    @endif
                </h4>
                <span>{{ $book->type }}</span>
                <div id="wish-price">
                    <span class="item-price">{{ $book->price, 2 }} €</span>
                    @php
                        $inWishlist = auth()->check() && auth()->user()->wishlists()->where('book_id', $book->id)->exists();
                    @endphp

                    @if($inWishlist)
                        <!-- Se já estiver na wishlist -->
                        <span class="wishlist-toggle remove" data-book-id="{{ $book->id }}">
                        <i class="fa-solid fa-heart"></i>
                        </span>
                    @else
                        <!-- Se não estiver na wishlist -->
                        <span class="wishlist-toggle add" data-book-id="{{ $book->id }}">
                         <i class="fa-regular fa-heart"></i>
                        </span>
                    @endif
                </div>
            </figcaption>
        </div>
    </div>
    @endforeach
</div>
<!-- ----- Paginação ----------  -->
<div class="card-footer">
    {{ $books->links('layouts.admin.parts.pagination') }}
</div>
