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
        <div class="publisher-bg">
            <h2 class="module-title font-alt" id="margin-top">{{ __('homepage.online') }} <br>{{ __('homepage.publisher') }}</h2>
            <p>
                {{ __('homepage.send_email') }}
            </p>
        </div>
        <div class="container">






        </div>
    </div>
@endsection
