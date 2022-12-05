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

            <div>
                @foreach($users as $user)
                    <h3>Név: {{$user->name}}</h3>
                     @if(auth()->user()->isAdmin())
                        <a href="users/{{$user->id}}">
                            Szerkesztés
                        </a>
                    @endif
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
        </div>
</section>

    @include('footer')

</body>
</html>