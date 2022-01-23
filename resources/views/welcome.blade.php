@extends('layouts.app')
@section('title', 'AllAboutAll.media')
@section('description', 'AllAboutAll.media главная страница. Это сайт где можно найти биографии, цитаты, статьи знаменитых людей, (актеров, футболистов, бизнесменов, певцов).')

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row mb-4">
                <ul class="categories carousel">
                    @foreach($categories as $category)
                        <li><a href="p/{{ $category->id }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- first top news --}}
            @include('includes.first_news')

            {{-- most popular news --}}
            @include('includes.most_popular_news')
        </div>
    </section>
@endsection
{{--
@push('scripts')
    <script src="{{ asset('js/slick/createCarousel.js') }}" defer></script>
@endpush --}}
