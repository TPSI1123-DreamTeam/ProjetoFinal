<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
 
<div class="event-wrapper">
    <h1>Lista de Eventos</h1>
 </div>
 <div class="linha-divisoria"></div>
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
             <td>{{ $loop->iteration }}</td>
             <td>{{ $event->name }}</td>
             <td>{{ @count($event->users) }}</td>
             <td>{{ $event->category->description }}</td>
             <td>{{ date('Y-m-d', strtotime($event->start_date)) }}</td>
             <td>{{ date('H:i', strtotime($event->start_time))}}</td>
             <td>{{ $event->amount }}€</td>
             <td>{{ $event->event_status }}</td>
         @endforeach
     </tbody>
 </table>
{{ $events->links() }}
