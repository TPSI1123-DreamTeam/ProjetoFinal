<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

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
            <a href="{{ route('profile.edit') }}" class="profile-edit">Editar Perfil</a>
        </div>

        <div class="chat-bell-icons">
            <i class='bx bx-chat' ></i>
            <i class='bx bx-bell'></i>
        </div>
    </nav>
    
    <div class="login">
    @if( isset(Auth::user()->name) )    
        <div class="user-name">
            <button id="user-toggle" class="user-button">
                <i class='bx bx-user'></i>  
                {{ Auth::user()->name }}
                <span class="dropdown-arrow">&#9660;</span>
            </button>
            <div class="dropdown-menu">
                <a href="{{ route('profile.edit') }}" class="dropdown-item">Editar Perfil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
                <form method="GET" action="{{ url('/') }}">
                    <button type="submit" class="dropdown-item">Voltar</button>
                </form>
            </div>
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
@vite('resources/js/change-sidebar.js')
@vite('resources/js/dropdown-header.js')