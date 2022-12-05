<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">

@include('navbar')
<a href="appointments/create">Időpont kiírás</a>

<div style="margin-left: 50px">
    @foreach($appointments as $appointment)
        <h3>Időpont: {{$appointment->date}}</h3>
        <form action="/appointments/{{$appointment->id}}/seize" method="POST">
            @csrf
            <button type="submit">Lefoglalom</button>
        </form>
        <p>Időtartam: {{$appointment->length}} perc</p>
        <p>Típus: </p>
        <ul>
            @foreach($appointment->types as $type)
                <li>{{$type->name}}</li>
            @endforeach
        </ul>
        <p>Oktató: </p>
        <ul>
            @foreach($appointment->publishers as $publisher)
                <li>{{$publisher->name}}</li>
            @endforeach
        </ul>
        <p>Hallgatók: </p>
        <ul>
            @foreach($appointment->holders as $holder)
                <li>{{$holder->name}}</li>
            @endforeach
        </ul>
    @endforeach
</div>
</body>
</html>
