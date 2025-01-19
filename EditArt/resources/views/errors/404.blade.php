@extends('layouts.client.base') <!--TODO role-->

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <!-- Banner ------------------------------------  -->
        <div class="error-404 text-center">
            <h2 id="title-404">404</h2>
            <h1 id="title-error-404">ERRO</h1>
            <p id="text-404">Oh, não! Parece que esta página perdeu-se nos labirintos dos livros.<br>
                Experimente procurar outra história!</p>
            <x-button.link link="{{ route('guest.books') }}" color="light-new">Voltar para a biblioteca</x-button.link>
        </div>
    </div>
@endsection
