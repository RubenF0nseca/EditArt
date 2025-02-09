@extends('layouts.admin.base')

@section('title',__('c_i_s_u.topic_list'))

@section('button')
    <x-button.add link="{{ route('admin.posts.create') }}" icon="fa-plus">&nbsp {{ __('c_i_s_u.new_topic') }}</x-button.add>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="table-responsive">

                        <x-table>
                            <x-table.thead>
                                <x-table.tr>
                                    <x-table.th>{{ __('c_i_s_u.title') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.content') }}</x-table.th>
                                    <x-table.th class="text-end">{{ __('c_i_s_u.actions') }}</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($posts as $post)
                                <x-table.tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ Str::limit($post->content, 60, '...') }}</td>
                                    <td class="text-end">

                                        <x-table.operation link="{{ route('admin.posts.show', $post->id) }}" name="info" icon="ti ti-eye"></x-table.operation>
                                        <x-table.operation link="{{ route('admin.posts.edit', $post->id) }}" name="edit" icon="fa fa-pencil"></x-table.operation>
                                        <x-table.delete action="{{ route('admin.posts.destroy', $post->id) }}"></x-table.delete>

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
