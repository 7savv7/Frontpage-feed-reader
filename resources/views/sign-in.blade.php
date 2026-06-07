<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            min-height: fit-content;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 400px;
            gap: 20px;
        }

        input {
            padding: 10px;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <form action="/sign-in" method="post">
        @csrf
        <h1>Create account</h1>
        <input type="email" name="email" placeholder="Email">
        @if ($errors->any())
        @foreach($errors->all() as $error)
        <p>{{$error}}</p>
        @endforeach
        @endif
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Submit</button>
    </form>
</body>

</html>