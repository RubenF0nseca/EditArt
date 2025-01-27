{{--Footer--}}
<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
        <div class="row">
            <div class="col-sm-4">
                <div class="widget">
                    <h5 class="widget-title font-alt">EditArt</h5>
                    <p>A EditArt é uma editora online dedicada à publicação e venda de livros e eBooks, oferecendo uma plataforma acessível para escritores que querem transformar as suas ideias em obras publicadas. Além disso, dispomos de um fórum para que os autores e os leitores possam interagir, trocar experiências e expandir o universo literário.</p>
                    <p><i class="fa-solid fa-phone-flip"></i>&nbsp +351 234 567 888</p>
                    <p><i class="fa-solid fa-envelope"></i><a href="edit.art@gmail.com">&nbsp edit.art@gmail.com</a></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="widget">
                    <h5 class="widget-title font-alt">Os nossos serviços</h5>
                    <ul class="icon-list">
                        <li><a href="{{route('guest.books')}}">Loja Online</a></li>
                        <li><a href="#">Editora Online</a></li>
                        <li><a href="{{route('forum')}}">Forum</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="widget">
                    <h5 class="widget-title font-alt">Subscrição</h5>
                    <form id="subscription-form" role="form" method="post" action="php/subscribe.php">
                        <div class="input-group">
                            <input class="form-control" type="email" id="semail" name="semail" placeholder="Your Email" data-validation-required-message="Please enter your email address." required="required"/><span class="input-group-btn">
                        <button class="btn btn-light-new" id="subscription-form-submit" type="submit">Submit</button></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 font-alt">
                <p>2025 © EditArt, All Rights Reserved</p>
            </div>
            <div class="col-sm-6">
                <p class="text-end">
                    <a href="https://github.com/RubenF0nseca/EditArt" class="git link-body-emphasis text-decoration-none">
                        <i class="fa-brands fa-github"></i>
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>
