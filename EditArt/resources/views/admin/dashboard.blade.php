@extends('layouts.admin.base')

@section('title','Admin Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            @if(session("success"))
                <x-alert id="success-alert" type="success">
                    {{session("success")}}
                </x-alert>
            @endif
            <div class="col-md-6 col-xl-3 mb-4">
                <x-card id="widget-card">
                    <x-widget.counter bgcolor="rgba(175, 136, 103, 0.58)" icon="icon-profile-male" title="Utilizadores" :count="$users_count"></x-widget.counter>
                </x-card>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <x-card id="widget-card">
                    <x-widget.counter bgcolor="rgb(103, 163, 175, 0.58)" icon="icon-book-open" title="Produtos" :count="$products_count"></x-widget.counter>
                </x-card>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <x-card id="widget-card">
                    <x-widget.counter bgcolor="rgb(103, 103, 175, 0.58)" icon="icon-profile-female" title="Autores" :count="$authors_count"></x-widget.counter>
                </x-card>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <x-card id="widget-card">
                    <x-widget.counter bgcolor="rgb(175, 175, 103, 0.58)" icon="icon-pencil" title="Avaliações" :count="$reviews_count"></x-widget.counter>
                </x-card>
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
