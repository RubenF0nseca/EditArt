@extends('layouts.client.base') <!-- TODO FALTA TRADUÇAO -->

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row" id="margin-top">
                <!-- Fazer um pedido ------------------------------------  -->
                <div class="col-lg-9 col-sm-offset-3">
                    <h1 class="section-title font-alt">Fazer um pedido</h1>
                    <hr class="divider">
                    <div class="mb-3 font-alt">
                        <a href="{{route('cart')}}"><i class="fa-solid fa-arrow-left-long"></i>&nbsp Voltar ao carrinho</a>
                    </div>
                    <div class="order-card mb-5">
                        <form>
                            <div class="font-alt mb-3"><h3>Morada de faturação</h3></div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="name" class="form-label required">Nome</label>
                                    <input type="text" id="name" name="name" class="form-control" >
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="surname" class="form-label required">Apelido</label>
                                    <input type="text" id="surname" name="surname" class="form-control" >
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="email" class="form-label required">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" >
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="phone_number" class="form-label required">Telemóvel</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control" >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label required">Morada</label>
                                    <input type="text" id="address" name="address" class="form-control" >
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="locality" class="form-label required">Localidade</label>
                                    <input type="text" id="locality" name="locality" class="form-control" >
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="postal_code" class="form-label required">Código postal</label>
                                    <input type="text" id="postal_code" name="postal_code" class="form-control" >
                                </div>
                            </div>

                            <div class="font-alt mb-3 mt-3">
                                <h3><i class="fa-brands fa-cc-paypal"></i>&nbsp Pagamento da conta Paypal</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="radio" value="" aria-label="Radio button for following text input">
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with radio button">
                                    </div>
                                    <div class="text-end mt-2">+ Adicionar nova conta</div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <!-- Total para pagamento ------------------------------------  -->
                <div class="col-lg-3 col-sm-offset-7">
                    <div>
                        <h1 class="section-title font-alt">Montante total</h1>
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
                                <th>Subtotal:</th>
                                <td>€40.00</td>
                            </tr>
                            <tr>
                                <th>Total de envio:</th>
                                <td>€2.00</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>€42.00</td>
                            </tr>
                            </tbody>
                        </table>
                        <x-button.submit color="solid btn-block">Pagar</x-button.submit>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
