<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="event-wrapper-participant">
    <h1 class="part-list-title">Lista de Participantes</h1>
</div>
<div class="linha-divisoria-participant-list"></div>

@php
    $firstOption = "Escolha o evento para listar participantes...";
@endphp


        @if(session('status'))
            <div id="success-notification" class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg opacity-0 transform transition-all duration-300 z-50">
                {{ session('status') }}
            </div>
        @endif


        @if(session('error'))
            <div id="success-notification" class="fixed bottom-4 right-4 bg-red-500 text-white p-4 rounded-lg shadow-lg opacity-0 transform transition-all duration-300 z-50">
                {{ session('error') }}
            </div>
        @endif


        @if(session('warning'))
            <div id="success-notification" class="fixed bottom-4 right-4 bg-yellow-500 text-white p-4 rounded-lg shadow-lg opacity-0 transform transition-all duration-300 z-50">
                {{ session('warning') }}
            </div>
        @endif


<form action="/searchEvents" method="POST">
    @csrf
    <div class="search-filter-export">
        <select class="choose-event" id="search" name="search">
            @if(isset($participants) && $participants->users && $participants->users->isNotEmpty() && isset($participants->users))
            @foreach ($events as $event)
                <option value="{{ $event->id }}" {{ request()->input('search') == $event->id ? 'selected' :'' }}>{{ $event->name }}</option>
            @endforeach
        @else
        <option selected>{{ $firstOption }}</option>
        @foreach ($events as $event)
            <option value="{{ $event->id }}" {{ request()->input('search') == $event->id ? 'selected' :'' }}>{{ $event->name }}</option>
        @endforeach
        @endif
        </select>
        <button class="search-participant-btn" type="submit">Search</button>
        @if(isset($participants) && $participants->users && $participants->users->isNotEmpty())
            <form>
                <a class="export-btn" href="{{url('participants/export/' . $participants->id)}}">Export</a>
            </form>
        @endif
    </div>
    <div class="selected-event-info">
        <h5>Participantes no Evento Selecionado<span>
        @if(isset($participants) && $participants->users && $participants->users->isNotEmpty() && isset($participants->users))
            ({{ count($participants->users) }})
        @else
            (0)
        @endif
        </span></h5>
        <h6>
        @if(isset($participants) && $participants->users && $participants->users->isNotEmpty())
            <span>Data:</span> {{ $participants->start_date }} <span>Hora:</span> {{ date('H:i', strtotime($participants->start_time)) }}
        @endif
    </div>
</form>

@if(isset($participants) && $participants->users && $participants->users->isNotEmpty())
<form action="/addParticipant" method="POST" class="add-participant-form">
    @csrf
    <div class="linha-divisoria-participant-list"></div>
    <h1>Adicionar Participante Manualmente</h1>
    <label for="pName">Nome</label>
    <input class="choose-event" id="search" name="pName" style="max-width: 350px"/>
    <label for="pName">Nº Telefone</label>
    <input class="choose-event" id="search" name="phoneNumber" style="max-width: 200px"/>
    <label for="pName">Email</label>
    <input class="choose-event" id="search" name="email" type="email" required style="max-width: 350px" placeholder="exemplo@dominio.com"/>
    <label hidden for="trueId"></label>
    <input hidden name="trueId" id="search" value="{{ $trueId }}"/>
    <button class="search-participant-btn" type="submit">Adicionar Participante</button>
    <div class="linha-divisoria-participant-list"></div>
</form>
@endif

<h1>Adicionar Participante Através de Excel</h1>
<form method="POST" action="{{url('participants/import/' . $event->id )}}" enctype="multipart/form-data" style="margin-top: 10px" class="add-participant-form">
    @csrf
    <div class="submit-excel-file">
        <label>Escolher Ficheiros:</label>
        <input type="file" id="ExcelFile" name="file">
        <input hidden name="event" value="{{ $event->id }}">
        <button class="search-participant-btn">Submeter</button>
    </div>
</form>

<table class="participant-list-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Contacto</th>
            <th>Email</th>
            <th>Confirmação</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="participant-list-table">
        <?php $emailsArray = []; ?>
        @if( !empty($participants) )
        @foreach ($participants->users as $participant)
        <tr>
            <td data-cell="nrº">{{ $loop->iteration }}</td>
            <td data-cell="nome">{{$participant->name}}</td>
            <td data-cell="contacto"><span class="badge badge-soft-success mb-0">{{$participant->phone}}</span></td>
            <td data-cell="email">{{$participant->email}} <?php $emailsArray = $participant->email ?></td>
            <td data-cell="confirmado">@if ($participant->pivot->confirmation) Sim @else Não  @endif</td>
            <td data-cell="ações">
                <div class="action-buttons-participants">
                    <form action="{{ url('participants/' . $participant->id . '/editState') }}" method="GET">
                        <button type="submit" class="edit-participant-btn">
                            <input hidden name="user" value="{{ $participant->id }}">
                            <input hidden name="event" value="{{ $trueId }}">
                            <input hidden name="confirmation" value="{{ $participant->pivot->confirmation }}">
                            <i class="bx bx-pencil"></i>
                        </button>
                    </form>
                    <form action="{{ url('participants/' . $participant->id . '/detachParticipant') }}" method="GET">
                        <button type="submit" class="remove-participant-btn">
                            <input hidden name="user" value="{{ $participant->id }}">
                            <input hidden name="event" value="{{ $trueId }}">
                            <input hidden name="confirmation" value="{{ $participant->pivot->confirmation }}">
                            <i class="bx bx-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

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
            }, 5000);
        }
    });
</script>

@vite('resources/js/orderTable.js')
