@extends('layouts.admin.base')

@section('title',__('c_i_s_u.authors_list_title'))

@section('button')
    <x-button.add link="{{ route('admin.authors.create') }}" icon="fa-user-plus">&nbsp {{ __('c_i_s_u.add_new_author_button') }}</x-button.add>
@endsection

@section('content')
    <div class="container">
        <!-- Barra de pesquisa -->
        <x-widget.search
            action="{{ route('admin.authors.index') }}"
            name="name"
            placeholder="{{ __('c_i_s_u.search_placeholder_author') }}"
            value="{{ request('name') }}"
        />

        <!-- Tabela -->
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="table-responsive">

                        <x-table>
                            <x-table.thead>
                                <x-table.tr>
                                    <x-table.th>{{ __('c_i_s_u.table_photo') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.table_name') }}</x-table.th>
                                    <x-table.th class="d-none">{{ __('c_i_s_u.table_biography') }}</x-table.th>
                                    <x-table.th class="d-none">{{ __('c_i_s_u.table_birthdate') }}</x-table.th>
                                    <x-table.th class="text-end">{{ __('c_i_s_u.table_actions') }}</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>
                                <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                                @foreach($authors as $author)
                                    <x-table.tr>
                                        <td>
                                            @if($author->profilePicture)
                                                <img src="{{asset('storage/'.$author->profilePicture)}}" class="product-thumb rounded" alt="{{ $author->name }}" style="width: 30px;">
                                            @else
                                                <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded" alt="{{ __('c_i_s_u.image_not_available') }}" style="width: 30px;">
                                            @endif
                                        </td>
                                        <td>{{ $author->name }}</td>
                                        <td class="d-none d-md-table-cell">{{ Str::limit($author->biography, 60, '...') }}</td>
                                        <td class="d-none d-md-table-cell">{{ $author->birthdate }}</td>
                                        <td class="text-end">

                                            <x-table.operation link="{{ route('admin.authors.show', $author->id) }}" name="info" icon="ti ti-eye"></x-table.operation>
                                            <x-table.operation link="{{ route('admin.authors.edit', $author->id) }}" name="edit" icon="fa fa-pencil"></x-table.operation>
                                            <x-table.delete action="{{ route('admin.authors.destroy', $author->id) }}"></x-table.delete>

                                        </td>
                                    </x-table.tr>
                                @endforeach
                            </x-table.tbody>
                        </x-table>

                    </div>
                    <div class="card-footer">
                        {{$authors->links('layouts.admin.parts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
