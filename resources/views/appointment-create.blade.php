<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('header')

    <title><?= $app['config']['app.title_hu']; ?></title>
</head>
<body class="antialiased">

@include('navbar')

<div style="margin-left: 50px">
    <form action="/appointments" method="POST">
        @csrf
        <div class="container">
            <h1>Időpont kiírás</h1>
            <p>Kérlek töltsd ki az alábbi mezőket!</p>
            <hr>

            <label for="date"><b>Időpont</b></label>
            <input type="datetime-local" name="date" id="date" min="{{now()->toDateString()}}" required>

            <label for="length"><b>Időtartam</b></label>
            <input type="number" name="length" id="length" min="5" placeholder="min: 5 perc" required>

            <label for="types[]"><b>Típus</b>
                <select name="types[]">
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
            </label>
            <hr>

            <button type="submit">Létrehozás</button>
        </div>
    </form>
</div>
</body>
</html>
