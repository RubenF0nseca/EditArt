@php
    $layout = 'layouts.guest.base';
    if (auth()->check() && auth()->user()->hasAnyRole(['admin', 'cliente'])) {
        $layout = 'layouts.client.base';
    }
@endphp

@extends($layout)

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <!-- Banner -->
        <div class="forum-bg">
            <h2 class="module-title font-alt" id="margin-top">{{ __('forum.forum_title') }}</h2>
        </div>
        <div class="container">
            <!-- Barra de Pesquisa -->
            <div class="row mt-5">
                <div class="col-sm-12">
                    <div class="widget">
                        <form role="form" action="{{ route('client.forum.index') }}" method="GET">
                            <div class="search-box mb-5">
                                <input type="text" name="search" class="form-control" placeholder="{{ __('forum.search_placeholder') }}" value="{{ request('search') }}">
                                <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Lista dos Tópicos -->
            <div class="row">
                <div class="col-sm-12 col-lg-8">
                    <x-table>
                        <x-table.thead>
                            <x-table.tr>
                                <x-table.th class="text-center">{{ __('forum.author') }}</x-table.th>
                                <x-table.th>{{ __('forum.topic') }}</x-table.th>
                                <x-table.th>{{ __('forum.category') }}</x-table.th>
                                <x-table.th>{{ __('forum.comments') }}</x-table.th>
                                <x-table.th>{{ __('forum.date') }}</x-table.th>
                            </x-table.tr>
                        </x-table.thead>
                        <x-table.tbody>
                            @forelse($posts as $post)
                                <x-table.tr>
                                    <td class="text-center">
                                        <a href="#">
                                            <img src="{{ asset('imgs/no_user.png') }}" class="author-avatar" alt="{{ $post->user->name }}">
                                            <p>{{ $post->user->name }}</p>
                                        </a>
                                    </td>
                                    <td>
                                        <h2 class="review-author font-alt">
                                            <a href="{{ route('client.forum.show', $post->id) }}">{{ $post->title }}</a>
                                        </h2>
                                    </td>
                                    <td>
                                        <p class="font-serif">{{ $post->category ?? 'Geral' }}</p>
                                    </td>
                                    <td>
                                        <p><a href="{{ route('client.forum.show', $post->id) }}">{{ $post->comments->count() }} {{ __('forum.comments') }}</a></p>
                                    </td>
                                    <td>
                                        <p><a href="{{ route('client.forum.show', $post->id) }}">{{ $post->created_at->format('M d, Y') }}</a></p>
                                    </td>
                                </x-table.tr>
                            @empty
                                <x-table.tr>
                                    <td colspan="5" class="text-center">{{ __('forum.no_topic_found') }}</td>
                                </x-table.tr>
                            @endforelse
                        </x-table.tbody>
                    </x-table>
                    <!-- Paginação -->
                    <div class="text-center">
                        {{ $posts->links() }}
                    </div>
                    <!-- Botão para Novo Tópico -->
                    <div class="text-center mt-5 mb-5">
                        <button class="btn btn-solid" id="show-editor">{{ __('forum.create_new_topic') }}</button>
                    </div>
                    <!-- Formulário para Criação de Novo Tópico (oculto por padrão) -->
                    <div class="editor" id="editor-form" style="display: none;">
                        <form action="{{ route('client.forum.topic.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="topic" id="topic" class="form-control" placeholder="{{ __('forum.topic_title_placeholder') }}" required>
                            </div>
                            <div class="mb-3">
                                <textarea name="content" rows="5" class="form-control" placeholder="{{ __('forum.topic_content_placeholder') }}" required></textarea>
                            </div>
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_support" value="0">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="is_support" value="1" checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Desligar support</label>
                            </div>
                            <div class="mt-3 text-end">
                                <button type="submit" class="btn btn-solid">{{ __('forum.submit_topic') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Sidebar: Regras do Fórum -->
                <div class="col-sm-12 col-lg-4">
                    <div class="text-center mb-4">
                        <h2 class="section-title font-alt">{{ __('forum.title') }}</h2>
                    </div>
                    <div class="accordion mb-3" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header font-alt">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fa-solid fa-angles-right"></i>&nbsp;{{ __('forum.main_rule') }}
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
                        <!-- Outros itens do accordion -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fa-solid fa-angles-right"></i>&nbsp;{{ __('forum.respect') }}
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{ __('forum.respect_text') }}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fa-solid fa-angles-right"></i>&nbsp;{{ __('forum.appropriate_content') }}
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{ __('forum.appropriate_content_text') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Alterna a visibilidade do formulário para criar novo tópico
        document.addEventListener('DOMContentLoaded', function() {
            const showEditorBtn = document.getElementById('show-editor');
            const editorForm = document.getElementById('editor-form');
            if (showEditorBtn && editorForm) {
                showEditorBtn.addEventListener('click', function() {
                    editorForm.style.display = (editorForm.style.display === 'none' || editorForm.style.display === '') ? 'block' : 'none';
                });
            }
        });
    </script>
@endpush
