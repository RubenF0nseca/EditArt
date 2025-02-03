@extends('layouts.admin.base')

@section('title', __('admin.dashboard_title'))

@section('id','admin-bg')

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
            <div class="col-md-6 col-xl-3 mb-4">
                <x-card id="widget-card">
                    <x-widget.counter bgcolor="rgba(175, 136, 103, 0.58)" icon="icon-profile-male" title="{{ __('admin.dashboard_users') }}" :count="$users_count"></x-widget.counter>
                </x-card>
            </div>
            <!-- Сontador dos produtos (livros) -->
            <div class="col-md-6 col-xl-3 mb-4">
                <x-card id="widget-card">
                    <x-widget.counter bgcolor="rgb(103, 163, 175, 0.58)" icon="icon-book-open" title="{{ __('admin.dashboard_products') }}" :count="$products_count"></x-widget.counter>
                </x-card>
            </div>
            <!-- Сontador dos autores -->
            <div class="col-md-6 col-xl-3 mb-4">
                <x-card id="widget-card">
                    <x-widget.counter bgcolor="rgb(103, 103, 175, 0.58)" icon="icon-profile-female" title="{{ __('admin.dashboard_authors') }}" :count="$authors_count"></x-widget.counter>
                </x-card>
            </div>
            <!-- Сontador dos avaliações -->
            <div class="col-md-6 col-xl-3 mb-4">
                <x-card id="widget-card">
                    <x-widget.counter bgcolor="rgb(175, 175, 103, 0.58)" icon="icon-pencil" title="{{ __('admin.dashboard_reviews') }}" :count="$reviews_count"></x-widget.counter>
                </x-card>
            </div>
        </div>

        <div class="row">
            <!-- Pedidos ------------------------------------  -->
            <div class="col-md-9">
                <h4 class="font-alt ml-5">Pedidos</h4>
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="table-responsive">

                        <x-table>
                            <x-table.thead>
                                <x-table.tr>
                                    <x-table.th>Avatar</x-table.th>
                                    <x-table.th>{{ __('client.name') }}</x-table.th>
                                    <x-table.th>Id do pedido</x-table.th>
                                    <x-table.th>Produto</x-table.th>
                                    <x-table.th>Quantidade</x-table.th>
                                    <x-table.th class="text-end">Status</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>

                                {{--@foreach($users as $user)--}}
                                    <x-table.tr>
                                        <td><img src="{{asset('imgs/no_user.png')}}" class="author-avatar" alt="" style="width: 30px; height: auto"></td>
                                        <td>{{-- $user->name --}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-end">



                                        </td>
                                    </x-table.tr>
                                {{--@endforeach--}}
                            </x-table.tbody>
                        </x-table>
                    </div>
                    <div class="card-footer text-center">
                        {{-- $users->links('layouts.admin.parts.pagination') --}} Pagination
                    </div>
                </div>
            </div>

            <!-- Transações ------------------------------------  -->
            <div class="col-md-3">
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
                                    <td>Ultimas 5 Transações</td>
                                </x-table.tr>
                                {{--@endforeach--}}
                            </x-table.tbody>
                        </x-table>
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
