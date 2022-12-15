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
            <h1>Időpontok listája</h1>              
            
            <div class="container">

                <a href="appointments/create">Időpont kiírása</a>

                <p>&nbsp;</p>

                <table class="table table-striped" id="appointmentList">
                  <thead>
                    <tr>
                      <th scope="col">Oktató(k)</th>
                      <th scope="col">Időpont</th>
                      <th scope="col">Időtartam</th>
                      <th scope="col">Típus</th>
                      <th scope="col">Hallgató(k)</th>
                      <th scope="col">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>        

                    @foreach($appointments as $appointment)
                        <tr>
                            <td>
                                <ul>
                                    @foreach($appointment->publishers as $publisher)
                                        <li>{{$publisher->name}}</li>
                                    @endforeach
                                </ul>
                            </td>

                            <td>
                                {{$appointment->date}}
                            </td>
                            <td>
                                {{$appointment->length}} perc
                            </td>
                            <td>
                                <ul>
                                    @foreach($appointment->types as $type)
                                        <li>{{$type->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @foreach($appointment->holders as $holder)
                                        <li>{{$holder->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                @if(auth()->user()->isTeacher())
                                    <form action="/appointments/{{$appointment->id}}/delete" method="POST">
                                        @csrf
                                        <button type="submit">Törlés</button>
                                    </form>
                                @endif
                                @if(auth()->user()->isStudent())
                                    <form action="/appointments/{{$appointment->id}}/resign" method="POST">
                                        @csrf
                                        <button type="submit">Lemondás</button>
                                    </form>
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
          $('#appointmentList').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/1.13.1/i18n/hu.json"}});
          $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>
</html>