
@extends('layouts.admin.base')

@section('title', __('c_i_s_u.details_title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body">
                        <!-- Alerta para mensagem de sucesso -->
                        @if(session('success'))
                            <x-alert id="success-alert" type="success">
                                {{session('success')}}
                            </x-alert>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.title') }}</th>
                                        <td>{{ $book->title }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.type') }}</th>
                                        <td>{{ $book->type }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.authors') }}</th>
                                        <td>
                                            @if($book->authors->isNotEmpty())
                                                <ul>
                                                    @foreach($book->authors as $author)
                                                        <li>{{ $author->name }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                {{ __('c_i_s_u.no_authors') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.genres') }}</th>
                                        <td>
                                            @if($book->genres->isNotEmpty())
                                                <ul>
                                                    @foreach($book->genres as $genre)
                                                        <li>{{ $genre->name }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                {{ __('c_i_s_u.no_genres') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.publication_date') }}</th>
                                        <td>{{ $book->publicationDate }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.edition_number') }}</th>
                                        <td>{{ $book->editionNumber }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.isbn') }}</th>
                                        <td>{{ $book->isbn }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.number_of_pages') }}</th>
                                        <td>{{ $book->numberOfPages }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.stock') }}</th>
                                        <td>{{ $book->stock }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.language') }}</th>
                                        <td>{{ $book->language }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.price') }}</th>
                                        <td>{{ $book->price }}€</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">{{ __('c_i_s_u.updated_at') }}</th>
                                        <td>{{ $book->updated_at }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                @if($book->CoverPicture)
                                    <img src="{{ asset('storage/'.$book->CoverPicture) }}" class="product-thumb rounded shadow-lg border-0 rounded-lg mt-5" alt="{{ $book->title }}" style="width: 280px; height: 400px;">
                                @else
                                    <img src="{{ asset('imgs/img_nao_disponivel.png') }}" class="product-thumb rounded shadow-lg border-0 rounded-lg mt-5" alt="{{ __('c_i_s_u.image_not_available') }}"  style="width: 280px; height: 400px;">
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="row p-2"><b>Descrição</b></div>
                                <div class="p-2">{{ $book->description }}</div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <x-button.link link="{{ route('admin.books.edit', $book->id) }}" color="solid">{{ __('c_i_s_u.edit') }}</x-button.link>
                                <x-button.link link="{{ route('admin.books.index') }}" color="light-new">{{ __('c_i_s_u.show_all_products') }}</x-button.link>
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
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');//
            if (successAlert) {
                setTimeout(function() {
                    // Adiciona a classe 'fade' e remove a classe 'show' para iniciar a transição de fechamento
                    successAlert.classList.remove('show');
                    successAlert.classList.add('fade');

                    // Remove o elemento do DOM depois da transição
                    setTimeout(function() {
                        successAlert.remove();
                    }, 500); // Ajuste o tempo conforme o efeito 'fade'
                }, 3000); // Fecha o alerta após 3 segundos
            }
        });
    </script>
@endpush
