<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/tokens.css')}}">
    <link rel="stylesheet" href="{{asset('css/components/header.css')}}">
    <script defer src="{{asset('js/components/header.js')}}"></script>
</head>

<body>
    <x-header />

    <div>
        @forelse($feeds as $feed)
        @foreach($feed->items as $item)
        <p>{{$item->get_title()}}</p>
        @endforeach
        @empty
        <p>No feeds</p>
        @endforelse
    </div>
</body>

</html>