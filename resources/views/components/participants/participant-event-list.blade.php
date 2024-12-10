<div class="event-wrapper">
    <div class="title-hidder-div">
        <h1>Lista de Eventos</h1>
    </div>
</div>
<div class="linha-divisoria-event-manager"></div>

 <form action="/eventsFilter" method="GET" class="search-participant-event">
    <!-- Campo 1 -->
    <select class="choose-event-participant" id="search" name="search">
        @foreach ($allEvents as $event)
            <option value="{{ $event->name }}" {{ request()->input('search') == $event->name ? 'selected' :'' }}>{{ $event->name }}</option>
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
        <form id="exportEventsForm" method="GET" action="{{ route('events.exportbyparticipant') }}">
            <input type="hidden" name="event_ids" id="event_ids" value="{{ implode(',', $events->pluck('id')->toArray()) }}">
            <button type="submit" class="event-button-export right" id="export">
                Exportar Lista
            </button>
        </form>
    </div>

<table>
    <thead>
        <tr>
            <th>Nome do Evento</th>
            <th>Data de Inicio</th>
            <th>Data de Fim</th>
            <th>Preço</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td data-cell="nome">{{ $event->name }}</td>
            <td data-cell="data de inicio">{{ $event->start_date }}</td>
            <td data-cell="data de fim">{{ $event->end_date}}</td>
            <td data-cell="preço">{{ number_format($event->ticket_amount, 2, ',', '.') }}€</td>
        </tr>
        @endforeach
    </tbody>
</table>

@vite('resources/js/orderTable.js')

{{-- <div class="pagination-user-list">
    {{ $events -> links()}}
</div> --}}


