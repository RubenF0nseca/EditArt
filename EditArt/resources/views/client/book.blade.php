@extends('layouts.client.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <div class="container">
            <div class="row" id="margin-top">
                <!-- Imagem do livro ------------------------------------  -->
                <div class="col-sm-6 mb-sm-40 d-flex justify-content-center">
                    <img class="product-img" src="{{ asset('imgs/img_nao_disponivel.png') }}" alt="Product Image"/>
                </div>
                <!-- Detalhes do livro ------------------------------------  -->
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="product-title font-alt">Title</h1>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12"><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star-off"></i></span>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <div class="price font-alt"><span class="amount">€20.00</span></div>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <div class="description">
                                <p>The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ in their grammar, their pronunciation and their most common words.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-4 mb-sm-20">
                            <input class="form-control input-lg" type="number" name="" value="1" max="40" min="1" required="required"/>
                        </div>
                        <div class="col-sm-8"><a class="btn btn-solid" href="#">Add To Cart</a></div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <div class="product_meta">Categories:<a href="#"> Man, </a><a href="#">Clothing, </a><a href="#">T-shirts</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tablist ------------------------------------  -->
            <div class="row mt-70">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs font-alt" role="tablist">
                        <li class=""><a href="#description" data-toggle="tab"><span class="icon-book-open"></span>&nbsp Descrição</a></li>
                        <li><a href="#data-sheet" data-toggle="tab"><span class="icon-map"></span>&nbsp Informações de envio</a></li>
                        <li><a href="#reviews" data-toggle="tab"><span class="icon-pencil"></span>&nbsp Avaliações (2)</a></li>
                    </ul>
                    <!-- Tab - Descrição ------------------------------------  -->
                    <div class="tab-content">
                        <div class="tab-pane " id="description">
                            <p>Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words. If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages.</p>

                        </div>
                        <!-- Tab - Informações de envio ---------------------  -->
                        <div class="tab-pane" id="data-sheet">
                            <p>The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ in their grammar, their pronunciation and their most common words.</p>
                        </div>
                        <!-- Tab - Avaliações ------------------------------------  -->
                        <div class="tab-pane active" id="reviews">
                            <div class="comments reviews">
                                <div class="comment clearfix">
                                    <div class="comment-avatar"><img src="" alt="avatar"/></div>
                                    <div class="comment-content clearfix">
                                        <div class="comment-author font-alt"><a href="#">John Doe</a></div>
                                        <div class="comment-body">
                                            <p>The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The European languages are members of the same family. Their separate existence is a myth.</p>
                                        </div>
                                        <div class="comment-meta font-alt">Today, 14:55 -<span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star-off"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment clearfix">
                                    <div class="comment-avatar"><img src="" alt="avatar"/></div>
                                    <div class="comment-content clearfix">
                                        <div class="comment-author font-alt"><a href="#">Mark Stone</a></div>
                                        <div class="comment-body">
                                            <p>Europe uses the same vocabulary. The European languages are members of the same family. Their separate existence is a myth.</p>
                                        </div>
                                        <div class="comment-meta font-alt">Today, 14:59 -<span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star-off"></i></span><span><i class="fa fa-star star-off"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="comment-form mt-30">
                                <h4 class="comment-form-title font-alt">Add review</h4>
                                <form method="post">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="sr-only" for="name">Name</label>
                                                <input class="form-control" id="name" type="text" name="name" placeholder="Name"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="sr-only" for="email">Name</label>
                                                <input class="form-control" id="email" type="text" name="email" placeholder="E-mail"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <select class="form-control">
                                                    <option selected="true" disabled="">Rating</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control" id="" name="" rows="4" placeholder="Review"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <button class="btn btn-solid" type="submit">Submit Review</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
