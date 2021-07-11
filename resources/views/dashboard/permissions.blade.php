@extends('layouts.appDashboard')
@section('title', 'Разрешения')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4>Разрешения</h4>
            <ol>
                @foreach($roles as $role)
                    <li class="role {{ $roleId == $role->id ? 'active' : '' }}">
                        <a href="/dashboard/permissions/get-by-role/{{ $role->id }}">{{ $role->name }}</a>
                    </li>
                @endforeach
            </ol>
        </div>
        <div class="mt-2 p-0">
            <table class="w-100 table-bordered table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Разрешения</th>
                        <th scope="col">Видеть</th>
                        <th scope="col">Добавить</th>
                        <th scope="col">Удалить</th>
                        <th scope="col">Изменить</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($permissions as $key => $permission)
                    <tr>
                        <th scope="row">{{ $key+1 }}</th>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <label for="input_view_{{ $key }}">
                                <input
                                    data-roleId="{{ $roleId }}"
                                    data-permissionId="{{ $permission->id }}"
                                    data-action="is_view"
                                    class="permission"
                                    id="input_view_{{ $key }}"
                                    type="checkbox" {{ $permission['actions']['is_view'] === 1 ? 'checked' : '' }}>
                            </label>
                        </td>
                        <td>
                            <label for="input_add_{{ $key }}">
                                <input
                                    data-roleId="{{ $roleId }}"
                                    data-permissionId="{{ $permission->id }}"
                                    data-action="is_add"
                                    class="permission"
                                    id="input_add_{{ $key }}"
                                    type="checkbox" {{ $permission['actions']['is_add'] === 1 ? 'checked' : '' }}>
                            </label>
                        </td>
                        <td>
                            <label for="input_delete_{{ $key }}">
                                <input
                                    data-roleId="{{ $roleId }}"
                                    data-permissionId="{{ $permission->id }}"
                                    data-action="is_delete"
                                    class="permission"
                                    id="input_delete_{{ $key }}"
                                    type="checkbox" {{ $permission['actions']['is_delete'] === 1 ? 'checked' : '' }}>
                            </label>
                        </td>
                        <td>
                            <label for="input_edit_{{ $key }}">
                                <input
                                    data-roleId="{{ $roleId }}"
                                    data-permissionId="{{ $permission->id }}"
                                    data-action="is_edit"
                                    class="permission"
                                    id="input_edit_{{ $key }}"
                                    type="checkbox" {{ $permission['actions']['is_edit'] === 1 ? 'checked' : '' }}>
                            </label>
                        </td>
                    </tr>
                @empty

                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/dashboard/permission.js') }}" defer></script>
@endpush
