@extends('layouts.client.base')

@section('content')
    <div class="page-wrapper wrapper d-flex flex-column min-vh-100">
        <!-- Banner -->
        <div class="forum-bg">
            <h2 class="module-title font-alt" id="margin-top">{{ __('forum.forum_title') }}</h2>
        </div>
        <div class="container">
            <div class="row mt-5">
                <!-- Conteúdo do Post -->
                <div class="col-sm-12 col-lg-8">
                    <div class="forum mb-4">
                        <div class="row">
                            <div class="col-md-2 text-center">
                                <img src="{{ asset('imgs/no_user.png') }}" class="author-avatar" alt="{{ $post->user->name }}">
                            </div>
                            <div class="col-md-6">
                                <h2 class="post-title font-alt">{{ $post->title }}</h2>
                                <h2 class="review-author font-alt"><a href="#">{{ $post->user->name }}</a></h2>
                            </div>
                            <div class="col-md-4 text-end">
                                <div class="review-date font-alt mb-3">{{ $post->created_at->format('M d, Y') }}</div>
                                <div class="text-end">
                                    <span><i class="fa-solid fa-thumbs-up"></i>&nbsp;{{ $post->likes_count ?? 0 }}</span>
                                    <span><i class="fa-solid fa-thumbs-down"></i>&nbsp;{{ $post->dislikes_count ?? 0 }}</span>
                                </div>
                            </div>
                            <div class="review-entry">
                                <p class="review-text">{{ $post->content }}</p>
                                <div class="text-end">
                                    <div class="review-comment font-serif">{{ $post->comments->count() }} {{ __('forum.comments') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comentários -->
                    <div class="text-center mb-4">
                        <h5 class="font-serif">{{ $post->comments->count() }} {{ __('forum.comments') }}</h5>
                    </div>
                    <div class="comments">
                        @forelse($comments as $comment)
                            <div class="row review-entry mb-3">
                                <div class="col-md-2 text-center">
                                    <img src="{{ asset('imgs/no_user.png') }}" class="author-avatar" alt="{{ $comment->user->name }}">
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2 class="review-author font-alt"><a href="#">{{ $comment->user->name }}</a></h2>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <div class="review-date font-alt">
                                                {{ $comment->created_at->format('M d, Y') }} -
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa {{ $i <= $comment->rating ? 'fa-star star' : 'fa-star star-off' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-body">
                                        <p>{{ $comment->content }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">{{ __('forum.no_comments') }}</p>
                        @endforelse
                    </div>

                    <!-- Paginação dos Comentários -->
                    <div class="text-center">
                        {{ $comments->links() }}
                    </div>

                    <!-- Formulário para Envio de Comentário -->
                    @auth
                        <div class="editor mt-4">
                            <form action="{{ route('client.forum.comment.store', $post->id) }}" method="POST">
                                @csrf
                                <div class="mb-3 font-alt">
                                    <label for="comment" class="form-label">{{ __('forum.write') }}</label>
                                </div>
                                <textarea name="content" id="comment" rows="5" class="form-control" placeholder="{{ __('forum.your_comment') }}" required></textarea>
                                <div class="mt-3 text-end">
                                    <button type="submit" class="btn btn-solid">{{ __('forum.send_button') }}</button>
                                </div>
                            </form>
                        </div>
                    @endauth
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
