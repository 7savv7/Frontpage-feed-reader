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

        .feeds {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 0;
        }

        .articles {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
            align-self: flex-end;
            overflow-y: auto;
        }

        .new-items {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: fit-content;
            background-color: var(--color-accent-subtle);
            color: var(--color-accent-hover);
            padding: 8px;
            border-bottom: 1px solid var(--color-border);
            margin-top: 5px;
        }

        .new-items-message {
            display: flex;
            align-items: center;
            font-weight: 600;
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
            <x-article-header :total='$total' />

            <div class="articles">
                @if ($new > 0)
                <div class="new-items">
                    <div class="new-items-message">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-up-icon lucide-move-up">
                            <path d="M8 6L12 2L16 6" />
                            <path d="M12 2V22" />
                        </svg>

                        <p>{{$new}} new items since your last visit</p>
                    </div>
                </div>
                @endif

                @if ($totalItems === 0)
                <div class="no-articles">
                    <p>No articles yet.</p>
                </div>
                @else
                @foreach($feeds as $feed)
                @foreach($feed->items as $item)
                <div class="article">
                    <div class="feed-info">
                        <img src="{{$feed->favicon}}" alt="favicon">

                        <p>{{$feed->title}}</p>
                    </div>

                    <div class="content">
                        <h3><a href="{{$item->url}}" target="_blank">{{$item->title}}</a></h3>

                        <p>{{Str::limit($item->description, 500)}}</p>

                        @if ($feed->category)
                        <div>
                            <p>{{ $feed->category->name }}</p>
                        </div>
                        @endif

                    </div>
                </div>
                @endforeach
                @endforeach
                @endif
            </div>
        </div>
    </main>
</body>

</html>