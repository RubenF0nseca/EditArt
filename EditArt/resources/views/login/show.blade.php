@extends('layouts.guest.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <section class="banner">
            <div class="container">
                <div class="row" id="margin-top">
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <div class="text-container2 mb-5">
                            <h1>“Think before you speak.<br> Read before you think.”</h1>
                            <h5 class="text-end">― Fran Lebowitz</h5>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <div class="card shadow-lg border-0 rounded-lg">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4 font-alt">Login</h3></div>
                            <div class="card-body">
                                <!-- Alerta de sucesso -->
                                @if(session('success'))
                                    <x-alert id="success-alert" type="success">
                                        {{ session('success') }}
                                    </x-alert>
                                @endif

                                <!-- Alerta de erros -->
                                @if($errors->has('error'))
                                    <x-alert id="" type="danger">
                                        {{$errors->first('error')}}
                                    </x-alert>
                                @endif

                                @if($errors->any())
                                    <div class="row p-2">
                                        <x-alert id="" type="danger">
                                            Verifique os dados inseridos
                                            <ul>
                                                @foreach($errors->all() as $message)
                                                    <li>{{$message}}</li>
                                                @endforeach
                                            </ul>
                                        </x-alert>
                                    </div>
                                @endif

                                <form method="POST" action="{{route('login')}}">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input value="{{old('email')}}" class="form-control" id="inputEmail" type="email" placeholder="" name="email"/>
                                        <label for="inputEmail">Email * </label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputPassword" type="password" placeholder="" name="password"/>
                                        <label for="inputPassword">Password * </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="{{ route('password.forgot') }}">Esqueceu-se da Password?</a>
                                        <button class="btn btn-primary" type="submit" name="bt_login">Entrar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="{{route('registration')}}">Não tem conta? Registe-se!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const successAlert = document.getElementById('success-alert');
                    if (successAlert) {
                        setTimeout(function() {
                            successAlert.classList.remove('show');
                            successAlert.classList.add('fade');

                            setTimeout(function() {
                                successAlert.remove();
                            }, 500);
                        }, 3000);
                    }
                });
            </script>
        @endpush
    </div>
@endsection
