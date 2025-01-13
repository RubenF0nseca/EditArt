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
                            <div class="card-header">
                                <h3 class="text-center font-alt font-weight-light my-4">Esqueceu-se da sua senha</h3>
                                <p>Será enviado um email com um link para recuperar a password</p>
                                <!-- Alerta para mensagem de sucesso -->
                                @if(session('success'))
                                    <x-alert id="success-alert" type="success">
                                        {{session('success')}}
                                    </x-alert>
                                @endif
                            </div>
                            <div class="card-body">

                                <!-- Alerta de erros -->
                                @if($errors->has('error'))
                                    <x-alert id="" type="danger">
                                        {{$errors->first('error')}}
                                    </x-alert>
                                @endif


                                <!-- Formulário -->
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-floating mb-3">
                                        <input
                                            class="form-control @error('email') is-invalid @enderror"
                                            id="inputEmail"
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="Insira o seu email"
                                        />
                                        <label for="inputEmail">Email ⃰ </label>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-block" type="submit" name="bt_registration">
                                                Enviar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
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
