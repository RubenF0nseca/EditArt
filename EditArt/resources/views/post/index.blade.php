@extends('layouts.admin.base')

@section('title',__('post.topic_list'))

@section('button')
    <x-button.add link="{{ route('admin.posts.create') }}" icon="fa-plus">&nbsp {{ __('post.new_topic') }}</x-button.add>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <!-- Alerta para mensagem de sucesso -->
            @if(session('success'))
                <x-alert id="success-alert" type="success">
                    {{session('success')}}
                </x-alert>
            @endif
            <div class="col-md-10 offset-md-1">
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="table-responsive">

                        <x-table>
                            <x-table.thead>
                                <x-table.tr>
                                    <x-table.th>{{ __('post.title') }}</x-table.th>
                                    <x-table.th>{{ __('post.content') }}</x-table.th>
                                    <x-table.th>{{ __('reviews.date') }}</x-table.th>
                                    <x-table.th class="text-end">{{ __('reviews.approval') }}</x-table.th>
                                    <x-table.th class="text-end">{{ __('post.actions') }}</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($posts as $post)
                                <x-table.tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ Str::limit($post->content, 60, '...') }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td class="text-end">
                                        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_resolved" value="{{ $post->is_resolved ? 0 : 1 }}">
                                            <button type="submit"><i class="fa-solid fa-check"></i></button>
                                        </form>

                                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete"><i class="fa-solid fa-xmark text-danger"></i></button>
                                        </form>
                                    </td>
                                    <td class="text-end">
                                        <x-table.operation link="{{ route('admin.posts.show', $post->id) }}" name="info" icon="ti ti-eye"></x-table.operation>
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');//
            if (successAlert) {
                setTimeout(function() {
                    // Adiciona a classe 'fade' e remove a classe 'show' para iniciar a transição de fechamento
                    successAlert.classList.remove('show');
                    successAlert.classList.add('fade');

                    // Remove o elemento do DOM depois da transição
                    setTimeout(function() {
                        successAlert.remove();
                    }, 500); // Ajuste o tempo conforme o efeito 'fade'
                }, 3000); // Fecha o alerta após 3 segundos
            }
        });
    </script>
@endpush
