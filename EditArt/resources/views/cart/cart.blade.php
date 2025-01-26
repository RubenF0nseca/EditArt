@extends('layouts.client.base') <!-- TODO FALTA TRADUÇAO -->

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row" id="margin-top">
                <!-- Lista de compras ------------------------------------  -->
                <div class="col-lg-9 col-sm-offset-3">
                    <h1 class="section-title font-alt">Сarrinho</h1>
                    <hr class="divider">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-border checkout-table">
                                <tbody>
                                <tr>
                                    <th style="width: 10%;">Capa</th>
                                    <th>Título</th>
                                    <th style="width: 15%;">Preço</th>
                                    <th style="width: 1%;">Quantidade</th>
                                    <th style="width: 15%;">Total</th>
                                    <th style="width: 1%;">Remover</th>
                                </tr>

                                <tr>
                                    <td><a href="#"><img src="#" alt="foto"/></a></td>
                                    <td class="font-alt">Titulo</td>
                                    <td class="font-alt">20.00 €</td>
                                    <td><input class="form-control" type="number" name="" value="1" max="50" min="1"/></td>
                                    <td class="font-alt">20.00 €</td>
                                    <td class="pr-remove"><a href="#" title="Remove"><i class="fa fa-times"></i></a></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- Paginação --> <!-- TODO pagination -->
                        <div class="text-center mt-5">Pagination</div>
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
                        <x-button.link link="{{route('order')}}" color="solid btn-block">PROSSEGUIR PARA O PAGAMENTO</x-button.link>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
