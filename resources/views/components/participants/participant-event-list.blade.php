<div class="event-wrapper">
    <h1>Lista de Eventos</h1>
 </div>
 <div class="linha-divisoria-event-manager"></div>
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

{{-- <div class="pagination-user-list">
    {{ $events -> links()}}
</div> --}}


 