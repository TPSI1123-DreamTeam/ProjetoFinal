<header>
    <nav class="navbar">
        <div class="logo">
            <a href="/"><img src="{{ asset('images/Logotipo.png') }}" alt="Logotipo"></a>
        </div>

        <input type="checkbox" id="menu-toggle" class="menu-toggle">

        <label for="menu-toggle" class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <nav class="nav">
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Página Inicial</a>
            <div class="dropdown-container">
                <a href="/event/public" class="dropdown-toggle {{ request()->is('event') ? 'active' : '' }}" id="event-toggle">Eventos</a>
                <div class="dropdown-menu" id="dropdown-menu">
                    <a href="/event/public" class="{{ request()->is('event/public') ? 'active' : '' }}">Eventos Públicos</a>
                    <a href="/event/private" class="{{ request()->is('event/private') ? 'active' : '' }}">Faz o teu próprio evento!</a>
                </div>
            </div>
            <a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">Sobre Nós</a>
            <a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Contacto</a>
        </nav>

        <div class="login">
            @if( isset(Auth::user()->name) )    
            <div class="dropdown">
                <button class="dropdown-btn">
                    {{ Auth::user()->name }} <span class="arrow-down">▼</span>
                </button>
                <div class="dropdown-content">
                    <a href="/dashboard">Dashboard</a>
                    <a href="/profile">Editar Perfil</a>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </div>
            @else
            <div class="not-login">
                <a class="not-logged" href="/login">Login</a>
                <span>Ainda não tens conta? <br>
                <a class="not-regis" href="/register">Registo</a></span>
            </div>
            @endif
        </div>
    </nav>
</header>
