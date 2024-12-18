<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />

<div class="event-wrapper">
    <div class="title-hidder-div">
        <h1>Histórico de Pagamentos</h1>
    </div>
</div>

<div class="linha-divisoria-event-manager"></div>

<div class="title-hidder-div">
    <h2>Escolha o evento para listar pagamentos...</h2>
</div>

<form action="/searchPayments" method="GET" class="search-participant-event">
    <!-- Campo 1 -->
    <select class="choose-event-participant" id="search" name="search">
        @foreach ($allEvents as $eventName)
            <option value="{{ $eventName->name }}" {{ request()->input('search') == $eventName->name ? 'selected' :'' }}>{{ $eventName->name }}</option>
        @endforeach
    </select>

    <!-- Campo 5 -->
    <div class="date-picker-participant">
        <label for="campo5" class="text-sm font-medium text-gray-700">Data</label>
        <div class="event-input-list">
            <input id="datepicker1" name="datepicker1" datepicker datepicker-format="yyyy-mm-dd" value="{{ isset($formFields['datepicker1']) ? $formFields['datepicker1'] : '' }}" type="date"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selecionar Data">
        </div>
        <div class="event-input-list">
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

<div class="action-buttons">
        <form id="exportPaymentsForm" method="GET" action="{{ route('payments.downloadPaymentList') }}">
            <input type="hidden" name="payment_ids" id="payment_ids" value="{{ implode(',', $payments->pluck('id')->toArray()) }}">
            <button type="submit" class="event-button-export right" id="export">
                Exportar Lista
            </button>
        </form>
</div>

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
            <td data-cell="data">{{ date('d-m-Y', strtotime($payment->date)) }}</td>
            <td data-cell="estado">{{ $payment->status == 'paid' ? 'Pago' : 'Pendente' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@if (!$payments)

@else
{{ $payments->links() }}
@endif

@vite('resources/js/orderTable.js')


