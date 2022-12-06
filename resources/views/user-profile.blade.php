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

            <div style="margin-left: 50px">
                @include('navbar')
                <form action="/users" method="POST">
                    <div class="container">
                        <h1>Profil</h1>
                        <h3>Név: {{$user->name}}</h3>
                        <p>Email: {{$user->email}}</p>
                        <p>Neptun: {{$user->code}}</p>
                        @if(!is_null($user->contact))
                            <p>Telefonszám: {{$user->contact}}</p>
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
        </section>
    @include('footer')
</body>
</html>