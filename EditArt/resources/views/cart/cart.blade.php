@php
    $layout = 'layouts.guest.base';

    if (auth()->check() && auth()->user()->hasAnyRole(['admin', 'cliente'])) {
        $layout = 'layouts.client.base';
    }
@endphp

@extends($layout)
@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row" id="margin-top">
                <!-- Lista de compras ------------------------------------  -->
                <div class="col-lg-9 col-sm-offset-3">
                    <h1 class="section-title font-alt">{{ __('cart.cart') }}</h1>
                    <hr class="divider">
                    <div class="row">
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="col-sm-12">
                            @if (count($cart) > 0)
                                <table class="table table-striped table-border checkout-table">
                                    <tbody>
                                    <tr>
                                        <th style="width: 10%;">{{ __('cart.cover') }}</th>
                                        <th>{{ __('cart.title_cart') }}</th>
                                        <th style="width: 15%;">{{ __('cart.price') }}</th>
                                        <th style="width: 1%;">{{ __('cart.quantity') }}</th>
                                        <th style="width: 15%;">{{ __('cart.total') }}</th>
                                        <th style="width: 1%;">{{ __('cart.remove') }}</th>
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
                                                        <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded" alt="{{ __('cart.image_not_available') }}" style="max-width: 90%; height: auto;">
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
                                                <a href="{{ route('cart.remove', $bookId) }}" title="{{ __('cart.remove_item') }}">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>{{ __('cart.cart_empty') }}</p>
                            @endif
                        </div>

                        <!-- Paginação (se for necessária, mas aqui é do carrinho,
                             normalmente não há paginação...) -->
                        <div class="text-center mt-5">{{ __('cart.pagination') }}</div>
                    </div>
                </div>

                <!-- Total para pagamento ------------------------------------  -->
                <div class="col-lg-3 col-sm-offset-7">
                    <div>
                        <h1 class="section-title font-alt">{{ __('cart.total_amount') }}</h1>
                        <hr class="divider">

                        <table class="table table-striped table-border checkout-table">
                            <tbody>
                            <tr>
                                <th>Total sem IVA</th>
                                <td id="total-sem-iva">{{ number_format($total_sem_iva, 2) }} €</td>
                            </tr>
                            <tr>
                                <th>IVA (6%)</th>
                                <td id="iva">{{ number_format($iva, 2) }} €</td>
                            </tr>
                            <tr>
                                <th>{{ __('cart.shipping') }}</th>
                                <td id="shipping">{{ number_format($shipping, 2) }} €</td>
                            </tr>
                            <tr>
                                <th>Valor a pagar (com IVA)</th>
                                <td id="total-pagar">{{ number_format($total_pagar, 2) }} €</td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- Botão para prosseguir -->
                        <x-button.link
                            link="{{ auth()->check() ? route('cart.order') : route('login', ['redirect' => '/cart']) }}"
                            color="solid btn-block">
                            {{ __('cart.proceed_to_payment') }}
                        </x-button.link>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');//
            if (successAlert) {
                setTimeout(function() {
                    // Adiciona a classe 'fade' e remove a classe 'show' para iniciar a transição de fechamento
                    successAlert.classList.remove('show');
                    successAlert.classList.add('fade');

                    // Remove o elemento do DOM depois da transição
                    setTimeout(function() {
                        successAlert.remove();
                    }, 500); // Ajuste o tempo conforme o efeito 'fade'
                }, 3000); // Fecha o alerta após 3 segundos
            }
        });
    </script>

@endpush
