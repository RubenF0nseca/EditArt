@extends('layouts.admin.base')

@section('title','Lista de Produtos')

@section('button')
    <x-button.add link="{{ route('admin.books.create') }}" icon="fa-file-circle-plus">&nbsp Novo produto</x-button.add>
@endsection

@section('content')
    <div class="container">
        <!-- Barra de pesquisa -->
        <x-widget.search action="#" name="#" placeholder="#" value="#"></x-widget.search>

        <!-- Tabela -->
        <div class="row">
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="table-responsive">

                        <x-table>
                            <x-table.thead>
                                <x-table.tr>
                                    <x-table.th>ID</x-table.th>
                                    <x-table.th>Capa</x-table.th>
                                    <x-table.th>Titulo</x-table.th>
                                    <x-table.th>Tipo</x-table.th>
                                    <x-table.th>Stock</x-table.th>
                                    <x-table.th>Preço</x-table.th>
                                    <x-table.th class="text-end">Ações</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($books as $book)
                                <x-table.tr>
                                    <td>{{ $book->id }}</td>
                                    <td>
                                        @if($book->CoverPicture)
                                            <img src="{{asset('storage/'.$book->CoverPicture)}}" class="product-thumb rounded" alt="{{ $book->title }}" style="width: 30px;">
                                        @else
                                            <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded" alt="Imagem não disponível" style="width: 30px;">
                                        @endif
                                        </td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->type }}</td>
                                    <td>{{ $book->stock }}</td>
                                    <td>{{ $book->price }}€</td>
                                    <td class="text-end">

                                        <x-table.operation link="{{ route('admin.books.show', $book->id) }}" name="info" icon="ti ti-eye"></x-table.operation>
                                        <x-table.operation link="{{ route('admin.books.edit', $book->id) }}" name="edit" icon="fa fa-pencil"></x-table.operation>
                                        <x-table.delete action="{{ route('admin.books.destroy', $book->id) }}"></x-table.delete>

                                    </td>
                                </x-table.tr>
                            @endforeach
                            </x-table.tbody>
                        </x-table>
                    </div>
                    <div class="card-footer">
                        {{ $books->links('layouts.admin.parts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
