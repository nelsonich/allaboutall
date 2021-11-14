@extends('layouts.appDashboard')
@section('title', 'Категории')

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
        <div class="d-flex justify-content-between mb-1">
            <h4>Категории</h4>
            @if($is_add)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal" data-whatever="@mdo">Создать</button>
            @endif
        </div>

        <table class="w-100 table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Дата создания</th>
                    @if($is_view)<th scope="col">Ссылка</th>@endif
                    @if($is_delete)<th scope="col">Удалить</th>@endif
                    @if($is_edit)<th scope="col">Изменить</th>@endif
                </tr>
            </thead>

            <tbody>
                @forelse($categories as $key => $category)
                    <tr>
                        <th scope="row">{{ $key+1 }}</th>
                        <td>{{ $category->name }}</th>
                        <td>{{ \Carbon\Carbon::parse($category->created_at)->isoFormat('MM-DD-YYYY, h:mm A') }}</td>
                        @if($is_view)
                            <td>
                                <a href="categories/{{ $category->id }}">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </td>
                        @endif
                        @if($is_delete)
                            <td>
                                @if(!$category->trashed())
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCategoryModal{{ $category->id }}" data-whatever="@mdo" style="padding: 0 5px">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                    {{-- Delete Modal --}}
                                    <div class="modal fade" id="deleteCategoryModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark" id="deleteCategoryModalLabel">Удалить Категорию ({{ $category->name }})</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ url('/dashboard/categories/delete', ['id' => $category->id]) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <p class="text-dark">
                                                            вы точно хотите <strong>удалить</strong> ету катекорию?
                                                        </p>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
                                                        <button type="submit" class="btn btn-danger">удалить</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#truashRestoreCategoryModal{{ $category->id }}" data-whatever="@mdo" style="padding: 0 5px">
                                        <i class="fas fa-trash-restore"></i>
                                    </button>

                                    {{-- Trash restore Modal --}}
                                    <div class="modal fade" id="truashRestoreCategoryModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="trsashRestoreCategoryModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark" id="trsashRestoreCategoryModalLabel">Восстановить Категорию ({{ $category->name }})</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="get" action="{{ url('/dashboard/categories/restore', ['id' => $category->id]) }}">
                                                        @csrf
                                                        <p class="text-dark">
                                                            вы точно хотите <strong>восстановить</strong> ету катекорию?
                                                        </p>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
                                                        <button type="submit" class="btn btn-warning">восстановить</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>        
                        @endif
                        @if($is_edit)
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editCategoryModal{{ $category->id }}" data-whatever="@mdo" style="padding: 0 5px">
                                    <i class="fas fa-edit"></i>
                                </button>
        
                                {{-- Edit Modal --}}
                                <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-dark" id="editCategoryModalLabel">Изменить Категорию ({{ $category->name }})</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('category.update') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $category->id }}">
                                                    <div class="form-group">
                                                        <label for="name{{ $category->id }}" class="col-form-label">Названия:</label>
                                                        <input type="text" class="form-control" id="name{{ $category->id }}" name="name" value="{{ $category->name }}">
                                                    </div>
                                                    <div class="form-group d-flex justify-content-center">
                                                        <label for="background{{ $category->id }}" class="col-form-label">
                                                            <img src="{{ asset('storage/backgrounds/' . $category->background) }}" alt="Image" class="w-100" />
                                                        </label>
                                                        <input type="file" id="background{{ $category->id }}" name="background" class="d-none changeImage">
                                                    </div>
        
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
                                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    </div>
    @if($is_add)
        @push('modals')
            <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCategoryModalLabel">Новый Категория</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('category.add') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Названия:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <label for="background" class="col-form-label">
                                        <img src="{{ asset('storage/noImage.png') }}" alt="Image" class="w-100" >
                                    </label>
                                    <input type="file" id="background" name="background" class="d-none changeImage">
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
