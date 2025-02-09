@extends('layouts.client.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row margin-top">
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
                                           value="{{ old('name', $user->name ?? '') }}"  readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label required">{{ __('cart.email') }}</label>
                                    <input type="text" id="email" name="email" class="form-control"
                                           value="{{ old('email', $user->email ?? '') }}" readonly>
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
                            <div class="container">
                                <h1>{{ __('cart.payment_with_paypal') }}</h1>
                                <div id="paypal-button-container"></div>
                            </div>
                            <x-button.submit color="solid btn-block">{{ __('cart.pay') }}</x-button.submit>
                        </form>
                    </div>
                </div>
                <!-- Tabela de Totais -->
                <div class="col-lg-3 col-sm-offset-7">
                    <div>
                        <h1 class="section-title font-alt">{{ __('cart.total_amount') }}</h1>
                        <hr class="divider">
                        <table class="table table-striped table-border checkout-table">
                            <tbody>
                            <tr>
                                <th>{{ __('cart.total_without_iva') }}</th>
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
                                <th>{{ __('cart.amount_to_pay') }}</th>
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
@push('scripts')
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ number_format($total_pagar, 2, ".", "") }}'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Pagamento concluído com sucesso, ' + details.payer.name.given_name + '!');

                    // Coletar os dados do formulário (exceto nome e email, que são read-only)
                    const billingData = {
                        address: document.getElementById('address').value,
                        locality: document.getElementById('locality').value,
                        postal_code: document.getElementById('postal_code').value,
                        nif: document.getElementById('nif').value,
                        phone_number: document.getElementById('phone_number').value
                    };

                    // Enviar os detalhes do pagamento junto com os dados do endereço para o controller
                    fetch('/payment/complete', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            transactionDetails: details,
                            billingData: billingData
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.href = '/order/confirmation';
                            } else {
                                alert('Ocorreu um erro ao registrar a transação.');
                            }
                        })
                        .catch(err => {
                            console.error('Erro:', err);
                            alert('Ocorreu um erro ao processar o pagamento.');
                        });
                });
            },
            onError: function(err) {
                console.error(err);
                alert('Ocorreu um erro ao processar o pagamento.');
            }
        }).render('#paypal-button-container');
    </script>
@endpush
