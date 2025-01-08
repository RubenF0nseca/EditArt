@extends('layouts.admin.base')

@section('title','Lista de Avaliações')

@section('button')
    <x-button.add link="{{ route('reviews.create') }}" icon="fa-plus">&nbsp Nova Avaliação</x-button.add>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="table-responsive">

                        <x-table>
                            <x-table.thead>
                                <x-table.tr>
                                    <x-table.th>ID</x-table.th>
                                    <x-table.th>ID livro</x-table.th>
                                    <x-table.th>ID user</x-table.th>
                                    <x-table.th>Nota</x-table.th>
                                    <x-table.th>Data</x-table.th>
                                    <x-table.th class="text-end">Ações</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($reviews as $review)
                                <x-table.tr>
                                    <td>{{ $review->id }}</td>
                                    <td>{{ $review->id_book }}</td>
                                    <td>{{ $review->id_user }}</td>
                                    <td>{{ $review->rating }}</td>
                                    <td>{{ $review->review_date }}</td>
                                    <td class="text-end">

                                        <a href="{{ route('reviews.show', $review->id) }}" class="btn btn-info "><i class="ti ti-eye"></i></a>
                                        <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display: inline" >
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-delete"><i class="ti ti-trash"></i></button>
                                        </form>
                                    </td>
                                </x-table.tr>
                            @endforeach
                            </x-table.tbody>
                        </x-table>
                    </div>
                    <div class="card-footer">
                        {{ $reviews->links('layouts.admin.parts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
