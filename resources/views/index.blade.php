<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/tokens.css')}}">
    <link rel="stylesheet" href="{{asset('css/components/header.css')}}">
    <script defer src="{{asset('js/components/header.js')}}"></script>
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
            height: calc(100% - 60px);
        }

        .side {
            width: 25%;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .items {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .items li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .separator {
            border-bottom: 1px solid black;
            width: 100%;
            margin: 20px 0;
        }

        .feeds {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .feeds-header {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid red;
            width: 100%;
        }

        .layout {
            border-radius: 8px;
            border: 1px solid grey;
            overflow: hidden;
        }

        .layout>div {
            padding: 8px;
            cursor: pointer;
        }

        .layout>div:nth-child(2) {
            border-left: 1px solid grey;
            border-right: 1px solid grey;
        }

        .layout-selected {
            background-color: grey;
        }

        .filter,
        .refresh,
        .read {
            padding: 4px 8px;
            border-radius: 10px;
            border: 1px solid grey;
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

        .article {
            padding: 10px;
            display: flex;
            flex-direction: column;
            border: 1px solid black;
            width: 100%;
            align-items: flex-start;
        }

        .feed-info>img {
            border-radius: 50%;
            margin-right: 10px;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
    </style>
</head>

<?php
$len = 0;
for ($i = 0; $i < count($feeds); $i++) {
    $len += count($feeds[$i]->items);
};
?>

<body>
    <x-header />
    <main>


        <div class="side">
            <ul class="items">
                <li>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-newspaper-icon lucide-newspaper">
                            <path d="M15 18h-5" />
                            <path d="M18 14h-8" />
                            <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-4 0v-9a2 2 0 0 1 2-2h2" />
                            <rect width="8" height="4" x="10" y="6" rx="1" />
                        </svg>
                        <p>All items</p>
                    </div>
                    <p>{{$len}}</p>
                </li>
                <li>
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

            <p>categories</p>
        </div>

        <div class="feeds">
            <div class="feeds-header">
                <div class="info">
                    <p>All items</p>
                    <p>{{$len}} unread</p>
                </div>

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
                        <h3>{{$item->get_title()}}</h3>

                        <p>{{Str::limit($item->get_description(), 100)}}</p>
                    </div>
                </div>
                @endforeach
                @empty
                <p>No articles yet.</p>
                @endforelse
            </div>
        </div>
    </main>
</body>

</html>