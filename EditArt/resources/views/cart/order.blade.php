@extends('layouts.client.base') <!-- TODO FALTA TRADUÇAO -->

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row" id="margin-top">
                <!-- Fazer um pedido ------------------------------------  -->
                <div class="col-lg-9 col-sm-offset-3">
                    <h1 class="section-title font-alt">{{ __('cart.place_order') }}</h1>
                    <hr class="divider">
                    <div class="mb-3 font-alt">
                        <a href="{{route('cart')}}"><i class="fa-solid fa-arrow-left-long"></i>&nbsp {{ __('cart.back_to_cart') }}</a>
                    </div>
                    <div class="order-card mb-5">
                        <form>
                            <div class="font-alt mb-3"><h3>{{ __('cart.billing_address') }}</h3></div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label required">{{ __('cart.name') }}</label>
                                    <input type="text" id="name" name="name" class="form-control" >
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label required">{{ __('cart.email') }}</label>
                                    <input type="text" id="email" name="email" class="form-control" >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label required">{{ __('cart.address') }}</label>
                                    <input type="text" id="address" name="address" class="form-control" >
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="locality" class="form-label required">{{ __('cart.locality') }}</label>
                                    <input type="text" id="locality" name="locality" class="form-control" >
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="postal_code" class="form-label required">{{ __('cart.zip_code') }}</label>
                                    <input type="text" id="postal_code" name="postal_code" class="form-control" >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="nif" class="form-label required">{{ __('cart.nif') }}</label>
                                    <input type="text" id="nif" name="nif" class="form-control" >
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="phone_number" class="form-label required">{{ __('cart.phone') }}</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control" >
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- Total para pagamento ------------------------------------  -->
                <div class="col-lg-3 col-sm-offset-7">
                    <div>
                        <h1 class="section-title font-alt">{{ __('cart.total_amount') }}</h1>
                        <hr class="divider">

                        <!-- TODO Cupom (Baixa prioridade) -->
                        <!--
                        <div >
                            <div class="form-group">
                                <input class="form-control" type="text" id="" name="" placeholder="Coupon code"/>
                            </div>
                        </div>
                        <div >
                            <div class="form-group">
                                <button class="btn btn-solid" type="submit">Apply</button>
                            </div>
                        </div>
                        -->

                        <table class="table table-striped table-border checkout-table">
                            <tbody>
                            <tr>
                                <th>Total sem IVA</th>
                                <td>40.00 €</td>
                            </tr>
                            <tr>
                                <th>IVA</th>
                                <td>€</td>
                            </tr>
                            <tr>
                                <th>{{ __('cart.shipping') }}</th>
                                <td>2.00 €</td>
                            </tr>
                            <tr>
                                <th>Valor a pagar</th>
                                <td>42.00 €</td>
                            </tr>
                            </tbody>
                        </table>
                        <x-button.submit color="solid btn-block">{{ __('cart.pay') }}</x-button.submit>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
