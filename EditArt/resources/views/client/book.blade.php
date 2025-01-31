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
            <!-- Alerta para mensagem de sucesso -->
            @if(session('success'))
                <x-alert id="success-alert" type="success">
                    {{ session('success') }}
                </x-alert>
            @endif

            @if(session('error'))
                <x-alert id="error-alert" type="danger">
                    {{ session('error') }}
                </x-alert>
            @endif

            <div class="row mb-5" id="margin-top">
                <!-- Alerta para mensagem de sucesso -->
                @if(session('success'))
                    <x-alert id="success-alert" type="success">
                        {{ session('success') }}
                    </x-alert>
                @endif

                @if(session('error'))
                    <x-alert id="error-alert" type="danger">
                        {{ session('error') }}
                    </x-alert>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Imagem do livro ------------------------------------  -->
                <div class="col-md-5 mb-3 d-flex justify-content-center">
                    @if($book->CoverPicture)
                        <img href="{{route('book', $book->id)}}" src="{{ asset('storage/'.$book->CoverPicture) }}" class="product-thumb rounded book-capa" alt="{{ $book->title }}">
                    @else
                        <img href="{{route('book', $book->id)}}" src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded book-capa" alt="{{ __('admin.books.image_not_available') }}">
                    @endif
                </div>

                <!-- Detalhes do livro ------------------------------------  -->
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="product-title font-alt">{{ $book->title }}</h1>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            @if($book->authors->isNotEmpty())
                                @foreach($book->authors as $author)
                                    <h2 class="author-name font-serif">{{ $author->name }}</h2>
                                @endforeach
                            @else
                                {{ __('client.no_authors') }}
                            @endif
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <div class="tipo">
                                <p>{{ $book->type }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $wholeStars)
                                <i class="fa fa-star" style="color: #b27e06;"></i>
                            @elseif ($i == $wholeStars + 1 && $hasHalfStar)
                                <i class="fa fa-star-half-alt" style="color: #b27e06;"></i>
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
                                <p>{{ Str::limit($book->description, 500, '...') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-20 mt-3">
                        <div class="col-md-5 mb-sm-20 mb-3" style="width: 8rem;">
                            <input class="form-control input-lg" type="number" name="" value="1" max="40" min="1" required="required"/>
                        </div>
                        <div class="col-md-7"><a class="btn btn-solid" href="#">Add To Cart</a></div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12 mt-4">
                            <span class="font-alt" style="color: #1d1d1c">Categories:</span>
                            <span class="categories font-alt">
                                @if($book->genres->isNotEmpty())
                                    @foreach($book->genres as $genre)
                                        {{ $genre->name }} &nbsp;
                                    @endforeach
                                @else
                                    {{ __('client.no_genres') }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tablist ------------------------------------  -->
            <div class="row mt-70 mb-5">
                <div class="col-sm-12">
                    <x-tab>
                        <x-tab.button class="active" id="description" target="description" controls="description" select="true" icon="icon-book-open">&nbsp Descrição</x-tab.button>
                        <x-tab.button class="" id="shipping-info" target="shipping-info" controls="shipping-info" select="false" icon="icon-map">&nbsp Informações de envio</x-tab.button>
                        <x-tab.button class="" id="reviews" target="reviews" controls="reviews" select="false" icon="icon-pencil">&nbsp Avaliações ({{ $reviewsCount }})</x-tab.button>
                    </x-tab>

                    <div class="tab-content" id="nav-tabContent">
                        <!-- Tab - Descrição ------------------------------------  -->
                        <x-tab.content class="show active" id="description" label="description">
                            <div class="row mt-70">
                                <div class="col-md-8 offset-md-2">
                                    {{ $book->description }}
                                </div>
                            </div>
                        </x-tab.content>

                        <!-- Tab - Informações de envio ---------------------  -->
                        <x-tab.content class="" id="shipping-info" label="shipping-info">
                            <div class="row mt-70">
                                <div class="col-md-8 offset-md-3 shipping-info">
                                    <ul>
                                        <li><i class="icon-wallet"></i>&nbsp; Aplicam-se portes de envio para encomendas de valor inferior a 45€.</li>
                                        <li><i class="icon-clock"></i>&nbsp; O prazo de processamento da encomenda é de 24 horas.</li>
                                        <li><i class="icon-calendar"></i>&nbsp; A entrega pode demorar até 72 horas para Portugal Continental e até 10 dias úteis para os Açores e Madeira, sendo realizada através dos CTT.</li>
                                        <li><i class="icon-profile-male"></i>&nbsp; Em caso de devolução ou troca, por favor, entre em contato com a nossa equipa de suporte.</li>
                                    </ul>
                                </div>
                            </div>
                        </x-tab.content>

                        <!-- Tab - Avaliações ------------------------------------  -->
                        <x-tab.content class="" id="reviews" label="reviews">
                            <div class="col-md-10 offset-md-1">

                                <div class="section-header text-center">
                                    <h2 class="section-title font-alt">{{ __('client.reviews_count') }}</h2>
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
                                                    <p>{{ $review->user->reviews->count() }} {{ __('client.reviews') }}</p>
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
                                                    <h2 class="review-title font-serif mb-3">{{ $review->topic }}</h2>
                                                    <p class="review-text">{!! $review->comment !!}</p>

                                                    <!-- Só mostra Botões e Formulário de edição para quem pode (autor ou admin) -->
                                                    @auth
                                                        @if( Auth::id() === $review->user_id || Auth::user()->hasRole('admin') )
                                                            <div class="text-end">
                                                                <div class="tooltip-container" style="display: inline-block;">
                                                                    <!-- Botão para mostrar o formulário de edição -->
                                                                    <button class="btn operation show-editor-3" type="button">
                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                    </button>
                                                                    <span class="tooltip-text">Editar crítica</span>
                                                                </div>

                                                                <div class="tooltip-container" style="display: inline-block;">
                                                                    <form
                                                                        action="{{ route('client.review.delete', ['book' => $book->id, 'review' => $review->id]) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Tens a certeza que queres apagar esta avaliação?');"
                                                                        style="display: inline;"
                                                                    >
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn operation" type="submit">
                                                                            <i class="fa-regular fa-trash-can"></i>
                                                                        </button>
                                                                        <span class="tooltip-text">Apagar crítica</span>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                            <!-- Formulário para editar a avaliação (oculto por padrão) -->
                                                            <div class="editor m-0 editor-form-3" style="display: none;">
                                                                <form
                                                                    action="{{ route('client.review.update', ['book' => $book->id, 'review' => $review->id]) }}"
                                                                    method="POST"
                                                                    name="review-form-edit"
                                                                >
                                                                    @csrf
                                                                    @method('PUT') <!-- caso uses RESTful (update) -->

                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-3">
                                                                            <input
                                                                                style="width: 100%;"
                                                                                type="text"
                                                                                name="topic"
                                                                                value="{{ $review->topic }}"
                                                                                placeholder="Título"
                                                                                required
                                                                            />
                                                                        </div>

                                                                        <div class="col-md-6 mb-3 text-end">
                                                                            Tua avaliação deste livro:
                                                                            <div class="stars">
                                                                                @for ($j = 1; $j <= 5; $j++)
                                                                                    <i
                                                                                        class="fa fa-star @if($j <= $review->rating) selected @endif"
                                                                                        data-rating="{{ $j }}"
                                                                                    ></i>
                                                                                @endfor
                                                                            </div>
                                                                            <input
                                                                                type="hidden"
                                                                                class="rating-edit"
                                                                                name="rating"
                                                                                value="{{ $review->rating }}"
                                                                                required
                                                                            />
                                                                        </div>
                                                                    </div>

                                                                    <!-- Container do Quill, com ID único -->
                                                                    <div
                                                                        class="editor-container-3"
                                                                        id="editor-container-3-{{ $review->id }}"
                                                                        data-initial-content="{!! e($review->comment) !!}"
                                                                        style="height: 200px; border: 1px solid #ccc;"
                                                                    ></div>

                                                                    <!-- Input hidden onde enviaremos o HTML final do Quill -->
                                                                    <input
                                                                        type="hidden"
                                                                        class="comment-edit"
                                                                        name="comment"
                                                                        required
                                                                    />

                                                                    <div class="mt-3 text-end">
                                                                        <button type="submit" class="btn btn-solid">Gravar</button>
                                                                        <button type="button" class="btn btn-dark-solid close-editor">
                                                                            Cancelar
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endauth
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p>{{ __('client.no_reviews') }}</p>
                                    @endforelse
                                </div>

                                <!-- Pagination -->
                                <div class="text-center mb-5">
                                    {{ $reviews->links('layouts.admin.parts.pagination') }}
                                </div>

                                <!-- Botão que chama o formulário -->
                                @auth
                                    @php
                                        // Verifica se este user já tem review para este livro
                                        $jaFezReview = $book->reviews->where('user_id', Auth::id())->count() > 0;
                                    @endphp
                                    @if(!$jaFezReview)
                                        <div class="text-center mt-5 mb-5">
                                            <button class="btn btn-solid" id="show-editor-2">Criar uma nova crítica</button>
                                        </div>

                                        <!-- Formulário para envio de avaliação -->
                                        <div class="editor" id="editor-form-2" style="display: none;">
                                            <form action="{{ route('client.reviews.store', $book->id) }}" method="POST" name="review-form" id="review-form">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" id="topic" name="topic" placeholder="Título" required />
                                                    </div>
                                                    <div class="col-md-6 mb-3 text-end">
                                                        Tua avaliação deste livro:
                                                        <div id="star-rating" class="stars">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i class="fa fa-star" data-rating="{{ $i }}"></i>
                                                            @endfor
                                                        </div>
                                                        <input type="hidden" id="rating" name="rating" required />
                                                    </div>
                                                </div>
                                                <div id="editor-container-2" style="height: 200px; border: 1px solid #ccc;"></div>
                                                <input type="hidden" id="comment" name="comment" required />
                                                <div class="mt-3 text-end">
                                                    <button type="submit" class="btn btn-solid">{{ __('client.send') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </x-tab.content>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');//
            if (successAlert) {
                setTimeout(function() {
                    // Adiciona a classe 'fade' e remove a classe 'show' para iniciar a transição de fechamento
                    successAlert.classList.remove('show');
                    successAlert.classList.add('fade');

                    // Remove o elemento do DOM depois da transição
                    setTimeout(function() {
                        successAlert.remove();
                    }, 500); // Ajuste o tempo conforme o efeito 'fade'
                }, 3000); // Fecha o alerta após 3 segundos
            }
        });
    </script>

@endpush
