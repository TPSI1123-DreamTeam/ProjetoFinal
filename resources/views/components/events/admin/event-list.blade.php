<div class="event-wrapper">
    <h1>Lista de Eventos</h1>
 </div>
 <div class="linha-divisoria-event-manager"></div>
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
         </tr>
     </thead>
     <tbody>
         @foreach($events as $event)
         <tr>
             <td data-cell="número">{{ $loop->iteration }}</td>
             <td data-cell="nome">{{ $event->name }}</td>
             <td data-cell="participantes">{{ @count($event->users) }}</td>
             <td data-cell="descrição">{{ $event->category->description }}</td>
             <td data-cell="data">{{ date('Y-m-d', strtotime($event->start_date)) }}</td>
             <td data-cell="hora de inicio">{{ date('H:i', strtotime($event->start_time))}}</td>
             <td data-cell="custo estimado">{{ $event->amount }}€</td>
             <td data-cell="estado">{{ $event->event_status }}</td>
         @endforeach
     </tbody>
 </table>

<div class="pagination-user-list">
    {{ $events -> links()}}
</div>
