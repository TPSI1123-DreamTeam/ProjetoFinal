<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />

@vite('resources/js/formListEventsManager.js')

<div class="content-header">
    <h1>Lista de Eventos</h1>
        <p>Bem-vindo à página de gestão de eventos! 
            Aqui pode visualizar todos os eventos disponíveis no nosso site, 
            com acesso rápido a informações detalhadas como o nome do evento, data, local e estado. 
            Esta ferramenta permite-lhe gerir os eventos de forma eficiente, 
            podendo editar as informações de um evento para refletir alterações necessárias ou cancelar eventos quando aplicável. 
            Mantenha a organização e o controlo sobre os seus eventos, 
            garantindo a melhor experiência para os utilizadores do site.</p>

</div>
<div class="linha-divisoria"></div>

<div class="flex-1 p-8 overflow-y-auto">    
    <p class="text-sm/6 font-bold text-gray-900">Lista de Eventos</p>  
   
    <form action="/searchEventsByManager" method="GET" class="grid grid-cols-4 gap-2 mt-5">

        <!-- Campo 1 -->
        <div class="flex items-center space-x-2 col-span-1">
            <label for="event_name" class="text-sm font-medium text-gray-700">Nome</label>
            <input type="text" name="event_name" id="event_name" 
                value="{{ isset($formFields['event_name']) ? $formFields['event_name'] : '' }}"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Campo 2 e 3-->
        <div class="flex items-center space-x-2 col-span-2">
            <label for="participantes" class="text-sm font-medium text-gray-700">Participantes</label>

            <input type="text" name="participants1" id="participants1" 
            value="{{ isset($formFields['participants1']) ? $formFields['participants1'] : '' }}"
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="De" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
            
            <input type="text" name="participants2" id="participants2" 
            value="{{ isset($formFields['participants2']) ? $formFields['participants2'] : '' }}"
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Até" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
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
        <div class="flex items-center space-x-2 col-span-2">
            <label for="participantes" class="text-sm font-medium text-gray-700">Custo</label>

            <input type="text" name="amount1" id="amount1" 
            value="{{ isset($formFields['amount1']) ? $formFields['amount1'] : '' }}"
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="De" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
            
            <input type="text" name="amount2" id="amount2" 
            value="{{ isset($formFields['amount2']) ? $formFields['amount2'] : '' }}"
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Até" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </div>

        <!-- Campo 5 -->
        <div class="flex items-center space-x-2 col-span-2">
            <label for="campo5" class="text-sm font-medium text-gray-700">Data</label>   
            <input id="datepicker1" name="datepicker1" datepicker datepicker-format="yyyy-mm-dd" value="{{ isset($formFields['datepicker1']) ? $formFields['datepicker1'] : '' }}" type="text" 
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selecionar Data">
            <input id="datepicker2" name="datepicker2" datepicker datepicker-format="yyyy-mm-dd" value="{{ isset($formFields['datepicker2']) ? $formFields['datepicker2'] : '' }}" type="text" 
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selecionar Data">
        </div>

        <div class="flex items-center space-x-2 col-span-1">
            <label for="campo6" class="text-sm font-medium text-gray-700" >Estado</label>
            <select name="event_status" id="event_status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="" readonly>Selecione o estado</option>
                <option value="ativo"     @if(isset($formFields['event_status']) && $formFields['event_status'] == 'ativo') selected @endif >Ativo</option>
                <option value="recusado"  @if(isset($formFields['event_status']) && $formFields['event_status'] == 'recusado') selected @endif>Recusado</option>
                <option value="pendente"  @if(isset($formFields['event_status']) && $formFields['event_status'] == 'pendente') selected @endif>Pendente</option>
                <option value="cancelado" @if(isset($formFields['event_status']) && $formFields['event_status'] == 'cancelado') selected @endif>Cancelado</option>
                <option value="concluido" @if(isset($formFields['event_status']) && $formFields['event_status'] == 'concluido') selected @endif>Concluido</option>
            </select> 
        </div>

        <!-- Botão Submit -->
        <div class="col-span-1">         
            <button type="submit" 
                class="w-50 py-2 px-4 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Pesquisar
            </button>

            <button type="submit" name="events_pending" id="events_pending" value="pending"
                class="w-50 py-2 px-4 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                Eventos Pendentes
            </button>
            <input type="hidden" name="pending" id="pending" value=""/>
        </div>
    </form>


 <table class="min-w-full bg-white border mt-5">
     <thead>
         <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Nº</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Nome do Evento</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Participantes /<br>Registados</th>            
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Categoria</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Data</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Hora</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Custo Estimado</th>       
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Estado do Evento</th>       
            <th class="border border-gray-300 px-4 py-2 text-center font-bold text-gray-700">Ações</th>
         </tr>
     </thead>
     <tbody>
         @foreach($events as $event)
         <tr class="odd:bg-white even:bg-gray-50">
             <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration + $events->firstItem() - 1 }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ $event->name }}</td>
             <td class="border border-gray-300 px-4 py-2 text-center" >{{ $event->number_of_participants }} / {{ @count($event->users) }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ $event->category->description }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ date('Y-m-d', strtotime($event->start_date)) }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ date('H:i', strtotime($event->start_time))}}</td>
             <td class="border border-gray-300 px-4 py-2">{{ number_format($event->amount, 2, ',', '.') }}€</td>
             <td class="border border-gray-300 px-4 py-2">{{ $event->event_status }}</td>
             <td class="border border-gray-300 px-4 py-2">
                <a  href="{{ url('events/manager/' . $event->id) }}" >
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Ver</button>
                </a>
                <a  href="{{ url('events/manager/' . $event->id . '/edit') }}" >
                    <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full">Editar</button>
                </a>
                <a  href="{{ url('events/' . $event->id) }}" >
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">Cancelar</button>
                </a>  
             </td>             
            </tr>
         @endforeach

         @if(count($events)==0)
         <tr class="odd:bg-white even:bg-gray-50 w-full">
             <td colspan="10" class="font-bold border border-gray-300 px-4 py-2">Não existem resultados para esta pesquisa.</td>    
            </tr>
         @endif
     </tbody>
 </table>

{{ $events->links() }}

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
