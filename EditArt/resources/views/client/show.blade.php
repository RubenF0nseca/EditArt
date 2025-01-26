@extends('layouts.admin.base')

@section('title',__('c_i_s_u.title_user'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body">
                        <!-- Alerta para mensagem de sucesso -->
                        @if(session('success'))
                            <x-alert id="success-alert" type="success">
                                {{session('success')}}
                            </x-alert>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <h3>ID / {{ $user->id }}</h3>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.name') }}</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.email') }}</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.nif') }}</th>
                                        <td>{{ $user->nif }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.phone') }}</th>
                                        <td>{{ $user->phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.address') }}</th>
                                        <td>{{ $user->address }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.created_at_2') }}</th>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.updated_at_2') }}</th>
                                        <td>{{ $user->updated_at }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-12 mt-4">
                                <x-button.link link="{{ route('admin.users.edit', $user->id) }}" color="solid">{{ __('c_i_s_u.edit') }}</x-button.link>
                                <x-button.link link="{{ route('admin.users.index') }}" color="light-new">{{ __('c_i_s_u.show_all_users') }}</x-button.link>
                            </div>
                        </div>
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
