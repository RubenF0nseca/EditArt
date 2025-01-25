@extends('layouts.admin.base')

@section('title', __('c_i_s_u.create_user'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('c_i_s_u.enter_user_details') }}</h4>
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

                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label required">{{ __('c_i_s_u.name') }}</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" >
                                @error('name')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label required">{{ __('c_i_s_u.email') }}</label>
                                <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" >
                                @error('email')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label required">{{ __('c_i_s_u.address') }}</label>
                                <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}" >
                                @error('address')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nif" class="form-label required">{{ __('c_i_s_u.nif') }}</label>
                                <input type="text" id="nif" name="nif" class="form-control @error('nif') is-invalid @enderror" value="{{old('nif')}}" >
                                @error('nif')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label required">{{ __('c_i_s_u.phone_number') }}</label>
                                <input type="text" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{old('phone_number')}}" >
                                @error('phone_number')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="birthdate" class="form-label required">{{ __('c_i_s_u.birthdate') }}</label>
                                <input type="date" id="birthdate" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{old('birthdate')}}" >
                                @error('birthdate')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label required">{{ __('c_i_s_u.password') }}</label>
                                <input type="text" id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}" >
                                @error('password')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label required">{{ __('c_i_s_u.user_type') }}</label>
                                <input type="text" id="role" name="role" class="form-control @error('role') is-invalid @enderror" value="{{old('role')}}" >
                                @error('role')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <x-button.submit color="solid">{{ __('c_i_s_u.create') }}</x-button.submit>
                                <x-button.link link="{{ route('admin.users.index') }}" color="dark-solid">{{ __('c_i_s_u.cancel') }}</x-button.link>
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
