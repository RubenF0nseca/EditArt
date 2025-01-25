@extends('layouts.admin.base')

@section('title', __('c_i_s_u.user_list'))

@section('button')
    <x-button.add link="{{ route('admin.users.create') }}" icon="fa-user-plus">&nbsp {{ __('c_i_s_u.new_user') }}</x-button.add>
@endsection

@section('content')
    <div class="container">
        <!-- Barra de pesquisa -->
        <x-widget.search action="#" name="#" placeholder="{{ __('c_i_s_u.search_placeholder') }}" value="#"></x-widget.search>

        <!-- Tabela -->
        <div class="row">
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="table-responsive">

                        <x-table>
                            <x-table.thead>
                                <x-table.tr>
                                    <x-table.th>{{ __('c_i_s_u.id') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.name') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.email') }}</x-table.th>
                                    <x-table.th>{{ __('c_i_s_u.role') }}</x-table.th>
                                    <x-table.th class="text-end">{{ __('c_i_s_u.actions') }}</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($users as $user)
                                <x-table.tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                                    <td class="text-end">

                                        <x-table.operation link="{{ route('admin.users.show', $user->id) }}" name="info" icon="ti ti-eye"></x-table.operation>
                                        <x-table.operation link="{{ route('admin.users.edit', $user->id) }}" name="edit" icon="fa fa-pencil"></x-table.operation>
                                        <x-table.delete action="{{ route('admin.users.destroy', $user->id) }}"></x-table.delete>

                                    </td>
                                </x-table.tr>
                            @endforeach
                            </x-table.tbody>
                        </x-table>
                    </div>
                    <div class="card-footer">
                        {{ $users->links('layouts.admin.parts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
