@extends('layouts.client.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row mt-5">

                <!-- Avatar do utilizador e nav-tab ------------------------------------  -->
                <div class="col-md-4 d-flex justify-content-center text-center">
                    <div id="user-card">
                        <h5>{{ __('client.welcome') }}<br><b>{{ auth()->user()->name}}</b></h5>
                        <img src="{{asset('imgs/no_user.png')}}" class="mt-4" alt="EditArt" id="avatar">
                        <hr>
                        <x-pills>
                            <x-pills.button class="active" id="profile" target="profile" controls="profile" select="true">{{ __('client.profile') }}</x-pills.button>
                            <x-pills.button class="" id="order" target="order" controls="order" select="false">{{ __('client.client_orders') }}</x-pills.button>
                            <x-pills.button class="" id="review" target="review" controls="review" select="false">{{ __('client.my_reviews') }}</x-pills.button>
                            <x-pills.button class="" id="comment" target="comment" controls="comment" select="false">{{ __('client.my_comments') }}</x-pills.button>
                        </x-pills>
                    </div>
                </div>

                <!-- Informações do utilizador   -->
                <div class="col-md-8 mt-5">
                    <div class="tab-content mt-5" id="v-pills-tabContent">

                        <!-- Alerta para mensagem de sucesso -->
                        @if(session('success'))
                            <x-alert id="success-alert" type="success">
                                {{ session('success') }}
                            </x-alert>
                        @endif

                        <!-- Alerta para mensagem de erro geral -->
                        @if($errors->has('error'))
                            <x-alert id="" type="danger">
                                {{$errors->first('error')}}
                            </x-alert>
                        @endif

                        <!-- Tab: Perfil ------------------------------------  -->
                        <x-pills.content class="show active" id="profile" label="profile">
                            <div class="review-post" id="view-mode">
                                <!-- Icon para editar -->
                                <div class="tooltip-container d-flex justify-content-end">
                                    <i class="fa-solid fa-pen-to-square" onclick="toggleEdit()" style="cursor: pointer;"></i>
                                    <span class="tooltip-text" style="width: auto">{{ __('client.edit_details') }}</span>
                                </div>
                                <!-- Os dados do utilizador -->
                                <div class="row">
                                    <span class="col-3 font-alt">{{ __('client.name') }}</span>
                                    <span class="col-9">{{ auth()->user()->name }}</span>
                                </div>
                                <div class="row review-entry">
                                    <span class="col-3 font-alt">{{ __('client.email') }}</span>
                                    <span class="col-9">{{ auth()->user()->email }}</span>
                                </div>
                                <div class="row review-entry">
                                    <span class="col-3 font-alt">{{ __('client.nif') }}</span>
                                    <span class="col-9">{{ auth()->user()->nif }}</span>
                                </div>
                                <div class="row review-entry">
                                    <span class="col-3 font-alt">{{ __('client.phone_number') }}</span>
                                    <span class="col-9">{{ auth()->user()->phone_number }}</span>
                                </div>
                                <div class="row review-entry">
                                    <span class="col-3 font-alt">{{ __('client.address') }}</span>
                                    <span class="col-9">{{ auth()->user()->address }}</span>
                                </div>
                                <div class="row review-entry">
                                    <span class="col-3 font-alt">{{ __('client.local') }}</span>
                                    <span class="col-9">{{--TODO--}}</span>
                                </div>
                                <div class="row review-entry">
                                    <span class="col-3 font-alt">{{ __('client.zip_code') }}</span>
                                    <span class="col-9">{{--TODO--}}</span>
                                </div>
                                <div class="row review-entry">
                                    <span class="col-3 font-alt">{{ __('client.account_created') }}</span>
                                    <span class="col-9">{{ auth()->user()->created_at }}</span>
                                </div>
                            </div>

                            <!-- Os dados do utilizador (modo de edição) -->
                            <div class="review-post" id="edit-mode" style="display: none;">
                                <form method="POST" action="{{ route('client.profile.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <label class="col-3 font-alt">{{ __('client.name') }}</label>
                                        <input class="col-9 form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ auth()->user()->name }}">
                                        @error('name')
                                        <div class="invalid-feedback" >{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="row review-entry">
                                        <label class="col-3 font-alt">{{ __('client.nif') }}</label>
                                        <input class="col-9 form-control @error('nif') is-invalid @enderror" type="text" name="nif" value="{{ auth()->user()->nif }}">
                                        @error('nif')
                                        <div class="invalid-feedback" >{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="row review-entry">
                                        <label class="col-3 font-alt">{{ __('client.phone') }}</label>
                                        <input class="col-9 form-control @error('phone_number') is-invalid @enderror" type="text" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}">
                                        @error('phone_number')
                                        <div class="invalid-feedback" >{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="row review-entry">
                                        <label class="col-3 font-alt">{{ __('client.address') }}</label>
                                        <input class="col-9 form-control @error('address') is-invalid @enderror" type="text" name="address" value="{{ auth()->user()->address }}">
                                        @error('address')
                                        <div class="invalid-feedback" >{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="row review-entry">
                                        <label class="col-3 font-alt">{{ __('client.local') }}</label>
                                        <input class="col-9 form-control" type="text" name="locality" value="">
                                        {{--TODO--}}
                                    </div>
                                    <div class="row review-entry">
                                        <label class="col-3 font-alt">{{ __('client.zip_code') }}</label>
                                        <input class="col-9 form-control" type="text" name="postal_code" value="">
                                        {{--TODO--}}
                                    </div>
                                    <div class="mt-3 text-end">
                                        <button class="btn btn-solid" type="submit">{{ __('client.save') }}</button>
                                        <button class="btn btn-dark-solid" type="button" onclick="toggleEdit()">{{ __('client.cancel') }}</button>
                                    </div>

                                </form>
                            </div>
                            <!-- Botão para trigger modal -->
                            <div class="text-end">
                                <button href="#myModal" class="btn btn-light-new" data-toggle="modal">{{ __('client.change_password') }}</button>
                            </div>

                            <!-- Modal -->
                            <div id="myModal" class="modal fade">
                                <div class="modal-dialog modal-confirm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="icon-box">
                                                <i class="fa-solid fa-check material-icons"></i>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-center">{{ __('client.message_pass') }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </x-pills.content>
                        <!-- Tab: Meus pedidos ------------------------------------  -->
                        <x-pills.content class="" id="order" label="order">{{ __('client.no_order') }}</x-pills.content>

                        <!-- Tab: Minhas avaliações ------------------------------------  -->
                        <x-pills.content class="" id="review" label="review">{{ __('client.no_reviews') }}</x-pills.content>

                        <!-- Tab: Meus comentários ------------------------------------  -->
                        <x-pills.content class="" id="comment" label="comment">{{ __('client.no_comments') }}</x-pills.content>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endpush
