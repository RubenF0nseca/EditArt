<!-- Barra de pesquisa -->
<div class="widget">
    <form role="form" method="GET" action="{{$action}}">
        <div class="search-box">
            <input class="form-control-admin" type="text" name="{{$name}}" placeholder="{{$placeholder}}" value="{{$value}}"/>
            <button class="search-admin" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>
</div>
