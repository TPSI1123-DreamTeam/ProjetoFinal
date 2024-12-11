<div class="event-wrapper">
    <h1>Lista de Eventos</h1>
</div>

<div class="filter-search-event">
    <form id="searchEventsByAdmin" action="/searchEventsByAdmin" method="GET" class="grid gap-2 mt-5">

        <!-- Campo 1 -->
        <div class="flex items-center space-x-2 col-span-1">
            <label for="event_name" class="text-sm font-medium text-gray-700">Nome</label>
            <input type="text" name="event_name" id="event_name"
                value="{{ isset($formFields['event_name']) ? $formFields['event_name'] : '' }}"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Campo 2 e 3-->
        <div class="flex items-center space-x-2">
            <label for="participantes" class="text-sm font-medium text-gray-700">Participantes</label>
            <div class="event-input-list">
                <input type="text" name="participants1" id="participants1"
                value="{{ isset($formFields['participants1']) ? $formFields['participants1'] : '' }}"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="De" oninput="this.value = this.value.replace(/[^0-9]/g, '');">

                <input type="text" name="participants2" id="participants2"
                value="{{ isset($formFields['participants2']) ? $formFields['participants2'] : '' }}"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Até" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
            </div>

        </div>

        <!-- Campo 4 -->
        <div class="flex items-center space-x-2 col-span-1">
            <label for="category_id" class="text-sm font-medium text-gray-700">Categoria</label>
            <select name="category_id" id="category_id" class="select-event-state">
                <option value="" readonly>Selecione a categoria</option>
                @foreach ($Category as $item)
                    <option value="{{ $item->id }}"
                    @if(isset($formFields['category_id']) && $formFields['category_id'] == $item->id) selected @endif
                    >{{ $item->description }}</option>
                @endforeach
            </select>
        </div>

        <!-- Campo 2 e 3-->
        <div class="flex items-center space-x-2">
            <label for="participantes" class="text-sm font-medium text-gray-700">Custo</label>
            <div class="event-input-list">
                <input type="text" name="amount1" id="amount1"
                value="{{ isset($formFields['amount1']) ? $formFields['amount1'] : '' }}"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="De" oninput="this.value = this.value.replace(/[^0-9]/g, '');">

                <input type="text" name="amount2" id="amount2"
                value="{{ isset($formFields['amount2']) ? $formFields['amount2'] : '' }}"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Até" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
            </div>
        </div>

        <div class="flex items-center space-x-2">
            <label for="campo6" class="text-sm font-medium text-gray-700">Estado</label>
            <select name="event_status" id="event_status" class="select-event-state">
                <option value="" readonly>Selecione o estado</option>
                <option value="ativo"     @if(isset($formFields['event_status']) && $formFields['event_status'] == 'ativo') selected @endif >Ativo</option>
                <option value="recusado"  @if(isset($formFields['event_status']) && $formFields['event_status'] == 'recusado') selected @endif>Recusado</option>            
                <option value="cancelado" @if(isset($formFields['event_status']) && $formFields['event_status'] == 'cancelado') selected @endif>Cancelado</option>
                <option value="concluido" @if(isset($formFields['event_status']) && $formFields['event_status'] == 'concluido') selected @endif>Concluido</option>
                <option value="aprovado"  @if(isset($formFields['event_status']) && $formFields['event_status'] == 'aprovado') selected @endif>Aprovado</option>
            </select>
        </div>

        <!-- Campo 5 -->
        <div class="flex items-center space-x-2">
            <label for="campo5" class="text-sm font-medium text-gray-700">Data</label>
            <div class="event-input-list">
                <input id="datepicker1" name="datepicker1" datepicker datepicker-format="yyyy-mm-dd" value="{{ isset($formFields['datepicker1']) ? $formFields['datepicker1'] : '' }}" type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selecionar Data">
                <input id="datepicker2" name="datepicker2" datepicker datepicker-format="yyyy-mm-dd" value="{{ isset($formFields['datepicker2']) ? $formFields['datepicker2'] : '' }}" type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selecionar Data">
            </div>
        </div>
        <div class="action-buttons">
            <button type="submit"
                class="event-button-search">
                Pesquisar
            </button>
        </div>

    </form>
    <div class="action-buttons">
        <form id="exportEventsForm" method="GET" action="{{ route('events.exportbyadmin') }}">
            <input type="hidden" name="event_ids" id="event_ids" value="{{ implode(',', $events->pluck('id')->toArray()) }}">
            <button type="submit" class="event-button-export right" id="export">
                Exportar Lista
            </button>
        </form>
</div>
        
<div class="linha-divisoria-event-manager"></div>

<!-- Tabela de Eventos -->
<table>
    <thead>
        <tr>
            <th>Nº</th>
            <th>Nome do Evento</th>
            <th>Categoria</th>
            <th>Participantes</th>
            <th>Data do Evento</th>
            <th>Custo Estimado</th>
            <th>Estado do Evento</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td data-cell="número">{{ $loop->iteration }}</td>
            <td data-cell="nome">{{ $event->name }}</td>
            <td data-cell="descrição">{{ $event->category->description }}</td>
            <td data-cell="participantes">{{ @count($event->users) }}</td>
            <td data-cell="data">{{ date('d-m-Y', strtotime($event->start_date)) }}</td>
            <td data-cell="custo estimado">{{ $event->amount }}€</td>
            <td data-cell="estado">{{ $event->event_status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination-user-list">
    {{ $events->links() }}
</div>

@vite('resources/js/orderTable.js')
