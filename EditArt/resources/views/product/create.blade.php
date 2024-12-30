@extends('layouts.admin.base')

@section('title','Criar um novo Produto')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Insira os dados para a criação de um novo produto</h4>
                    </div>
                    <div class="card-body">
                        <!-- Alerta para mensagem de sucesso -->
                        @if(session('success'))
                            <div id="success-alert" class="alert alert-success alert-dismissible fade show"
                                 role="alert">
                                {{session('success')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif


                        <!-- Alerta para mensagem de erro geral -->
                        @if($errors->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{$errors->first('error')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif


                        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label required">Title</label>
                                <input type="text" id="title" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title' )}}">
                                @error('title')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="authors" class="form-label required">Autores</label>
                                <div class="custom-dropdown">
                                    <input type="text" id="search-authors" class="form-control" placeholder="Pesquise e selecione autores...">
                                    <div id="selected-authors" class="selected-authors">
                                        <!-- Autores selecionados aparecerão aqui -->
                                    </div>
                                    <div id="dropdown-authors" class="dropdown-list">
                                        @foreach($authors as $author)
                                            <div class="dropdown-item" data-value="{{ $author->id }}">{{ $author->name }}</div>
                                        @endforeach
                                    </div>
                                    <!-- Campo oculto para envio dos IDs selecionados -->
                                    <input type="hidden" id="authors" name="authors[]" value="">
                                </div>
                                @error('authors')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label required">Tipo</label>
                                <select id="type" name="type" class="form-control @error('type') is-invalid @enderror">
                                    <option value="" disabled {{ old('type') ? '' : 'selected' }}>Selecione uma opção
                                    </option>
                                    <option value="book" {{ old('type') == 'book' ? 'selected' : '' }}>Book</option>
                                    <option value="ebook" {{ old('type') == 'ebook' ? 'selected' : '' }}>eBook</option>
                                </select>
                                @error('type')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="publicationDate" class="form-label required">Data publicação</label>
                                <input type="date" id="publicationDate" name="publicationDate"
                                       class="form-control @error('publicationDate') is-invalid @enderror"
                                       value="{{old('publicationDate')}}">
                                @error('publicationDate')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="editionNumber" class="form-label required">Numero de edição</label>
                                <input type="text" id="editionNumber" name="editionNumber"
                                       class="form-control @error('editionNumber') is-invalid @enderror"
                                       value="{{old('editionNumber')}}">
                                @error('editionNumber')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="isbn" class="form-label required">ISBN</label>
                                <input type="text" id="isbn" name="isbn"
                                       class="form-control @error('isbn') is-invalid @enderror" value="{{old('isbn')}}">
                                @error('isbn')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="numberOfPages" class="form-label required">Numero de paginas</label>
                                <input type="text" id="numberOfPages" name="numberOfPages"
                                       class="form-control @error('numberOfPages') is-invalid @enderror"
                                       value="{{old('numberOfPages')}}">
                                @error('numberOfPages')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label required">Stock</label>
                                <input type="text" id="stock" name="stock"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       value="{{old('stock')}}">
                                @error('stock')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="language" class="form-label required">Idioma</label>
                                <input type="text" id="language" name="language"
                                       class="form-control @error('language') is-invalid @enderror"
                                       value="{{old('language')}}">
                                @error('language')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label required">Preço</label>
                                <input type="text" id="price" name="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{old('price')}}">
                                @error('price')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="CoverPicture" class="form-label required">Imagem da Capa</label>
                                <input type="file"
                                       id="CoverPicture"
                                       name="CoverPicture"
                                       class="form-control @error('CoverPicture') is-invalid @enderror">
                                @error('CoverPicture')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Criar</button>
                                <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
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
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');//
            if (successAlert) {
                setTimeout(function () {
                    // Adiciona a classe 'fade' e remove a classe 'show' para iniciar a transição de fechamento
                    successAlert.classList.remove('show');
                    successAlert.classList.add('fade');

                    // Remove o elemento do DOM depois da transição
                    setTimeout(function () {
                        successAlert.remove();
                    }, 500); // Ajuste o tempo conforme o efeito 'fade'
                }, 3000); // Fecha o alerta após 3 segundos
            }
        });
    </script>

@endpush
