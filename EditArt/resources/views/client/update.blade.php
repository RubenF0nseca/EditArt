@extends('layouts.admin.base')

@section('title',__('client.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('client.edit_user') }}</h4>
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

                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label required">{{ __('client.name') }}</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" >
                                @error('name')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label required">{{ __('client.email') }}</label>
                                <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" >
                                @error('email')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">{{ __('client.address') }}</label>
                                <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $user->address }}" >
                                @error('address')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="locality" class="form-label">{{ __('client.local') }}</label>
                                <input type="text" id="locality" name="locality" class="form-control @error('locality') is-invalid @enderror" value="{{ $user->locality }}" >
                                @error('locality')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="postal_code" class="form-label">{{ __('client.zip_code') }}</label>
                                <input type="text" id="postal_code" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" value="{{ $user->postal_code }}" >
                                @error('postal_code')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nif" class="form-label">{{ __('client.nif') }}</label>
                                <input type="text" id="nif" name="nif" class="form-control @error('nif') is-invalid @enderror" value="{{ $user->nif }}" >
                                @error('nif')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">{{ __('client.phone') }}</label>
                                <input type="text" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $user->phone_number }}" >
                                @error('phone_number')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="birthdate" class="form-label">{{ __('client.birthdate') }}</label>
                                <input type="text" id="birthdate" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{ $user->birthdate }}" >
                                @error('birthdate')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label required">{{ __('client.password') }}</label>
                                <input type="text" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>

                            <div class="text-end">
                                <x-button.submit color="solid">{{ __('client.save') }}</x-button.submit>
                                <x-button.link link="{{ route('admin.users.show', $user->id) }}" color="dark-solid">{{ __('client.cancel') }}</x-button.link>
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
