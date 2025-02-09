@extends('layouts.admin.base')

@section('title', __('client.user_list'))

@section('button')
    <x-button.add link="{{ route('admin.users.create') }}" icon="fa-user-plus">&nbsp {{ __('client.new_user') }}</x-button.add>
@endsection

@section('content')
    <div class="container">
        <!-- Barra de pesquisa -->
        <x-widget.search
            action="{{ route('admin.users.index') }}"
            name="name"
            placeholder="{{ __('client.search_placeholder') }}"
            value="{{ request('name') }}"
        />

        <!-- Tabela -->
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="table-responsive">

                        <x-table>
                            <x-table.thead>
                                <x-table.tr>
                                    <x-table.th>{{ __('client.name') }}</x-table.th>
                                    <x-table.th>{{ __('client.email') }}</x-table.th>
                                    <x-table.th>{{ __('client.role') }}</x-table.th>
                                    <x-table.th class="text-end">{{ __('client.actions') }}</x-table.th>
                                </x-table.tr>
                            </x-table.thead>
                            <x-table.tbody>
                            <!-- Aqui, o loop deve ser substituído por uma lista de elementos gerada dinamicamente -->
                            @foreach($users as $user)
                                <x-table.tr>
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
