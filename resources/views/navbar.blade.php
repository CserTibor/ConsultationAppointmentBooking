<div>
    <!-- Right Side Of Navbar -->
    <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (auth()->guest())
            <li><a href="{{ url('/login') }}">Bejelentkezés</a></li>
            <li><a href="{{ url('/users/create') }}">Regisztráció</a></li>
        @else
            <li><a href="{{ url('/users') }}">Felhasználók</a></li>
            <li><a href="{{ url('/appointments') }}">Időpontok</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ auth()->user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                </ul>
            </li>
        @endif
    </ul>
</div>
