@extends('layouts.admin.base')

@section('title', __('admin.dashboard_title'))

@section('content')
    <div class="container">
        <div class="row">
            <!-- Alerta para mensagem de sucesso -->
            @if(session("success"))
                <x-alert id="success-alert" type="success">
                    {{session("success")}}
                </x-alert>
            @endif

            <!-- Сontadores de informações gerais ------------------------------------  -->
            <!-- Сontador dos utilizadores -->
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-4">
                <x-card id="widget-card">
                    <x-widget.counter bgcolor="rgba(175, 136, 103, 0.58)" icon="icon-profile-male" title="{{ __('admin.dashboard_users') }}" :count="$users_count"></x-widget.counter>
                </x-card>
            </div>
            <!-- Сontador dos produtos (livros) -->
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-4">
                <x-card id="widget-card">
                    <x-widget.counter bgcolor="rgb(103, 163, 175, 0.58)" icon="icon-book-open" title="{{ __('admin.dashboard_products') }}" :count="$products_count"></x-widget.counter>
                </x-card>
            </div>
            <!-- Сontador dos autores -->
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-4">
                <x-card id="widget-card">
                    <x-widget.counter bgcolor="rgb(103, 103, 175, 0.58)" icon="icon-profile-female" title="{{ __('admin.dashboard_authors') }}" :count="$authors_count"></x-widget.counter>
                </x-card>
            </div>
            <!-- Сontador dos avaliações -->
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-4">
                <x-card id="widget-card">
                    <x-widget.counter bgcolor="rgb(175, 175, 103, 0.58)" icon="icon-pencil" title="{{ __('admin.dashboard_reviews') }}" :count="$reviews_count"></x-widget.counter>
                </x-card>
            </div>
        </div>

        <div class="row">
            <!-- Vendas ------------------------------------  -->
            <div class="col-xl-6 mb-4">
                <h4 class="font-alt">Vendas</h4>
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Livros mais vendidos ------------------------------------  -->
            <div class="col-xl-6 mb-4">
                <h4 class="font-alt">Livros mais vendidos</h4>
                <div class="card shadow-lg border-0 rounded-lg mt-4 widget-height">
                    <div class="chart-container">
                        <div class="chart">

                            <div class="bar-container">
                                <div class="value-label">120</div>
                                <div class="bar" style="height: 12vh;"></div>
                                <div class="bar-label">Nome do livro</div>
                            </div>
                            <div class="bar-container">
                                <div class="value-label">180</div>
                                <div class="bar" style="height: 18vh;"></div>
                                <div class="bar-label">Nome do livro</div>
                            </div>
                            <div class="bar-container">
                                <div class="value-label">210</div>
                                <div class="bar" style="height: 21vh;"></div>
                                <div class="bar-label">Nome do livro</div>
                            </div>
                            <div class="bar-container">
                                <div class="value-label">150</div>
                                <div class="bar" style="height: 15vh;"></div>
                                <div class="bar-label">Nome do livro</div>
                            </div>
                            <div class="bar-container">
                                <div class="value-label">240</div>
                                <div class="bar" style="height: 24vh;"></div>
                                <div class="bar-label">Nome do livro</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Gerir stock ------------------------------------  -->
            <div class="col-xl-9 mb-4">
                <h4 class="font-alt">Gerir stock</h4>
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="table-responsive">

                        <x-table>
                            <x-table.thead>
                                <x-table.tr>
                                    <x-table.th>{{ __('c_i_s_u.cover') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.title') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.stock') }}</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody id="stock-container">
                                @foreach($books as $book)
                                    <x-table.tr>
                                        <td>
                                            @if($book->CoverPicture)
                                                <img src="{{asset('storage/'.$book->CoverPicture)}}" class="product-thumb rounded" alt="{{ $book->title }}" style="width: 30px;">
                                            @else
                                                <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded" alt="Imagem não disponível" style="width: 30px;">
                                            @endif
                                        </td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->stock }}</td>

                                    </x-table.tr>
                                @endforeach
                            </x-table.tbody>
                        </x-table>

                    </div>
                    <!-- ----- Paginação ----------  -->
                    <div class="card-footer text-center m-3" id="stock-pagination">
                        {{ $books->links('layouts.admin.parts.pagination') }}
                    </div>
                </div>
            </div>

            <!-- Vendas Total -->
            <div class="col-xl-3">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-12 mb-4">
                        <h4 class="font-alt">Vendas por ano</h4>
                        <x-card id="widget-card">
                            <x-widget.counter bgcolor="rgb(250,128,114)" icon="icon-wallet" title="Vendas total" :count="$reviews_count">€</x-widget.counter>
                        </x-card>
                    </div>
                    <!-- Transações ------------------------------------  -->
                    <div class="col-md-6 col-lg-6 col-xl-12 mb-4">
                        <h4 class="font-alt ml-5">Transações</h4>
                        <div class="card shadow-lg border-0 rounded-lg mt-4">
                            <div class="table-responsive">

                                <x-table>
                                    <x-table.thead>
                                        <x-table.tr>
                                            <x-table.th><i class="fa-brands fa-paypal"></i>&nbsp;Paypal</x-table.th>
                                        </x-table.tr>
                                    </x-table.thead>
                                    <x-table.tbody>

                                        {{--@foreach($users as $user)--}}
                                        <x-table.tr>
                                            <td>+ Ultimas 5 Transações €</td>
                                        </x-table.tr>
                                        {{--@endforeach--}}
                                    </x-table.tbody>
                                </x-table>
                            </div>
                        </div>
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
