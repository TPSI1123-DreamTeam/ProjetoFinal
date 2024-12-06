<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />

<div class="event-wrapper">
    <div class="title-hidder-div">
        <h1>Histórico de Pagamentos</h1>
    </div>
</div>

<form action="/searchPayments" method="GET" class="grid gap-2 mt-5">
<!-- Campo 1 -->
<select class="choose-event" id="search" name="search">
    <option selected>Escolha o evento para listar participantes...</option>
    @foreach ($allEvents as $eventName)
        <option value="{{ $eventName->name }}" {{ request()->input('search') == $eventName->name ? 'selected' :'' }}>{{ $eventName->name }}</option>
    @endforeach
</select>

<!-- Campo 5 -->
<div class="flex items-center space-x-2" style="max-width: 350px;">
    <label for="campo5" class="text-sm font-medium text-gray-700">Data</label>
    <div class="event-input-list">
        <input id="datepicker1" name="datepicker1" datepicker datepicker-format="yyyy-mm-dd" value="{{ isset($formFields['datepicker1']) ? $formFields['datepicker1'] : '' }}" type="date"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selecionar Data">
        <input id="datepicker2" name="datepicker2" datepicker datepicker-format="yyyy-mm-dd" value="{{ isset($formFields['datepicker2']) ? $formFields['datepicker2'] : '' }}" type="date"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selecionar Data">
    </div>
</div>

 <!-- Botão Submit -->
 <div class="action-buttons">
    <button type="submit"
        class="event-button-search">
        Pesquisar
    </button>
</div>
</form>

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
            <td data-cell="preço">{{ $payment->amount }} €</td>
            <td data-cell="data">{{ $payment->date }}</td>
            <td data-cell="estado">{{ $payment->status == 'paid' ? 'Pago' : 'Pendente' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@vite('resources/js/hidder.js')
@vite('resources/js/orderTable.js')

