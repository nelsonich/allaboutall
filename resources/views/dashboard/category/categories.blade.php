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
        <div class="d-flex justify-content-between">
            <h4>Категории</h4>
            @if($is_add)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal" data-whatever="@mdo">Создать</button>
            @endif
        </div>
        <ol>
            @forelse($categories as $category)
                <li>
                    @if($is_view)
                        <a href="categories/{{ $category->id }}">{{ $category->name }}</a>
                    @else
                        {{ $category->name }}
                    @endif
                    @if($is_delete)
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCategoryModal{{ $category->id }}" data-whatever="@mdo" style="padding: 0 5px">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        {{-- Delete Modal --}}
                        <div class="modal fade" id="deleteCategoryModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteCategoryModalLabel">Удалить Категорию ({{ $category->name }})</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ url('/dashboard/categories/delete', ['id' => $category->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <p>вы точно хотите удалить ету катекорию?</p>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
                                            <button type="submit" class="btn btn-danger">удалить</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($is_edit)
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editCategoryModal{{ $category->id }}" data-whatever="@mdo" style="padding: 0 5px">
                            <i class="fas fa-edit"></i>
                        </button>

                        {{-- Edit Modal --}}
                        <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCategoryModalLabel">Изменить Категорию ({{ $category->name }})</h5>
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
                    @endif
                </li>
            @empty
                <p>Нет Категории</p>
            @endforelse
        </ol>
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
