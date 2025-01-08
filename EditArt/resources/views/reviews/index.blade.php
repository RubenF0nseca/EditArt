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

                                        <x-table.operation link="{{ route('reviews.show', $review->id) }}" name="info" icon="ti ti-eye"></x-table.operation>
                                        <x-table.operation link="{{ route('reviews.edit', $review->id) }}" name="edit" icon="fa fa-pencil"></x-table.operation>
                                        <x-table.delete action="{{ route('reviews.destroy', $review->id) }}"></x-table.delete>

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
