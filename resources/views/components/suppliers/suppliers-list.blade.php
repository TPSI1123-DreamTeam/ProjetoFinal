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

 <div class="add-supplier-btn">
    <a href="{{ url('suppliers/create') }}"><button>Adicionar Fornecedor</button></a>
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
            <td class="supplier-td" data-cell="fornece">Cerveja</td>
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
    {{ $suppliers->links() }}
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
