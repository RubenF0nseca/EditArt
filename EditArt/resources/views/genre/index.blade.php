@extends('layouts.admin.base')

@section('title','Lista de Géneros Literários')

@section('button')
    <a href="{{ route('genres.create') }}" class="btn btn-primary rounded-pill shadow-sm">
        <i class="fa-solid fa-user-plus"></i>&nbsp Novo Género Literário</a>
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
                                <th class="d-none d-md-table-cell">Nome</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($genre as $gen)
                                <tr>
                                    <td>{{ $gen->id }}</td>
                                    <td>{{ $gen->name }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('genres.edit', $gen->id) }}" class="btn btn-warning"><i
                                                class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('genres.destroy', $gen->id) }}" method="POST"
                                              style="display: inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{$genre->links('layouts.admin.parts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
