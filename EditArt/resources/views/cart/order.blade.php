@extends('layouts.client.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row" id="margin-top">
                <!-- Fazer o pedido -->
                <div class="col-lg-9 col-sm-offset-3">
                    <h1 class="section-title font-alt">{{ __('cart.place_order') }}</h1>
                    <hr class="divider">
                    <div class="mb-3 font-alt">
                        <a href="{{ route('cart') }}"><i class="fa-solid fa-arrow-left-long"></i>&nbsp;{{ __('cart.back_to_cart') }}</a>
                    </div>
                    <div class="order-card mb-5">
                        <form action="#" method="POST">
                            @csrf
                            <div class="font-alt mb-3"><h3>{{ __('cart.billing_address') }}</h3></div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label required">{{ __('cart.name') }}</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                           value="{{ old('name', $user->name ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label required">{{ __('cart.email') }}</label>
                                    <input type="text" id="email" name="email" class="form-control"
                                           value="{{ old('email', $user->email ?? '') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label required">{{ __('cart.address') }}</label>
                                    <input type="text" id="address" name="address" class="form-control"
                                           value="{{ old('address', $user->address ?? '') }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="locality" class="form-label required">{{ __('cart.locality') }}</label>
                                    <input type="text" id="locality" name="locality" class="form-control"
                                           value="{{ old('locality', $user->locality ?? '') }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="postal_code" class="form-label required">{{ __('cart.zip_code') }}</label>
                                    <input type="text" id="postal_code" name="postal_code" class="form-control"
                                           value="{{ old('postal_code', $user->postal_code ?? '') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="nif" class="form-label required">{{ __('cart.nif') }}</label>
                                    <input type="text" id="nif" name="nif" class="form-control"
                                           value="{{ old('nif', $user->nif ?? '') }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="phone_number" class="form-label required">{{ __('cart.phone') }}</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control"
                                           value="{{ old('phone_number', $user->phone_number ?? '') }}">
                                </div>
                            </div>

                            <!-- Botão de submit -->
                            <x-button.submit color="solid btn-block">{{ __('cart.pay') }}</x-button.submit>
                        </form>
                    </div>
                </div>
                <!-- Tabela de Totais (idem à página do carrinho) -->
                <div class="col-lg-3 col-sm-offset-7">
                    <div>
                        <h1 class="section-title font-alt">{{ __('cart.total_amount') }}</h1>
                        <hr class="divider">
                        <table class="table table-striped table-border checkout-table">
                            <tbody>
                            <tr>
                                <th>{{ __('cart.total_sem_iva') }}</th>
                                <td id="total-sem-iva">{{ number_format($total_sem_iva, 2) }} €</td>
                            </tr>
                            <tr>
                                <th>{{ __('cart.iva') }}</th>
                                <td id="iva">{{ number_format($iva, 2) }} €</td>
                            </tr>
                            <tr>
                                <th>{{ __('cart.shipping') }}</th>
                                <td id="shipping">{{ number_format($shipping, 2) }} €</td>
                            </tr>
                            <tr>
                                <th>{{ __('cart.valor_a_pagar') }}</th>
                                <td id="total-pagar">{{ number_format($total_pagar, 2) }} €</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
