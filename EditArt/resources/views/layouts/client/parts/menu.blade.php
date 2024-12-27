<!-- Navegação ------------------------------------  -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" >
    <div class="container"><a class="navbar-brand" href="{{ route('home') }}"><img src={{asset('imgs/logo-editart.png')}} alt="EditArt" width="50" /></a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav mx-auto border-bottom border-lg-bottom-0 pt-2 pt-lg-0">
                <li class="nav-item"><a class="nav-link active active" aria-current="page" href="{{ route('home')}}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('guest.books') }}">Livros</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('guest.authors') }}">Autores</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Online Editora</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('client.forum') }}">Forum</a></li>
            </ul>
            <ul class="d-flex py-3 py-lg-0 flex-end top-icons">
                <li class="nav-item"><a class="nav-link" href="{{ route('client.profile') }}"><i class="fa-solid fa-user"></i></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('client.wishlist') }}"><i class="fa-solid fa-heart"></i></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('client.cart') }}"><i class="fa-solid fa-cart-shopping"></i></a></li>
                <li class="nav-item"><a class="nav-link" href="#">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>
