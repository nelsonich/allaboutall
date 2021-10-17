@extends('layouts.appDashboard')
@section('title', 'Подкатегории')

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
            <h4>{{ $category->name }}</h4>
            @if($is_add)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal" data-whatever="@mdo">Создать</button>
            @endif
        </div>
        <div class="mt-2 p-0">
            <table class="w-100 table-bordered table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Клики</th>
                        <th scope="col">Название</th>
                        @if($is_delete)<th scope="col">Удалить</th>@endif
                        @if($is_edit)<th scope="col">Изменить</th>@endif
                        <th scope="col">
                            Показать на сайте
                            <span class="tableInfo">
                                <i class="far fa-plus-circle"></i>

                                <div class="tableInfoContent">
                                    Статьи могут быть активными и неактивными. <br/>
                                    Если статья деактивирован, то не буден показан на сайте.
                                </div>
                            </span>
                        </th>
                        <th scope="col">
                            Добавить тег
                            <span class="tableInfo">
                                <i class="far fa-plus-circle"></i>

                                <div class="tableInfoContent">
                                    Тег нужен для того, чтобы пользователи могли найти статью.
                                </div>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categoryChildes as $key => $item)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $item->click_count }}</td>
                            <td>{{ $item->name }}</td>
                            @if($is_delete)
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCategoryModal{{ $item->id }}" data-whatever="@mdo" style="padding: 0 5px">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    {{-- Delete Modal --}}
                                    @push('modals')
                                        <div class="modal fade" id="deleteCategoryModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteCategoryModalLabel">Удалить Категорию ({{ $item->name }})</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ url('/dashboard/categories/child/delete', ['id' => $item['categoryDetails']->category_id]) }}">
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
                                    @endpush
                                </td>
                            @endif
                            @if($is_edit)
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editCategoryModal{{ $item->id }}" data-whatever="@mdo" style="padding: 0 5px">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    {{-- Edit Modal --}}
                                    @push('modals')
                                        <div class="modal fade" id="editCategoryModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editCategoryModalLabel">Изменить Категорию ({{ $item->name }})</h5>
                                                        <span class="openCarouselModal" title="Создать карусель">
                                                            <i class="fas fa-plus-square fa-2x"></i>
                                                        </span>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('category-child.update') }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $item['categoryDetails']->id }}">
                                                            <input type="hidden" name="parentId" value="{{ $item->id }}">
                                                            <div class="form-group">
                                                                <label for="name{{ $item->id }}" class="col-form-label">Названия:</label>
                                                                <input type="text" class="form-control" id="name{{ $item->id }}" name="name" value="{{ $item->name }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="preview-description{{ $item->id }}" class="col-form-label">Предварительный просмотр:</label>
                                                                <textarea class="form-control" id="preview-description{{ $item->id }}" name="preview">{!! $item['categoryDetails']->preview_text !!}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="description{{ $item->id }}" class="col-form-label">Описание:</label>
                                                                <textarea class="form-control description" id="description{{ $item->id }}" name="description">{!! $item['categoryDetails']->description !!}</textarea>
                                                            </div>
                                                            <div class="form-group d-flex justify-content-center">
                                                                <label for="image{{ $item->id }}" class="col-form-label">
                                                                    <img src="{{ asset('storage/category_details/images/' . $item['categoryDetails']->image) }}" alt="Image" class="w-100" />
                                                                </label>
                                                                <input type="file" id="image{{ $item->id }}" name="image" class="d-none changeImage">
                                                            </div>

                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
                                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                                        </form>
                                                    </div>
                                                    <div class="carouselItemsModal hide">
                                                        <div class="header">
                                                            <h5>Саздать карусель</h5>
                                                            <span class="closeCarouselModal">
                                                                <i class="fas fa-window-close fa-2x"></i>
                                                            </span>
                                                        </div>
                                                        <div class="content">
                                                            <form method="post" action="{{ route('add-carousel-item') }}" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                                <input type="file" name="photos[]" multiple />

                                                                <ul class="p-0 d-flex justify-content-center">
                                                                    @forelse($item['categoryCarouselItems'] as $carouselItem)
                                                                        <li style="background-image: url('{{ asset('storage/carousel/' . $carouselItem['name']) }}')">
                                                                            <span class="removeCarouselItem" data-id="{{ $carouselItem->id }}">
                                                                                <i class="fas fa-window-close fa-2x"></i>
                                                                            </span>
                                                                        </li>
                                                                    @empty
                                                                        Пусто !!
                                                                    @endforelse
                                                                </ul>

                                                                <div class="footer">
                                                                    <button type="submit" class="btn-success m-2">Сахранить</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpush
                                </td>
                            @endif
                            <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#isActiveCategoryModal{{ $item->id }}" data-whatever="@mdo" style="padding: 0 5px">
                                    @if($item->is_active === 'true')
                                        <i class="far fa-eye"></i>
                                    @else
                                        <i class="far fa-eye-slash"></i>
                                    @endif
                                </button>
                                {{-- Is Active Modal --}}
                                @push('modals')
                                    <div class="modal fade" id="isActiveCategoryModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="isActiveCategoryModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="isActiveCategoryModalLabel">Изменить активность ({{ $item->name }})</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ route('category-child.changeActive') }}">
                                                        @csrf
                                                        @if($item->is_active === 'true')
                                                            <p>вы точно хотите <strong>деактивировать</strong> ету катекорию?</p>
                                                        @else
                                                            <p>вы точно хотите <strong>активировать</strong> ету катекорию?</p>
                                                        @endif
                                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
                                                        <button type="submit" class="btn btn-warning">Сахранить</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endpush
                            </td>
                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addSearchTagsModal{{ $item->id }}" data-whatever="@mdo" style="padding: 0 5px">
                                    <i class="far fa-plus-square"></i>
                                </button>
                                {{-- Add Search Tags Modal --}}
                                @push('modals')
                                    <div class="modal fade" id="addSearchTagsModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="addSearchTagsModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addSearchTagsModalLabel">Добавить тег ({{ $item->name }})</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ route('category-child.addSearchTags') }}">
                                                        @csrf
                                                        <label for="tags{{ $item->id }}"></label>
                                                        <input type="text" data-role="tagsinput" name="tags" id="tags{{ $item->id }}" value="{{ implode(',', $item['tags']) }}" />

                                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
                                                        <button type="submit" class="btn btn-warning">Сахранить</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endpush
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <strong>Пусто!</strong>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-2">
                {{ $categoryChildes->links() }}
            </div>
        </div>
    </div>

    @if($is_add)
        @push('modals')
            <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCategoryModalLabel">Новый Подкатегория</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('category-child.add') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Названия:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="preview-description" class="col-form-label">Предварительный просмотр:</label>
                                    <textarea class="form-control" id="preview-description" name="preview"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-form-label">Описание:</label>
                                    <textarea class="form-control description" id="description" name="description"></textarea>
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <label for="background" class="col-form-label">
                                        <img src="{{ asset('storage/noImage.png') }}" alt="Image" class="w-100" >
                                    </label>
                                    <input type="file" id="background" name="image" class="d-none changeImage">
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
