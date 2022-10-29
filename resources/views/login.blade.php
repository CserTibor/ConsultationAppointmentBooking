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
    <div style="margin-left: 50px">
        <form action="/login" method="POST">
            <div class="container">
                <h1>Időpontfoglaló Alkalmazás</h1>
                <p>Kérlek jelentkezz be!</p>
                <hr>

                <label for="email"><b>Email</b></label>
                <input type="text" name="email" id="email" required>

                <label for="password"><b>Jelszó</b></label>
                <input type="password" name="password" id="password" required>

                <button type="submit">Bejelentkezés</button>

            </div>
        </form>
    <p>Még nem regisztráltál?</p>
    <button type="button" onclick="window.location='{{ url('/users/create') }}'">Regisztráció</button>
    </div>
</div>
</body>
</html>
