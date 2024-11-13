<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">



<main class="flex-1 p-8 overflow-y-auto">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6 grid-cols-1 md:grid-cols-2 xl:grid-cols-2">
            <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">
                <h1 class="text-3xl font-semibold text-gray-900 mb-4">Bem-vindo, {{ Auth::user()->name }}!</h3>
                <h2 class="text-gray-700 mt-4">Dashboard de Administrador</h2>
            </div>
            
            <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">
                        <!-- Resumo do Perfil -->
                        <h3 class="text-3xl font-semibold text-gray-900 mb-4">Resumo do Perfil</h3>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                            <div class="flex justify-between items-center mb-4">
                                    <span class="text-gray-700">Nome</span>
                                    <span class="text-gray-900 font-semibold">{{ Auth::user()->name }}</span>
                                </div>
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-gray-700">Email</span>
                                    <span class="text-gray-900 font-semibold">{{ Auth::user()->email }}</span>
                                </div>
                                
                            </div>
                            <a href="{{ route('profile.edit') }}" class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                                Editar Perfil
                            </a>
                        </div>
                    </div>
                </div>
                <h1 class="text-3xl font-semibold text-gray-900 mb-2">Utilizadores</h1>
                <table class="min-w-full bg-white border">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">ID</th>
                                <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Nome</th>
                                <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Email</th>
                                <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Cargo</th>
                                <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="px-4 py-2 border-b border-gray-200 text-sm">{{ $user->id }}</td>
                                <td class="px-4 py-2 border-b border-gray-200 text-sm">{{ $user->name }}</td>
                                <td class="px-4 py-2 border-b border-gray-200 text-sm">{{ $user->email }}</td>
                                <td class="px-4 py-2 border-b border-gray-200 text-sm">
                                @switch($user->role_id)
                                    @case(1) Administrador @break
                                    @case(2) Gestor de Eventos @break
                                    @case(3) Proprietário de Evento @break
                                    @case(4) Participante @break
                                    @endswitch
                                </td>
                                <td class="px-4 py-2 border-b border-gray-200 text-sm">
                                    <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Editar</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Tem a certeza que deseja apagar este utilizador?')">Apagar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</main>