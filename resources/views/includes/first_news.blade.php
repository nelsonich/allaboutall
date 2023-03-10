<div class="row">
    <div class="col-md-4">
        <div class="singleTopFirstNewsLeft">
            <div class="singleNewsHead">
                <div title="{{ $firstTopNews[0]->name }}">
                    <a href="/info-p/{{ $firstTopNews[0]->parent_id . '/' . $firstTopNews[0]->id }}"
                        class="click">
                        <img src="{{ asset('storage/category_details/images/' . $firstTopNews[0]->categoryDetails->image) }}"
                            alt="{{ $firstTopNews[0]->name }}" />
                    </a>
                </div>
                <div>
                    <h6 class="newsCat">{{ $firstTopNews[0]->parent_category->name }}</h6>
                    <a href="/info-p/{{ $firstTopNews[0]->parent_id . '/' . $firstTopNews[0]->id }}"
                        class="newsDesc click">
                        {{ limit($firstTopNews[0]->categoryDetails->preview_text, 60) }}
                    </a>
                    <p class="newsCreatedDate m-0">
                        <i class="far fa-clock"></i>
                        {{ \Carbon\Carbon::parse($firstTopNews[0]->created_at)->isoFormat('MM-DD-YYYY, h:mm A') }}
                    </p>
                </div>
            </div>
            <div class="singleNewsFoot">
                <div>
                    <div class="users_watch_count">
                        <i class="far fa-eye"></i>
                        {{ $firstTopNews[0]->click_count }}
                    </div>
                </div>
            </div>
        </div>
        <div class="singleTopFirstNewsLeft">
            <div class="singleNewsHead">
                <div title="{{ $firstTopNews[1]->name }}">
                    <a href="/info-p/{{ $firstTopNews[1]->parent_id . '/' . $firstTopNews[1]->id }}"
                        class="click">
                        <img src="{{ asset('storage/category_details/images/' . $firstTopNews[1]->categoryDetails->image) }}"
                            alt="{{ $firstTopNews[1]->name }}" />
                    </a>
                </div>
                <div>
                    <h6 class="newsCat">{{ $firstTopNews[1]->parent_category->name }}</h6>
                    <a href="/info-p/{{ $firstTopNews[1]->parent_id . '/' . $firstTopNews[1]->id }}"
                        class="newsDesc click">
                        {{ limit($firstTopNews[1]->categoryDetails->preview_text, 60) }}
                    </a>
                    <p class="newsCreatedDate m-0">
                        <i class="far fa-clock"></i>
                        {{ \Carbon\Carbon::parse($firstTopNews[1]->created_at)->isoFormat('MM-DD-YYYY, h:mm A') }}
                    </p>
                </div>
            </div>
            <div class="singleNewsFoot">
                <div class="users_watch_count">
                    <i class="far fa-eye"></i>
                    {{ $firstTopNews[1]->click_count }}
                </div>
            </div>
        </div>
        <div class="singleTopFirstNewsLeft">
            <div class="singleNewsHead">
                <div title="{{ $firstTopNews[2]->name }}">
                    <a href="/info-p/{{ $firstTopNews[2]->parent_id . '/' . $firstTopNews[2]->id }}"
                        class="click">
                        <img src="{{ asset('storage/category_details/images/' . $firstTopNews[2]->categoryDetails->image) }}"
                            alt="{{ $firstTopNews[2]->name }}" />
                    </a>
                </div>
                <div>
                    <h6 class="newsCat">{{ $firstTopNews[2]->parent_category->name }}</h6>
                    <a href="/info-p/{{ $firstTopNews[2]->parent_id . '/' . $firstTopNews[2]->id }}"
                        class="newsDesc click">
                        {{ limit($firstTopNews[2]->categoryDetails->preview_text, 60) }}
                    </a>
                    <p class="newsCreatedDate m-0">
                        <i class="far fa-clock"></i>
                        {{ \Carbon\Carbon::parse($firstTopNews[2]->created_at)->isoFormat('MM-DD-YYYY, h:mm A') }}
                    </p>
                </div>
            </div>
            <div class="singleNewsFoot">
                <div class="users_watch_count">
                    <i class="far fa-eye"></i>
                    {{ $firstTopNews[2]->click_count }}
                </div>
            </div>
        </div>
        <div class="singleTopFirstNewsLeft">
            <div class="singleNewsHead">
                <div title="{{ $firstTopNews[3]->name }}">
                    <a href="/info-p/{{ $firstTopNews[3]->parent_id . '/' . $firstTopNews[3]->id }}"
                        class="click">
                        <img src="{{ asset('storage/category_details/images/' . $firstTopNews[3]->categoryDetails->image) }}"
                            alt="{{ $firstTopNews[3]->name }}" />
                    </a>
                </div>
                <div>
                    <h6 class="newsCat">{{ $firstTopNews[3]->parent_category->name }}</h6>
                    <a href="/info-p/{{ $firstTopNews[3]->parent_id . '/' . $firstTopNews[3]->id }}"
                        class="newsDesc click">
                        {{ limit($firstTopNews[3]->categoryDetails->preview_text, 60) }}
                    </a>
                    <p class="newsCreatedDate m-0">
                        <i class="far fa-clock"></i>
                        {{ \Carbon\Carbon::parse($firstTopNews[3]->created_at)->isoFormat('MM-DD-YYYY, h:mm A') }}
                    </p>
                </div>
            </div>
            <div class="singleNewsFoot">
                <div class="users_watch_count">
                    <i class="far fa-eye"></i>
                    {{ $firstTopNews[3]->click_count }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="singleTopFirstNewsCenter mb-3">
            <div class="singleNewsHead">
                <div title="{{ $firstTopNews[4]->name }}">
                    <a href="/info-p/{{ $firstTopNews[4]->parent_id . '/' . $firstTopNews[4]->id }}"
                        class="click">
                        <img src="{{ asset('storage/category_details/images/' . $firstTopNews[4]->categoryDetails->image) }}"
                            alt="{{ $firstTopNews[4]->name }}" />
                    </a>
                </div>
                <div>
                    <h6 class="newsCat">{{ $firstTopNews[4]->parent_category->name }}</h6>
                    <a href="/info-p/{{ $firstTopNews[4]->parent_id . '/' . $firstTopNews[4]->id }}"
                        class="newsDesc click">
                        {{ limit($firstTopNews[4]->categoryDetails->preview_text, 550) }}
                    </a>
                </div>
            </div>
            <div class="singleNewsFoot">
                <div>
                    <div class="users_watch_count">
                        <i class="far fa-eye"></i>
                        {{ $firstTopNews[4]->click_count }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="singleTopFirstNewsRight">
            <div class="singleNewsHead">
                <div title="{{ $firstTopNews[5]->name }}">
                    <a href="/info-p/{{ $firstTopNews[5]->parent_id . '/' . $firstTopNews[5]->id }}"
                        class="click">
                        <img src="{{ asset('storage/category_details/images/' . $firstTopNews[5]->categoryDetails->image) }}"
                            alt="{{ $firstTopNews[5]->name }}" />
                    </a>
                </div>
                <div>
                    <h6 class="newsCat">{{ $firstTopNews[5]->parent_category->name }}</h6>
                    <a href="/info-p/{{ $firstTopNews[5]->parent_id . '/' . $firstTopNews[5]->id }}"
                        class="newsDesc click">
                        {{ limit($firstTopNews[5]->categoryDetails->preview_text, 60) }}
                    </a>
                    <p class="newsCreatedDate m-0">
                        <i class="far fa-clock"></i>
                        {{ \Carbon\Carbon::parse($firstTopNews[5]->created_at)->isoFormat('MM-DD-YYYY, h:mm A') }}
                    </p>
                </div>
            </div>

            <div class="singleNewsFoot">
                <div>
                    <div class="users_watch_count">
                        <i class="far fa-eye"></i>
                        {{ $firstTopNews[5]->click_count }}
                    </div>
                </div>
            </div>
        </div>
        <div class="singleTopFirstNewsRight">
            <div class="singleNewsHead">
                <div title="{{ $firstTopNews[6]->name }}">
                    <a href="/info-p/{{ $firstTopNews[6]->parent_id . '/' . $firstTopNews[6]->id }}"
                        class="click">
                        <img src="{{ asset('storage/category_details/images/' . $firstTopNews[6]->categoryDetails->image) }}"
                            alt="{{ $firstTopNews[6]->name }}" />
                    </a>
                </div>
                <div>
                    <h6 class="newsCat">{{ $firstTopNews[6]->parent_category->name }}</h6>
                    <a href="/info-p/{{ $firstTopNews[6]->parent_id . '/' . $firstTopNews[6]->id }}"
                        class="newsDesc click">
                        {{ limit($firstTopNews[6]->categoryDetails->preview_text, 60) }}
                    </a>
                    <p class="newsCreatedDate m-0">
                        <i class="far fa-clock"></i>
                        {{ \Carbon\Carbon::parse($firstTopNews[6]->created_at)->isoFormat('MM-DD-YYYY, h:mm A') }}
                    </p>
                </div>
            </div>

            <div class="singleNewsFoot">
                <div>
                    <div class="users_watch_count">
                        <i class="far fa-eye"></i>
                        {{ $firstTopNews[6]->click_count }}
                    </div>
                </div>
            </div>
        </div>
        <div class="singleTopFirstNewsRight">
            <div class="singleNewsHead">
                <div title="{{ $firstTopNews[7]->name }}">
                    <a href="/info-p/{{ $firstTopNews[7]->parent_id . '/' . $firstTopNews[7]->id }}"
                        class="click">
                        <img src="{{ asset('storage/category_details/images/' . $firstTopNews[7]->categoryDetails->image) }}"
                            alt="{{ $firstTopNews[7]->name }}" />
                    </a>
                </div>
                <div>
                    <h6 class="newsCat">{{ $firstTopNews[7]->parent_category->name }}</h6>
                    <a href="/info-p/{{ $firstTopNews[7]->parent_id . '/' . $firstTopNews[7]->id }}"
                        class="newsDesc click">
                        {{ limit($firstTopNews[7]->categoryDetails->preview_text, 60) }}
                    </a>
                    <p class="newsCreatedDate m-0">
                        <i class="far fa-clock"></i>
                        {{ \Carbon\Carbon::parse($firstTopNews[7]->created_at)->isoFormat('MM-DD-YYYY, h:mm A') }}
                    </p>
                </div>
            </div>

            <div class="singleNewsFoot">
                <div>
                    <div class="users_watch_count">
                        <i class="far fa-eye"></i>
                        {{ $firstTopNews[7]->click_count }}
                    </div>
                </div>
            </div>
        </div>
        <div class="singleTopFirstNewsRight">
            <div class="singleNewsHead">
                <div title="{{ $firstTopNews[8]->name }}">
                    <a href="/info-p/{{ $firstTopNews[8]->parent_id . '/' . $firstTopNews[8]->id }}"
                        class="click">
                        <img src="{{ asset('storage/category_details/images/' . $firstTopNews[8]->categoryDetails->image) }}"
                            alt="{{ $firstTopNews[8]->name }}" />
                    </a>
                </div>
                <div>
                    <h6 class="newsCat">{{ $firstTopNews[8]->parent_category->name }}</h6>
                    <a href="/info-p/{{ $firstTopNews[8]->parent_id . '/' . $firstTopNews[8]->id }}"
                        class="newsDesc click">
                        {{ limit($firstTopNews[8]->categoryDetails->preview_text, 60) }}
                    </a>
                    <p class="newsCreatedDate m-0">
                        <i class="far fa-clock"></i>
                        {{ \Carbon\Carbon::parse($firstTopNews[8]->created_at)->isoFormat('MM-DD-YYYY, h:mm A') }}
                    </p>
                </div>
            </div>

            <div class="singleNewsFoot">
                <div>
                    <div class="users_watch_count">
                        <i class="far fa-eye"></i>
                        {{ $firstTopNews[8]->click_count }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
