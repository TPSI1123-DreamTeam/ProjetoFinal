<header class="header">
    <div class="logo">
        <img src="{{ asset('images/Logotipo.png') }}" alt="Logotipo">
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

        <div class="">    
        <a href="/dashboard">{{ Auth::user()->name }}</a></span>
            <!-- Authentication -->
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
        <div class="login">
            <a href="/login">Login</a>
            <span>Ainda não tens conta? <br>
            <a href="/register">Registo</a></span>
        </div>
        @endif
    </div>
</header>
