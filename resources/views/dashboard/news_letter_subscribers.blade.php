@extends('layouts.appDashboard')
@section('title', 'Пользователи')

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                
                {{ $error }}
                
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4>Подписчики</h4>
            {{-- @if($is_add)
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal" data-whatever="@mdo">Создать</button>
                    <a href={{ route('export-users-as-excel') }} type="button" class="btn btn-warning">
                        Экспортировать пользователей
                    </a>
                </div>
            @endif --}}
        </div>
        <div class="mt-2 p-0">
            <table class="w-100 table-bordered table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">ел. почта</th>
                        <th scope="col">Дата подписки</th>
                        @if($is_delete)<th scope="col">Удалить</th>@endif
                        @if($is_edit)<th scope="col">Изменить</th>@endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscribers as $key => $user)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            @if($is_delete)
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal{{ $user->id }}" data-whatever="@mdo" style="padding: 0 5px">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    {{-- Delete Modal --}}
                                    @push('modals')
                                        <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteUserModalLabel">Удалить Пользователя ({{ $user->name }})</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('subscribers.delete') }}">
                                                            @csrf
                                                            <p>вы точно хотите удалить {{ $user->name }}?</p>
                                                            <input type="hidden" value="{{ $user->id }}" name="id">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
                                                            <button type="submit" class="btn btn-danger">удалить</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpush
                                </td>
                            @endif
                            @if($is_edit)
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editUserModal{{ $user->id }}" data-whatever="@mdo" style="padding: 0 5px">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    {{-- Edit Modal --}}
                                    @push('modals')
                                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editCategoryModalLabel">Изменить Пользователя ({{ $user->name }})</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('users.update') }}">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                                            <div class="form-group">
                                                                <label for="name{{ $user->id }}" class="col-form-label">Названия:</label>
                                                                <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email{{ $user->id }}" class="col-form-label">Ел. почта:</label>
                                                                <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}">
                                                            </div>

                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
                                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpush
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <strong>Пусто!</strong>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-2">
                {{ $subscribers->links() }}
            </div>
        </div>
    </div>
    @if($is_add)
        @push('modals')
            <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">Новый Пользователь</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('users.add') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Названия:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Ел. почта:</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Пароль</label>
                                    <input type="password" class="form-control" id="password" name="password">
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