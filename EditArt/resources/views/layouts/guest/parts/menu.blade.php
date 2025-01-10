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
            </ul>
            <form class="d-flex py-3 py-lg-0">
                <a href="{{ route('registration') }}" class="btn btn-link text-1000 fw-medium order-1 order-lg-0" type="submit">Registar</a>
                <x-button.link link="{{ route('login') }}" color="light-new rounded-pill" type="submit">Entrar</x-button.link>
            </form>
        </div>
    </div>
</nav>
