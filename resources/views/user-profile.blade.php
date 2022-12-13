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
                <div class="container">

                    <h1>Profil</h1>

                    <div class="row">
                        <div class="col-3">
                          <img src="{{ asset('img/profile.png') }}" style="height:250px" alt="User Profile" />
                        </div>
                        <div class="col-9">
                            <h3>{{$user->name}}</h3>

                            <p> &nbsp; </p>

                            <div class="row">
                                <div class="col-3">
                                  Email:
                                </div>
                                <div class="col-9"> {{$user->email}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                  Neptun-kód:
                                </div>
                                <div class="col-9"> {{$user->code}}
                                </div>
                            </div>

                            @if(!is_null($user->contact))
                            <div class="row">
                                <div class="col-3">
                                  Elérhetőség:
                                </div>
                                <div class="col-9"> {{$user->contact}}
                                </div>
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-3">
                                  Jogosultságok:
                                </div>
                                <div class="col-9"> 


                                    @php

                                        function getRoleIcon($role) {

                                            $retval = "";

                                            switch($role) {
                                                case 'Role1':
                                                    $retval =  ' Tanár ';
                                                    break;
                                                case 'Role2':
                                                    return ' Diák ';
                                                    break;
                                                default:
                                                    return $role;
                                                    break;
                                            }

                                        }

                                        foreach ($user->roles as $role) {
                                            echo getRoleIcon($role->name);
                                        }

                                    @endphp
                                </div>
                            </div>

                        </div>
                        
                      </div>
                </div>
            
            </div>
        </section>
    @include('footer')
</body>
</html>