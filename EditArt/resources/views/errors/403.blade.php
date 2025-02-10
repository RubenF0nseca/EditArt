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
        <div class="error-403 text-center">
            <h2 id="title-403">403</h2>
            <h1 id="title-error-403">{{ __('error.error') }}</h1>
            <p id="text-403">{{ __('error.message1') }}<br>{{ __('error.message2') }}
            </p>
            <x-button.link link="{{ route('guest.books') }}" color="light-new">{{ __('error.back_to_library') }}</x-button.link>
        </div>
    </div>
@endsection


