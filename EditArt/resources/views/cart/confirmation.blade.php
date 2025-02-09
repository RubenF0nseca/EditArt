@extends('layouts.client.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row margin-top">
                <div id="logo-bg"></div>
                <!-- Confirmação do Pedido -->
                <div class="col-lg-8 offset-2">
                    <h1 class="section-title font-alt">{{ __('cart.confirmation_title') }}</h1>
                    <h2 class="section-subtitle font-serif">{{ __('cart.thank_you') }}</h2>
                    <hr class="divider">
                    <div class="order-card mb-5 p-5">
                        <!-- Nome do Cliente -->
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.name') }}</h3></span>
                            <span class="col-9">{{ $transaction->user->name }}</span>
                        </div>
                        <!-- Endereço -->
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.address') }}</h3></span>
                            <span class="col-9">
                            {{ $transaction->user_address }},
                            {{ $transaction->user_locality }},
                            {{ $transaction->user_postal_code }}
                        </span>
                        </div>
                        <!-- E-mail -->
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.email') }}</h3></span>
                            <span class="col-9">{{ $transaction->user->email }}</span>
                        </div>
                        <!-- Telefone -->
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.phone') }}</h3></span>
                            <span class="col-9">{{ $transaction->user_phone_number }}</span>
                        </div>
                        <!-- Data do Pedido -->
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.order_date') }}</h3></span>
                            <span class="col-9">{{ $transaction->transaction_date }}</span>
                        </div>
                        <!-- Total do Pedido -->
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.total') }}</h3></span>
                            <span class="col-9">{{ number_format($transaction->price, 2) }} €</span>
                        </div>
                        <!-- Lista de Compras -->
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>{{ __('cart.shopping_list') }}</h3></span>
                            <span class="col-9">
                            <ul>
                                @foreach($transaction->items as $item)
                                    <li>
                                        {{ $item->book->title }} -
                                        {{ $item->quantity }} x {{ number_format($item->unit_price, 2) }} €
                                    </li>
                                @endforeach
                            </ul>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
