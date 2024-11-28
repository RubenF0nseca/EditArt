@extends('layouts.admin.base')

@section('title','Detalhes do Comentário')

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
                            <div class="col-md-12">
                                <h3>[#{{ $comment->id }}] </h3>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th scope="row">Comentário</th>
                                        <td>{{ $comment->content }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Avaliação criada em:</th>
                                        <td>{{ $comment->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Avaliação atualizada em:</th>
                                        <td>{{ $comment->updated_at }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('comments.index') }}" class="btn btn-secondary mt-3 shadow-lg border-0 rounded-lg">Lista de todos os comentários</a>
                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning mt-3 shadow-lg border-0 rounded-lg"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp Editar</a>
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
