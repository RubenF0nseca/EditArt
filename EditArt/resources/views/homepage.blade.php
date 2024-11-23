@extends('layouts.guest.base')

@section('content')
    <!-- Main Content -->
    <div class="page-wrapper">
        <section class="banner">
            <div class="text-container">
                <h1>“Think before you speak.<br>Read before you think.”</h1>
                <h5>― Fran Lebowitz</h5>
            </div>
        </section>

        {{--Page Body--}}
        <div class="page-body">
            <div class="container-xl">
                <section id="popular-books" class="bookshelf py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="section-header text-center pb-5">
                                    <h2 class="section-title">As nossas publicações</h2>

                                </div>

                                <div class="tab-content">
                                    <div id="all-genre" data-tab-content="" class="active">
                                        produtos
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        {{--Footer--}}
        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl"></div>
            <div class="row text-center align-items-center flex-row-reverse">
                <div class="col">
                    <p>2024 © EditArt</p>
                    <p class="text-center">
                        <a href="https://github.com/RubenF0nseca/EditArt" class="git link-body-emphasis text-decoration-none">
                            <i class="fa-brands fa-github"></i>
                        </a>
                </div>
            </div>
        </footer>
    </div>
@endsection
