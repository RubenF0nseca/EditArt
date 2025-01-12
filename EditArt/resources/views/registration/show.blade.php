@extends('layouts.guest.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <section class="banner">
            <div class="container">
                <div class="row mb-5" id="margin-top">
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <div class="text-container2 mb-5">
                            <h1>“Think before you speak.<br>Read before you think.”</h1>
                            <h5 class="text-end">― Fran Lebowitz</h5>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <div class="card shadow-lg border-0 rounded-lg">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Criar Conta</h3></div>
                            <div class="card-body">
                                <form method="post">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="inputName" type="text" placeholder="" name="usr_name"/>
                                                <label for="inputName">Nome</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" id="inputNif" type="text" placeholder="" name="usr_nif"/>
                                                <label for="inputNif">NIF</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" type="email" placeholder="" name="log_email"/>
                                        <label for="inputEmail">Email</label>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="inputTelefone" type="text" placeholder="" name="usr_telefone"/>
                                                <label for="inputTelefone">Telefone</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="inputAddress" type="text" placeholder="" name="usr_address"/>
                                                <label for="inputAddress">Morada</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="" name="log_password"/>
                                                <label for="inputPassword">Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="" name="password_check"/>
                                                <label for="inputPasswordConfirm">Confirmar Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-block" type="submit" name="bt_registration">Criar Conta</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="{{route('login')}}">Já tem conta? Faça Login!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
