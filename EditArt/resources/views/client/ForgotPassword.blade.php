@extends('layouts.guest.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <section class="banner">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center min-vh-100">
                    <div class="col-md-6 d-flex justify-content-center align-items-center min-vh-100">
                        <div class="card shadow-lg border-0 rounded-lg">
                            <div class="card-header">
                                <h3 class="text-center font-alt font-weight-light my-4">{{ __('client.forgot_password') }}</h3>
                                <p>{{ __('client.password_recovery_instructions') }}</p>
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
                                            placeholder="{{ __('client.email_placeholder') }}"
                                        />
                                        <label for="inputEmail">{{ __('client.email') }} *</label>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <button class="btn btn-solid btn-block" type="submit" name="bt_registration">
                                                {{ __('client.send') }}
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
