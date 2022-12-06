<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('header')

    <title><?= $app['config']['app.title_hu']; ?></title>
</head>
<body class="antialiased">


    @include('navbar')

    <!-- Header - set the background image for the header in the line below-->
    <header class="py-5 bg-image-full firstPageHeader">
        <div class="text-center my-5">
            <img class="img-fluid mb-4" src="{{ asset('img/tuition2.png') }}" alt="Időpontfoglaló" />
            <h1 class="text-black fs-3 fw-bolder"><?= $app['config']['app.title_hu']; ?></h1>
            <p class="text-black mb-0">Kérjük, jelentkezzen be a folytatáshoz.</p>
            <p class="mt-10">
                    <a href="{{ url('/login') }}"><button class="myButton">
                            Bejelentkezés
                        </button></a>
                        &nbsp; 
                    <a href="{{ url('/users/create') }}"><button class="myButton">
                            Regisztráció
                        </button></a>
                    </p>
                </p>
        </div>
    </header>

    <!-- Content section-->
    <section class="py-5">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h2>Konzultációs időpontok egy helyen</h2>
                    <p class="lead">Egyszerű, egységesített kezelőfelület a hallgatók és előadók közötti kapcsolattartáshoz.</p>
                    <p class="mb-0">&nbsp;</p>
                </div>
            </div>
        </div>
    </section>

    @include('footer')
</body>
</html>
