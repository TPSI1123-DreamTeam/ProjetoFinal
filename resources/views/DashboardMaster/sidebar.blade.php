<div class="sidebar">
    <div class="user-profile">
        <div class="user-avatar">
            <img src="/{{ Auth::user()->image }}" style="border-radius: 50%;"><img>
        </div>
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
                        Proprietário
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
                    <li><a href="{{ route('users') }}">Lista de Utilizadores&nbsp; <span>&gt;</span></a></li>
                    <li><a href="{{ url('/events/admin') }}">Lista de Eventos&nbsp; <span>&gt;</span></a></li>
                    <li><a href="{{ url('/events/admin/report') }}">Relatórios&nbsp; <span>&gt;</span></a></li>
                    @break
                @case(2)  {{-- Manager  --}}
                    <li><a href="{{ url('/events/manager') }}">Gerir Eventos&nbsp; <span>&gt;</span></a></li>
                    <li><a href="{{ url('/events/manager/approve') }}">Aprovar Eventos&nbsp; <span>&gt;</span></a></li>
                    <li><a href="{{ url('/suppliers') }}">Lista de Fornecedores&nbsp; <span>&gt;</span></a></li>
                    <li><a href="{{ url('/events/manager/report') }}">Relatórios&nbsp; <span>&gt;</span></a></li>
                    @break
                @case(3) {{-- Owner --}}
                    <li><a href="{{ route('participants.index') }}">Lista de Participantes&nbsp; <span>&gt;</span></a></li>
                    <li><a href="{{ route('events.eventsbyowner') }}">Lista de Eventos&nbsp; <span>&gt;</span></a></li>
                    <li><a href="{{ url('/events/owner/report') }}">Relatórios&nbsp; <span>&gt;</span></a></li>
                    <li><a href="{{ route('invitations.index') }}">Criar Convite&nbsp; <span>&gt;</span></a></li>
                    <li><a href="{{ url('/participants/participant-event-list') }}">Meus Eventos&nbsp; <span>&gt;</span></a></li>
                    <li><a href="{{ url('/payment-list') }}">Histórico de Pagamentos&nbsp; <span>&gt;</span></a></li>
                    @break

                @case(4)   {{-- Participante  --}}
                    <li><a href="{{ url('/participants/participant-event-list') }}">Meus Eventos&nbsp; <span>&gt;</span></a></li>
                    <li><a href="{{ url('/payment-list') }}">Histórico de Pagamentos&nbsp; <span>&gt;</span></a></li>
                    @break
                    @endswitch
        </ul>
    </div>
    <div class="buttons-dashboard">
        <form method="GET" action="{{ url('/event/public') }}">
            <button type="submit" class="logout-button">Voltar</button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>
</div>
