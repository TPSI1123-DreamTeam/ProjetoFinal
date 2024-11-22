<div class="flex-1 p-8 overflow-y-auto">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
 
 <div class="container-fluid">
     <div class="d-flex align-items-center">
         <p class="text-sm/6 font-bold text-gray-900">Event List</p>
     </div>
 </div>
 <table class="min-w-full bg-white border mt-5">
     <thead>
         <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Nº</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Nome do Evento</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Participantes</th>            
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Descrição</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Data</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Hora de Ínicio</th>
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Custo Estimado</th>       
            <th class="border border-gray-300 px-4 py-2 text-left font-bold text-gray-700">Estado do Evento</th>       
            <th class="border border-gray-300 px-4 py-2 text-center font-bold text-gray-700">Ações</th>
         </tr>
     </thead>
     <tbody>
         @foreach($events as $event)
         <tr class="odd:bg-white even:bg-gray-50">
             <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ $event->name }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ @count($event->users) }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ $event->category->description }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ date('Y-m-d', strtotime($event->start_date)) }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ date('H:i', strtotime($event->start_time))}}</td>
             <td class="border border-gray-300 px-4 py-2">{{ $event->amount }}€</td>
             <td class="border border-gray-300 px-4 py-2">{{ $event->event_status }}</td>
             <td class="border border-gray-300 px-4 py-2">
                <a  href="{{ url('event/' . $event->id) }}" >
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Ver</button>
                </a>
                 <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full"><a  href="{{ url('event/' . $event->id) }}" ></a>Editar</button>
                 <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                 @if( $event->event_status != 'ativo') disabled @endif > <a  href="{{ url('event/' . $event->id) }}" ></a>Cancelar</button>
             </td>             
            </tr>
         @endforeach
     </tbody>
 </table>
</div>
{{ $events->links() }}