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

<div style="margin-left: 50px">
    <form action="/users" method="POST">
        <div class="container">
            <h1>Profil</h1>
            <h3>Név: {{$user->name}}</h3>
            <p>Email: {{$user->email}}</p>
            @if(!is_null($user->mobile_number))
                <p>Telefonszám: {{$user->mobile_number}}</p>
            @endif
            <p>Jogosultságok:</p>
            <ul>
                @foreach($user->roles as $role)
                    <li>{{$role->name}}</li>
                @endforeach
            </ul>
        </div>
    </form>
</div>
</body>
</html>