@extends('layouts.admin.base')

@section('title','Lista de Comentários')

@section('button')
    <x-button.add link="{{ route('admin.comments.create') }}" icon="fa-plus">&nbsp Novo Comentário</x-button.add>
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

                                        <x-table.operation link="{{ route('admin.comments.show', $comment->id) }}" name="info" icon="ti ti-eye"></x-table.operation>
                                        <x-table.operation link="{{ route('admin.comments.edit', $comment->id) }}" name="edit" icon="fa fa-pencil"></x-table.operation>
                                        <x-table.delete action="{{ route('admin.comments.destroy', $comment->id) }}"></x-table.delete>

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
