<header>
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('images/Logotipo.png') }}" alt="Logotipo">
        </div>

        <input type="checkbox" id="menu-toggle" class="menu-toggle">

        <label for="menu-toggle" class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <ul class="nav-links">
            <li><a href="{{ url('/') }}" class="active">Página Inicial</a></li>
            <li><a href="{{ url('/event') }}">Eventos</a></li>
            <li><a href="{{ url('/about') }}">Sobre Nós</a></li>
            <li><a href="{{ url('/contact') }}">Contacto</a></li>
        </ul>

        <div class="login">
            @if( isset(Auth::user()->name) )
                <div>
                    <a href="/dashboard">{{ Auth::user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                     this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            @else
                <div class="login-links">
                    <a href="/login">Login</a>
                    <span>Ainda não tens conta?</span>
                    <a href="/register">Registo</a>
                </div>
            @endif
        </div>
    </nav>
</header>
