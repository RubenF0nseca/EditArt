@extends('layouts.admin.base')

@section('title','Lista de Autores')

@section('button')
    <a href="{{ route('authors.create') }}" class="btn btn-lightnew rounded-pill shadow-sm">
        <i class="fa-solid fa-user-plus"></i>&nbsp Novo autor</a>
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
                                <th class="d-none d-md-table-cell">Foto</th>
                                <th class="d-none d-md-table-cell">Nome</th>
                                <th class="d-none d-md-table-cell">biografia</th>
                                <th class="d-none d-md-table-cell">Data nascimento</th>
                                <th class="w-auto text-end">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($authors as $author)
                                <tr>
                                    <td>{{ $author->id }}</td>
                                    <td>
                                        @if($author->profilePicture)
                                            <img src="{{asset('storage/'.$author->profilePicture)}}" class="product-thumb rounded" alt="{{ $author->name }}" style="width: 30px;">
                                        @else
                                            <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded" alt="Imagem não disponível" style="width: 30px;">
                                        @endif
                                    </td>
                                    <td>{{ $author->name }}</td>
                                    <td class="d-none d-md-table-cell">{{ Str::limit($author->biography, 60, '...') }}</td>
                                    <td class="d-none d-md-table-cell">{{ $author->birthdate }}</td>
                                    <td class="text-end">

                                        <a href="{{ route('authors.show', $author->id) }}" class="btn btn-info"><i class="ti ti-eye"></i></a>
                                        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display: inline" >
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-delete"><i class="ti ti-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{$authors->links('layouts.admin.parts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
