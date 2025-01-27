@extends('layouts.admin.base')

@section('title', __('c_i_s_u.genre_list'))

@section('button')
    <x-button.add link="{{ route('admin.genres.create') }}" icon="fa-plus">&nbsp {{ __('c_i_s_u.new_genre') }}</x-button.add>
@endsection

@section('content')
    <div class="container">
        <!-- Barra de pesquisa -->
        <x-widget.search
            action="{{ route('admin.genres.index') }}"
            name="name"
            placeholder="{{ __('c_i_s_u.search_genre_placeholder') }}"
            value="{{ request('name') }}"
        />

        <!-- Tabela -->
        <div class="row">
            <div class="col">

                <!-- Alerta para mensagem de sucesso -->
                @if(session('success'))
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <!-- Alerta para mensagem de erro geral -->
                @if($errors->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" >
                        {{$errors->first('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="table-responsive">

                        <x-table>
                            <x-table.thead>
                                <x-table.tr>
                                    <x-table.th>{{ __('c_i_s_u.id_column') }}</x-table.th>
                                    <x-table.th>{{__('c_i_s_u.genre_name_column') }}</x-table.th>
                                    <x-table.th class="text-end">{{ __('c_i_s_u.actions_column') }}</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($genres as $genre)
                                <x-table.tr>
                                    <td>{{ $genre->id }}</td>
                                    <td>{{$genre->name}}</td>
                                    <td class="text-end">

                                        <x-table.operation link="{{ route('admin.genres.edit', $genre->id) }}" name="edit" icon="fa fa-pencil"></x-table.operation>
                                        <x-table.delete action="{{ route('admin.genres.destroy', $genre->id) }}"></x-table.delete>

                                    </td>
                                </x-table.tr>
                            @endforeach
                            </x-table.tbody>
                        </x-table>
                    </div>
                    <div class="card-footer">
                        {{$genres->links('layouts.admin.parts.pagination') }}
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
