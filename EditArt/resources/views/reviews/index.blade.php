@extends('layouts.admin.base')

@section('title', __('c_i_s_u.reviews_list'))

@section('button')
    <x-button.add link="{{ route('admin.reviews.create') }}" icon="fa-plus">&nbsp {{ __('c_i_s_u.new_review') }}</x-button.add>
@endsection

@section('content')
    <div class="container">
        <div class="row">
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
                                    <x-table.th class="text-end">>{{ __('c_i_s_u.actions') }}</x-table.th>
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
                                    <td>{{ $review->review_date }}</td>
                                    <td class="text-end">

                                        <x-table.operation link="{{ route('admin.reviews.show', $review->id) }}" name="info" icon="ti ti-eye"></x-table.operation>
                                        <x-table.operation link="{{ route('admin.reviews.edit', $review->id) }}" name="edit" icon="fa fa-pencil"></x-table.operation>
                                        <x-table.delete action="{{ route('admin.reviews.destroy', $review->id) }}"></x-table.delete>

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
