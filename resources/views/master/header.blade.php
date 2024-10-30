<header>
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset ('images/Logotipo.png') }}" alt="Logotipo">
        </div>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}" class="active">Página Inicial</a></li>
            <li><a href="{{ url('/event') }}">Eventos</a></li>
            <li><a href="{{ url('/') }}">Sobre Nós</a></li>
            <li><a href="{{ url('/') }}">Contacto</a></li>
        </ul>
        <div class="login">
            <p>Ainda não tens conta? <a href="/register">Registo / </a><a href="/login">Login</a></p>
        </div>
    </nav>
</header>