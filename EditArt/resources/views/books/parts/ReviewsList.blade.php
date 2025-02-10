@forelse($reviews as $review)
    <div class="review-post">
        <div class="row">
            <div class="col-md-2 text-center">
                <img src="{{ asset('imgs/no_user.png') }}" class="author-avatar" alt="User Avatar">
            </div>
            <div class="col-md-5">
                <h2 class="review-author font-alt">
                    <a href="#">{{ $review->user->name }}</a>
                </h2>
                <p>{{ $review->user->reviews->count() }} {{ __('book.reviews') }}</p>
            </div>
            <div class="col-md-5 text-end">
                <div class="review-date font-alt">{{ $review->created_at }}</div>
                <div class="col-sm-12">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fa fa-star{{ $i <= $review->rating ? '' : '-off' }}"></i>
                    @endfor
                </div>
            </div>

            <div class="review-entry">
                <h2 class="review-title font-serif mb-3">{{ $review->topic }}</h2>
                <p class="review-text">{!! $review->comment !!}</p>

                <!-- Só mostra Botões e Formulário de edição para quem pode (autor ou admin) -->
                @auth
                    @if( Auth::id() === $review->user_id || Auth::user()->hasRole('admin') )
                        <div class="text-end">
                            <div class="tooltip-container" style="display: inline-block;">
                                <!-- Botão para mostrar o formulário de edição -->
                                <button class="btn operation show-editor-3" type="button">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <span class="tooltip-text">{{ __('book.edit_review') }}</span>
                            </div>

                            <div class="tooltip-container" style="display: inline-block;">
                                <form
                                    action="{{ route('client.review.delete', ['book' => $book->id, 'review' => $review->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('{{ __('book.confirm') }}');"
                                    style="display: inline;"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn operation" type="submit">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                    <span class="tooltip-text">{{ __('book.delete_review') }}</span>
                                </form>
                            </div>
                        </div>

                        <!-- Formulário para editar a avaliação (oculto por padrão) -->
                        <div class="editor m-0 editor-form-3" style="display: none;">
                            <form
                                action="{{ route('client.review.update', ['book' => $book->id, 'review' => $review->id]) }}"
                                method="POST"
                                name="review-form-edit"
                            >
                                @csrf
                                @method('PUT') <!-- caso uses RESTful (update) -->

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input
                                            style="width: 100%;"
                                            type="text"
                                            name="topic"
                                            value="{{ $review->topic }}"
                                            placeholder="Título"
                                            required
                                        />
                                    </div>

                                    <div class="col-md-6 mb-3 text-end">
                                        {{ __('book.your_review') }}
                                        <div class="stars">
                                            @for ($j = 1; $j <= 5; $j++)
                                                <i
                                                    class="fa fa-star @if($j <= $review->rating) selected @endif"
                                                    data-rating="{{ $j }}"
                                                ></i>
                                            @endfor
                                        </div>
                                        <input
                                            type="hidden"
                                            class="rating-edit"
                                            name="rating"
                                            value="{{ $review->rating }}"
                                            required
                                        />
                                    </div>
                                </div>

                                <!-- Container do Quill, com ID único -->
                                <div
                                    class="editor-container-3"
                                    id="editor-container-3-{{ $review->id }}"
                                    data-initial-content="{!! e($review->comment) !!}"
                                    style="height: 200px; border: 1px solid #ccc;"
                                ></div>

                                <!-- Input hidden onde enviaremos o HTML final do Quill -->
                                <input
                                    type="hidden"
                                    class="comment-edit"
                                    name="comment"
                                    required
                                />

                                <div class="mt-3 text-end">
                                    <button type="submit" class="btn btn-solid">{{ __('book.save') }}</button>
                                    <button type="button" class="btn btn-dark-solid close-editor">
                                        {{ __('book.cancel') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
@empty
    <p>{{ __('book.no_reviews') }}</p>
@endforelse

