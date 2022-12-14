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
            <h1>Időpont kiírása</h1>

            <form action="/appointments" method="POST">
                @csrf
                <div class="container">

                    <div class="row form-group">
                        <div class="col-3">
                          <label for="date"><b>Időpont</b></label>
                        </div>
                        <div class="col-9">
                            <input type="datetime-local" name="date" id="date" min="{{now()->toDateString()}}" required="true" />
                        </div>
                        <br>&nbsp;
                    </div>

                    <div class="row form-group">
                        <div class="col-3">
                          <label for="length"><b>Időtartam</b></label>
                        </div>
                        <div class="col-9">
                            <input type="number" name="length" id="length" min="5" placeholder="min: 5 perc" required="true" />
                        </div>
                        <br>&nbsp;
                    </div>

                    <div class="row form-group">
                        <div class="col-3">
                          <label for="length"><b>Típus</b></label>
                        </div>
                        <div class="col-9">
                            <select name="types[]">
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>&nbsp;
                    </div>

                    <p>
                        &nbsp;
                    </p>

                    <button type="submit">Létrehozás</button>
                </div>
            </form>
        </div>
    </section>

</body>
</html>
