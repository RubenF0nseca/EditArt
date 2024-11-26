@extends('layouts.admin.base')

@section('title','Lista de autores')

@section('button')
    <a href="{{ route('authors.create') }}" class="btn btn-primary rounded-pill">
        <i class="fa-solid fa-user-plus"></i>&nbsp Novo escritor</a>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="">ID</th>
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
                                    <td>{{ $author->name }}</td>
                                    <td class="d-none d-md-table-cell">{{ $author->biography }}</td>
                                    <td class="d-none d-md-table-cell">{{ $author->birthdate }}</td>
                                    <td class="text-end">

                                        <a href="#" class="btn btn-info "><i class="ti ti-eye"></i></a>
                                        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display: inline" >
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
                </div>
            </div>
        </div>
    </div>
@endsection
