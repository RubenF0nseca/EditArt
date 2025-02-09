admin.@extends('layouts.admin.base')

@section('title', __('reviews.create_review'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('reviews.create_review_header') }}</h4>
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

                        <form action="{{ route('admin.reviews.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="book_id" class="form-label required">{{ __('reviews.book_id') }}</label>
                                <input type="text" id="book_id" name="book_id" class="form-control @error('book_id') is-invalid @enderror" value="{{old('book_id')}}" >
                                @error('book_id')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="user_id" class="form-label required">{{ __('reviews.user_id') }}</label>
                                <input type="text" id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror" value="{{old('user_id')}}" >
                                @error('user_id')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label required">{{ __('reviews.comment') }}</label>
                                <input type="text" id="comment" name="comment" class="form-control @error('comment') is-invalid @enderror" value="{{old('comment')}}" >
                                @error('comment')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label required">{{ __('reviews.review_rating') }}</label>
                                <input type="text" id="rating" name="rating" class="form-control @error('rating') is-invalid @enderror" value="{{old('rating')}}" >
                                @error('rating')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <x-button.submit color="solid">{{ __('reviews.create_button') }}</x-button.submit>
                                <x-button.link link="{{ route('admin.reviews.index') }}" color="dark-solid">{{ __('reviews.cancel_button') }}</x-button.link>
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
