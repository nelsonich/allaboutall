@extends('layouts.app')
@section('title', $parentCategory->name)
@section('description', 'Это страница всех статей. Здесь можно увидеть стати конкретной категории.')

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <ul class="breadcrumb p-2">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Главная страница</a></li>
                        <li class="breadcrumb-item" style="color: #000000">{{ limit($parentCategory->name, 15) }}</li>
                    </ul>

                    <div class="text-center">
                        <label for="search" class="d-block">
                            <input
                            class="w-100"
                                data-parent_id="{{ $parentCategory->id }}"
                                type="text"
                                placeholder="Введите поисковый запрос"
                                id="search">
                        </label>
                    </div>
                    <div class="childCategories" data-ifIssetData="{{ $ifIssetData }}">
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
                                <hr />
                            @empty
                                Нечего показать!!!
                            @endforelse
                        </ul>
                        <p class='text-center loader hide'>Загрузка...</p>
                    </div>
                </div>
                <div class="col-md-4">
                    {{-- topic news --}}
                    <div class="home_page_section_title">
                        <h2>{{ $parentCategory->name }}</h2>
                    </div>

                    <ol class="topic_news">
                        @foreach($topic_news as $item)
                            <li class="singleTopicNews">
                                <a href="/info-p/{{ $item->parent_id . '/' . $item->id }}" class="click">
                                    {{ limit($item->categoryDetails->preview_text, 150) }}
                                </a>
                                <p class="created_date">
                                    <i class="far fa-clock"></i>
                                    {{ \Carbon\Carbon::parse($item->created_at)->isoFormat("MMMM DD, YYYY") }}
                                </p>
                            </li>
                        @endforeach
                    </ol>

                    {{-- most popular news --}}
                    @include('includes.news_letter')
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/search.js') }}" defer></script>
@endpush
