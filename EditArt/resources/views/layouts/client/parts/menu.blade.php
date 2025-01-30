<!-- Navegação ------------------------------------  -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" >
    <!-- Logo -->
    <div class="container"><a class="navbar-brand" href="{{ route('home') }}"><img src={{asset('imgs/logo-editart.png')}} alt="EditArt" width="50" /></a>
        <!-- Menu -->
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav mx-auto border-bottom border-lg-bottom-0 pt-2 pt-lg-0">
                <li class="nav-item"><a class="nav-link active active" aria-current="page" href="{{ route('home')}}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('guest.books') }}">{{ __('menu.books') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('guest.authors') }}">{{ __('menu.authors') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#">{{ __('menu.online_publisher') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('forum') }}">Forum</a></li>
            </ul>
            <!-- Icons -->
            <ul class="d-flex py-3 py-lg-0 flex-end top-icons">
                @role('admin') <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-dashboard"></i>&nbsp Dashboard</a></li>@endrole
                <li class="nav-item"><a class="nav-link" href="{{ route('client.profile') }}"><i class="fa-solid fa-user"></i></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('wishlist') }}"><i class="fa-solid fa-heart"></i></a></li>
                <li class="nav-item">
                    <a class="nav-link position-relative" href="{{ route('cart') }}">
                        <i class="fa-solid fa-cart-shopping" id="cart-icon"></i>
                        <span id="cart-counter"
                              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ count(session('cart', [])) }}
                            </span>
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="nav-link border-0 bg-transparent" type="submit">
                            <span class="nav-link-title">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </span>
                        </button>
                    </form>
                </li>
                <!-- Tradução PT/EN -->
                <li class="nav-item">
                    @if(app()->getLocale() === 'pt')
                        <a class="nav-link" href="{{route('lang.switch',['locale'=>'en'])}}">
                            <img src="{{ asset('flags/uk.png') }}" alt="English" style="width: 25px; height: auto;">
                            {{ __('menu.language_en') }}
                        </a>
                    @else
                        <a class="nav-link" href="{{route('lang.switch',['locale'=>'pt'])}}">
                            <img src="{{ asset('flags/pt.png') }}" alt="Portuguese" style="width: 25px; height: auto;">
                            {{ __('menu.language_pt') }}
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
