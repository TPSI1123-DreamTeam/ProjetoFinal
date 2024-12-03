<div class="table-wrapper">
<h1 class="user-management">Gestão de Utilizadores</h1>

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
