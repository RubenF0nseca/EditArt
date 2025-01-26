@extends('layouts.client.base') <!-- TODO FALTA TRADUÇAO -->

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row" id="margin-top">
                <!-- Lista de compras ------------------------------------  -->
                <div class="col-lg-9 col-sm-offset-3">
                    <h1 class="section-title font-alt">{{ __('admin.cart') }}</h1>
                    <hr class="divider">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-border checkout-table">
                                <tbody>
                                <tr>
                                    <th style="width: 10%;">{{ __('admin.cover') }}</th>
                                    <th>{{ __('admin.title_cart') }}</th>
                                    <th style="width: 15%;">{{ __('admin.price') }}</th>
                                    <th style="width: 1%;">{{ __('admin.quantity') }}</th>
                                    <th style="width: 15%;">{{ __('admin.total') }}</th>
                                    <th style="width: 1%;">{{ __('admin.remove') }}</th>
                                </tr>

                                <tr>
                                    <td><a href="#"><img src="#" alt="foto"/></a></td>
                                    <td class="font-alt">{{ __('admin.title_cart') }}</td>
                                    <td class="font-alt">20.00 €</td>
                                    <td><input class="form-control" type="number" name="" value="1" max="50" min="1"/></td>
                                    <td class="font-alt">20.00 €</td>
                                    <td class="pr-remove"><a href="#" title="{{ __('admin.remove_item') }}"><i class="fa fa-times"></i></a></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- Paginação --> <!-- TODO pagination -->
                        <div class="text-center mt-5">{{ __('admin.pagination') }}</div>
                    </div>
                </div>
                <!-- Total para pagamento ------------------------------------  -->
                <div class="col-lg-3 col-sm-offset-7">
                    <div>
                        <h1 class="section-title font-alt">{{ __('admin.total_amount') }}</h1>
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
                                <th>{{ __('admin.subtotal') }}:</th>
                                <td>€40.00</td>
                            </tr>
                            <tr>
                                <th>{{ __('admin.shipping') }}</th>
                                <td>€2.00</td>
                            </tr>
                            <tr>
                                <th>{{ __('admin.total') }}</th>
                                <td>€42.00</td>
                            </tr>
                            </tbody>
                        </table>
                        <x-button.link link="{{route('order')}}" color="solid btn-block">{{ __('admin.proceed_to_payment') }}</x-button.link>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
