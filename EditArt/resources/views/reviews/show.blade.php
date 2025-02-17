@extends('layouts.admin.base')

@section('title', __('reviews.review_details'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body">
                        <!-- Alerta para mensagem de sucesso -->
                        @if(session('success'))
                            <x-alert id="success-alert" type="success">
                                {{session('success')}}
                            </x-alert>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th scope="row">{{ __('reviews.book') }}</th>
                                        <td>{{ $review->book->title }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('reviews.user') }}</th>
                                        <td>{{ $review->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('reviews.comment') }}</th>
                                        <td>{{ $review->comment }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('reviews.rating') }}</th>
                                        <td>{{ $review->rating }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('reviews.date') }}</th>
                                        <td>{{ $review->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('reviews.review_update') }}</th>
                                        <td>{{ $review->updated_at }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12 mt-4">
                                <x-button.link link="{{ route('admin.reviews.edit', $review->id) }}" color="solid">{{ __('reviews.back') }}</x-button.link>
                                <x-button.link link="{{ route('admin.reviews.index') }}" color="light-new">{{ __('reviews.show_all_reviews') }}</x-button.link>
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
