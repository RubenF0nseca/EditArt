@extends('layouts.client.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <!-- Banner ------------------------------------  -->
        <div class="forum-bg">
            <h2 class="module-title font-alt" id="margin-top">Forum</h2>
        </div>
        <div class="container">

            <div class="row mt-5">
                <!-- Forum ------------------------------------  -->
                <div class="col-sm-8">

                    <!-- Barra de pesquisa -->
                    <div class="widget">
                        <form role="form">
                            <div class="search-box mb-5">
                                <input class="form-control" type="text" placeholder="Procurar..."/>
                                <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- Forum -->
                    <x-table>
                        <x-table.thead>
                            <x-table.tr>
                                <x-table.th class="text-center">Author</x-table.th>
                                <x-table.th>Tema</x-table.th>
                                <x-table.th>Categoria</x-table.th>
                                <x-table.th>Comentarios</x-table.th>
                                <x-table.th>Data</x-table.th>
                            </x-table.tr>
                        </x-table.thead>
                        <x-table.tbody class="forum">
                            <x-table.tr>
                                <td class="text-center"><a href="#"><img src="{{asset('imgs/no_user.png')}}" class="author-avatar" alt="">
                                        <p>Maria Mendes</p></a></td>
                                <td><h2 class="review-author font-alt align-items-center"><a href="#">Tema Title lorem ipsum</a></h2></td>
                                <td><p class="font-serif"><a href="#">Blog</a></p></td>
                                <td><p><a href="#">3 Comentarios</a></p></td>
                                <td><p><a href="#">June 21, 2018</a></p></td>
                            </x-table.tr>

                        </x-table.tbody>
                    </x-table>

                    <!-- Paginação --> <!-- TODO pagination -->
                    <div class="text-center">Pagination</div>

                    <!-- Botão que chama o formulário -->
                    <div class="text-center mt-5 mb-5">
                        <h5>Não conseguiu encontrar o tópico que procurava? Cria um novo tópico.</h5>
                        <button class="btn btn-solid" id="show-editor">Criar um novo tópico</button>
                    </div>

                    <!-- Formulário para envio de tópico -->
                    <div class="editor" id="editor-form" style="display: none;">
                        <form action="#" method="POST">
                            @csrf

                            <div class="mb-3">
                                <input type="text" id="topic" name="topic" placeholder="Título" />
                            </div>
                            <div id="editor-container-2"></div>
                            <input type="hidden" id="content" name="content" />
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
