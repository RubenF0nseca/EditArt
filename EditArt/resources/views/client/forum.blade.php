@extends('layouts.client.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <!-- Banner ------------------------------------  -->
        <div class="forum-bg">
            <h2 class="module-title font-alt" id="margin-top">Forum</h2>
        </div>
        <div class="container">
            <blockquote class="section-subtitle font-serif">
                <p class="quot">&quot; Think before you speak. Read before you think. &quot;</p>
                <p class="text-end">― Fran Lebowitz</p><hr class="divider">
            </blockquote>
            <div class="row">
                <!-- Forum ------------------------------------  -->
                <div class="col-sm-8">
                    <div class="post">
                        <div class="author-avator set-bg" data-setbg="./assets/images/rp-1.jpg" style="background-image: url(&quot;./assets/images/rp-1.jpg&quot;);"></div>
                        <div class="post-header font-alt">
                            <h2 class="post-title"><a href="#">Our trip to the Alps</a></h2>
                            <div class="post-date">June 21, 2018</div>
                            <div class="post-meta">By&nbsp;<a href="#">Mark Stone</a>| 3 Comments | <a href="#">Photography, </a><a href="#">Web Design</a>
                            </div>
                        </div>
                        <div class="post-entry">
                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.</p>
                            <a class="more-link" href="#">Read more</a>
                        </div>
                    </div>
                    <div class="post">
                        <div class="author-avator set-bg" data-setbg="./assets/images/rp-1.jpg" style="background-image: url(&quot;./assets/images/rp-1.jpg&quot;);"></div>
                        <div class="post-header font-alt">
                            <h2 class="post-title"><a href="#">Our trip to the Alps</a></h2>
                            <div class="post-date">June 21, 2018</div>
                            <div class="post-meta">By&nbsp;<a href="#">Mark Stone</a>| 3 Comments | <a href="#">Photography, </a><a href="#">Web Design</a>
                            </div>
                        </div>
                        <div class="post-entry">
                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.</p>
                            <a class="more-link" href="#">Read more</a>
                        </div>
                    </div>
                    <div class="post">
                        <div class="author-avator set-bg" data-setbg="./assets/images/rp-1.jpg" style="background-image: url(&quot;./assets/images/rp-1.jpg&quot;);"></div>
                        <div class="post-header font-alt">
                            <h2 class="post-title"><a href="#">Our trip to the Alps</a></h2>
                            <div class="post-date">June 21, 2018</div>
                            <div class="post-meta">By&nbsp;<a href="#">Mark Stone</a>| 3 Comments | <a href="#">Photography, </a><a href="#">Web Design</a>
                            </div>
                        </div>
                        <div class="post-entry">
                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.</p>
                            <a class="more-link" href="#">Read more</a>
                        </div>
                    </div>

                    <!-- TODO pagination -->

                    <div class="pagination font-alt"><a href="#"><i class="fa fa-angle-left"></i></a><a class="active" href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#"><i class="fa fa-angle-right"></i></a></div>
                </div>
                <!-- Forum Categorias ------------------------------------  -->
                <div class="col-sm-4 col-md-3 col-md-offset-1 sidebar">
                    <div class="widget">
                        <h5 class="widget-title font-alt">Forum Categorias</h5>
                        <ul class="icon-list">
                            <li><a href="#">Photography - 7</a></li>
                            <li><a href="#">Web Design - 3</a></li>
                            <li><a href="#">Illustration - 12</a></li>
                            <li><a href="#">Marketing - 1</a></li>
                            <li><a href="#">Wordpress - 16</a></li>
                        </ul>
                    </div>
                    <!-- Tags ------------------------------------  -->
                    <div class="widget">
                        <h5 class="widget-title font-alt">Tag</h5>
                        <div class="tags font-serif"><a href="#" rel="tag">Blog</a><a href="#" rel="tag">Photo</a><a href="#" rel="tag">Video</a><a href="#" rel="tag">Image</a><a href="#" rel="tag">Minimal</a><a href="#" rel="tag">Post</a><a href="#" rel="tag">Theme</a><a href="#" rel="tag">Ideas</a><a href="#" rel="tag">Tags</a><a href="#" rel="tag">Bootstrap</a><a href="#" rel="tag">Popular</a><a href="#" rel="tag">English</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
