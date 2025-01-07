@extends('layouts.guest.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <section class="banner">
            <div class="row" id="margin-top">
                <div class="col-md-6 ">
                    <div class="text-container2">
                        <h1>“Think before you speak.<br>Read before you think.”</h1>
                        <h5>― Fran Lebowitz</h5>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mb-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="row p-2">
                                    <x-alert type="danger">
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
                                    <input value="{{old('email')}}" class="form-control" id="inputEmail" type="email" placeholder="" name="log_email"/>
                                    <label for="inputEmail">name@example.com</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputPassword" type="password" placeholder="" name="log_password"/>
                                    <label for="inputPassword">Password</label>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small" href="#">Esqueceu-se da Password?</a>      {{--TODO fix or delete --}}
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
        </section>
    </div>
@endsection
