<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('header')

    <title><?= $app['config']['app.title_hu']; ?></title>
</head>
<body class="antialiased">


@include('navbar')

<a href="appointments/create">Időpont kiírás</a>

<div style="margin-left: 50px">
    @foreach($appointments as $appointment)
        <h3>Időpont: {{$appointment->date}}</h3>
        @if(auth()->user()->isTeacher())
            <form action="/appointments/{{$appointment->id}}/delete" method="POST">
                @csrf
                <button type="submit">Törlés</button>
            </form>
        @endif
        @if(auth()->user()->isStudent())
            <form action="/appointments/{{$appointment->id}}/resign" method="POST">
                @csrf
                <button type="submit">Lemondás</button>
            </form>
        @endif
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
