
@extends('layouts.admin.base')

@section('title','Detalhes do Produto')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body">
                        <!-- Alerta para mensagem de sucesso -->
                        @if(session('success'))
                            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('success')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <h3>[#{{ $book->id }}] </h3>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th scope="row">Titulo</th>
                                        <td>{{ $book->title }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tipo</th>
                                        <td>{{ $book->type }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Autores</th>
                                        <td>
                                            @if($book->authors->isNotEmpty())
                                                <ul>
                                                    @foreach($book->authors as $author)
                                                        <li>{{ $author->name }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                Nenhum autor associado.
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Data Publicação</th>
                                        <td>{{ $book->publicationDate }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Numero de edição</th>
                                        <td>{{ $book->editionNumber }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">ISBN</th>
                                        <td>{{ $book->isbn }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Numero de paginas</th>
                                        <td>{{ $book->numberOfPages }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Stock</th>
                                        <td>{{ $book->stock }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Idioma</th>
                                        <td>{{ $book->language }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Preço</th>
                                        <td>{{ $book->price }}€</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Produto atualizado em:</th>
                                        <td>{{ $book->updated_at }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                @if($book->CoverPicture)
                                    <img src="{{ asset('storage/'.$book->CoverPicture) }}" class="product-thumb rounded shadow-lg border-0 rounded-lg" alt="{{ $book->title }}" style="width: 280px; height: 400px;">
                                @else
                                    <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded shadow-lg border-0 rounded-lg" alt="Imagem não disponível" style="width: 280px; height: 400px;">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3 shadow-lg border-0 rounded-lg">Mostrar todos os produtos</a>
                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning mt-3 shadow-lg border-0 rounded-lg"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp Editar</a>
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
