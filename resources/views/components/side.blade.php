@vite('resources/css/components/side.css')

<aside class="side">
    <ul class="items">
        <li class="items-li">
            <a href="/" class="filter-option {{empty(request('feed')) ? 'filter-option-active' : ''}}">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-newspaper-icon lucide-newspaper">
                        <path d="M15 18h-5" />
                        <path d="M18 14h-8" />
                        <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-4 0v-9a2 2 0 0 1 2-2h2" />
                        <rect width="8" height="4" x="10" y="6" rx="1" />
                    </svg>
                    <p>All Items</p>
                </div>
                <p>43</p>
            </a>
        </li>
        <li class="filter-option">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark-icon lucide-bookmark">
                    <path d="M17 3a2 2 0 0 1 2 2v15a1 1 0 0 1-1.496.868l-4.512-2.578a2 2 0 0 0-1.984 0l-4.512 2.578A1 1 0 0 1 5 20V5a2 2 0 0 1 2-2z" />
                </svg>
                <p>Saved</p>
            </div>
            <p>0</p>
        </li>
    </ul>

    <div class="separator"></div>

    <p class="categories">categories</p>

    <ul class="categories-list">
        @if ($categories !== null)
        @foreach($categories as $category)
        <li class="category-container">
            <div class="category filter-option">{{Str::limit($category->name, 20)}} <span>10</span></div>

            @if (count($feeds->where('category_id', $category->id)))
            <ul class="category-feeds">
                @foreach ($feeds->where('category_id', $category->id) as $feed)
                <li class="feed-li">
                    <a href="#" data-id="{{$feed->id}}" class="feed category-feed filter-option {{in_array($feed->id, request('feed', [])) ? 'filter-option-active' : ''}}">
                        <div>
                            <img src="{{$feed->favicon}}" alt="favicon">
                            <p>{{ Str::limit($feed->title, 20) }}</p>
                        </div>
                        <p class="count">{{$feed->items}}</p>
                    </a>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
        @endif

        @if (count($feeds->where('category_id', null)) >= 1)
        @foreach ($feeds->where('category_id', null) as $feed)
        <li class="uncategorized-li">
            <a href="#" data-id="{{$feed->id}}" class="feed uncategorized filter-option {{in_array($feed->id, request('feed', [])) ? 'filter-option-active' : ''}}">
                <div>
                    <img src="{{$feed->favicon}}" alt="favicon">
                    <p>{{ Str::limit($feed->title, 20) }}</p>
                </div>
                <p class="count">{{count($feed->items)}}</p>
            </a>
        </li>
        @endforeach
        @endif
    </ul>

    <div class="separator"></div>

</aside>