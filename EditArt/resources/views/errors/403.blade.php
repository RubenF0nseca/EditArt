@extends('layouts.client.base') <!--TODO role-->

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <!-- Banner ------------------------------------  -->
        <div class="error-403 text-center">
            <h2 id="title-403">403</h2>
            <h1 id="title-error-403">ERRO</h1>
            <p id="text-403">Parece que tropeçaste num capítulo bloqueado.<br>
                Mas não te preocupes, há muitas outras histórias na nossa biblioteca!</p>
            <x-button.link link="{{ route('guest.books') }}" color="light-new">Voltar para a biblioteca</x-button.link>
        </div>
    </div>
@endsection


<!-- FALTA TRADUÇAO-->
