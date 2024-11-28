@extends('layouts.admin.base')

@section('title','Detalhes do Utilizador')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body">
                        <!-- Alerta para mensagem de sucesso -->
                        @if(session('success'))
                            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('success')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <h3>[#{{ $user->id }}] </h3>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th scope="row">Nome</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">NIF</th>
                                        <td>{{ $user->nif }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Telefone</th>
                                        <td>{{ $user->phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Morada</th>
                                        <td>{{ $user->address }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Сonta criada</th>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Сonta atualizada</th>
                                        <td>{{ $user->updated_at }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3 shadow-lg border-0 rounded-lg">Mostrar todos os utilizadores</a>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning mt-3 shadow-lg border-0 rounded-lg"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp Editar</a>
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
