@extends('layouts.admin.base')

@section('title', __('c_i_s_u.edit_product'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('c_i_s_u.insert_product_details') }}</h4>
                    </div>
                    <div class="card-body">
                        <!-- Alerta para mensagem de sucesso -->
                        @if(session('success'))
                            <x-alert id="success-alert" type="success">
                                {{ session('success') }}
                            </x-alert>
                        @endif

                        <!-- Alerta para mensagem de erro geral -->
                        @if($errors->has('error'))
                            <x-alert id="" type="danger">
                                {{$errors->first('error')}}
                            </x-alert>
                        @endif

                        <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Título -->
                            <div class="mb-3">
                                <label for="title" class="form-label required">{{ __('c_i_s_u.title') }}</label>
                                <input type="text"
                                       id="title"
                                       name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ $book->title }}" >
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Autores -->
                            <div class="mb-3">
                                <label for="authors" class="form-label required">{{ __('c_i_s_u.authors') }}</label>
                                <div class="custom-dropdown">
                                    <!-- Campo de pesquisa -->
                                    <input type="text"
                                           id="search-authors"
                                           class="form-control"
                                           placeholder="Pesquise e selecione autores...">

                                    <!-- Tags visuais já existentes -->
                                    <div id="selected-authors" class="selected-authors">
                                        @foreach($book->authors as $author)
                                            <div class="author-tag" data-value="{{ $author->id }}">
                                                {{ $author->name }}
                                                <span class="remove-tag" data-value="{{ $author->id }}">x</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Itens do dropdown -->
                                    <div id="dropdown-authors" class="dropdown-list">
                                        @foreach($authors as $author)
                                            <div class="dropdown-item" data-value="{{ $author->id }}">
                                                {{ $author->name }}
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Inputs hidden para enviar autores selecionados -->
                                    <div id="authors-container">
                                        @foreach($book->authors as $author)
                                            <input type="hidden" name="authors[]" value="{{ $author->id }}">
                                        @endforeach
                                    </div>
                                </div>
                                @error('authors')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tipo (Book/eBook) -->
                            <div class="mb-3">
                                <label for="type" class="form-label required">{{ __('c_i_s_u.type') }}</label>
                                <select id="type"
                                        name="type"
                                        class="form-control @error('type') is-invalid @enderror">
                                    <option value="" disabled {{ old('type', $book->type) == '' ? 'selected' : '' }}>
                                        {{ __('c_i_s_u.select_option') }}
                                    </option>
                                    <option value="book"  {{ old('type', $book->type) == 'book'  ? 'selected' : '' }}>
                                        {{ __('c_i_s_u.book') }}
                                    </option>
                                    <option value="ebook" {{ old('type', $book->type) == 'ebook' ? 'selected' : '' }}>
                                        {{ __('c_i_s_u.ebook') }}
                                    </option>
                                </select>
                                @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gêneros -->
                            <div class="mb-3">
                                <label for="genres" class="form-label required">{{ __('c_i_s_u.genres') }}</label>
                                <div class="custom-dropdown">
                                    <!-- Campo de pesquisa -->
                                    <input type="text"
                                           id="search-genres"
                                           class="form-control"
                                           placeholder="{{ __('messages.search_and_select_genres') }}">

                                    <!-- Tags visuais já existentes -->
                                    <div id="selected-genres" class="selected-authors">
                                        @foreach($book->genres as $genre)
                                            <div class="author-tag" data-value="{{ $genre->id }}">
                                                {{ $genre->name }}
                                                <span class="remove-tag" data-value="{{ $genre->id }}">x</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Itens do dropdown -->
                                    <div id="dropdown-genres" class="dropdown-list">
                                        @foreach($genres as $genre)
                                            <div class="dropdown-item" data-value="{{ $genre->id }}">
                                                {{ $genre->name }}
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Inputs hidden para enviar géneros selecionados -->
                                    <div id="genres-container">
                                        @foreach($book->genres as $genre)
                                            <input type="hidden" name="genres[]" value="{{ $genre->id }}">
                                        @endforeach
                                    </div>
                                </div>
                                @error('genres')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Data de publicação -->
                            <div class="mb-3">
                                <label for="publicationDate" class="form-label required">{{ __('c_i_s_u.publication_date') }}</label>
                                <input type="date"
                                       id="publicationDate"
                                       name="publicationDate"
                                       class="form-control @error('publicationDate') is-invalid @enderror"
                                       value="{{ $book->publicationDate }}" >
                                @error('publicationDate')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Número de edição -->
                            <div class="mb-3">
                                <label for="editionNumber" class="form-label required">{{ __('c_i_s_u.edition_number') }}</label>
                                <input type="text"
                                       id="editionNumber"
                                       name="editionNumber"
                                       class="form-control @error('editionNumber') is-invalid @enderror"
                                       value="{{ $book->editionNumber }}" >
                                @error('editionNumber')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- ISBN -->
                            <div class="mb-3">
                                <label for="isbn" class="form-label required">{{ __('c_i_s_u.isbn') }}</label>
                                <input type="text"
                                       id="isbn"
                                       name="isbn"
                                       class="form-control @error('isbn') is-invalid @enderror"
                                       value="{{ $book->isbn }}" >
                                @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Número de páginas -->
                            <div class="mb-3">
                                <label for="numberOfPages" class="form-label required">{{ __('c_i_s_u.number_of_pages') }}</label>
                                <input type="text"
                                       id="numberOfPages"
                                       name="numberOfPages"
                                       class="form-control @error('numberOfPages') is-invalid @enderror"
                                       value="{{ $book->numberOfPages }}" >
                                @error('numberOfPages')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Stock -->
                            <div class="mb-3">
                                <label for="stock" class="form-label required">{{ __('c_i_s_u.stock') }}</label>
                                <input type="text"
                                       id="stock"
                                       name="stock"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       value="{{ $book->stock }}" >
                                @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Idioma -->
                            <div class="mb-3">
                                <label for="language" class="form-label required">{{ __('c_i_s_u.language') }}</label>
                                <input type="text"
                                       id="language"
                                       name="language"
                                       class="form-control @error('language') is-invalid @enderror"
                                       value="{{ $book->language }}" >
                                @error('language')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Preço -->
                            <div class="mb-3">
                                <label for="price" class="form-label required">{{ __('c_i_s_u.price') }}</label>
                                <input type="text"
                                       id="price"
                                       name="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ $book->price }}" >
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Imagem da capa -->
                            <div class="mb-3">
                                <label for="CoverPicture" class="form-label required">{{ __('c_i_s_u.cover_picture') }}</label>
                                <input type="file"
                                       id="CoverPicture"
                                       name="CoverPicture"
                                       class="form-control @error('CoverPicture') is-invalid @enderror">
                                @error('CoverPicture')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Botões -->
                            <div class="text-end">
                                <x-button.submit color="solid">{{ __('c_i_s_u.save') }}</x-button.submit>
                                <x-button.link link="{{ route('admin.books.show', $book->id) }}" color="dark-solid">{{ __('c_i_s_u.cancel') }}</x-button.link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');
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
