<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('header')

    <title><?= $app['config']['app.title_hu']; ?></title>
</head>
<body class="antialiased">


 @include('navbar')

 <section class="py-5">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form action="/users" method="POST" class="userLogin">
                        <div class="container">
                            <h1><?= $app['config']['app.title_hu']; ?></h1>
                            <h2 class="mb-2">Regisztráció</h2>

                            <p>
                                <label for="email"><b>Email</b></label>
                                <input type="text" name="email" id="email" required>
                            </p>

                            <p>
                                <label for="name"><b>Név</b></label>
                                <input type="text"  name="name" id="name" required>
                            </p>

                            <p>
                                <label for="contact"><b>Elérhetőség</b></label>
                                <input type="text"  name="contact" id="contact" required>
                            </p>

                            <p>
                                <label for="code"><b>Neptun</b></label>
                                <input type="text" name="code" id="code" required>
                            </p>

                            <p>
                                <label for="password"><b>Jelszó</b></label>
                                <input type="password"  name="password" id="password" required>
                            </p>

                            <p>
                                <label for="password_confirmation"><b>Jelszó megerősítés</b></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required>
                            </p>

                            <p>
                                <button type="submit">Regisztráció</button>
                            </p>
                        </div>

                        <div>
                            <p>Regisztráltál már? Itt tudsz bejelentkezni: <a href="/login">Bejelentkezés</a>.</p>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</section>

    @include('footer')

</body>
</html>