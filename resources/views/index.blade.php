@php
$total = 0;
foreach ($feeds as $feed) {
$total += $feed->items->count();
}
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontpage</title>
    @vite('resources/css/global.css')
    <script defer src="{{asset('js/components/header.js')}}"></script>
    <script defer src="{{asset('js/components/side.js')}}"></script>
    <script defer src="{{asset('js/index.js')}}"></script>

    <style>
        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            display: flex;
            width: 100%;
            height: calc(100% - 60px);
            font-family: var(--font-sans);
        }

        .info {
            font-size: 22px;
            font-weight: bold;
        }

        .info span {
            font-size: 14px;
            font-weight: 500;
            color: grey;
            margin-left: 5px;
        }

        .feeds {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 0;
        }

        .feeds-header {
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            border-bottom: 1px solid var(--color-border);
        }

        .options {
            display: flex;
        }

        .layout {
            display: flex;
        }

        .layout {
            border-radius: 8px;
            border: 1px solid var(--color-border);
            overflow: hidden;
        }

        .layout>div {
            padding: 8px;
            cursor: pointer;
        }

        .layout>div:nth-child(2) {
            border-left: 1px solid var(--color-border);
            border-right: 1px solid var(--color-border);
        }

        .layout-selected {
            background-color: var(--color-bg-tertiary);
        }

        .filter,
        .refresh,
        .read {
            display: flex;
            gap: 5px;
            align-items: center;
            padding: 4px 8px;
            border-radius: 10px;
            border: 1px solid var(--color-border);
            margin-left: 8px;
            cursor: pointer;
        }

        .articles {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
            align-self: flex-end;
            overflow-y: auto;
        }

        .no-articles {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .article {
            padding: 10px 40px;
            display: flex;
            flex-direction: column;
            border-bottom: 1px solid var(--color-border);
            width: 100%;
            align-items: flex-start;
            word-break: break-all;
        }

        .feed-info>img {
            border-radius: 5px;
            margin-right: 10px;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .content a {
            all: unset;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <x-header />
    <main>
        <x-side :total='$total' />

        <div class="feeds">
            <div class="feeds-header">
                <p class="info">All Items <span>{{$total}} unread</span></p>

                <div class="options">
                    <div class="layout">
                        <div class="layout-option layout-selected">

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu-icon lucide-menu">
                                <path d="M4 5h16" />
                                <path d="M4 12h16" />
                                <path d="M4 19h16" />
                            </svg>
                        </div>

                        <div class="layout-option">

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-grid-icon lucide-layout-grid">
                                <rect width="7" height="7" x="3" y="3" rx="1" />
                                <rect width="7" height="7" x="14" y="3" rx="1" />
                                <rect width="7" height="7" x="14" y="14" rx="1" />
                                <rect width="7" height="7" x="3" y="14" rx="1" />
                            </svg>
                        </div>

                        <div class="layout-option">

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-table-of-contents-icon lucide-table-of-contents">
                                <path d="M16 5H3" />
                                <path d="M16 12H3" />
                                <path d="M16 19H3" />
                                <path d="M21 5h.01" />
                                <path d="M21 12h.01" />
                                <path d="M21 19h.01" />
                            </svg>
                        </div>
                    </div>

                    <div class="filter">
                        <p>Newest</p>
                    </div>

                    <div class="refresh">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-refresh-ccw-icon lucide-refresh-ccw">
                            <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                            <path d="M3 3v5h5" />
                            <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                            <path d="M16 16h5v5" />
                        </svg>

                        <p>Refresh</p>
                    </div>

                    <div class="read">
                        <p>Mark all read</p>
                    </div>
                </div>
            </div>


            <div class="articles">
                @forelse($feeds as $feed)
                @foreach($feed->items as $item)
                <div class="article">
                    <div class="feed-info">
                        <img src="{{$feed->favicon}}" alt="favicon">

                        <p>{{$feed->title}}</p>
                    </div>

                    <div class="content">
                        <h3><a href="{{$item->get_link()}}" target="_blank">{{$item->get_title()}}</a></h3>

                        <p>{{Str::limit($item->get_description(), 500)}}</p>

                        @php
                        $category = $categories->firstWhere('id', $feed->category_id);
                        @endphp

                        @if ($category)
                        <div>
                            <p>{{ $category->name }}</p>
                        </div>
                        @endif

                    </div>
                </div>
                @endforeach
                @empty
                <div class="no-articles">
                    <p>No articles yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </main>
</body>

</html>