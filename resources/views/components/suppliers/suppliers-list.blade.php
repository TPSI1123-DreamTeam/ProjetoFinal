<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @if(session('status'))
        <div id="success-notification"
        class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg opacity-0 transform transition-all duration-300 z-50">
    {{ session('status') }}
    </div>
    @endif

<div class="supplier-wrapper">
    <h1>Lista de Fornecedores</h1>
 </div>
 <div class="linha-divisoria"></div>

 <div class="filter-search-event">
    <form action="{{ route('suppliers.searchby') }}" method="GET" class="grid gap-2 mt-5">

        <!-- Campo 1: Nome de Fornecedor -->
        <div class="flex items-center space-x-2 col-span-1">
            <label for="name" class="text-sm font-medium text-gray-700">Nome de Fornecedor</label>
            <input type="text" name="name" id="name"
                value="{{ isset($_GET['name']) ? $_GET['name'] : '' }}"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Campo 2: Email -->
        <div class="flex items-center space-x-2 col-span-1">
            <label for="email" class="text-sm font-medium text-gray-700">Email</label>
            <input type="text" name="email" id="email"
                value="{{ isset($_GET['email']) ? $_GET['email'] : '' }}"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Campo 3: Contacto -->
        <div class="flex items-center space-x-2 col-span-1">
            <label for="contact" class="text-sm font-medium text-gray-700">Contacto</label>
            <input type="text" name="contact" id="contact"
                value="{{ isset($_GET['contact']) ? $_GET['contact'] : '' }}"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Campo 4: Estado -->
        <div class="flex items-center space-x-2 col-span-1">
            <label for="status" class="text-sm font-medium text-gray-700">Estado</label>
            <select name="status" id="status" class="block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Selecione o estado</option>
                <option value="1" @if(isset($_GET['status']) && $_GET['status'] == '1') selected @endif>Ativo</option>
                <option value="0" @if(isset($_GET['status']) && $_GET['status'] == '0') selected @endif>Inativo</option>
            </select>
        </div>

        <!-- Campo 5: Tipo de Fornecedor -->
        <div class="flex items-center space-x-2 col-span-1">
            <label for="supplier_type_id" class="text-sm font-medium text-gray-700">Tipo de Fornecedor</label>
            <select name="supplier_type_id" id="supplier_type_id"
                class="block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Selecione o Tipo de Fornecedor</option>
                @foreach ($supplierTypes as $supplierType)
                <option value="{{ $supplierType->id }}"
                    {{ isset($_GET['supplier_type_id']) && $_GET['supplier_type_id'] == $supplierType->id ? 'selected' : '' }}>
                    {{ $supplierType->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Botões de Ação -->
        <div class="action-buttons">
            <button type="submit" class="event-button-search">
                Pesquisar
            </button>
        </div>

    </form>


<div class="action-buttons-end">
    <form id="exportSuppliersForm" method="GET" action="{{ route('suppliers.downloadSuppliersList') }}">
        <input type="hidden" name="supplier_ids" id="supplier_ids" value="{{ implode(',', $suppliers->pluck('id')->toArray()) }}">
        <button type="submit" class="event-button-export right" id="export">
            Exportar Lista
        </button>
    </form>
    <div class="add-supplier-btn">
        <a href="{{ url('suppliers/create') }}"><button>Adicionar Fornecedor</button></a>
    </div>
</div>
<table>
    <thead>
        <tr>
            <th>Fornecedor</th>
            <th>Email</th>
            <th>Contacto</th>
            <th>Eventos</th>
            <th>Tipo de Fornecedor</th>
            <th>Estado</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($suppliers as $supplier)
        <tr>
            <td class="supplier-td" data-cell="área">{{ $supplier->name }}</td>
            <td class="supplier-td" data-cell="email">{{ $supplier->email }}</td>
            <td class="supplier-td" data-cell="contacto">{{ $supplier->contact }}</td>
            <td class="supplier-td" data-cell="eventos">
                <ul>
                    @foreach ($supplier->events as $event)
                    <li>{{ $event->name }}</li>
                    @endforeach
                </ul>
            </td>
            <td class="supplier-td" data-cell="fornece">{{$supplier->supplierType->name}}</td>
            <td class="supplier-td" data-cell="estado">{{ $supplier->status == 1 ? 'Ativo' : 'Inativo'}}</td>
            <td class="supplier-td" data-cell="ações">
                <a href="{{ url('suppliers/' . $supplier->id) }}"><button class="details-btn">Detalhes</button></a>
                <a href="{{ url('suppliers/' . $supplier->id) . '/edit' }}"><button class="edit-btn-supplier">Editar</button></a>
                <form action="{{ route('suppliers.toggle-status', $supplier->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    @if($supplier->status == 1)
                        <button type="submit" class="deactivate-btn">Desativar</button>
                    @else
                        <button type="submit" class="activate-btn">Ativar</button>
                    @endif
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination-user-list">
    {{ $suppliers->appends(request()->query())->links() }}
</div>

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
            }, 3000);
        }
    });
</script>

@vite('resources/js/orderTable.js')
