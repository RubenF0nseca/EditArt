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
                        <x-tab.div class="nav flex-column nav-pills me-3" id="v-pills-tab" orientation="vertical">
                            <x-tab.button class="active" id="v-pills-profile-tab" toggle="pill" target="#v-pills-profile" controls="v-pills-profile" select="true">Perfil</x-tab.button>
                            <x-tab.button class="" id="v-pills-rewiew-tab" toggle="pill" target="#v-pills-rewiew" controls="v-pills-rewiew" select="false">Minhas avaliações</x-tab.button>
                            <x-tab.button class="" id="v-pills-comment-tab" toggle="pill" target="#v-pills-comment" controls="v-pills-comment" select="false">Meus comentários</x-tab.button>
                        </x-tab.div>
                    </div>
                </div>

                <!-- Informações do utilizador   -->
                <div class="col-md-8 mt-5">
                    <div class="tab-content mt-5" id="v-pills-tabContent">

                        <!-- Tab: Perfil ------------------------------------  -->
                        <x-tab.content class="show active" id="v-pills-profile" label="v-pills-profile-tab">
                            <div class="post">
                                <div class="row">
                                    <span class="col-2 font-alt">ID</span>
                                    <span class="col-10">{{ auth()->user()->id }}</span>
                                </div>
                                <div class="row post-entry">
                                    <span class="col-2 font-alt">Nome</span>
                                    <span class="col-10">{{ auth()->user()->name }}</span>
                                </div>
                                <div class="row post-entry">
                                    <span class="col-2 font-alt">Email</span>
                                    <span class="col-10">{{ auth()->user()->email }}</span>
                                </div>
                                <div class="row post-entry">
                                    <span class="col-2 font-alt">NIF</span>
                                    <span class="col-10">{{ auth()->user()->nif }}</span>
                                </div>
                                <div class="row post-entry">
                                    <span class="col-2 font-alt">Telefone</span>
                                    <span class="col-10">{{ auth()->user()->phone_number }}</span>
                                </div>
                                <div class="row post-entry">
                                    <span class="col-2 font-alt">Morada</span>
                                    <span class="col-10">{{ auth()->user()->address }}</span>
                                </div>
                                <div class="row post-entry">
                                    <span class="col-2 font-alt">Сonta criada</span>
                                    <span class="col-10">{{ auth()->user()->created_at }}</span>
                                </div>
                            </div>
                        </x-tab.content>

                        <!-- Tab: Minhas avaliações ------------------------------------  -->
                        <x-tab.content class="" id="v-pills-rewiew" label="v-pills-rewiew-tab">Nenhuma revisão ainda</x-tab.content>

                        <!-- Tab: Meus comentários ------------------------------------  -->
                        <x-tab.content class="" id="v-pills-comment" label="v-pills-comment-tab">Nenhum comentário ainda</x-tab.content>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
