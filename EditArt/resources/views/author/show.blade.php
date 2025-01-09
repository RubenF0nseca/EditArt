@extends('layouts.admin.base')

@section('title','Detalhes do Autor')

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
                                <h3>ID / {{ $author->id }}</h3>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th scope="row">Nome</th>
                                        <td>{{ $author->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Biografia</th>
                                        <td>{{ $author->biography }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Data Nascimento</th>
                                        <td>{{ $author->birthdate }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Сonta criada</th>
                                        <td>{{ $author->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Сonta atualizada</th>
                                        <td>{{ $author->updated_at }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                @if($author->profilePicture)
                                    <img src="{{ asset('storage/'.$author->profilePicture) }}" class="product-thumb rounded shadow-lg border-0 rounded-lg mt-5" alt="{{ $author->name }}" style="width: 280px; height: 400px;">
                                @else
                                    <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded shadow-lg border-0 rounded-lg mt-5" alt="Imagem não disponível" style="width: 280px; height: 400px;">
                                @endif
                            </div>
                            <div class="col-md-12 mt-4">
                                <x-button.link link="{{ route('authors.edit', $author->id) }}" color="solid">Editar</x-button.link>
                                <x-button.link link="{{ route('authors.index') }}" color="light-new">Mostrar todos os autores</x-button.link>
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
