@extends('layouts.client.base')

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
                                    <th class="hidden-xs">Capa</th>
                                    <th>Título</th>
                                    <th class="hidden-xs">Preço</th>
                                    <th>Quantidade</th>
                                    <th>Total</th>
                                    <th>Remover</th>
                                </tr>
                                <tr>
                                    <td class="hidden-xs"><a href="#"><img src="assets/images/shop/product-14.jpg" alt="Accessories Pack"/></a></td>
                                    <td>
                                        <p class="product-title font-alt">Accessories Pack</p>
                                    </td>
                                    <td class="hidden-xs">
                                        <p class="product-title font-alt">£20.00</p>
                                    </td>
                                    <td>
                                        <input class="form-control" type="number" name="" value="1" max="50" min="1"/>
                                    </td>
                                    <td>
                                        <p class="product-title font-alt">£20.00</p>
                                    </td>
                                    <td class="pr-remove"><a href="#" title="Remove"><i class="fa fa-times"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="hidden-xs"><a href="#"><img src="assets/images/shop/product-13.jpg" alt="Men’s Casual Pack"/></a></td>
                                    <td>
                                        <p class="product-title font-alt">Men’s Casual Pack</p>
                                    </td>
                                    <td class="hidden-xs">
                                        <p class="product-title font-alt">£20.00</p>
                                    </td>
                                    <td>
                                        <input class="form-control" type="number" name="" value="1" max="50" min="1"/>
                                    </td>
                                    <td>
                                        <p class="product-title font-alt">£20.00</p>
                                    </td>
                                    <td class="pr-remove"><a href="#" title="Remove"><i class="fa fa-times"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input class="form-control" type="text" id="" name="" placeholder="Coupon code"/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <button class="btn btn-solid" type="submit">Apply</button>
                            </div>
                        </div>
                    </div>
                    <hr class="divider">
                </div>
                <!-- Total para pagamento ------------------------------------  -->
                <div class="col-lg-3 col-sm-offset-7">
                    <div class="shop-Cart-totalbox">
                        <h1 class="section-title font-alt">Montante total</h1>
                        <hr class="divider">
                        <table class="table table-striped table-border checkout-table">
                            <tbody>
                            <tr>
                                <th>Subtotal:</th>
                                <td>£40.00</td>
                            </tr>
                            <tr>
                                <th>Total de envio:</th>
                                <td>£2.00</td>
                            </tr>
                            <tr class="shop-Cart-totalprice">
                                <th>Total:</th>
                                <td>£42.00</td>
                            </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-solid btn-block" type="submit">Pagar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
