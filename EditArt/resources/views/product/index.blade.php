@extends('layouts.admin.base')

@section('title', __('c_i_s_u.list_of_books'))

@section('button')
    <x-button.add link="{{ route('admin.books.create') }}" icon="fa-file-circle-plus">&nbsp {{ __('c_i_s_u.new_book') }}</x-button.add>
@endsection

@section('content')
    <div class="container">
        <!-- Barra de pesquisa -->
        <x-widget.search
            action="{{ route('admin.books.index') }}"
            name="title"
            placeholder="{{ __('c_i_s_u.search_placeholder') }}"
            value="{{ request('title') }}"
        />

        <!-- Tabela -->
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card shadow-lg border-0 rounded-lg mt-4" >
                    <div class="table-responsive">

                        <x-table>
                            <x-table.thead>
                                <x-table.tr>
                                    <x-table.th>{{ __('c_i_s_u.cover') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.title') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.type') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.stock') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.price') }}</x-table.th>
                                    <x-table.th class="text-end">{{ __('c_i_s_u.actions') }}</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($books as $book)
                                <x-table.tr>
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
