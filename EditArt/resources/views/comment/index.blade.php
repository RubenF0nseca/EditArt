@extends('layouts.admin.base')

@section('title','Lista de Comentários')

@section('button')
    <x-button.add link="{{ route('comments.create') }}" icon="fa-plus">&nbsp Novo Comentário</x-button.add>
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
                                    <x-table.th>Comentário</x-table.th>
                                    <x-table.th class="text-end">Ações</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($comments as $comment)
                                <x-table.tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ Str::limit($comment->content, 120, '...') }}</td>
                                    <td class="text-end">

                                        <a href="{{ route('comments.show', $comment->id) }}" class="btn btn-info "><i class="ti ti-eye"></i></a>
                                        <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline" >
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
                        {{ $comments->links('layouts.admin.parts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
