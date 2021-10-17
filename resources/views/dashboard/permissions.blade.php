@extends('layouts.appDashboard')
@section('title', 'Разрешения')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4>Разрешения</h4>
                @if($is_add)
                    <button type="button" 
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#addPermissionModal"
                            data-whatever="@mdo">
                        Создать
                    </button>
                @endif
            </div>
            <ol>
                @foreach($roles as $role)
                    <li class="role {{ $roleId == $role->id ? 'active' : '' }}">
                        <a href="/dashboard/permissions/get-by-role/{{ $role->id }}">
                            {{ $role->name }}
                        </a>
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

    @if($is_add)
        @push('modals')
            <div class="modal fade" id="addPermissionModal" tabindex="-1" role="dialog" aria-labelledby="addPermissionModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addPermissionModalLabel">Новый Разрешения</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('permission.add') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Названия:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="slug" class="col-form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug">
                                </div>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endpush
    @endif
@endsection

@push('script')
    <script src="{{ asset('js/dashboard/permission.js') }}" defer></script>
@endpush
