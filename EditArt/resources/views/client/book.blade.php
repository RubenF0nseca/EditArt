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
                                Nenhum autor associado.
                            @endif

                        </div>
                    </div>
                    <div class="row mb-20"> <!-- Estrelas -->
                        <div class="col-sm-12"><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star-off"></i></span>
                        </div>
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
                        <x-tab.button class="" id="reviews" target="reviews" controls="reviews" select="false" icon="icon-pencil">&nbsp Avaliações (2)</x-tab.button>
                    </x-tab>

                    <div class="tab-content" id="nav-tabContent">
                    <!-- Tab - Descrição ------------------------------------  -->
                        <x-tab.content class="show active" id="description" label="description">
                            {{ $book->description }}
                        </x-tab.content>

                        <!-- Tab - Informações de envio ---------------------  -->
                        <x-tab.content class="" id="shipping-info" label="shipping-info">
                            <!-- TODO TEXT  --> TO DO TEXT
                        </x-tab.content>

                        <!-- Tab - Avaliações ------------------------------------  -->
                        <x-tab.content class="" id="reviews" label="reviews">
                            <div class="section-header text-center">
                                <h2 class="section-title font-alt">CRÍTICAS DE LEITORES</h2>
                            </div>
                            <!-- Avaliações -->
                            <div class="review-post">
                                <div class="row">
                                    <div class="col-md-2 text-center">
                                        <img src="{{asset('imgs/no_user.png')}}" class="author-avatar" alt="">
                                    </div>
                                    <div class="col-md-5">
                                        <h2 class="review-author font-alt"><a href="#">Maria Mendes</a></h2>
                                        <p>32 críticas</p>
                                    </div>
                                    <div class="col-md-5 text-end">
                                        <div class="review-date font-alt">June 21, 2018</div>
                                        <div class="col-sm-12"><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star-off"></i></span></div>
                                        <div class="review-comment">3 Comentarios</div>
                                    </div>
                                    <div class="review-entry">
                                        <h2 class="review-title font-serif mb-3">Title lorem ipsum</h2>
                                        <p class="review-text">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span><i class="fa-solid fa-angles-up">&nbsp 18</i></span>
                                                <span><i class="fa-solid fa-angles-down">&nbsp 0</i></span>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <a class="more-link font-serif" href="#">Mostrar resenha completa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TODO Pagination -->
                            <div class="text-center mb-5">
                                Pagination
                            </div>

                            <!-- Formulário para envio de avaliação -->
                            <div class="review-post">
                                <form action="#" method="POST">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="editor-container font-alt">Escreva aqui sua crítica</label>
                                        <div id="editor-container" style="height: 200px; border: 1px solid #ccc;"></div>
                                    </div>

                                    <input type="hidden" name="content" />

                                    <button type="submit" class="btn btn-solid">Enviar</button>
                                </form>
                            </div>

                        </x-tab.content>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
