<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/tokens.css')}}">
    <link rel="stylesheet" href="{{asset('css/components/header.css')}}">
</head>

<body>
    <x-header />
    <form action="/sign-out" method="POST">
        @csrf
        <button type="submit">Sign Out</button>
    </form>

</body>

</html>