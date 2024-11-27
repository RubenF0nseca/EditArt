@extends('layouts.admin.base')

@section('title','Lista de Produtos')

@section('button')
    <a href="{{ route('books.create') }}" class="btn btn-primary rounded-pill shadow-sm">
        <i class="fa-solid fa-file-circle-plus"></i>&nbsp Novo produto</a>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="">ID</th>
                                <th class="d-none d-md-table-cell">Capa</th>
                                <th class="d-none d-md-table-cell">Titulo</th>
                                <th class="d-none d-md-table-cell">Tipo</th>
                                <th class="d-none d-md-table-cell">Stock</th>
                                <th class="d-none d-md-table-cell">Preço</th>
                                <th class="w-auto text-end">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($books as $book)
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>
                                        @if($book->CoverPicture)
                                            <img src="{{asset('storage/'.$book->CoverPicture)}}" class="product-thumb rounded" alt="{{ $book->title }}" style="width: 30px;">
                                        @else
                                            <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded" alt="Imagem não disponível" style="width: 30px;">
                                        @endif
                                        </td>
                                    <td>{{ $book->title }}</td>
                                    <td class="d-none d-md-table-cell">{{ $book->type }}</td>
                                    <td class="d-none d-md-table-cell">{{ $book->stock }}</td>
                                    <td class="d-none d-md-table-cell">{{ $book->price }}€</td>
                                    <td class="text-end">

                                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-info "><i class="ti ti-eye"></i></a>
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline" >
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i class="ti ti-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $books->links('layouts.admin.parts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
