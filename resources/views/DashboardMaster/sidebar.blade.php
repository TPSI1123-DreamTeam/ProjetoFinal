<div class="sidebar">
    <div class="user-profile">
        <div class="user-avatar"></div>
        <div class="user-info">
            <a href="#">{{ Auth::user()->name }}</a><br>
            <span>
            @switch(Auth::user()->role_id)
                    @case(1)
                        Administrador
                        @break
                    @case(2)
                        Gestor de Eventos
                        @break
                    @case(3)
                        Proprietário de Evento
                        @break
                    @case(4)
                        Participante
                        @break
                @endswitch
            </span>
            </a>
        </div>
    </div>
    <div class="menu">
        <h2>Dashboard Menu</h2>
        <ul>
        @switch(Auth::user()->role_id)  {{-- Switch Case relevante aos roles do user  --}}
                @case(1) {{-- Admin  --}}
                    <li><a href="{{ route('users') }}">Lista de Users&nbsp; <span>&gt;</span></a></li>
                    <li><a href="{{ url('/events/admin') }}">Lista de Eventos&nbsp; <span>&gt;</span></a></li>
                    <li><a href="#">Relatorios&nbsp; <span>&gt;</span></a></li>
                    @break
                @case(2)  {{-- Manager  --}}
                    <li><a href="{{ url('/events/manager') }}">Gerir Eventos&nbsp; <span>&gt;</span></a></li>
                    <li><a href="#">Lista de Fornecedores&nbsp; <span>&gt;</span></a></li>
                    <li><a href="#">Editar Custo de Evento&nbsp; <span>&gt;</span></a></li>
                    @break
                @case(3) {{-- Owner --}}
                    <li><a href="{{ url('/participants') }}">Lista de Participantes&nbsp; <span>&gt;</span></a></li>
                    <li><a href="{{ url('/events/owner') }}">Lista de Eventos&nbsp; <span>&gt;</span></a></li>
                    {{-- <li><a href="#">Lista de Fornecedores&nbsp; <span>&gt;</span></a></li>
                    <li><a href="#">Editar Custo de Evento&nbsp; <span>&gt;</span></a></li> --}}
                    <li><a href="#">Carregar Convite&nbsp; <span>&gt;</span></a></li>
                    <li><a href="#">Venda de Bilhetes&nbsp; <span>&gt;</span></a></li>
                    <li><a href="#">Relatórios&nbsp; <span>&gt;</span></a></li>
                    @break

                @case(4)   {{-- Participante  --}}
                    <li><a href="{{ url('/events') }}">Meus Eventos&nbsp; <span>&gt;</span></a></li>
                    <li><a href="{{ url('/payment-list') }}">Histórico de Pagamentos&nbsp; <span>&gt;</span></a></li>
                    @break
                    @endswitch
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                    </form>

                    <form method="GET" action="{{ url('/') }}">
                    <button type="submit" class="logout-button">Regressar à Página Principal</button>
                    </form>

        </ul>
    </div>
    </form>
</div>
