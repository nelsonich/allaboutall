@extends('layouts.app')
@section('title', 'Все Обо Всем')
@section('description', 'Это главная страница. Здесь можно увидеть все категории статей.')

@section('content')
    <section data-bg="bg.jpg" data-path="backgrounds">
        <div class="container-fluid">
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
                    <div class="text-center">
                        <h1>Все Обо Всем</h1>
                    </div>
                    <div class="categories">
                        <h2 class="text-center">Категории</h2>
                        <ol>
                            @foreach($categories as $category)
                                <li><a href="p/{{ $category->id }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ol>
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
