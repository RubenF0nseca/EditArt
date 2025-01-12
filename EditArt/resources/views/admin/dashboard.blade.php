@extends('layouts.admin.base')

@section('title','Admin Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            @if(session("success"))
                <x-alert id="login-notify" type="success">
                    {{session("success")}}
                </x-alert>
            @endif
            <div class="col-md-6 col-xl-3 mb-4">
                <x-card id="widget-card">
                    <div class="row align-items-center widget-item">
                        <div class="col-3 text-center circle">
                          <span>
                            <i class="icon-profile-male widget-icon"></i>
                          </span>
                        </div>
                        <div class="col pr-0">
                            <p class="font-alt mb-0">Utilizadores</p>
                            <span class="h3 mb-0">1250</span>
                        </div>
                    </div>
                </x-card>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <x-card id="widget-card">
                    <div class="row align-items-center widget-item">
                        <div class="col-3 text-center circle">
                          <span>
                            <i class="icon-profile-male widget-icon"></i>
                          </span>
                        </div>
                        <div class="col pr-0">
                            <p class="font-alt mb-0">Utilizadores</p>
                            <span class="h3 mb-0">1250</span>
                        </div>
                    </div>
                </x-card>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <x-card id="widget-card">
                    <div class="row align-items-center widget-item">
                        <div class="col-3 text-center circle">
                          <span>
                            <i class="icon-profile-male widget-icon"></i>
                          </span>
                        </div>
                        <div class="col pr-0">
                            <p class="font-alt mb-0">Utilizadores</p>
                            <span class="h3 mb-0">1250</span>
                        </div>
                    </div>
                </x-card>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <x-card id="widget-card">
                    <div class="row align-items-center widget-item">
                        <div class="col-3 text-center circle">
                          <span>
                            <i class="icon-profile-male widget-icon"></i>
                          </span>
                        </div>
                        <div class="col pr-0">
                            <p class="font-alt mb-0">Utilizadores</p>
                            <span class="h3 mb-0">1250</span>
                        </div>
                    </div>
                </x-card>
            </div>

        </div>
    </div>
@endsection
