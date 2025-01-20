@extends('layouts.client.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row mt-5">

                <!-- Avatar do utilizador e nav-tab ------------------------------------  -->
                <div class="col-md-4 d-flex justify-content-center text-center">
                    <div id="user-card">
                        <h5>Bem-vindo(a),<br><b>{{ auth()->user()->name}}</b></h5>
                        <img src="{{asset('imgs/no_user.png')}}" class="mt-4" alt="EditArt" id="avatar">
                        <hr>
                        <x-pills>
                            <x-pills.button class="active" id="profile" target="profile" controls="profile" select="true">Perfil</x-pills.button>
                            <x-pills.button class="" id="review" target="review" controls="review" select="false">Minhas avaliações</x-pills.button>
                            <x-pills.button class="" id="comment" target="comment" controls="comment" select="false">Meus comentários</x-pills.button>
                        </x-pills>
                    </div>
                </div>

                <!-- Informações do utilizador   -->
                <div class="col-md-8 mt-5">
                    <div class="tab-content mt-5" id="v-pills-tabContent">

                        <!-- Tab: Perfil ------------------------------------  -->
                        <x-pills.content class="show active" id="profile" label="profile">
                            <div class="review-post">
                                <div class="row">
                                    <span class="col-3 font-alt">Nome</span>
                                    <span class="col-9">{{ auth()->user()->name }}</span>
                                </div>
                                <div class="row review-entry">
                                    <span class="col-3 font-alt">Email</span>
                                    <span class="col-9">{{ auth()->user()->email }}</span>
                                </div>
                                <div class="row review-entry">
                                    <span class="col-3 font-alt">NIF</span>
                                    <span class="col-9">{{ auth()->user()->nif }}</span>
                                </div>
                                <div class="row review-entry">
                                    <span class="col-3 font-alt">Telefone</span>
                                    <span class="col-9">{{ auth()->user()->phone_number }}</span>
                                </div>
                                <div class="row review-entry">
                                    <span class="col-3 font-alt">Morada</span>
                                    <span class="col-9">{{ auth()->user()->address }}</span>
                                </div>
                                <div class="row review-entry">
                                    <span class="col-3 font-alt">Сonta criada</span>
                                    <span class="col-9">{{ auth()->user()->created_at }}</span>
                                </div>
                            </div>
                        </x-pills.content>

                        <!-- Tab: Minhas avaliações ------------------------------------  -->
                        <x-pills.content class="" id="review" label="review">Nenhuma revisão ainda</x-pills.content>

                        <!-- Tab: Meus comentários ------------------------------------  -->
                        <x-pills.content class="" id="comment" label="comment">Nenhum comentário ainda</x-pills.content>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
