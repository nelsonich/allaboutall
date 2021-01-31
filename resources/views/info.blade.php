@extends('layouts.app')
@section('title', $parentCategory->name . ' | ' . $childCategories->name)
@section('description', $childCategories->categoryDetails->preview_text)

@section('content')
    <section data-bg="{{ $childCategories['categoryDetails']['image'] }}" data-path="category_details/images">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="leftBanner col-md-3 col-sm-12 text-center mb-3">
                    <img src="https://dummyimage.com/200x500/000/fff.jpg&text=Ad" alt="Ad">
                    <img src="https://dummyimage.com/350x200/000/fff.jpg&text=Ad" alt="Ad">
                </div>
                <div class="col-md-6 col-sm-12 centerBar">

                    <ul class="breadcrumb mt-3 mb-0 p-2">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Категории</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/p/' . $parentCategory->id) }}">{{ $parentCategory->name }}</a></li>
                        <li class="breadcrumb-item" style="color: #000000">{{ limit($childCategories->name, 15) }}</li>
                    </ul>

                    <div class="text-center">
                        <h1>Все Обо Всем</h1>
                    </div>

                    @if(count($childCategories['categoryCarouselItems']) > 0)
                        <div class="carousel">
                            @foreach($childCategories['categoryCarouselItems'] as $item)
                                <div><img src="{{ asset('storage/carousel/' . $item->name) }}" alt="Item"></div>
                            @endforeach
                        </div>
                    @endif

                    <div class="p-4">
                        <h2 class="text-center">
                            {{ $childCategories->name }}
                        </h2>

                        {!! $childCategories['categoryDetails']['description'] !!}

                        <div class="shareButtons">
                            <iframe src="https://www.facebook.com/plugins/share_button.php?href={{ \Request::url() }}&layout=button_count&size=large&width=168&height=28&appId" width="168" height="28" style="border:none;overflow:hidden; text-align: center;" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                            {{--<a href="https://t.me/share/url?url={{ \Request::url() }}&text={{ 'a' }}">Share</a>--}}
                        </div>
                    </div>
                </div>
                <div class="rightBanner col-md-3 col-sm-12 text-center mt-3">
                    <img src="https://dummyimage.com/200x500/000/fff.jpg&text=Ad" alt="Ad">
                    <img src="https://dummyimage.com/350x200/000/fff.jpg&text=Ad" alt="Ad">
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/slick/createCarousel.js') }}" defer></script>
@endpush
