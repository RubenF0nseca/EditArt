@extends('layouts.client.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <!-- Banner ------------------------------------  -->
        <div class="forum-bg">
            <h2 class="module-title font-alt" id="margin-top">Forum</h2>
        </div>
        <div class="container">

            <div class="row mt-5">
                <!-- Forum post------------------------------------  -->
                <div class="col-sm-8">
                    <div class="forum">
                        <div class="row">
                            <div class="col-md-1 text-center">
                                <img src="{{asset('imgs/no_user.png')}}" class="author-avatar" alt="">
                            </div>
                            <div class="col-md-7">
                                <h2 class="post-title font-alt">Our trip to the Alps</h2>
                                <h2 class="review-author font-alt"><a href="#">Maria Mendes</a></h2>

                            </div>
                            <div class="col-md-4 text-end">
                                <div class="review-date font-alt mb-3">June 21, 2018</div>
                                <div class="text-end">
                                    <span><i class="fa-solid fa-thumbs-up">&nbsp 18</i></span>
                                    <span><i class="fa-solid fa-thumbs-down">&nbsp 0</i></span>
                                </div>

                            </div>
                            <div class="review-entry">
                                <p class="review-text">A wonderful serenity has taken possession of my entire soul,
                                    like these sweet mornings of spring which I enjoy with my whole heart.
                                    I am alone, and feel the charm of existence in this spot,
                                    which was created for the bliss of souls like mine.</p>
                                <p class="review-text">A wonderful serenity has taken possession of my entire soul,
                                    like these sweet mornings of spring which I enjoy with my whole heart.
                                    I am alone, and feel the charm of existence in this spot,
                                    which was created for the bliss of souls like mine.</p>
                                <p class="review-text">A wonderful serenity has taken possession of my entire soul,
                                    like these sweet mornings of spring which I enjoy with my whole heart.
                                    I am alone, and feel the charm of existence in this spot,
                                    which was created for the bliss of souls like mine.</p>
                                <div class="text-end">
                                    <div class="review-comment font-serif">3 Comentarios</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <h5 class="font-serif">3 Comentarios</h5>
                    </div>
                    <!-- Comentários-->
                    <div class="comments">
                        <div class="row review-entry">
                            <div class="col-md-2 text-center">
                                <img src="{{asset('imgs/no_user.png')}}" class="author-avatar" alt="">
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="review-author font-alt"><a href="#">Maria Mendes</a></h2>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <div class="review-date font-alt">June 21, 2018 -<span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star-off"></i></span></div>
                                    </div>
                                </div>

                                <div class="comment-body">
                                    <p>The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The European languages are members of the same family. Their separate existence is a myth.</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 review-entry">
                            <div class="col-md-2 text-center">
                                <img src="{{asset('imgs/no_user.png')}}" class="author-avatar" alt="">
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="review-author font-alt"><a href="#">Maria Mendes</a></h2>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <div class="review-date font-alt">June 21, 2018 -<span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star"></i></span><span><i class="fa fa-star star-off"></i></span></div>
                                    </div>
                                </div>

                                <div class="comment-body">
                                    <p>The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The European languages are members of the same family. Their separate existence is a myth.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Paginação --> <!-- TODO pagination -->
                    <div class="text-center">Pagination</div>

                    <!-- Formulário para envio de comentários-->
                    <div class="editor" id="editor-form">
                        <form action="#" method="POST">
                            @csrf
                            <div class="mb-3 font-alt">
                                <label for="editor-container">Escreva aqui seu comentário</label>
                            </div>
                            <div id="editor-container"></div>
                            <input type="hidden" name="content" />
                            <div class="mt-3 text-end">
                                <button type="submit" class="btn btn-solid">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Regras do Fórum -------------------TODO TEXTO----------------- -->
                <div class="col-sm-4">
                    <div class="text-center">
                        <h2 class="section-title font-alt">Regras do Fórum</h2>
                    </div>
                    <div class="accordion mb-3" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header font-alt">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fa-solid fa-angles-right"></i>&nbsp A regra principal:
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="font-serif mt-3">
                                        <h2 class="quot text-center">"Think before you speak.<br> Read before you think."</h2>
                                        <p class="text-end">― Fran Lebowitz</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fa-solid fa-angles-right"></i>&nbsp Accordion Item #2
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fa-solid fa-angles-right"></i>&nbsp Accordion Item #3
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
