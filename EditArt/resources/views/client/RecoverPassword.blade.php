
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
                                <h3 class="text-center font-alt font-weight-light my-4">{{ __('c_i_s_u.password_reset') }}</h3>
                            </div>
                            <div class="card-body">

                                <!-- Alerta de erros -->
                                @if($errors->has('error'))
                                    <x-alert id="" type="danger">
                                        {{$errors->first('error')}}
                                    </x-alert>
                                @endif

                                <!-- Alerta para mensagem de sucesso -->
                                @if(session('success'))
                                    <x-alert id="success-alert" type="success">
                                        {{session('success')}}
                                    </x-alert>
                                @endif

                                <!-- Formulário -->
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input type="hidden" name="email" value="{{ $email }}">
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
                                                <label for="password">{{ __('c_i_s_u.new_password') }} *</label>
                                                @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    id="password_confirmation"
                                                    type="password"
                                                    name="password_confirmation"
                                                    placeholder="Confirme a password"
                                                />
                                                <label for="password_confirmation">{{ __('c_i_s_u.new_password') }} *</label>
                                                @error('password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-block" type="submit" name="bt_registration">
                                                {{ __('c_i_s_u.change_password') }}
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
