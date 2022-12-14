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
            <h1>Felhasználók listája</h1>

            
            
            <div class="container">

                @php

                    if(count($users)==0) {
                        echo "Nincsenek megjeleníthető felhasználók.";
                    }

                @endphp

                <table class="table table-striped" id="userList">
                  <thead>
                    <tr>
                      <th scope="col">Név</th>
                      <th scope="col">Email-cím</th>
                      <th scope="col">Azonosító</th>
                      <th scope="col">Elérhetőség</th>
                      <th scope="col">Jogosultságok</th>

                      @if($isAdmin)
                         <th scope="col">&nbsp;</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
            
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            <td>
                                {{$user->code}}
                            </td>
                            <td>
                                @if(!is_null($user->contact))
                                    {{$user->contact}}
                                @endif
                            </td>
                            <td>
                                <ul>
                                    @foreach($user->roles as $role)
                                        <li>{{$role->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                            @if($isAdmin)
                                <a href="users/{{$user->id}}">Szerkesztés</a>&nbsp; 
                            @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
</section>

    @include('footer')

    <script>
        $(document).ready(function () {
          $('#userList').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/1.13.1/i18n/hu.json"}});
          $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>
</html>