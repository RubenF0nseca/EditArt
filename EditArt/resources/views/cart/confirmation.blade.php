@extends('layouts.client.base') <!-- TODO FALTA TRADUÇAO -->

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row" id="margin-top">
                <div id="logo-bg"></div>
                <!-- Confirmação ------------------------------------  -->
                <div class="col-lg-8 offset-2">
                    <h1 class="section-title font-alt">Confirmação do pedido</h1>
                    <h2 class="section-subtitle font-serif">Obrigado pelo seu pedido!</h2>
                    <hr class="divider">
                    <div class="order-card mb-5 p-5">
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>Nome</h3></span>
                            <span class="col-9">#</span>
                        </div>
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>Morada</h3></span>
                            <span class="col-9">#</span>
                        </div>
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>Email</h3></span>
                            <span class="col-9">#</span>
                        </div>
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>Telemóvel</h3></span>
                            <span class="col-9">#</span>
                        </div>
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>Conta Paypal</h3></span>
                            <span class="col-9">#</span>
                        </div>
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>Data do pedido</h3></span>
                            <span class="col-9">#</span>
                        </div>
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>Total</h3></span>
                            <span class="col-9">#</span>
                        </div>
                        <div class="row review-entry">
                            <span class="col-3 font-alt"><h3>Lista de compras</h3></span>
                            <span class="col-9">#</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
