@extends('layouts.admin.base')

@section('title','Lista de tópicos')

@section('button')
    <x-button.add link="{{ route('posts.create') }}" icon="fa-plus">&nbsp Novo Topico</x-button.add>
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
                                    <x-table.th>Titulo</x-table.th>
                                    <x-table.th>Conteúdo</x-table.th>
                                    <x-table.th class="text-end">Ações</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($posts as $post)
                                <x-table.tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ Str::limit($post->content, 60, '...') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info "><i class="ti ti-eye"></i></a>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline" >
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
                        {{ $posts->links('layouts.admin.parts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
