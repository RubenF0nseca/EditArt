@extends('layouts.client.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row" id="margin-top">

                <!-- Imagem do livro ------------------------------------  -->
                <div class="col-sm-5 mb-sm-40 d-flex justify-content-center">
                    <img class="product-img product-thumb rounded" src="{{ asset('imgs/img_nao_disponivel.png') }}" alt="Product Image"/>
                </div>

                <!-- Detalhes do livro ------------------------------------  -->
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="product-title font-alt">{{ $book->title }}</h1>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <div class="tipo">
                                <p>{{ $book->type }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            @if($book->authors->isNotEmpty())
                                    @foreach($book->authors as $author)
                                        <h2 class="author-name font-serif">{{ $author->name }}</h2>
                                    @endforeach
                            @else
                                {{ __('c_i_s_u.no_authors') }}
                            @endif

                        </div>
                    </div>
                    <div class="col-sm-12">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $wholeStars)
                                <i class="fa fa-star" style="color: gold;"></i>
                            @elseif ($i == $wholeStars + 1 && $hasHalfStar)
                                <i class="fa fa-star-half-alt" style="color: gold;"></i>
                            @else
                                <i class="fa fa-star" style="color: lightgray;"></i>
                            @endif
                        @endfor
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <div class="price font-alt"><span class="amount">{{ $book->price }}€</span></div>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <div class="description">
                                <p>{{ $book->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-20 mt-3">
                        <div class="col-sm-4 mb-sm-20">
                            <input class="form-control input-lg" type="number" name="" value="1" max="40" min="1" required="required"/>
                        </div>
                        <div class="col-sm-8"><a class="btn btn-solid" href="#">Add To Cart</a></div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <div class="categories font-alt mt-5">Categories:<a href="#"> Romance, </a><a href="#">Fantasia </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tablist ------------------------------------  -->
            <div class="row mt-70">
                <div class="col-sm-12">
                    <x-tab>
                        <x-tab.button class="active" id="description" target="description" controls="description" select="true" icon="icon-book-open">&nbsp Descrição</x-tab.button>
                        <x-tab.button class="" id="shipping-info" target="shipping-info" controls="shipping-info" select="false" icon="icon-map">&nbsp Informações de envio</x-tab.button>
                        <x-tab.button class="" id="reviews" target="reviews" controls="reviews" select="false" icon="icon-pencil">&nbsp Avaliações ({{ $reviewsCount }})</x-tab.button>
                    </x-tab>

                    <div class="tab-content" id="nav-tabContent">
                    <!-- Tab - Descrição ------------------------------------  -->
                        <x-tab.content class="show active" id="description" label="description">
                            {{ $book->description }}
                        </x-tab.content>

                        <!-- Tab - Informações de envio ---------------------  -->
                        <x-tab.content class="" id="shipping-info" label="shipping-info">{{ __('c_i_s_u.shipping_info') }}
                            <!-- TODO TEXT  --> TO DO TEXT
                        </x-tab.content>

                        <!-- Tab - Avaliações ------------------------------------  -->
                        <x-tab.content class="" id="reviews" label="reviews">
                            <div class="section-header text-center">
                                <h2 class="section-title font-alt">{{ __('c_i_s_u.reviews_count') }}</h2>
                            </div>
                            <!-- Avaliações -->
                            <div class="reviews-section">

                                @forelse($book->reviews as $review)
                                    <div class="review-post">
                                        <div class="row">
                                            <div class="col-md-2 text-center">
                                                <img src="{{ asset('imgs/no_user.png') }}" class="author-avatar" alt="User Avatar">
                                            </div>
                                            <div class="col-md-5">
                                                <h2 class="review-author font-alt">
                                                    <a href="#">{{ $review->user->name }}</a>
                                                </h2>
                                                <p>{{ $review->user->reviews->count() }} {{ __('c_i_s_u.reviews') }}</p>
                                            </div>
                                            <div class="col-md-5 text-end">
                                                <div class="review-date font-alt">{{ $review->created_at }}</div>
                                                <div class="col-sm-12">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fa fa-star{{ $i <= $review->rating ? '' : '-off' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="review-entry">
                                                <h2 class="review-title font-serif mb-3">{{ __('c_i_s_u.review_title') }}</h2>
                                                <p class="review-text">{{ $review->comment }}</p>
                                                <div class="text-end">
                                                    <button class="btn" type="submit"><i class="fa-solid fa-pen-to-square"></i></button>
                                                    <button class="btn" type="submit"><i class="fa-regular fa-trash-can"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>{{ __('c_i_s_u.no_reviews') }}</p>
                                @endforelse
                            </div>

                            <!-- TODO Pagination -->
                            <div class="text-center mb-5">
                                Pagination
                            </div>

                            <!-- Botão que chama o formulário -->
                            <div class="text-center mt-5 mb-5">
                                <button class="btn btn-solid" id="show-editor">Criar uma nova crítica</button>
                            </div>

                            <!-- Formulário para envio de avaliação -->
                            <div class="editor" id="editor-form" style="display: none;">
                                <form action="#" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" id="topic" name="topic" placeholder="Título" />
                                        </div>
                                        <div class="col-md-6 mb-3 text-end">
                                            Tua avaliação deste livro:
                                            STARS :)
                                        </div>
                                    </div>
                                    <div id="editor-container-2"></div>
                                    <input type="hidden" id="content" name="content" />
                                    <div class="mt-3 text-end">
                                        <button type="submit" class="btn btn-solid">{{ __('c_i_s_u.send') }}</button>
                                    </div>
                                </form>
                            </div>

                        </x-tab.content>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
