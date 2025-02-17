@extends('layouts.guest.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <section class="banner">
            <div class="container">
                <div class="row mt-2 d-flex justify-content-center align-items-center min-vh-100">
                    <div class="col-md-8 d-flex justify-content-center align-items-center min-vh-100">
                        <div class="card shadow-lg border-0 rounded-lg">
                            <div class="card-header">
                                <h3 class="text-center font-alt font-weight-light my-4">{{ __('registration_login.create') }}</h3>
                            </div>
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


                                <!-- Formulário -->
                                <form method="POST" action="{{ route('register.store') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="name"
                                                    type="text"
                                                    name="name"
                                                    value="{{ old('name') }}"
                                                    placeholder="Insira o seu nome"
                                                />
                                                <label for="inputName">{{ __('registration_login.name') }} *</label>
                                                @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input
                                                    class="form-control @error('nif') is-invalid @enderror"
                                                    id="nif"
                                                    type="text"
                                                    name="nif"
                                                    value="{{ old('nif') }}"
                                                    placeholder="Insira o seu NIF"
                                                />
                                                <label for="nif">{{ __('registration_login.nif') }}</label>
                                                @error('nif')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input
                                            class="form-control @error('email') is-invalid @enderror"
                                            id="inputEmail"
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="Insira o seu email"
                                        />
                                        <label for="inputEmail">{{ __('registration_login.email') }} *</label>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input
                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                    id="phone_number"
                                                    type="text"
                                                    name="phone_number"
                                                    value="{{ old('phone_number') }}"
                                                    placeholder="Insira o seu telefone"
                                                />
                                                <label for="phone_number">{{ __('registration_login.phone') }}</label>
                                                @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input
                                                    class="form-control @error('Address') is-invalid @enderror"
                                                    id="Address"
                                                    type="text"
                                                    name="Address"
                                                    value="{{ old('Address') }}"
                                                    placeholder="Insira a sua morada"
                                                />
                                                <label for="Address">{{ __('registration_login.address') }}</label>
                                                @error('Address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password"
                                                    type="password"
                                                    name="password"
                                                    placeholder="Insira a password"
                                                />
                                                <label for="password">{{ __('registration_login.password') }} *</label>
                                                @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    id="inputPasswordConfirm"
                                                    type="password"
                                                    name="password_confirmation"
                                                    placeholder="Confirme a password"
                                                />
                                                <label for="inputPasswordConfirm">{{ __('registration_login.confirm_password') }} * </label>
                                                @error('password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <button class="btn btn-solid btn-block" type="submit" name="bt_registration">
                                                {{ __('registration_login.create') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small">
                                    <a href="{{ route('login') }}">{{ __('registration_login.have_account') }}</a>
                                </div>
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
