@extends('layouts.app')
@section('title', $parentCategory->name)
@section('description', 'Это страница всех статей. Здесь можно увидеть стати конкретной категории.')

@section('content')
    <section data-bg="{{ $parentCategory->background }}" data-path="backgrounds">
        <div class="container">
            <div class="row">
                <div class="leftBanner col-md-3 col-sm-12 text-center mb-3">
                    <a href="http://drycode.loc/" target="_blank">
                        <img src="{{ asset('storage/drycode_200_500.png') }}" alt="Ad">
                    </a>
                    <a href="#" target="_blank">
                        <img src="{{ asset('storage/drycode_350_200.png') }}" alt="Ad">
                    </a>
                </div>
                <div class="col-md-6 col-sm-12 centerBar">

                    <ul class="breadcrumb mt-3 mb-0 p-2">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Категории</a></li>
                        <li class="breadcrumb-item" style="color: #000000">{{ limit($parentCategory->name, 15) }}</li>
                    </ul>

                    <div class="text-center">
                        <label for="search" class="d-block">
                            <input
                                data-parent_id="{{ $parentCategory->id }}"
                                type="text"
                                placeholder="Введите поисковый запрос"
                                id="search">
                        </label>
                    </div>
                    <div class="childCategories" data-ifIssetData="{{ $ifIssetData }}">
                        <h2 class="text-center border-bottom py-2">
                            {{ $parentCategory->name }}
                        </h2>
                        <ul class="p-0">
                            @forelse($childCategories as $category)
                                <li>
                                    <div style="background-image: url('{{ asset('storage/category_details/images/' . $category->categoryDetails->image) }}')"></div>
                                    <div class="ml-1">
                                        <h3>
                                            <a href="/info-p/{{ $parentCategory->id . '/' . $category->id }}" class="click">
                                                {{ $category->name }}
                                            </a>
                                        </h3>
                                        <p>{{ limit($category->categoryDetails->preview_text, 100) }}</p>
                                    </div>
                                </li>
                            @empty
                                Нечего показать!!!
                            @endforelse
                        </ul>
                    </div>
                    <div class="d-flex justify-content-center align-content-center mt-2">
                        <img src="{{ asset('storage/loader.gif') }}" alt="Loader..." id="loader" class="hide">
                    </div>
                </div>
                <div class="rightBanner col-md-3 col-sm-12 text-center mt-3">
                    <a href="http://drycode.loc/" target="_blank">
                        <img src="{{ asset('storage/drycode_200_500.png') }}" alt="Ad">
                    </a>
                    <a href="#" target="_blank">
                        <img src="{{ asset('storage/drycode_350_200.png') }}" alt="Ad">
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/search.js') }}" defer></script>
@endpush
