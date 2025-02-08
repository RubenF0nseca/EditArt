<!-- Footer -->
<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-3">
                <div class="widget">
                    <h5 class="widget-title font-alt">{{ __('homepage.title') }}</h5>
                    <p>{{ __('homepage.description') }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget">
                    <h5 class="widget-title font-alt">Os nossos contatos</h5>
                    <p><i class="fa-solid fa-phone-flip"></i>&nbsp +351 234 567 888</p>
                    <p><i class="fa-solid fa-envelope"></i><a href="edit.art@gmail.com">&nbsp edit.art@gmail.com</a></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget">
                    <h5 class="widget-title font-alt">{{ __('homepage.services_title') }}</h5>
                    <ul class="icon-list">
                        <li><a href="{{route('guest.books')}}">{{ __('homepage.online_store') }}</a></li>
                        <li><a href="{{route('publisher')}}">{{ __('homepage.online_publisher') }}</a></li>
                        <li><a href="{{route('client.forum.index')}}">{{ __('homepage.forum') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget">
                    <h5 class="widget-title font-alt">A Nossa Equipe</h5>
                    <ul class="icon-list">
                        <li>Leila Arruda</li>
                        <li>Lucas Patrício</li>
                        <li>Olesea Vulpe</li>
                        <li>Rúben Fonseca</li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 font-alt">
                <p>{{ __('homepage.copyright') }}</p>
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
