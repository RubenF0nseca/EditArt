@extends('layouts.admin.base')

@section('title', __('c_i_s_u.reviews_list'))

@section('button')
    <x-button.add link="{{ route('admin.reviews.create') }}" icon="fa-plus">&nbsp {{ __('c_i_s_u.new_review') }}</x-button.add>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <!-- Alerta para mensagem de sucesso -->
            @if(session('success'))
                <x-alert id="success-alert" type="success">
                    {{session('success')}}
                </x-alert>
            @endif
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="table-responsive">

                        <x-table>
                            <x-table.thead>
                                <x-table.tr>
                                    <x-table.th>{{ __('c_i_s_u.id') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.book') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.user') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.rating') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.date') }}</x-table.th>
                                    <x-table.th class="text-end">Aprovação</x-table.th>
                                    <x-table.th class="text-end">{{ __('c_i_s_u.actions') }}</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                                @foreach($reviews as $review)
                                    <x-table.tr>
                                        <td>{{ $review->id }}</td>
                                        <td>{{ $review->book->title }}</td>
                                        <td>{{ $review->user->name }}</td>
                                        <td>{{ $review->rating }}</td>
                                        <td>{{ $review->created_at }}</td>
                                        <td class="text-end">
                                            <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" style="display: inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="is_approved" value="{{ $review->is_approved ? 0 : 1 }}">
                                                <button type="submit"><i class="fa-solid fa-check"></i></button>
                                            </form>

                                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete"><i class="fa-solid fa-xmark text-danger"></i></button>
                                            </form>
                                        </td>
                                        <td class="text-end">
                                            <x-table.operation link="{{ route('admin.reviews.show', $review->id) }}" name="info" icon="ti ti-eye"></x-table.operation>
                                        </td>
                                    </x-table.tr>
                                @endforeach
                            </x-table.tbody>
                        </x-table>
                    </div>
                    <div class="card-footer">
                        {{ $reviews->links('layouts.admin.parts.pagination') }}
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
