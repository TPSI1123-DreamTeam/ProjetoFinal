    <main class="flex-1 p-8 bg-gray-100 overflow-y-auto">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6 grid-cols-1 md:grid-cols-2">
                        <!-- Conteúdo original da página -->
                        <!-- Boas-vindas e Resumo do Perfil -->
                        <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">
                            <h1 class="text-3xl font-semibold text-gray-900 mb-4">Bem-vindo, {{ Auth::user()->name }}!</h3>
                            <h2 class="text-gray-700 mt-4">Dashboard de participante</h2>
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
    
                        <!-- Histórico de Pagamentos -->
                        <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">
                            <h3 class="text-3xl font-semibold text-gray-900 mb-4">Histórico de Pagamentos</h3>
                            <div class="bg-gray-100 p-4 rounded-lg shadow-inner overflow-y-auto max-h-80">
                                <table class="w-full text-center table-auto">
                                    <thead>
                                        <tr class="bg-gray-200 border-b border-gray-300">
                                            <th class="px-4 py-2 text-gray-800 font-semibold">Data</th>
                                            <th class="px-4 py-2 text-gray-800 font-semibold">Nome</th>
                                            <th class="px-4 py-2 text-gray-800 font-semibold">Montante (€)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($payments))
                                        <!-- @foreach ($payments as $payment)
                                        <tr class="border-b border-gray-300">
                                            <td class="px-4 py-2">{{ $payment->created_at->format('d/m/Y') }}</td>
                                            <td class="px-4 py-2">{{ $payment->name }}</td>
                                            <td class="px-4 py-2">{{ $payment->amount }}</td>
                                        </tr>
                                        @endforeach -->
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
