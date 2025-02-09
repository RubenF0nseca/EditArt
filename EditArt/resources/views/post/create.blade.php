@extends('layouts.admin.base')

@section('title',__('post.create_product'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('post.enter_product_data') }}</h4>
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

                        <form action="{{ route('admin.posts.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label required">{{ __('post.title') }}</label>
                                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" >
                                @error('title')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label required">{{ __('post.authors') }}</label>
                                <input type="text" id="content" name="content" class="form-control @error('content') is-invalid @enderror" value="{{old('content')}}" >
                                @error('content')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <x-button.submit color="solid">{{ __('post.save') }}</x-button.submit>
                                <x-button.link link="{{ route('admin.posts.index') }}" color="dark-solid">{{ __('post.cancel') }}</x-button.link>
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
