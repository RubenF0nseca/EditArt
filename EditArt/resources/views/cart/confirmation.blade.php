@extends('layouts.client.base') <!-- TODO FALTA TRADUÇAO -->

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row" id="margin-top">
                <div id="logo-bg"></div>
                <!-- Confirmação ------------------------------------  -->
                <div class="col-lg-8 offset-2">
                    <h1 class="section-title font-alt">{{ __('cart.confirmation_title') }}</h1>
                    <h2 class="section-subtitle font-serif">{{ __('cart.thank_you') }}</h2>
                    <hr class="divider">
                    <div class="order-card mb-5 p-5">
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.name') }}</h3></span>
                            <span class="col-9">#</span>
                        </div>
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.address') }}</h3></span>
                            <span class="col-9">#</span>
                        </div>
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.email') }}</h3></span>
                            <span class="col-9">#</span>
                        </div>
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.phone') }}</h3></span>
                            <span class="col-9">#</span>
                        </div>
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.paypal_account') }}</h3></span>
                            <span class="col-9">#</span>
                        </div>
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.order_date') }}</h3></span>
                            <span class="col-9">#</span>
                        </div>
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.total') }}</h3></span>
                            <span class="col-9">#</span>
                        </div>
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.shopping_list') }}</h3></span>
                            <span class="col-9">#</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
