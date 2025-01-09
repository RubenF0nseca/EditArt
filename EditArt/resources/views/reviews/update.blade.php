@extends('layouts.admin.base')

@section('title','Editar avaliação')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Insira os dados para editar o comentário</h4>
                    </div>
                    <div class="card-body">
                        <!-- Alerta para mensagem de sucesso -->
                        @if(session('success'))
                            <x-alert id="success-alert" type="success">
                                {{session('success')}}
                            </x-alert>
                        @endif

                        <!-- Alerta para mensagem de erro geral -->
                        @if($errors->has('error'))
                            <x-alert id="" type="danger">
                                {{$errors->first('error')}}
                            </x-alert>
                        @endif

                        <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="id_book" class="form-label required">Id Livro</label>
                                <input type="text" id="id_book" name="id_book" class="form-control @error('id_book') is-invalid @enderror" value="{{old('id_book', $review->id_book)}}" >
                                @error('id_book')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="id_user" class="form-label required">Id User</label>
                                <input type="text" id="id_user" name="id_user" class="form-control @error('id_user') is-invalid @enderror" value="{{old('id_user', $review->id_user)}}" >
                                @error('id_user')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label required">Comentário</label>
                                <input type="text" id="comment" name="comment" class="form-control @error('comment') is-invalid @enderror" value="{{old('comment', $review->comment)}}" >
                                @error('comment')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label required">Nota</label>
                                <input type="text" id="rating" name="rating" class="form-control @error('rating') is-invalid @enderror" value="{{old('rating', $review->rating)}}" >
                                @error('rating')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <x-button.submit color="solid">Guardar</x-button.submit>
                                <x-button.link link="{{ route('reviews.show', $review->id) }}" color="dark-solid">Cancelar</x-button.link>
                            </div>
                        </form>
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
