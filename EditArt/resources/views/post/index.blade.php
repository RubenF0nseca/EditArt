@extends('layouts.admin.base')

@section('title','Lista de tópicos')

@section('button')
    <a href="{{ route('posts.create') }}" class="btn btn-primary rounded-pill">
        <i class="fa-solid fa-plus"></i>&nbsp Novo Topico</a>
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
                                <th class="d-none d-md-table-cell">Titulo</th>
                                <th class="d-none d-md-table-cell">Conteúdo</th>
                                <th class="w-auto text-end">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td class="d-none d-md-table-cell">{{ Str::limit($post->content, 60, '...') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info "><i class="ti ti-eye"></i></a>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline" >
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
                        {{ $posts->links('layouts.admin.parts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
