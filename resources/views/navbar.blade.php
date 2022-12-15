<!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!"><?= $app['config']['app.title_hu']; ?></a>
            <div align="right">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <!-- Authentication Links -->
                        @if (auth()->guest())
                            <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Bejelentkezés</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/users/create') }}">Regisztráció</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ url('/users') }}">Felhasználók</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/appointments') }}">Időpontok</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/users/appointments') }}">Időpontjaim</a></li>

                            <li class="nav-item dropdown">
                                
                                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                  </a>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item text-dark" href="{{ url('/users/me') }}">Profil</a></li>
                                    <li><a class="dropdown-item text-dark" href="{{ url('/logout') }}">Kijelentkezés</a></li>
                                  </ul>
                                
                            </li>

                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
