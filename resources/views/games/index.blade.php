<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todos mis jueguitos</title>
</head>
<body>
    <main>
        <h1>Todos mis jueguitos :3 uwu</h1>
        @foreach ($games as $game)
        <article>
            <h2>{{ $game->title }}</h2>
            <img src="{{ $game->cover }}" alt="">
        </article>
        @endforeach
    </main>
</body>
</html>