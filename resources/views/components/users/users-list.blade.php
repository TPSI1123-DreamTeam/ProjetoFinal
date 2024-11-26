<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <h1>Gestão de Utilizadores</h1>

    <div class="linha-divisoria"></div>

    <ul role="list" class="list">

        @foreach ($users as $user)
        <li class="card-user">
            <!-- Informação do Utilizador -->
            <div class="user-card-header">
                <img src="{{ $user->image }}" alt="{{ $user->name }}">
                <div>
                    <p class="user-nameEmail">{{ $user->name }}</p>
                    <p class="user-nameEmail">{{ $user->email }}</p>
                    <p class="user-role-change">
                        <span >Função:</span>
                        @switch($user->role_id)
                            @case(1) <span>Administrador</span> @break
                            @case(2) <span>Gestor de Eventos</span> @break
                            @case(3) <span>Proprietário de Eventos</span> @break
                            @case(4) <span>Participante</span> @break
                        @endswitch
                    </p>
                </div>
            </div>

            <!-- Ações -->
            <div>
                <!-- Alterar Função -->
                <form action="{{ route('users.update-role', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @if($user->role_id != 1)
                    <select name="role_id">
                        <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Gestor de Eventos</option>
                        <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Proprietário de Evento</option>
                        <option value="4" {{ $user->role_id == 4 ? 'selected' : '' }}>Participante</option>
                    </select>
                    <button type="submit">Atualizar</button>
                    @endif

                </form>

                <!-- Redefinir Password -->
                <form action="{{ route('users.reset-password', $user->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-4">
                        <label for="password" >New Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            >
                    </div>
                    <button type="submit">
                        Alterar senha
                    </button>
                </form>

            </div>
        </li>
        @endforeach
    </ul>
<!-- Paginação -->
{{ $users->links() }}