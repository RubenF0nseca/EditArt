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
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center mt-5">
                    <img src="{{asset('imgs/logo-editart.png')}}" class="mt-5" height="100%" alt="EditArt">
                </div>
                <div class="col-md-12 d-flex justify-content-center mt-5">
                    <h1 class="mt-5" id="title_authors">{{ __('guest.maintenance') }}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection



