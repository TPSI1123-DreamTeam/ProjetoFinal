<div class="table-wrapper">
<h1 class="user-management">Gestão de Utilizadores</h1>

@if(session('status'))
            <div id="success-notification" class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg opacity-0 transform transition-all duration-300 z-50">
                {{ session('status') }}
            </div>
        @endif

<div class="search-bar">
    <form action="{{ route('users') }}" method="GET" class="search-users-form">
        <!-- Pesquisa por nome ou email -->
        <input type="text" name="search" placeholder="Pesquisar por nome ou email" value="{{ request('search') }}">

        <!-- Dropdown de função -->
        <select name="role_id">
            <option value="">Todas as Funções &#9660;</option>
            <option value="1" {{ request('role_id') == 1 ? 'selected' : '' }}>Administrador</option>
            <option value="2" {{ request('role_id') == 2 ? 'selected' : '' }}>Gestor</option>
            <option value="3" {{ request('role_id') == 3 ? 'selected' : '' }}>Proprietário</option>
            <option value="4" {{ request('role_id') == 4 ? 'selected' : '' }}>Participante</option>
        </select>
        <div class="submit-search-div">
            <button class="submit-search-users" type="submit">Pesquisar</button>
        </div>  
    </form>

    <div class="action-buttons">
        <form id="exportEventsForm" method="GET" action="{{ route('users.downloadUsersList') }}">
            <input type="hidden" name="user_ids" id="user_ids" value="{{ implode(',', $users->pluck('id')->toArray()) }}">
            <button type="submit" class="event-button-export right" id="export">
                Exportar Lista
            </button>
        </form>
    </div>
</div>

<div class="linha-divisoria"></div>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Função</th>
            <th>Alterar Função</th>
            <th>Alterar Password</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <!-- Nome -->
            <td data-cell="nome">{{ $user->name }}</td>
            <!-- Email -->
            <td  data-cell="email">{{ $user->email }}</td>
            <!-- Função -->
            <td data-cell="função">
                @switch($user->role_id)
                    @case(1) Administrador @break
                    @case(2) Gestor @break
                    @case(3) Proprietário @break
                    @case(4) Participante @break
                @endswitch
            </td>
            <!-- Alterar Função -->
            <td data-cell="alterar função">
                @if($user->role_id != 1)
                <form action="{{ route('users.update-role', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="role_id">
                        <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Gestor</option>
                        <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Proprietário</option>
                        <option value="4" {{ $user->role_id == 4 ? 'selected' : '' }}>Participante</option>
                    </select>
                    <button class="change-role-admin" type="submit">Atualizar</button>
                </form>
                @endif
            </td>
            <!-- Redefinir Palavra-passe -->
            <td data-cell="alterar password">
                <form action="{{ route('users.reset-password', $user->id) }}" method="POST">
                    @csrf
                    @method('POST')
                        <input id="password" name="password" type="password" required>
                    <button class="update-pw-admin" type="submit">
                        Alterar
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

<!-- Paginação -->
<div class="pagination-user-list">
    {{$users->links()}}
</div>

@vite('resources/js/orderTable.js')

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const successNotification = document.getElementById('success-notification');

        if (successNotification) {
            setTimeout(() => {
                successNotification.classList.remove('opacity-0');
                successNotification.classList.add('opacity-100');
            }, 100);

            setTimeout(() => {
                successNotification.classList.remove('opacity-100');
                successNotification.classList.add('opacity-0');
            }, 5000);
        }
    });
</script>