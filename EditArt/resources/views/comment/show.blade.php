@extends('layouts.admin.base')

@section('title','Detalhes da avaliação')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <!-- Alerta para mensagem de sucesso -->
                        @if(session('success'))
                            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('success')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <h3>[#{{ $review->id }}] </h3>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th scope="row">ID Livro</th>
                                        <td>{{ $review->id_book }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">ID Utilizador</th>
                                        <td>{{ $review->id_user }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Comentários</th>
                                        <td>{{ $review->comment }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Avaliação</th>
                                        <td>{{ $review->rating }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Avaliação criada em:</th>
                                        <td>{{ $review->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Avaliação atualizada em:</th>
                                        <td>{{ $review->updated_at }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('reviews.index') }}" class="btn btn-secondary mt-3">Lista de todas as avaliações</a>
                <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning mt-3"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp Editar</a>
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
