@extends('layouts.admin.base')

@section('title','Detalhes da Avaliação')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body">
                        <!-- Alerta para mensagem de sucesso -->
                        @if(session('success'))
                            <x-alert id="success-alert" type="success">
                                {{session('success')}}
                            </x-alert>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <h3>ID / {{ $review->id }}</h3>
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
                            <div class="col-md-12 mt-4">
                                <x-button.link link="{{ route('reviews.edit', $review->id) }}" color="solid">Editar</x-button.link>
                                <x-button.link link="{{ route('reviews.index') }}" color="light-new">Mostrar todas as avaliações</x-button.link>
                            </div>
                        </div>
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
