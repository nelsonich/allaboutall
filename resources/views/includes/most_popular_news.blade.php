<div class="row mt-3">
    <div class="col-md-8">
        <div class="home_page_section_title">
            <h2>Популярные новости</h2>
        </div>
        <div class="row mostPopularNews">
            @forelse($mostPopularNews as $item)
                <div class="col-md-6 singleMostPopularNews">
                    <div class="singleMostPopularNewsHead">
                        <div>
                            <a href="/info-p/{{ $item->parent_id . '/' . $item->id }}" class="click">
                                <img src="{{ asset('storage/category_details/images/' . $item->categoryDetails->image) }}"
                                    alt="{{ $item->name }}" />
                            </a>
                        </div>
                        <div>
                            <h6 class="newsCat">{{ $item->parent_category->name }}</h6>
                            <a href="/info-p/{{ $item->parent_id . '/' . $item->id }}" class="newsDesc click">
                                {{ limit($item->categoryDetails->preview_text, 200) }}
                            </a>
                        </div>
                    </div>

                    <div class="singleMostPopularNewsFoot">
                        <div>
                            <div class="users_watch_count">
                                <i class="far fa-eye"></i>
                                {{ $item->click_count }}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>empty</p>
            @endforelse
        </div>
    </div>
    <div class="col-md-4">
        <div class="home_page_section_title">
            <h2>{{ count($oldestNews) }} старые новости</h2>
        </div>
        <ol class="oldestNews">
            @foreach ($oldestNews as $item)
                <li class="singleOldestNews">
                    <a href="/info-p/{{ $item->parent_id . '/' . $item->id }}" class="click">
                        {{ limit($item->categoryDetails->preview_text, 150) }}
                    </a>
                    <p class="created_date">
                        <i class="far fa-clock"></i>
                        {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('MMMM DD, YYYY') }}
                    </p>
                </li>
            @endforeach
        </ol>

        {{-- Newsletter --}}
        @include("includes.news_letter")
    </div>
</div>
