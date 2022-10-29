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
            <h1>Regisztráció</h1>
            <p>Kérlek töltsd ki az alábbi mezőket!</p>
            <hr>

            <label for="email"><b>Email</b></label>
            <input type="text" name="email" id="email" required>

            <label for="name"><b>Név</b></label>
            <input type="text"  name="name" id="name" required>

            <label for="mobileNumber"><b>Telefonszám</b></label>
            <input type="text"  name="mobileNumber" id="mobileNumber" required>

            <label for="password"><b>Jelszó</b></label>
            <input type="password"  name="password" id="password" required>

            <label for="password_confirmation"><b>Jelszó megerősítés</b></label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   required>
            <hr>

            <button type="submit">Regisztráció</button>
        </div>

        <div>
            <p>Regisztráltál már? Jelentkezz be!<a href="#">Bejelentkezés</a>.</p>
        </div>
    </form>
</div>
</body>
</html>
