<div>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
 
 <div>
     <div>
         <p>Event List</p>
     </div>
 </div>
 <table>
     <thead>
         <tr>
            <th>Nº</th>
            <th>Nome do Evento</th>
            <th>Participantes</th>            
            <th>Descrição</th>
            <th>Data</th>
            <th>Hora de Ínicio</th>
            <th>Custo Estimado</th>       
            <th>Estado do Evento</th>       
            <th>Ações</th>
         </tr>
     </thead>
     <tbody>
         @foreach($events as $event)
         <tr>
             <td>{{ $loop->iteration }}</td>
             <td>{{ $event->name }}</td>
             <td>{{ @count($event->users) }}</td>
             <td>{{ $event->category->description }}</td>
             <td>{{ date('Y-m-d', strtotime($event->start_date)) }}</td>
             <td>{{ date('H:i', strtotime($event->start_time))}}</td>
             <td>{{ $event->amount }}€</td>
             <td>{{ $event->event_status }}</td>
             <td>
                <a  href="{{ url('event/' . $event->id) }}" >
                    <button>Ver</button>
                </a>
                 <button><a  href="{{ url('event/' . $event->id) }}" ></a>Editar</button>
                 <button
                 @if( $event->event_status != 'ativo') disabled @endif > <a  href="{{ url('event/' . $event->id) }}" ></a>
                 Cancelar
                </button>
             </td>             
            </tr>
         @endforeach
     </tbody>
 </table>
</div>

<div class="pagination-user-list">

</div>
