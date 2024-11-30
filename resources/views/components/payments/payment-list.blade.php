<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />

<div class="event-wrapper">
    <div class="title-hidder-div">
        <h1>Histórico de Pagamentos</h1>
    </div>
</div>
<div class="linha-divisoria-event-manager"></div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome do Evento</th>
            <th>Preço</th>
            <th>Data</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td data-cell="iD">{{ $payment->id }}</td>
            <td data-cell="nome">{{ $payment->name }}</td>
            <td data-cell="preço">{{ $payment->amount }}</td>
            <td data-cell="data">{{ $payment->date }}</td>
            <td data-cell="estado">{{ $payment->status == 'paid' ? 'Pago' : 'Pendente' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@vite('resources/js/hidder.js')