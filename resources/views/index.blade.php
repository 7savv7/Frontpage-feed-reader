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

        section {
            overflow-y: auto;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-self: flex-end;
        }

        .new-items {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: fit-content;
            background-color: var(--color-accent-subtle);
            padding: 8px;
            border-bottom: 1px solid var(--color-border);
            margin-top: 5px;
        }

        .new-items-message {
            color: var(--color-accent-hover);
            display: flex;
            align-items: center;
            font-weight: 600;
            cursor: pointer;
            background: transparent;
            border: none;
            font-family: var(--font-sans);
            font-weight: 500;
            font-size: 16px;
        }

        .articles {
            width: 100%;
            height: 100%;
        }

        .first {
            display: flex;
            flex-direction: column;
            align-self: flex-end;
        }

        .second {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: 200px;
            gap: 10px;
            padding: 10px;
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
            position: relative;
        }

        .second .article {
            border: 1px solid var(--color-border);
            border-radius: 10px;
            overflow: hidden;
        }

        .third .article {
            flex-direction: row;
            gap: 10px;
        }

        .article .seen {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--color-unread-indicator);
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .article .feed-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .third .feed-info p {
            display: none;
        }

        .article .feed-info>img {
            border-radius: 5px;
            width: 20px;
            height: 20px;
        }

        .article .content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .third .content p,
        .third .content div {
            display: none;
        }

        .article .content a {
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

            <section>
                @if ($new > 0)
                <form class="new-items" action="/refresh" method="post">
                    @csrf
                    <button class="new-items-message">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-up-icon lucide-move-up">
                            <path d="M8 6L12 2L16 6" />
                            <path d="M12 2V22" />
                        </svg>

                        <p>{{$new}} new items since your last visit</p>
                    </button>
                </form>
                @endif

                <div class="articles first">
                    @if ($totalItems === 0)
                    <div class="no-articles">
                        <p>No articles yet.</p>
                    </div>
                    @else
                    @foreach($feeds as $feed)
                    @foreach($feed->items as $item)
                    <div class="article">
                        @if (!$item->seen)
                        <div class="seen"></div>
                        @endif

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
            </section>

        </div>
    </main>
</body>

</html>