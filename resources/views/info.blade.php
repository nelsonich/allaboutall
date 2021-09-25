@extends('layouts.app')
@section('title', $info->parent_category->name . ' | ' . $info->name)
@section('description', $info->categoryDetails->preview_text)

@section('content')
    <section>
        <div class="container-fluid info">
            <div class="row">
                <div class="col-md-8">
                    <div class="info-header">
                        <ul class="breadcrumb mb-1 p-2">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Главная страница</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/p/' . $info->parent_category->id) }}">{{ $info->parent_category->name }}</a></li>
                            <li class="breadcrumb-item" style="color: #000000">{{ limit($info->name, 50) }}</li>
                        </ul>
    
                        <h1>{{ $info->name }}</h1>
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <div>
                                <span class="mr-2">
                                    <i style="font-size: 17px" class="far fa-chart-bar"></i>
                                    {{ $info->click_count }}
                                    просмотров
                                </span>
                                <i style="font-size: 7px" class="fas fa-circle"></i>
                                <span class="ml-2">
                                    <i class="far fa-clock"></i>
                                    {{ \Carbon\Carbon::parse($info->created_at)->isoFormat('MM-DD-YYYY, h:mm A') }}
                                </span>
                            </div>
                            <div>
                                <div class="shareButtons">
                                    <iframe src="https://www.facebook.com/plugins/share_button.php?href={{ \Request::url() }}&layout=button_count&size=large&width=168&height=28&appId" width="168" height="28" style="border:none;overflow:hidden; text-align: center;" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                </div>
                            </div>
                        </div>
    
                        <hr />
                    </div>
                    <div class="info-body">
                        <div class="info-image" style="background-image: url('{{ asset('storage//category_details/images/' . $info->categoryDetails->image) }}')"></div>
                        {!! $info->categoryDetails->description !!}
                    </div>
                    <div class="info-footer"></div>
                </div>
                <div class="col-md-4">
                    {{-- carousel --}}
                    @if(count($info['categoryCarouselItems']) > 1)
                        <div class="carousel mb-3">
                            @foreach($info['categoryCarouselItems'] as $item)
                                <div><img src="{{ asset('storage/carousel/' . $item->name) }}" alt="Item"></div>
                            @endforeach
                        </div>
                    @endif

                    {{-- topic news --}}
                    <div class="home_page_section_title">
                        <h2>{{ $info->parent_category->name }}</h2>
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
    <script src="{{ asset('js/slick/createCarousel.js') }}" defer></script>
@endpush
