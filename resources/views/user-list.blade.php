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
    @foreach($users as $user)
        <h3>Név: {{$user->name}}</h3>
        <p>Email: {{$user->email}}</p>
        <p>Neptun: {{$user->code}}</p>
        @if(!is_null($user->contact))
            <p>Elérhetőség: {{$user->contact}}</p>
        @endif
        <p>Jogosultságok:</p>
        <ul>
            @foreach($user->roles as $role)
                <li>{{$role->name}}</li>
            @endforeach
        </ul>
    @endforeach
</div>
</body>
</html>
