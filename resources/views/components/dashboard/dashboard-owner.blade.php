<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<main class="flex-1 p-8 bg-gray-100 overflow-y-auto">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6 grid-cols-1 md:grid-cols-2">
                        <!-- Conteúdo original da página -->
                        <!-- Boas-vindas e Resumo do Perfil -->
                        <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">
                            <h1 class="text-3xl font-semibold text-gray-900 mb-4">Bem-vindo, {{ Auth::user()->name }}!</h3>
                            <h2 class="text-gray-700 mt-4">Dashboard de Proprietário de Evento</h2>
                        </div>
    
                        <!-- Resumo do Perfil -->
                        <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">
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
            </main>
        </div>
    </body>