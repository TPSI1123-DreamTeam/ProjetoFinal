<header class="header">
    <div class="logo">
        <img src="{{ asset('images/Logotipo.png') }}" alt="Logotipo">
    </div>
    <nav class="nav">
        <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Página Inicial</a>
        <div class="dropdown-container">
            <a href="/event" class="dropdown-toggle {{ request()->is('event') ? 'active' : '' }}" id="event-toggle">Eventos</a>
            <div class="dropdown-menu" id="dropdown-menu">
                <a href="/event" class="{{ request()->is('event/public') ? 'active' : '' }}">Eventos Públicos</a>
                <a href="/event" class="{{ request()->is('event/custom') ? 'active' : '' }}">Faz o teu próprio evento!</a>
            </div>
        </div>
        <a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">Sobre Nós</a>
        <a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Contacto</a>
    </nav>
    <div class="login">
        <a href="/login">Login</a>
        <span>Ainda não tens conta? <br>
        <a href="/register">Registo</a></span>
    </div>
</header>
