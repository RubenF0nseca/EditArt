@extends('layouts.admin.base')

@section('title','Lista de Produtos')

@section('button')
    <x-button.add link="{{ route('books.create') }}" icon="fa-file-circle-plus">&nbsp Novo produto</x-button.add>
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

                                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-info "><i class="ti ti-eye"></i></a>
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline" >
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
                        {{ $books->links('layouts.admin.parts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
