@props(["length", "feeds", "categories"])

<div class="side">
    <ul class="items">
        <li class="filter-option filter-option-active">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-newspaper-icon lucide-newspaper">
                    <path d="M15 18h-5" />
                    <path d="M18 14h-8" />
                    <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-4 0v-9a2 2 0 0 1 2-2h2" />
                    <rect width="8" height="4" x="10" y="6" rx="1" />
                </svg>
                <p>All items</p>
            </div>
            <p>{{$length}}</p>
        </li>
        <li class="filter-option">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark-icon lucide-bookmark">
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
        <li class="category">{{$category->name}}</li>
        <ul>
            @foreach ($feeds->where('category_id', $category->id) as $feed)
            <li class="category-feed">
                <div>

                    <img src="{{$feed->favicon}}" alt="favicon">
                    <p>{{ $feed->title }}</p>
                </div>
                <p class="count">{{count($feed->items)}}</p>
            </li>
            @endforeach
        </ul>
        @endforeach
        @endif

        @foreach ($feeds->where('category_id', null) as $feed)
        <li class="uncategorized">
            <div>
                <img src="{{$feed->favicon}}" alt="favicon">
                <p>{{ $feed->title }}</p>
            </div>
            <p class="count">{{count($feed->items)}}</p>
        </li>
        @endforeach
    </ul>

    <div class="separator"></div>

</div>