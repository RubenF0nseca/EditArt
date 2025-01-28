{{--Footer--}}
<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
        <div class="row">
            <div class="col-sm-4">
                <div class="widget">
                    <h5 class="widget-title font-alt">{{ __('homepage.title') }}</h5>
                    <p>{{ __('homepage.footer.description') }}</p>
                    <p><i class="fa-solid fa-phone-flip"></i>&nbsp +351 234 567 888</p>
                    <p><i class="fa-solid fa-envelope"></i><a href="edit.art@gmail.com">&nbsp edit.art@gmail.com</a></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="widget">
                    <h5 class="widget-title font-alt">{{ __('homepage.services_title') }}</h5>
                    <ul class="icon-list">
                        <li><a href="{{route('guest.books')}}">{{ __('homepage.online_store') }}</a></li>
                        <li><a href="#">{{ __('homepage.online_publisher') }}</a></li>
                        <li><a href="{{route('forum')}}">{{ __('homepage.forum') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="widget">
                    <h5 class="widget-title font-alt">{{ __('homepage.subscription_title') }}</h5>
                    <form id="subscription-form" role="form" method="post" action="php/subscribe.php">
                        <div class="input-group">
                            <input class="form-control" type="email" id="semail" name="semail" placeholder="{{ __('homepage.subscription_placeholder') }}" data-validation-required-message="Please enter your email address." required="required"/><span class="input-group-btn">
                        <button class="btn btn-light-new" id="subscription-form-submit" type="submit">{{ __('homepage.subscription_submit') }}</button></span>
                        </div>
                    </form>
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
