@extends('layouts.admin.base')

@section('title','Lista de Comentários')

@section('button')
    <a href="{{ route('comments.create') }}" class="btn btn-lightnew rounded-pill">
        <i class="fa-solid fa-plus"></i>&nbsp Novo Comentário</a>
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
                                <th class="d-none d-md-table-cell">Comentário</th>
                                <th class="w-auto text-end">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td class="d-none d-md-table-cell">{{ Str::limit($comment->content, 120, '...') }}</td>
                                    <td class="text-end">

                                        <a href="{{ route('comments.show', $comment->id) }}" class="btn btn-info "><i class="ti ti-eye"></i></a>
                                        <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline" >
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
                        {{ $comments->links('layouts.admin.parts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
