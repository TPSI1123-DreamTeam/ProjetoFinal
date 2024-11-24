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

<table>
    <thead>
        <tr>
            <th>ID</th>
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
            <td>{{ $event->id }}</td>
            <td>{{ $event->name }}</td>
            <td>{{ @count($event->users) }}</td>
            <td>{{ $event->category->description }}</td>
            <td>{{ date('Y-m-d', strtotime($event->start_date)) }}</td>
            <td>{{ date('H:i', strtotime($event->start_time))}}</td>
            <td>{{ $event->amount }}€</td>
            <td>{{ $event->event_status }}</td>
            <td>
               <a  href="{{ url('events/manager/' . $event->id) }}" >
                   <button class="show-button">Ver</button>
               </a>
               <a  href="{{ url('events/manager/' . $event->id . '/edit') }}" >
                   <button class="edit-button">Editar</button>
               </a>
                <button class="cancel-button"
                @if( $event->event_status != 'ativo') disabled @endif > <a  href="{{ url('event/' . $event->id) }}" ></a>Cancelar</button>
            </td>               
           </tr>
        @endforeach
    </tbody>
</table>

{{ $events->links() }}
