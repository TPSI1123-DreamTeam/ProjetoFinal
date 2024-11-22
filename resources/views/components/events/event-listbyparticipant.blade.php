<div class="flex-1 p-8 overflow-y-auto">

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="container-fluid">
    <div class="d-flex align-items-center">
        <p class="text-sm/6 font-semibold text-gray-900">Events List</p>
    </div>
</div>
<table class="min-w-full bg-white border">
    <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">ID</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Nome do Evento</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Data de Inicio</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Data de Fim</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Preço</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr class="odd:bg-white even:bg-gray-50">
            <td class="border border-gray-300 px-4 py-2">{{ $event->id }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $event->name }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $event->start_date }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $event->end_date}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $event->amount}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

 