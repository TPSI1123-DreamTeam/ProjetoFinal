<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Gestão de Utilizadores</h1>

    <ul role="list" class="divide-y divide-gray-200 bg-white shadow rounded-lg">
        @foreach ($users as $user)
        <li class="p-6 flex items-center justify-between gap-6">
            <!-- Informação do Utilizador -->
            <div class="flex items-center gap-4">
                <img class="h-14 w-14 rounded-full bg-gray-50 object-cover" src="{{ $user->image }}" alt="{{ $user->name }}">
                <div>
                    <p class="text-lg font-semibold text-gray-900">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    <p class="text-sm text-gray-500">
                        <span class="font-medium text-gray-700">Função:</span>
                        @switch($user->role_id)
                            @case(1) <span class="text-blue-600">Administrador</span> @break
                            @case(2) <span class="text-green-600">Gestor de Eventos</span> @break
                            @case(3) <span class="text-yellow-600">Proprietário de Eventos</span> @break
                            @case(4) <span class="text-purple-600">Participante</span> @break
                        @endswitch
                    </p>
                </div>
            </div>

            <!-- Ações -->
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <!-- Alterar Função -->
                <form action="{{ route('users.update-role', $user->id) }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    @method('PUT')
                    @if($user->role_id != 1)
                    <select name="role_id" class="form-select rounded-md text-sm border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Gestor de Eventos</option>
                        <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Proprietário de Evento</option>
                        <option value="4" {{ $user->role_id == 4 ? 'selected' : '' }}>Participante</option>
                    </select>
                    <button type="submit" class="px-3 py-1 text-white bg-blue-600 hover:bg-blue-700 rounded-md text-sm shadow-sm">Atualizar</button>
                    @endif

                </form>

                <!-- Redefinir Password -->
                <form action="{{ route('users.reset-password', $user->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="px-3 py-1 text-white bg-red-600 hover:bg-red-700 rounded-md text-sm shadow-sm">
                        Alterar senha
                    </button>
                </form>
            </div>
        </li>
        @endforeach
    </ul>

    <!-- Paginação -->
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
