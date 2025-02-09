@extends('layouts.guest.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <section class="banner">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center min-vh-100">
                    <div class="col-md-6 d-flex justify-content-center align-items-center min-vh-100">
                        <div class="card shadow-lg border-0 rounded-lg">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4 font-alt">{{ __('auth.login') }}</h3>
                            <div class="card-body">
                                <!-- Alerta de sucesso -->
                                @if(session('success'))
                                    <x-alert id="success-alert" type="success">
                                        {{ session('success') }}
                                    </x-alert>
                                @endif

                                <!-- Alerta de erros -->
                                @if($errors->has('error'))
                                    <x-alert id="error-alert" type="danger">
                                        {{ __('auth.error') }}: {{$errors->first('error')}}
                                    </x-alert>
                                @endif

                                @if($errors->any())
                                    <div class="row p-2">
                                        <x-alert id="validation-errors-alert" type="danger">
                                            {{ __('auth.check_data') }}
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
                                    @if(request()->has('redirect'))
                                        <input type="hidden" name="redirect" value="{{ request()->query('redirect') }}">
                                    @endif

                                    <div class="form-floating mb-3">
                                        <input value="{{old('email')}}" class="form-control" id="inputEmail" type="email" placeholder="{{ __('auth.email_placeholder') }}" name="email"/>
                                        <label for="inputEmail">{{ __('auth.email') }} *</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputPassword" type="password" placeholder="" name="password"/>
                                        <label for="inputPassword">{{ __('auth.password') }} *</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="{{ route('password.forgot') }}">{{ __('auth.forgot_password') }}</a>
                                        <button class="btn btn-solid" type="submit" name="bt_login">{{ __('auth.enter') }}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="{{route('registration')}}">{{ __('auth.register_prompt') }}</a></div>
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
