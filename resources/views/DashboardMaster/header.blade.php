<header class="header">
    <div class="logo">
        <img src="{{ asset('images/Logotipo.png') }}" alt="Logotipo">
    </div>

        
    <nav class="nav">
        <div class="hamburguer-button">
            <input type="checkbox" id="menu-toggle" class="menu-toggle">
            <label for="menu-toggle" class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>
        <a href="{{ route('profile.edit') }}">Editar Perfil</a>
        <i class='bx bx-chat' ></i>
        <i class='bx bx-bell'></i>
    </nav>
    
    <div class="login">
        @if( isset(Auth::user()->name) )    

        <div class="user-name">
            <i class='bx bx-user'></i>  
            <a href="/dashboard">{{ Auth::user()->name }}</a></span>
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
