@extends('layouts.admin.base')

@section('title','Lista de Avaliações')

@section('button')
    <a href="{{ route('reviews.create') }}" class="btn btn-primary rounded-pill">
        <i class="fa-solid fa-user-plus"></i>&nbsp Nova Avaliação</a>
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
                                <th class="d-none d-md-table-cell">ID livro</th>
                                <th class="d-none d-md-table-cell">ID user</th>
                                <th class="d-none d-md-table-cell">Nota</th>
                                <th class="d-none d-md-table-cell">Data</th>
                                <th class="w-auto text-end">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $review->id }}</td>
                                    <td>{{ $review->id_book }}</td>
                                    <td>{{ $review->id_user }}</td>
                                    <td class="d-none d-md-table-cell">{{ $review->rating }}</td>
                                    <td class="d-none d-md-table-cell">{{ $review->review_date }}</td>
                                    <td class="text-end">

                                        <a href="{{ route('reviews.show', $review->id) }}" class="btn btn-info "><i class="ti ti-eye"></i></a>
                                        <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display: inline" >
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
                        {{ $reviews->links('layouts.admin.parts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
