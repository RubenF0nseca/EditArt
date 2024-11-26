@extends('layouts.admin.base')

@section('title','Criar um novo Tipo de Obra')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Insira os dados para a criação de um novo autor</h4>
                    </div>
                    <div class="card-body">
                        <!-- Alerta para mensagem de sucesso -->
                        @if(session('success'))
                            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('success')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif


                        <!-- Alerta para mensagem de erro geral -->
                        @if($errors->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" >
                                {{$errors->first('error')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif


                        <form action="{{ route('authors.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label required">Nome</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" >
                                @error('name')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="biography" class="form-label required">Bibliografia</label>
                                <input type="text" id="biography" name="biography" class="form-control @error('biography') is-invalid @enderror" value="{{old('biography')}}" >
                                @error('biography')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="birthdate" class="form-label required">Data de Nascimento</label>
                                <input type="date" id="birthdate" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{old('birthdate')}}" >
                                @error('birthdate')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>







                            <div class="mb-3">
                                <label for="address" class="form-label required">Morada</label>
                                <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}" >
                                @error('address')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nif" class="form-label required">NIF</label>
                                <input type="text" id="nif" name="nif" class="form-control @error('nif') is-invalid @enderror" value="{{old('nif')}}" >
                                @error('nif')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label required">Número de Telefone</label>
                                <input type="text" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{old('phone_number')}}" >
                                @error('phone_number')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="birthdate" class="form-label required">Data de Nascimento</label>
                                <input type="date" id="birthdate" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{old('birthdate')}}" >
                                @error('birthdate')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label required">Password</label>
                                <input type="text" id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}" >
                                @error('password')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label required">Tipo de Utilizador</label>
                                <input type="text" id="role" name="role" class="form-control @error('role') is-invalid @enderror" value="{{old('role')}}" >
                                @error('role')
                                <div class="invalid-feedback" >{{$message}}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
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
