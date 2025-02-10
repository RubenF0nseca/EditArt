@php
    $layout = 'layouts.guest.base';

    if (auth()->check() && auth()->user()->hasAnyRole(['admin', 'cliente'])) {
        $layout = 'layouts.client.base';
    }
@endphp

@extends($layout)

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <!-- Banner ------------------------------------  -->
        <div class="error-404 text-center">
            <h2 id="title-404">404</h2>
            <h1 id="title-error-404">{{ __('error.error') }}</h1>
            <p id="text-404">{{ __('error.message3') }}<br>
                {{ __('error.message4') }}</p>
            <x-button.link link="{{ route('guest.books') }}" color="light-new">{{ __('error.back_to_library') }}</x-button.link>
        </div>
    </div>
@endsection


