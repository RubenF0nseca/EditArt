@php
    $layout = 'layouts.guest.base';

    if (auth()->check() && auth()->user()->hasAnyRole(['admin', 'cliente'])) {
        $layout = 'layouts.client.base';
    }
@endphp

@extends($layout)
@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <!-- Banner ------------------------------------  -->
        <div class="store-bg">
            <h2 class="module-title font-alt margin-top">{{ __('guest.store') }} <br>{{ __('guest.online') }}</h2>
        </div>
        <!-- ----- Os produtos ---------------------------  -->
        <div class="page-body">
            <div class="container-xl">
                <section id="popular-books" class="bookshelf py-5">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <div class="section-header text-center pb-5">
                                <h2 class="section-title font-alt">{{ __('guest.our_publications') }}</h2>
                                <div class="section-subtitle font-serif">{{ __('guest.our_authors_works') }}</div> <!-- ------ TODO TEXTO--------  -->
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
                                        <input class="form-control"
                                               type="text"
                                               name="title"
                                               id="search-input"
                                               placeholder="{{ __('guest.search_by_title') }}"
                                               value="{{ request('title') }}"/>
                                        <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>

                            <!-- Filtrar por categorias de livros  -->
                            <div class="widget">
                                <h5 class="widget-title font-alt">{{ __('guest.categories') }}</h5>
                                <ul class="icon-list">
                                    <li><a href="{{ route('guest.books') }}">{{ __('guest.all_genres') }}</a></li>
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
                            <div id="books-container">
                                @include('books.parts.BookList')
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
