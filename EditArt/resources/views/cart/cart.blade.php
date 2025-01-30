@extends('layouts.client.base')

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
                            @if (count($cart) > 0)
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

                                    @foreach ($cart as $bookId => $item)
                                        @php
                                            $book = $item['book'];
                                            $quantity = $item['quantity'];
                                            $lineTotal = $book->price * $quantity;
                                        @endphp
                                        <tr data-book-id="{{ $bookId }}">
                                            <td>
                                                <a href="{{ route('guest.books', $book->id) }}">
                                                    @if($book->CoverPicture)
                                                        <img src="{{ asset('storage/'.$book->CoverPicture) }}" class="product-thumb rounded" alt="{{ $book->title }}" style="max-width: 90%; height: auto;">
                                                    @else
                                                        <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded" alt="{{ __('homepage.image_not_available') }}" style="max-width: 90%; height: auto;">
                                                    @endif
                                                </a>
                                            </td>

                                            <td class="font-alt">{{ $book->title }}</td>
                                            <td class="font-alt">{{ number_format($book->price, 2) }} €</td>

                                            <td>
                                                <input
                                                    class="form-control update-cart"
                                                    type="number"
                                                    min="1"
                                                    max="{{ $book->stock }}"
                                                    name="quantity_{{ $bookId }}"
                                                    value="{{ $quantity }}"
                                                    data-book-id="{{ $bookId }}"
                                                >
                                            </td>

                                            <td class="font-alt line-total">{{ number_format($lineTotal, 2) }} €</td>

                                            <td class="pr-remove">
                                                <a href="{{ route('cart.remove', $bookId) }}" title="{{ __('admin.remove_item') }}">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>{{ __('admin.cart_empty') }}</p>
                            @endif
                        </div>

                        <!-- Paginação (se for necessária, mas aqui é do carrinho,
                             normalmente não há paginação...) -->
                        <div class="text-center mt-5">{{ __('admin.pagination') }}</div>
                    </div>
                </div>

                <!-- Total para pagamento ------------------------------------  -->
                <div class="col-lg-3 col-sm-offset-7">
                    <div>
                        <h1 class="section-title font-alt">{{ __('admin.total_amount') }}</h1>
                        <hr class="divider">

                        <table class="table table-striped table-border checkout-table">
                            <tbody>
                            <tr>
                                <th>Subtotal:</th>
                                <td id="subtotal">{{ number_format($subtotal, 2) }} €</td>
                            </tr>
                            <tr>
                                <th>Shipping:</th>
                                <td>{{ number_format($shipping, 2) }} €</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td id="total">{{ number_format($total, 2) }} €</td>
                            </tr>
                            </tbody>
                        </table>

                        <!-- Botão para prosseguir -->
                        <x-button.link link="{{ route('order') }}" color="solid btn-block">
                            {{ __('admin.proceed_to_payment') }}
                        </x-button.link>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
