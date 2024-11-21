<div class="flex-1 p-8 overflow-y-auto">

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="container-fluid">
    <div class="d-flex align-items-center">
        <p class="text-sm/6 font-semibold text-gray-900">Payments List</p>
    </div>
</div>
<table class="min-w-full bg-white border">
    <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">ID</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Nome do Evento</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Preço</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Data</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
        <tr class="odd:bg-white even:bg-gray-50">
            <td class="border border-gray-300 px-4 py-2">{{ $payment->id }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $payment->name }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $payment->amount }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $payment->date }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $payment->status == 'paid' ? 'Pago' : 'Pendente' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

 