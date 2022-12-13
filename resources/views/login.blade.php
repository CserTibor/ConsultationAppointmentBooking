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

                    <img class="img-fluid mb-4" src="{{ asset('img/tuition2.png') }}" alt="Időpontfoglaló" />

                </div>
                <div class="col-lg-6">
                    <form action="/login" method="POST" class="userLogin">
                        <div class="container">
                            <h1 class="mb-2"><?= $app['config']['app.title_hu']; ?></h1>
                            <h2 class="mb-2">Bejelentkezés</h2>

                            <p>Bejelentkezési adatok:</p>                                    

                            <p>
                                <label for="email"><b>Email:</b></label>
                                <input type="text" name="email" id="email" required>
                            </p>


                            <p>
                                <label for="password"><b>Jelszó:</b></label>
                                <input type="password" name="password" id="password" required>
                            </p>

                            <p>
                                <button type="submit">Bejelentkezés</button>
                            </p>

                        </div>
                    </form>
                <p>
                    Még nem regisztráltál?  
                    <button type="button" onclick="window.location='{{ url('/users/create') }}'">Regisztráció</button>
                </p>
                </div>
            </div>
        </div>
    </section>



    @include('footer')
</body>
</html>