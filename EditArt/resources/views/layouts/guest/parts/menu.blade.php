{{--Navegação--}}
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" >
    <div class="container"><a class="navbar-brand" href="#"><img src={{asset('imgs/logo-editart.png')}} alt="EditArt" width="50" /></a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav mx-auto border-bottom border-lg-bottom-0 pt-2 pt-lg-0">
                <li class="nav-item"><a class="nav-link active active" aria-current="page" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Livros</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Autores </a></li>
            </ul>
            <form class="d-flex py-3 py-lg-0">
                <button class="btn btn-link text-1000 fw-medium order-1 order-lg-0" type="button">Registar</button>
                <a href="http://localhost:8000/admin/dashboard" class="btn btn-enter rounded-pill order-0" type="submit">Entrar</a>
            </form>
        </div>
    </div>
</nav>
