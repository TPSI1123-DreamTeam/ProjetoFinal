<header>
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset ('images/Logotipo.png') }}" alt="Logotipo">
        </div>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}" class="active">Página Inicial</a></li>
            <li><a href="{{ url('/event') }}">Eventos</a></li>
            <li><a href="{{ url('/about') }}">Sobre Nós</a></li>
            <li><a href="{{ url('/contact') }}">Contacto</a></li>
        </ul>
        <div class="login">
        <a href="/login">Login</a>
        <span>Ainda não tens conta? <br>
        <a href="/register">Registo</a></span>
    </div>
    </nav>
</header>