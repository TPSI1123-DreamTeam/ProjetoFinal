<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="container mx-auto p-6">

    <div class="mb-6 flex items-center">
        <p class="text-xl font-semibold text-gray-900">Lista de Fornecedores</p>
    </div>

    

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Fornecedor</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Contacto</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Eventos</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Tipo de Fornecedor</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Estado</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($suppliers as $supplier)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        <div class="flex items-center space-x-4">
                        <img class="h-12 w-12 rounded-full bg-gray-50" 
                             src="{{ filter_var($supplier->image, FILTER_VALIDATE_URL) ? $supplier->image : asset('images/suppliers/' . $supplier->id . '/' . $supplier->image) }}" 
                             alt="{{ $supplier->name }}">
                            <span>{{ $supplier->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $supplier->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $supplier->contact }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <ul>
                            @foreach ($supplier->events as $event)
                            <li>{{ $event->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cerveja</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $supplier->status == 1 ? 'Ativo' : 'Inativo'}}
                        


                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                        <a href="{{ url('suppliers/' . $supplier->id) }}" class="text-green-500 hover:text-green-700 mr-4">Mostrar Detalhes</a>
                        <a href="{{ url('suppliers/' . $supplier->id) . '/edit' }}" class="text-blue-500 hover:text-blue-700 mr-4">Editar Detalhes</a>
                        <form action="{{ route('suppliers.toggle-status', $supplier->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-yellow-500 hover:text-yellow-700">
                            {{ $supplier->status == 1 ? 'Desativar' : 'Ativar' }}
                        </form>
                        <!-- Mostrar botão para ativar/desativar -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <a href="{{ url('suppliers/create') }}" class="text-blue-500 hover:text-blue-700">Adicionar Fornecedor</a>
    </div>

    <div class="mt-6">
        {{ $suppliers->links() }}
    </div>
</div>
