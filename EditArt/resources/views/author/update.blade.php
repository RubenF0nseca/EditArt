@extends('layouts.admin.base')

@section('title', __('c_i_s_u.edit_author_title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('c_i_s_u.edit_author_heading') }}</h4>
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

                        <form action="{{ route('admin.authors.update', $author->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label required">{{ __('c_i_s_u.author_name') }}</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $author->name)}}" >
                                @error('name')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="biography" class="form-label required">{{ __('c_i_s_u.author_biography') }}</label>
                                <input type="text" id="biography" name="biography" class="form-control @error('biography') is-invalid @enderror" value="{{old('biography', $author->biography)}}" >
                                @error('biography')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="birthdate" class="form-label required">{{ __('c_i_s_u.author_birthdate') }}</label>
                                <input type="date" id="birthdate" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{old('birthdate', $author->birthdate)}}" >
                                @error('birthdate')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="profilePicture" class="form-label required">{{ __('c_i_s_u.author_profile_picture') }}</label>
                                <input type="file"
                                       id="profilePicture"
                                       name="profilePicture"
                                       class="form-control @error('profilePicture') is-invalid @enderror">
                                @error('profilePicture')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <x-button.submit color="solid">{{ __('c_i_s_u.save_button') }}</x-button.submit>
                                <x-button.link link="{{ route('admin.authors.show', $author->id) }}" color="dark-solid">{{ __('c_i_s_u.cancel_button') }}</x-button.link>
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
