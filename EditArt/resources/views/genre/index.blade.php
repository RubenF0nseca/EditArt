@extends('layouts.admin.base')

@section('title','Lista de Géneros Literários')

@section('button')
    <x-button.add link="{{ route('genres.create') }}" icon="fa-plus">&nbsp Novo Género Literário</x-button.add>
@endsection

@section('content')
    <div class="container">
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
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="">ID</th>
                                <th class="d-none d-md-table-cell">Nome</th>
                                <th class="w-auto text-end">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($genres as $genre)
                                <tr>
                                    <td>{{ $genre->id }}</td>
                                    <td class="d-none d-md-table-cell">{{$genre->name}}</td>
                                    <td class="text-end">

                                        <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-edit"><i
                                                class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('genres.destroy', $genre->id) }}" method="POST"
                                              style="display: inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-delete"><i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
