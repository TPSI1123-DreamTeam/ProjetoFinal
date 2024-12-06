<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />

        @if(session('status'))
            <div id="success-notification"
            class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg opacity-0 transform transition-all duration-300 z-50">
        {{ session('status') }}
        </div>
        @endif

<div class="event-wrapper">
    <div class="title-hidder-div">
        <h1>Lista de Eventos</h1>
    </div>
</div>
<div class="linha-divisoria-event-manager"></div>

<div class="filter-search-event">
    <form id="searchEventsByManager" action="/searchEventsByManager" method="GET" class="grid gap-2 mt-5">

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
            <select name="category_id" id="category_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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
            <label for="campo6" class="text-sm font-medium text-gray-700" >Estado</label>
            <select name="event_status" id="event_status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="" readonly>Selecione o estado</option>
                <option value="ativo"     @if(isset($formFields['event_status']) && $formFields['event_status'] == 'ativo') selected @endif >Ativo</option>
                <option value="recusado"  @if(isset($formFields['event_status']) && $formFields['event_status'] == 'recusado') selected @endif>Recusado</option>
                <!-- <option value="pendente"  @if(isset($formFields['event_status']) && $formFields['event_status'] == 'pendente') selected @endif>Pendente</option> -->
                <option value="cancelado" @if(isset($formFields['event_status']) && $formFields['event_status'] == 'cancelado') selected @endif>Cancelado</option>
                <option value="concluido" @if(isset($formFields['event_status']) && $formFields['event_status'] == 'concluido') selected @endif>Concluido</option>
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
        <form id="exportEventsForm" method="GET" action="{{ url('export/eventsbymanager/') }}">
            <input type="hidden" name="event_ids" id="event_ids" value="{{ implode(',', $events->pluck('id')->toArray()) }}">
            <button type="submit" class="event-button-export right" id="export">
                Exportar Lista
            </button>
        </form>
    </div>
</div>

 <table>
     <thead>
         <tr class="tr-heading">
            <th>Nº</th>
            <th>Nome do Evento</th>
            <th>Participantes</th>
            <th>Categoria</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Custo Estimado</th>
            <th>Estado do Evento</th>
            <th>Ações</th>
         </tr>
     </thead>
     <tbody>
         @foreach($events as $event)
         <tr class="tr-body">
             <td data-cell="número">{{ $loop->iteration + $events->firstItem() - 1 }}</td>
             <td data-cell="nome">{{ $event->name }}</td>
             <td data-cell="participantes">{{ $event->number_of_participants }} / {{ @count($event->users) }}</td>
             <td data-cell="descrição">{{ $event->category->description }}</td>
             <td data-cell="data">{{ date('Y-m-d', strtotime($event->start_date)) }}</td>
             <td data-cell="hora de inicio">{{ date('H:i', strtotime($event->start_time))}}</td>
             <td data-cell="custo estimado">{{ number_format($event->amount, 2, ',', '.') }}€</td>
             <td data-cell="estado">{{ $event->event_status }}
             </td>
             <td data-cell="ações" class="action-buttons-table">
                @if( $event->event_status == 'pendente')
                    <a  href="{{ url('events/manager/' . $event->id) }}" >
                        <button class="show-btn">Ver</button>
                    </a>
                    <a  href="{{ url('events/manager/' . $event->id . '/edit') }}" >
                        <button class="edit-btn">Editar</button>

                    </a>
                    <form action="{{url('events/'. $event->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a  href="{{ url('events/' . $event->id) }}" >
                            <button class="cancel-btn">Cancelar</button>
                        </a>
                    </form>
                @endif()
                @if( $event->event_status == 'cancelado')
                <a  href="{{ url('events/manager/' . $event->id) }}" >
                    <button class="show-btn">Ver</button>
                </a>
                <form action="{{ route('events.updatestatus', $event->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <a href="/events/manager">
                        <button class="activate-btn" type="submit">Ativar</button>
                    </a>
                </form>
                @endif()
                @if( $event->event_status == 'recusado' || $event->event_status == 'concluido')
                    <a  href="{{ url('events/manager/' . $event->id) }}" >
                        <button class="show-btn">Ver</button>
                    </a>
                @endif
                @if( $event->event_status == 'ativo')
                    <a  href="{{ url('events/manager/' . $event->id) }}" >
                        <button class="show-btn">Ver</button>
                    </a>
                    <a  href="{{ url('events/manager/' . $event->id . '/edit') }}" >
                        <button class="edit-btn">Editar</button>
                    </a>
                @endif
             </td>
            </tr>
         @endforeach

         @if(@count($events)==0)
         <tr>
            <td colspan="10">Não existem resultados para esta pesquisa.</td>
        </tr>
         @endif
     </tbody>
 </table>

 <div class="pagination-user-list">
    {{ $events ->links() }}
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

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
