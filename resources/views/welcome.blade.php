<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/sign-out" method="POST">
        @csrf
        <button type="submit">Sign Out</button>
    </form>

</body>

</html>